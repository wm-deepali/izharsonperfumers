<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServiceBookings extends Model
{
    use HasFactory;

    protected $table = 'service_booking';

    protected $fillable=[
        'customer_id',
        'service_id',
        'description',
        'status'
    ];

public function customers(){
    return $this->hasOne(Customer::class,'customer_id','id');
}
    public static function GetUserName($id){
        if($id == null){
            return 'id not Found !';
        }else{
            $daa = Customer::find($id);
            if($daa){
                return $daa->name;
            }else{
                return 'Username Not Found!';
            }
        }

    }


    public static function GetServiceCatName($id){
        if($id == null){
            return 'id not Found !';
        }else{
            $daa = Services::find($id);
            if($daa){
                return $daa->name;
            }else{
                return 'Service Not Found!';
            }
        }

    }


}
