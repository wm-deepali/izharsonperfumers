<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable=[
        'service_category_id',
        'name',
        'name_ar',
        'code',
        'slug',
        'image',
        'status',
       'description',
        'description_ar',
        'variant_options',
        'min_mrp',
        'max_mrp',
        'min_price',
        'max_price',
        'service_time',
    ];
    public function service_options()
    {
        return $this->hasMany(ServiceOption::class,'service_id','id');
    }
    public function service_category()
    {
        return $this->hasOne(ServiceCategory::class,'id','service_category_id');
    }
    
    public static function test($id){
        if($id == null){
            return 'id not Found !';
        }else{
            $daa = ServiceCategory::find($id);
            if($daa){
                return $daa->name;
            }else{
                return 'Service Not Found!';
            }
        }

    }


}
