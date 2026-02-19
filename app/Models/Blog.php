<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class Blog extends Model
{
    use HasFactory,Metable;

    protected $fillable = [
        'title',
        'url',
        'image',
        'content',
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
