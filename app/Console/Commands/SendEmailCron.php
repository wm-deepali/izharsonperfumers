<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Mail\AdminOrderMail;

class SendEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendemail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin= User::first();
        $orders = Order::where('sendmailstatus',0)->get();
        foreach($orders as $order){
            $customer = Customer::where('id',$order->customer_id)->first();
            $datas=array('email' => $customer->email,
                'mobile_number'=>$customer->mobile_number,
                'name' => $customer->name,
                'order_id'=>$order->order_number,
                'pdf_url'=>url('storage').$order->invoice_url,
                'order'=>$order,
                
                );
                
              Mail::to($customer->email)->send(new OrderMail($datas));
              Mail::to($admin->alert_email)->send(new AdminOrderMail($datas));  
              Order::where('id',$order->id)->update(['sendmailstatus'=>1]);
        // dispatch(new \App\Jobs\SendEmailJob($customer->email,$datas,$admin->alert_email));
        
        }
        
    }
}
