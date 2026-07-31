<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\PendingRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Http;
use App\Services\OtpService;
use App\Jobs\SendRegistrationVerificationMailJob;

class CustomerAuthController extends Controller
{
    protected OtpService $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show Customer Login Page
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

    public function showRegister(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.account-details');
        }

        if ($request->has('redirect')) {
            session(['customer_intended_url' => $request->redirect]);
        }

        return view('customer.auth.register');
    }

    /**
     * Handle registration submission — writes to pending_registrations,
     * branches into mobile OTP (India) or email link (non-India).
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email|unique:pending_registrations,email',
            'country_code' => 'required|string|max:6',
            'mobile_number' => 'required|digits:10|unique:customers,mobile_number|unique:pending_registrations,mobile_number',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
        ]);

        $captcha = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ])->json();

        if (!($captcha['success'] ?? false)) {
            return back()->withErrors(['captcha' => 'Captcha verification failed'])->withInput();
        }

        // clear any stale pending registration with same email/mobile
        PendingRegistration::where('email', $request->email)
            ->orWhere('mobile_number', $request->mobile_number)
            ->delete();

        $isIndia = $request->country_code === '+91';

        $pending = PendingRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'verification_token' => $isIndia ? null : $this->otpService->generateEmailToken(),
            'expires_at' => $isIndia ? Carbon::now()->addMinutes(10) : Carbon::now()->addHours(24),
        ]);

        if ($isIndia) {
            $this->otpService->generateAndSend($request->mobile_number, 'register');
            session(['pending_registration_id' => $pending->id]);
            return redirect()->route('customer.register.verify-otp');
        }

        SendRegistrationVerificationMailJob::dispatch($pending->id);
        session(['pending_registration_id' => $pending->id]);
        return redirect()->route('customer.register.check-email');
    }

    public function showRegisterOtp()
    {
        $pendingId = session('pending_registration_id');
        if (!$pendingId || !PendingRegistration::find($pendingId)) {
            return redirect()->route('customer.register');
        }
        return view('customer.auth.verify-otp', ['purpose' => 'register']);
    }

    public function verifyRegisterOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $pendingId = session('pending_registration_id');
        $pending = PendingRegistration::find($pendingId);
        if (!$pending) {
            return redirect()->route('customer.register')->withErrors(['otp' => 'Session expired, please register again.']);
        }

        if ($pending->isExpired()) {
            $pending->delete();
            return redirect()->route('customer.register')->withErrors(['otp' => 'Registration session expired, please register again.']);
        }

        $result = $this->otpService->verify($pending->mobile_number, 'register', $request->otp);
        if (!$result['success']) {
            return back()->withErrors(['otp' => $result['message']]);
        }

        $customer = Customer::create([
            'name' => $pending->name,
            'email' => $pending->email,
            'country_code' => $pending->country_code,
            'mobile_number' => $pending->mobile_number,
            'password' => $pending->password,
            'mobile_verified_at' => Carbon::now(),
        ]);

        $pending->delete();
        session()->forget('pending_registration_id');

        Auth::guard('customer')->login($customer);
        $this->mergeCartAndRedirect($request, $customer);

        return redirect()->route('customer.account-details')->with('success', 'Registration successful!');
    }

    public function resendRegisterOtp(Request $request)
    {
        $pending = PendingRegistration::find(session('pending_registration_id'));
        if (!$pending) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 422);
        }

        $this->otpService->generateAndSend($pending->mobile_number, 'register');
        return response()->json(['success' => true, 'message' => 'OTP resent.']);
    }

    public function showCheckEmailNotice()
    {
        return view('customer.auth.check-email');
    }

    public function verifyRegisterEmail(string $token, Request $request)
    {
        $pending = PendingRegistration::where('verification_token', $token)->first();

        if (!$pending) {
            return redirect()->route('customer.register')->withErrors(['token' => 'Invalid or already-used verification link.']);
        }

        if ($pending->isExpired()) {
            $pending->delete();
            return redirect()->route('customer.register')->withErrors(['token' => 'Verification link expired, please register again.']);
        }

        $customer = Customer::create([
            'name' => $pending->name,
            'email' => $pending->email,
            'country_code' => $pending->country_code,
            'mobile_number' => $pending->mobile_number,
            'password' => $pending->password,
            'email_verified_at' => Carbon::now(),
        ]);

        $pending->delete();

        Auth::guard('customer')->login($customer);
        $this->mergeCartAndRedirect($request, $customer);

        return redirect()->route('customer.account-details')->with('success', 'Email verified — registration successful!');
    }

    /**
     * AJAX: given a login identifier, tell the frontend which field to show.
     */
    public function checkLoginType(Request $request)
    {
        $request->validate(['login_id' => 'required|string']);
        $value = trim($request->login_id);

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['mode' => 'password']);
        }

        if (preg_match('/^[0-9]{10}$/', $value)) {
            $customer = Customer::where('mobile_number', $value)->first();

            if (!$customer) {
                return response()->json(['mode' => 'not_found']);
            }

            return response()->json([
                'mode' => $customer->country_code === '+91' ? 'otp' : 'password',
            ]);
        }

        return response()->json(['mode' => 'password']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required',
        ]);

        $value = trim($request->login_id);
        $field = filter_var($value, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile_number';

        if (Auth::guard('customer')->attempt([$field => $value, 'password' => $request->password], $request->boolean('remember'))) {
            $customer = Auth::guard('customer')->user();
            $this->mergeCartAndRedirect($request, $customer);

            $redirectUrl = session()->pull('customer_intended_url');
            return redirect($redirectUrl ?? route('customer.account-details'))->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function loginWithOtpRequest(Request $request)
    {
        $request->validate(['login_id' => 'required|digits:10']);

        $customer = Customer::where('mobile_number', $request->login_id)
            ->where('country_code', '+91')
            ->first();

        if (!$customer) {
            return back()->withErrors(['login_id' => 'No account found for this mobile number.']);
        }

        $this->otpService->generateAndSend($customer->mobile_number, 'login');
        session(['login_otp_customer_id' => $customer->id]);

        return redirect()->route('customer.login.verify-otp');
    }

    public function showLoginOtp()
    {
        if (!session('login_otp_customer_id')) {
            return redirect()->route('customer.login');
        }
        return view('customer.auth.verify-otp', ['purpose' => 'login']);
    }

    public function verifyLoginOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $customer = Customer::find(session('login_otp_customer_id'));
        if (!$customer) {
            return redirect()->route('customer.login')->withErrors(['otp' => 'Session expired, please try again.']);
        }

        $result = $this->otpService->verify($customer->mobile_number, 'login', $request->otp);
        if (!$result['success']) {
            return back()->withErrors(['otp' => $result['message']]);
        }

        session()->forget('login_otp_customer_id');
        Auth::guard('customer')->login($customer);
        $this->mergeCartAndRedirect($request, $customer);

        $redirectUrl = session()->pull('customer_intended_url');
        return redirect($redirectUrl ?? route('customer.account-details'))->with('success', 'Login successful');
    }

    public function resendLoginOtp(Request $request)
    {
        $customer = Customer::find(session('login_otp_customer_id'));
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 422);
        }

        $this->otpService->generateAndSend($customer->mobile_number, 'login');
        return response()->json(['success' => true, 'message' => 'OTP resent.']);
    }

    public function checkUserExists(Request $request)
    {
        $response = [];

        if ($request->email) {
            $response['email'] = Customer::where('email', $request->email)->exists()
                || PendingRegistration::where('email', $request->email)->exists();
        }

        if ($request->mobile_number) {
            $response['mobile'] = Customer::where('mobile_number', $request->mobile_number)->exists()
                || PendingRegistration::where('mobile_number', $request->mobile_number)->exists();
        }

        return response()->json($response);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login')->with('success', 'Logged out successfully');
    }

    protected function mergeCartAndRedirect(Request $request, Customer $customer): void
    {
        $deviceId = $request->device_id ?? session('device_id');
        CartController::mergeGuestCart($customer->id, $deviceId);
    }
}