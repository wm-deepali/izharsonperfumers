<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_ar',
        'url',
        'image',
        'content',
        'content_ar',
        'author',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_tags',
        'twitter_cards',
        'og_tags',
    ];
}
