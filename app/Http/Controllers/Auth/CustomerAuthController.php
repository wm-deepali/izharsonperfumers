<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Http;

class CustomerAuthController extends Controller
{
    /**
     * Show Customer Login Page
     */
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.account-details');
        }

        return view('customer.auth.login');
    }

    /**
     * Show Customer Register Page
     */
    public function showRegister()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.account-details');
        }

        return view('customer.auth.register');
    }

    /**
     * Register Customer
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'mobile_number' => 'required|digits:10|unique:customers,mobile_number',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required'
        ]);

        // Verify captcha
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!$result['success']) {
            return back()->withErrors(['captcha' => 'Captcha verification failed'])->withInput();
        }


        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
        ]);

        // auto login after register
        Auth::guard('customer')->login($customer);

        // ⭐ merge guest cart
        $deviceId = $request->device_id ?? session('device_id');

        CartController::mergeGuestCart($customer->id, $deviceId);

        return redirect()->route('customer.account-details')
            ->with('success', 'Registration successful!');
    }

    public function checkUserExists(Request $request)
    {
        $response = [];

        if ($request->email) {
            $response['email'] = Customer::where('email', $request->email)->exists();
        }

        if ($request->mobile_number) {
            $response['mobile'] = Customer::where('mobile_number', $request->mobile_number)->exists();
        }

        return response()->json($response);
    }
    /**
     * Customer Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt($request->only('email', 'password'), $request->remember)) {

            $customer = Auth::guard('customer')->user();

            $deviceId = $request->device_id ?? session('device_id');

            CartController::mergeGuestCart($customer->id, $deviceId);

            return redirect()->route('customer.account-details')
                ->with('success', 'Login successful');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password'
        ])->withInput();
    }
    /**
     * Logout Customer
     */
    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('customer.login')
            ->with('success', 'Logged out successfully');
    }

}