<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCAvenue extends Model
{
    use HasFactory;
protected $table = 'ccavenue';
    protected $fillable = [
        'user_id',
        'billing_id',
        'shipping_id',
        'shipping_type',
        'payment_mode',
        'paymentid',
        'iscountryindia',
        'order_id',
        'transaction_id',
        'amount',
        'status',
        'payment_status'
    ];
}
