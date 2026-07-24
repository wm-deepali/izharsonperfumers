<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use App\Models\GeneralSetting;
use App\Models\HeaderSetting;
use App\Models\EmailSetting;
use Config;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

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

        view()->composer('*', function ($view) {
            $data  = Cache::remember('general_settings', 3600, fn() => GeneralSetting::first());
            $datah = Cache::remember('header_settings', 3600, fn() => HeaderSetting::first());

            $view->with('language', $data->lan_ar ?? null);
            $view->with('headerdata', $datah);
        });
    }
}