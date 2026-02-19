<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetService extends Model
{
    use HasFactory;
protected $table='fleet_services';
    protected $fillable = [
        'title',
        'title_ar',
        'image',
        'content',
        'content_ar',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_tags',
        'twitter_cards',
        'og_tags',
    ];
}
