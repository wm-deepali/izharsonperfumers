<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cylinder extends Model
{
    use HasFactory;
    protected $table='cylinders';
     protected $fillable = [
        'title',
        'status',
    ];
}
