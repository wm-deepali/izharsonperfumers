<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\GeneralSetting;
use App\Models\HeaderSetting;
use App\Models\EmailSetting;
use Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\AdminOrderMail;
use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $orders = Order::where('sendmailstatus',0)->get();
        if(isset($orders)){
            $admin= User::first();
        foreach($orders as $order){
            $customer = Customer::where('id',$order->customer_id)->first();
            $datas=array('email' => $customer->email,
                'mobile_number'=>$customer->mobile_number,
                'name' => $customer->name,
                'order_id'=>$order->order_number,
                'pdf_url'=>url('storage').$order->invoice_url,
                'order'=>$order,
                
                );
                try{
            Mail::to($customer->email)->send(new OrderMail($datas));
              Mail::to($admin->alert_email)->send(new AdminOrderMail($datas));  
              Order::where('id',$order->id)->update(['sendmailstatus'=>1]); 
                }catch(\Exception $e){
                    
                }
               
        // dispatch(new \App\Jobs\SendEmailJob($customer->email,$datas,$admin->alert_email));
        
        }
        }
        $mail=EmailSetting::first();
        $data=[
                    'driver'     => $mail->mailer,
                    'host'       => $mail->host,
                    'port'       => $mail->port,
                    'from'       => array('address' => $mail->mail_from, 'name' => $mail->name),
                    'encryption' => $mail->encryption,
                    'username'   => $mail->username,
                    'password'   => $mail->password,
                    // 'sendmail'   => '/usr/sbin/sendmail -bs',
                    // 'pretend'    => false,
            
            ];
            Config::set('mail',$data);
        // $data = GeneralSetting::first();
        // $path = base_path('.env');
            
        //     if (file_exists($path)) {
        //     file_put_contents($path, str_replace(
        //         'MAIL_MAILER='.env('MAIL_MAILER'), 'MAIL_MAILER='.$mail->mailer, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_HOST='.env('MAIL_HOST'), 'MAIL_HOST='.$mail->host, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_PORT='.env('MAIL_PORT'), 'MAIL_PORT='.$mail->port, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_USERNAME='.env('MAIL_USERNAME'), 'MAIL_USERNAME='.$mail->username, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_PASSWORD='.env('MAIL_PASSWORD'), 'MAIL_PASSWORD='.$mail->password, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_ENCRYPTION='.env('MAIL_ENCRYPTION'), 'MAIL_ENCRYPTION='.$mail->encryption, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'MAIL_FROM_ADDRESS='.env('MAIL_FROM_ADDRESS'), 'MAIL_FROM_ADDRESS='.$mail->mail_from, file_get_contents($path)
        //     ));
        //     file_put_contents($path, str_replace(
        //         'APP_NAME='.env('APP_NAME'), 'APP_NAME='.$mail->name, file_get_contents($path)
        //     ));
        //     }
        // env('APP_LANGUAGE='.$data->lan_ar);
        Schema::defaultStringLength(191);
        view()->composer('*',function($view) {   
            $data = GeneralSetting::first();
            $datah = HeaderSetting::first();
            $language = $data->lan_ar;
            $view->with('language',$language );
            $view->with('headerdata',$datah );
    });
         }
}
