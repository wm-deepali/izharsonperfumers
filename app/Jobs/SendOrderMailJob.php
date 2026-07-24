<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use App\Mail\OrderMail;
use App\Mail\AdminOrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Cache;
use Config;

class SendOrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(public int $orderId) {}

   public function handle(): void
{
    $order = Order::find($this->orderId);
    if (!$order || $order->sendmailstatus == 1) return;

    $customer = Customer::find($order->customer_id);
    if (!$customer) return;

    $admin = User::first();
    $data = [
        'email'         => $customer->email,
        'mobile_number' => $customer->mobile_number,
        'name'          => $customer->name,
        'order_id'      => $order->order_number,
        'pdf_url'       => url('storage') . $order->invoice_url,
        'order'         => $order,
    ];

    $mail = EmailSetting::first();
    if ($mail) {
        Config::set('mail.default', $mail->mailer);
        Config::set('mail.mailers.smtp.transport', $mail->mailer);
        Config::set('mail.mailers.smtp.host', $mail->host);
        Config::set('mail.mailers.smtp.port', $mail->port);
        Config::set('mail.mailers.smtp.username', $mail->username);
        Config::set('mail.mailers.smtp.password', $mail->password);
        Config::set('mail.mailers.smtp.encryption', $mail->encryption);
        Config::set('mail.from.address', $mail->mail_from);
        Config::set('mail.from.name', $mail->name);
    }

    try {
        Mail::to($customer->email)->send(new OrderMail($data));
        if ($admin) {
            Mail::to($admin->alert_email)->send(new AdminOrderMail($data));
        }
        $order->update(['sendmailstatus' => 1]);
    } catch (\Throwable $e) {
        \Log::error('Mail send failed for order ' . $order->id . ': ' . $e->getMessage());
        throw $e; // taaki job retry ho aur failed() bhi trigger ho
    }
}

    public function failed(\Throwable $e): void
    {
        \Log::error('Order mail job failed for order ' . $this->orderId . ': ' . $e->getMessage());
    }
}