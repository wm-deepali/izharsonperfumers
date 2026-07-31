<?php

namespace App\Services;

use App\Models\OtpVerification;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OtpService
{
    protected SmsOtpService $sms;

    public function __construct(SmsOtpService $sms)
    {
        $this->sms = $sms;
    }

    public function generateAndSend(string $mobileNumber, string $purpose): OtpVerification
    {
        // invalidate any previous unverified OTPs for this identifier+purpose
        OtpVerification::where('identifier', $mobileNumber)
            ->where('purpose', $purpose)
            ->whereNull('verified_at')
            ->delete();

        $otp = (string) random_int(100000, 999999);

        $record = OtpVerification::create([
            'identifier' => $mobileNumber,
            'otp_code' => $otp,
            'purpose' => $purpose,
            'attempts' => 0,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);

        $this->sms->send($mobileNumber, $otp, $purpose);

        return $record;
    }

    public function verify(string $mobileNumber, string $purpose, string $otpInput): array
    {
        $record = OtpVerification::where('identifier', $mobileNumber)
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