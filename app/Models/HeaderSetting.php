<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class HeaderSetting extends Model
{
    use HasFactory,Metable;

     protected $fillable = [      
        'email',
        'show_in_header_email',
        'show_in_footer_email',
        'tollfree_number',
        'show_in_header_tollfree_number',
        'show_in_footer_tollfree_number',
        'show_in_header_other_number',      
        'show_in_footer_other_number',      
        'show_in_header_coupon_code',      
        'show_in_footer_coupon_code',      
        'show_in_header_whatsapp_number',      
        'show_in_footer_whatsapp_number',      
        'whatsapp_number',      
        'other_number',      
        'coupon_code',      
        'header_logo',      
        'footer_logo',      
        'favicon',      
        'short_description',      
        'address',      
    ];
    
}
