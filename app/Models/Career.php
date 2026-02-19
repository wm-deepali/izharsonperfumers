<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
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
