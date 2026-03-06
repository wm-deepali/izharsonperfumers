<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnAuthCart extends Model
{
    use HasFactory;
    protected $table='unauth_carts';
    protected $fillable = [
        'device_id',
        'coupon_id',
        'total_price',
        'discount_amount',
        'total_price_after_discount',
    ];

      public function cart_details()
    {
        return $this->hasMany(UnAuthCartDetail::class, 'cart_id');
    }
}
