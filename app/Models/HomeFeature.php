<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFeature extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'position',
        'status'
    ];
}
