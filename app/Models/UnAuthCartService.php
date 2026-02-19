<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnAuthCartService extends Model
{
    use HasFactory;
    protected $table = 'unauth_cart_services';
    protected $fillable = [
        'device_id',
        'coupon_id',
        'total_price',
        'discount_amount',
        'total_price_after_discount',
    ];

}
