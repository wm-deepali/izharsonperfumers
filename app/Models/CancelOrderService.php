<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrderService extends Model
{
    use HasFactory;
    protected $table='cancel_order_services';
     protected $fillable=[
        'order_id','reason_id','service_type','cancellation_reason'
        ];
        
         public function reasons(){
             return $this->belongsTo(Reason::class,'reason_id','id')->select('id','title');
        }
}
