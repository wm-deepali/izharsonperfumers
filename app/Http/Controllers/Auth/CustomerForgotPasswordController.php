<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\User;

class CustomerForgotPasswordController extends Controller
{
    /**
     * Show forgot password page
     */
    public function showForm()
    {
        return view('customer.auth.forgot-password');
    }

    /**
     * Send reset password link
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $admin = User::first();

        Mail::send(
            'email.forgetpassword',
            [
                'url' => route('customer.password.reset', $token),
            ],
            function ($message) use ($request, $admin) {
                $message->to($request->email);
                if ($admin && $admin->alert_email) {
                    $message->cc($admin->alert_email);
                }
                $message->subject('Reset Password');
            }
        );

        return back()->with('success', 'We have emailed your password reset link!');
    }

    /**
     * Show reset password page
     */
    public function showResetForm($token)
    {
        return view('customer.auth.reset-password', compact('token'));
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $record = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['Invalid or expired token']);
        }

        Customer::where('email', $record->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('token', $request->token)->delete();

        return redirect()->route('customer.login')
            ->with('success', 'Password changed successfully. Please login.');
    }
}