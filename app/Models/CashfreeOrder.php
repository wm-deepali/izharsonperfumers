<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashfreeOrder extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'link_id', 'cf_link_url',
        'amount', 'payment_status', 'status',
    ];
}