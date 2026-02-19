<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrderImage extends Model
{
    use HasFactory;
     protected $table='return_order_images';
    protected $fillable=[
        'return_id','image'
        ];
}
