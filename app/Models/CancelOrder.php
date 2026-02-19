<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;
    protected $table='cancel_orders';
    protected $fillable=[
        'order_id','reason_id','request_id','cancelled_by','cancellation_reason','cancellation_reason_admin'
        ];
        public function reasons(){
             return $this->belongsTo(Reason::class,'reason_id','id')->select('id','title','type','category');
        }
         public function order(){
             return $this->belongsTo(Order::class,'order_id','id');
        }
        
}
