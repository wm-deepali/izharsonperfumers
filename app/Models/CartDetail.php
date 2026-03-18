<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'customer_id',
        'cart_id',
        'product_id',
        'product_option_id',
        'quantity',
    ];
    
    public function product_options()
    {
        return $this->hasOne(ProductOption::class,'id','product_option_id')->with('packaging');
    }
    public function products()
    {
        return $this->hasOne(Product::class,'id','product_id')->select('id','name','image', 'slug');
    }
    
     public function carmake(){
        return $this->hasOne(Brand::class,'id','brand_id')->select('id','name','image');
    }
     public function packaging(){
        return $this->hasOne(Brand::class,'id','brand_id')->select('id','name','image');
    }
    public function carmodel(){
        return $this->hasOne(BrandModel::class,'id','brandmodel_id')->select('id','name','image');
    }
    
}
