<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'coupon_id',
        'total_price',
        'pre_discount',
        'discount_amount',
        'total_price_after_discount',
    ];

    protected $casts = [
        'total_price' => 'string',
        'pre_discount' => 'string',
        'total_price_after_discount' => 'string',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function cart_details()
    {
        return $this->hasMany(CartDetail::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    // total items quantity (badge count)
    public function getItemsCountAttribute()
    {
        return $this->cart_details()->sum('quantity');
    }
}
