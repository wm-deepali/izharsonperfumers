<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Laravel\Socialite\Two\InvalidStateException;

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
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('customer.login')
                ->with('error', 'Google login session expired, please try again.');
        } catch (\Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage());
            return redirect()->route('customer.login')
                ->with('error', 'Could not sign in with Google, please try again.');
        }

        $email = $googleUser->getEmail();

        if (!$email) {
            return redirect()->route('customer.login')
                ->with('error', 'Your Google account did not share an email address.');
        }

        $customer = Customer::where('email', $email)->first();

        if (!$customer) {
            $customer = Customer::create([
                'name' => $googleUser->getName() ?: 'Guest User',
                'email' => $email,
                'google_id' => $googleUser->getId(),
                'password' => Hash::make((string) rand(100000, 999999)),
                'email_verified_at' => Carbon::now(),
            ]);
        } elseif (!$customer->google_id || !$customer->email_verified_at) {
            $customer->update([
                'google_id' => $customer->google_id ?: $googleUser->getId(),
                'email_verified_at' => $customer->email_verified_at ?: Carbon::now(),
            ]);
        }

        Auth::guard('customer')->login($customer);

        // merge guest cart same as normal login/register flow
        $deviceId = $request->device_id ?? session('device_id');
        CartController::mergeGuestCart($customer->id, $deviceId);

        $redirectUrl = session()->pull('customer_intended_url');

        return redirect($redirectUrl ?? route('customer.account-details'))
            ->with('success', 'Logged in with Google');
    }
}