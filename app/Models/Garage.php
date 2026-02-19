<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_ar',
        'url',
        'image',
        'content',
        'content_ar',
        'status'
    ];
}
