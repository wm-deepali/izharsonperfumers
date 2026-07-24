<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAdminSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 2;

    public function __construct(
        public string $name,
        public string $email,
        public string $mobile,
        public float $amount
    ) {}

    public function handle(): void
    {
        $message = "Received an order from {$this->name}, Mob: {$this->mobile}, and Email: {$this->email} today, Billed Amount {$this->amount}, \nThanks & Regards \nIzharsons Perfumers";

        $dlt_id = '1307175755306351640';
        $pe_id = '1301169510661908409';
        $params = [
            'authkey' => '468706Au6g3Hg7oQKn68c3a8c6P1',
            'mobiles' => '8188983264',
            'sender'  => 'IZHARS',
            'message' => urlencode($message),
            'route'   => '4',
            'country' => '91',
        ];
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($params as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }
        $url .= 'DLT_TE_ID=' . $dlt_id . '&PE_ID=' . $pe_id;
        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            \Log::error('Admin SMS failed: ' . $e->getMessage());
        }
    }
}