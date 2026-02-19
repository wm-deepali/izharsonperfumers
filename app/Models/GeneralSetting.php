<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'email',
        'mobile_number',
        'whatsapp_number',
        'map',
        'address',
        'address_ar',
        'cod',
        // 'city_id',
        // 'state_id',
        // 'country_id',
        // 'header_logo',
        // 'footer_logo',
        // 'footer_content',
        // 'facebook',
        // 'twitter',
        // 'instagram',
        // 'youtube',
        // 'cgst_percentage',
        // 'sgst_percentage',
        // 'igst_percentage',
    ];
}
