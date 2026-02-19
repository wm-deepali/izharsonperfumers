<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellOrderImage extends Model
{
    use HasFactory;
     protected $table='cancell_order_image';
    protected $fillable=[
        'cancell_id','image'
        ];
}
