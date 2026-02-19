<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRefund extends Model
{
    use HasFactory;
    protected $table='order_refunds';
    protected $fillable=[
        'order_id','transaction_id','refunded_amount','refunded_date'
        ];
}
