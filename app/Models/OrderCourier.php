<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCourier extends Model
{
    use HasFactory;
    protected $table="order_courier";
    protected $fillable=[
        'awb_number','courier_name','date','delivery_date','order_id','tracking_url'
        ];
}
