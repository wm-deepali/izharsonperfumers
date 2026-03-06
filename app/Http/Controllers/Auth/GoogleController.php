<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $customer = Customer::where('email', $googleUser->getEmail())->first();

        if (!$customer) {
            $customer = Customer::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(rand(100000,999999)),
                'is_email_verified' => 1,
            ]);
        }

        Auth::guard('customer')->login($customer);

        return redirect('/')->with('success','Logged in with Google');
    }
}