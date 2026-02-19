<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
    use HasFactory;
    protected $tables='book_appointments';
    protected $fillable=[
            'name',
            'mobile_number',
            'email',
            'carmake',
            'carmodel',
            'fuel_type',
            'description'

    ];
}
