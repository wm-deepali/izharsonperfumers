<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect(Request $request)
    {
        if ($request->has('redirect')) {
            session(['customer_intended_url' => $request->redirect]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $customer = Customer::where('email', $googleUser->getEmail())->first();

        if (!$customer) {
            $customer = Customer::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(rand(100000, 999999)),
                'is_email_verified' => 1,
            ]);
        }

        Auth::guard('customer')->login($customer);

        // merge guest cart same as normal login/register flow
        $deviceId = $request->device_id ?? session('device_id');
        CartController::mergeGuestCart($customer->id, $deviceId);

        $redirectUrl = session()->pull('customer_intended_url');

        return redirect($redirectUrl ?? '/')
            ->with('success', 'Logged in with Google');
    }
}