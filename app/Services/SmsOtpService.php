<?php

namespace App\Services;

class SmsOtpService
{
    public function send(string $mobileNumber, string $otp, string $purpose = 'register'): bool
    {
        $message = "{$otp} is the OTP to verify your mobile number at https://izharsonperfumers.com, please do not share this OTP with anyone. Regards Izharson Perfumers";

        $requestParameters = [
            'authkey' => config('services.sms.auth_key'),
            'mobiles' => $mobileNumber,
            'sender' => config('services.sms.sender'),
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
        ];

        $url = config('services.sms.base_url') . '?';
        foreach ($requestParameters as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }
        $url .= 'DLT_TE_ID=' . config('services.sms.dlt_te_id') . '&PE_ID=' . config('services.sms.pe_id');
        $url = rtrim($url, '&');

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $output = curl_exec($ch);
            curl_close($ch);

            return $output !== false;
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }
}