<?php

namespace App\Services;

use App\Models\OtpVerification;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService
{
    protected SmsOtpService $sms;

    public function __construct(SmsOtpService $sms)
    {
        $this->sms = $sms;
    }

    public function generateAndSend(string $identifier, string $purpose): OtpVerification
    {
        // invalidate any previous unverified OTPs for this identifier+purpose
        OtpVerification::where('identifier', $identifier)
            ->where('purpose', $purpose)
            ->whereNull('verified_at')
            ->delete();

        $otp = (string) random_int(100000, 999999);

        $record = OtpVerification::create([
            'identifier' => $identifier,
            'otp_code' => $otp,
            'purpose' => $purpose,
            'attempts' => 0,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            Mail::to($identifier)->send(new OtpMail($otp, $purpose));
        } else {
            $this->sms->send($identifier, $otp, $purpose);
        }

        return $record;
    }

    public function verify(string $identifier, string $purpose, string $otpInput): array
    {
        $record = OtpVerification::where('identifier', $identifier)
            ->where('purpose', $purpose)
            ->whereNull('verified_at')
            ->latest()
            ->first();
        if (!$record) {
            return ['success' => false, 'message' => 'No OTP request found. Please request a new one.'];
        }

        if ($record->isExpired()) {
            return ['success' => false, 'message' => 'OTP has expired. Please request a new one.'];
        }

        if ($record->attempts >= OtpVerification::MAX_ATTEMPTS) {
            return ['success' => false, 'message' => 'Too many attempts. Please request a new OTP.'];
        }

        if ($record->otp_code !== $otpInput) {
            $record->increment('attempts');
            return ['success' => false, 'message' => 'Invalid OTP.'];
        }

        $record->update(['verified_at' => Carbon::now()]);

        return ['success' => true, 'message' => 'OTP verified.'];
    }

    public function generateEmailToken(): string
    {
        return Str::random(48);
    }
}