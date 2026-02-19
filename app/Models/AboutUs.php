<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class AboutUs extends Model
{
    use HasFactory,Metable;

    protected $fillable = [
        'id',
        'title',
        'title_ar',
        'image',
        'content',
        'content_ar',
        'description',
    ];
}
