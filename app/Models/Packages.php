<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Packages extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable=[
        // 'service_category_id',
        // 'service_id',
        'name',
        'name_ar',
        'sub_title',
        'sub_title_ar',
        // 'currency_type',
        'price',
        'discountable_price',
        'pkg_features',
        'slug',
        'image',
        'short_description',
        'detail_description',
        'service_time',
        'status'
    ];
    public function package_options()
    {
        return $this->hasMany(PackageOption::class,'package_id','id');
    }
    public function package_option()
    {
        return $this->hasMany(PackageOption::class,'package_id','id');
    }
    public function service(){
        return $this->hasOne(Services::class,'id','service_id');
    }
    

}
