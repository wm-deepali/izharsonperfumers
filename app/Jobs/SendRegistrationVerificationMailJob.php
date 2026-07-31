<?php

namespace App\Jobs;

use App\Models\PendingRegistration;
use App\Models\EmailSetting;
use App\Mail\RegistrationVerificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Config;

class SendRegistrationVerificationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(public int $pendingRegistrationId) {}

    public function handle(): void
    {
        $pending = PendingRegistration::find($this->pendingRegistrationId);
        if (!$pending) return;

        $data = [
            'name' => $pending->name,
            'verification_url' => route('customer.register.verify-email', ['token' => $pending->verification_token]),
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
            Mail::to($pending->email)->send(new RegistrationVerificationMail($data));
        } catch (\Throwable $e) {
            \Log::error('Registration verification mail failed for pending id ' . $pending->id . ': ' . $e->getMessage());
            throw $e;
        }
    }

    public function failed(\Throwable $e): void
    {
        \Log::error('Registration verification mail job failed for pending id ' . $this->pendingRegistrationId . ': ' . $e->getMessage());
    }
}