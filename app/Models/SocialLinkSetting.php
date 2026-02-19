<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinkSetting extends Model
{
    use HasFactory;
     protected $fillable = [      
        'fb_name',
        'twit_name',
        'insta_name',
        'linkedin_name',
        'youtube_name',
        'show_in_header_fb',
        'show_in_footer_fb',
        'show_in_header_twit',
        'show_in_footer_twit',
        'show_in_header_insta',
        'show_in_footer_insta',
        'show_in_header_linkedin',
        'show_in_footer_linkedin',
        'show_in_header_youtube',
        'show_in_footer_youtube',
         
    ];
}
