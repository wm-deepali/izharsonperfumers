<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $tables='teams';
    protected $fillable=[
        'name',
        'name_ar',
        'designation',
        'designation_ar',
        'image',
    ];
}
