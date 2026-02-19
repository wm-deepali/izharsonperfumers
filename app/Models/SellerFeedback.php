<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerFeedback extends Model
{
    use HasFactory;
    protected $table='seller_feedbacks';
    protected $fillable=[
        'order_id','order_detail_id','rating','review'
        ];
}
