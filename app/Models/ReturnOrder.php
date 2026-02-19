<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrder extends Model
{
    use HasFactory;
     protected $table='return_orders';
    protected $fillable=[
        'order_id','order_detail_id','request_id','reason_id','return_reason','return_date'
        ];
        
         public function images(){
            return $this->hasMany(ReturnOrderImage::class,'return_id','id');
        }
        
         public function reasons(){
             return $this->belongsTo(Reason::class,'reason_id','id')->select('id','title','category');
        }
        
         public function order(){
             return $this->belongsTo(Order::class,'order_id','id');
        }
}
