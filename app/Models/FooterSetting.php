<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;
     protected $fillable = [      
        'email',
        'mobile_number',
        'short_desc_ar',
        'footer_logo',
        'whatsapp_number',
        'coupon_code',
        'short_description',      
    ];
}
