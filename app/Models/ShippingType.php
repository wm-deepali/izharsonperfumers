<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'maximum_days',
        'price',
        'minimum_cart_price',
        'status',
    ];

    public function pincodes() {
        return $this->belongsToMany(Pincode::class, 'shipping_type_pincodes');
    }
}
