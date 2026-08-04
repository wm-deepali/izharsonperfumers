<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PendingRegistration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\CartController;
use App\Services\OtpService;
use Illuminate\Support\Str;


class CustomerAuthController extends Controller
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Single Sign-In / Sign-Up page.
     */
    public function showLogin(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.account-details');
        }

        if ($request->has('redirect')) {
            session(['customer_intended_url' => $request->redirect]);
        }

        return view('customer.auth.login');
    }

    /**
     * AJAX: given a login identifier, tell the frontend which mode to show.
     * - mobile (10 digits) -> always 'otp' (login or implicit registration)
     * - existing email     -> 'password'
     * - new email          -> 'otp' (implicit registration via email OTP)
     */
    public function checkLoginType(Request $request)
    {
        $request->validate(['login_id' => 'required|string']);
        $value = trim($request->login_id);

        if (preg_match('/^[0-9]{10}$/', $value)) {
            return response()->json(['mode' => 'otp']);
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $exists = Customer::where('email', $value)->exists();
            return response()->json(['mode' => $exists ? 'password' : 'otp']);
        }

        return response()->json(['mode' => 'invalid']);
    }

    /**
     * Password login — existing email/password customers only.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|email',
            'password' => 'required',
        ]);

        if (
            Auth::guard('customer')->attempt(
                ['email' => $request->login_id, 'password' => $request->password],
                $request->boolean('remember')
            )
        ) {
            $customer = Auth::guard('customer')->user();
            $this->mergeCartAndRedirect($request, $customer);

            return redirect($this->resolveRedirect())->with('success', 'Login successful');
        }

        return back()->withErrors(['login_id' => 'Invalid credentials'])->withInput();
    }

    /**
     * AJAX: request OTP. Handles both mobile numbers and brand-new emails —
     * covers login (existing mobile) and implicit registration (new mobile
     * or new email) with one endpoint.
     */
    public function requestOtp(Request $request)
    {
        $request->validate(['login_id' => 'required|string']);
        $value = trim($request->login_id);

        if (preg_match('/^[0-9]{10}$/', $value)) {
            return $this->requestMobileOtp($value);
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $this->requestEmailOtp($value);
        }

        return response()->json(['success' => false, 'message' => 'Enter a valid mobile number or email.'], 422);
    }

    protected function requestMobileOtp(string $mobile)
    {
        $customer = Customer::where('mobile_number', $mobile)
            ->where('country_code', '+91')
            ->first();

        if ($customer) {
            $this->otpService->generateAndSend($mobile, 'login');
            session()->forget('pending_registration_id');
            session(['login_otp_customer_id' => $customer->id]);
            return response()->json(['success' => true]);
        }

        // Brand-new number — clear any stale pending row and start fresh.
        PendingRegistration::where('mobile_number', $mobile)->delete();

        $pending = PendingRegistration::create([
            'mobile_number' => $mobile,
            'country_code' => '+91',
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $this->otpService->generateAndSend($mobile, 'register');
        session()->forget('login_otp_customer_id');
        session(['pending_registration_id' => $pending->id]);

        return response()->json(['success' => true]);
    }

    protected function requestEmailOtp(string $email)
    {
        if (Customer::where('email', $email)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This email is already registered — please login with your password.',
            ], 422);
        }

        // Brand-new email — clear any stale pending row and start fresh.
        PendingRegistration::where('email', $email)->delete();

        $pending = PendingRegistration::create([
            'email' => $email,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $this->otpService->generateAndSend($email, 'register');
        session()->forget('login_otp_customer_id');
        session(['pending_registration_id' => $pending->id]);

        return response()->json(['success' => true]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        // Case 1: existing customer logging in via mobile OTP.
        if ($customerId = session('login_otp_customer_id')) {
            $customer = Customer::find($customerId);
            if (!$customer) {
                return $this->otpFailResponse($request, 'Session expired, please try again.', true);
            }

            $result = $this->otpService->verify($customer->mobile_number, 'login', $request->otp);
            if (!$result['success']) {
                return $this->otpFailResponse($request, $result['message']);
            }

            session()->forget('login_otp_customer_id');
            Auth::guard('customer')->login($customer);
            $this->mergeCartAndRedirect($request, $customer);

            return $this->otpSuccessResponse($request, $this->resolveRedirect(), 'Login successful');
        }

        // Case 2: brand-new mobile number OR email — implicit registration.
        $pending = PendingRegistration::find(session('pending_registration_id'));

        if (!$pending) {
            return $this->otpFailResponse($request, 'Session expired, please try again.', true);
        }

        if ($pending->isExpired()) {
            $pending->delete();
            return $this->otpFailResponse($request, 'OTP session expired, please try again.', true);
        }

        $identifier = $pending->mobile_number ?: $pending->email;
        $result = $this->otpService->verify($identifier, 'register', $request->otp);
        if (!$result['success']) {
            return $this->otpFailResponse($request, $result['message']);
        }

        $customer = $pending->mobile_number
            ? Customer::create([
                'name' => 'Guest User',
                'country_code' => $pending->country_code,
                'mobile_number' => $pending->mobile_number,
                'mobile_verified_at' => Carbon::now(),
            ])
            : Customer::create([
                'name' => 'Guest User',
                'email' => $pending->email,
                'email_verified_at' => Carbon::now(),
            ]);

        $pending->delete();
        session()->forget('pending_registration_id');

        Auth::guard('customer')->login($customer);
        $this->mergeCartAndRedirect($request, $customer);

        return $this->otpSuccessResponse($request, $this->resolveRedirect(), 'Welcome!');
    }

    /**
     * AJAX callers (the inline OTP box on the login page) get JSON with a
     * redirect_url; a plain form POST (JS-disabled fallback) still gets a
     * normal redirect.
     */
    protected function otpSuccessResponse(Request $request, string $redirectUrl, string $message)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'redirect_url' => $redirectUrl, 'message' => $message]);
        }

        return redirect($redirectUrl)->with('success', $message);
    }

    protected function otpFailResponse(Request $request, string $message, bool $redirectToLogin = false)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'redirect_to_login' => $redirectToLogin,
            ], 422);
        }

        if ($redirectToLogin) {
            return redirect()->route('customer.login')->withErrors(['otp' => $message]);
        }

        return back()->withErrors(['otp' => $message]);
    }
    public function resendOtp(Request $request)
    {
        if ($customerId = session('login_otp_customer_id')) {
            $customer = Customer::find($customerId);
            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Session expired.'], 422);
            }
            $this->otpService->generateAndSend($customer->mobile_number, 'login');
            return response()->json(['success' => true, 'message' => 'OTP resent.']);
        }

        $pending = PendingRegistration::find(session('pending_registration_id'));
        if (!$pending) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 422);
        }

        $this->otpService->generateAndSend($pending->mobile_number ?: $pending->email, 'register');
        return response()->json(['success' => true, 'message' => 'OTP resent.']);
    }

    /** Optional live-check, still handy for the email field. */
    public function checkUserExists(Request $request)
    {
        $response = [];

        if ($request->email) {
            $response['email'] = Customer::where('email', $request->email)->exists()
                || PendingRegistration::where('email', $request->email)->exists();
        }

        return response()->json($response);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login')->with('success', 'Logged out successfully');
    }

    /**
     * Where to send the user after ANY successful auth:
     * back to checkout if that's where they came from, else the dashboard.
     */
    protected function resolveRedirect(): string
    {
        return session()->pull('customer_intended_url') ?? route('customer.account-details');
    }

    protected function mergeCartAndRedirect(Request $request, Customer $customer): void
    {
        $deviceId = $request->device_id ?? session('device_id');
        CartController::mergeGuestCart($customer->id, $deviceId);
    }
}