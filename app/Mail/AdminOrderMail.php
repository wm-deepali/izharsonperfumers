<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $mail = $this->subject('New Order ID #' . $this->data['order_id'])
                     ->markdown('email.adminorderemail', ['data' => $this->data]);

        if (!empty($this->data['invoice_path']) && file_exists($this->data['invoice_path'])) {
            $mail->attach($this->data['invoice_path'], [
                'as'   => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}