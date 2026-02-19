<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilGrade extends Model
{
    use HasFactory;
    protected $table='oil_grades';
     protected $fillable = [
        'title',
        'status',
    ];
}
