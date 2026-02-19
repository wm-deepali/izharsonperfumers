<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartService extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'coupon_id',
        'total_price',
        'discount_amount',
        'total_price_after_discount',
    ];

    // public function customer() {
    //     return $this->belongsTo(Customer::class);
    // }

    // public function coupon() {
    //     return $this->belongsTo(Coupon::class);
    // }

    // public function cart_details(){
    //     return $this->hasMany(CartDetail::class);
    // }
}
