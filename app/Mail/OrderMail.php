<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $mail = $this->subject('Order Confirmed')
                     ->markdown('email.orderemail', ['data' => $this->data]);

        // $this->data['invoice_path'] should be a LOCAL storage path, not a URL
        if (!empty($this->data['invoice_path']) && file_exists($this->data['invoice_path'])) {
            $mail->attach($this->data['invoice_path'], [
                'as'   => 'invoice.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}