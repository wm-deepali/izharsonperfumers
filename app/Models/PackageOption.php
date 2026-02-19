<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
    use HasFactory;
    protected $table='packages_options';
    protected $fillable = [
        'package_id',
        'carorigin_id',
        'category_id',
        'oilgrade_id',
        'cylinder_id',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'default_price'
    ];

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }

    public function carmake(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function carmodel(){
        return $this->hasOne(BrandModel::class,'id','brandmodel_id');
    }
    public function cylinder(){
        return $this->hasOne(Cylinder::class,'id','cylinder_id');
    }
     public function carorigin(){
        return $this->hasOne(CarOrigin::class,'id','carorigin_id');
    }
     public function oilgrade(){
        return $this->hasOne(OilGrade::class,'id','oilgrade_id');
    }
    public static function cylinders($id){
        if($id == null){
            return 'id not Found !';
        }else{
            $daa = Cylinder::where('id',$id)->first();
            if($daa){
                return $daa->title;
            }else{
                return 'Cylinder Not Found!';
            }
        }

    }
    // public function getModelIdAttribute($value){
    //     return jsonContains($value);
    // }
}
