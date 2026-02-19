<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code',
        'description',
        'discount_type',
        'discount_amount',
        'maximum_discount',
        'start_date',
        'end_date',
        'subtotal_start',
        'subtotal_end',
        'limit_use',
        'number_of_use',
        'categories',
        'products',
        'status',
    ];
}
