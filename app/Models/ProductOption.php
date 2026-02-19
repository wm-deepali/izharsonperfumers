<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'brand_id',
        'stock',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'default_price',
        'image',
    ];
protected $casts = [
        'price' => 'double',
        'default_price' => 'double',
        'discount_amount' => 'double',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function attribute_1()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attribute_2()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product_option_images()
    {
        return $this->hasMany(ProductOptionImage::class);
    }
    
    public function product_variant_images()
    {
        return $this->hasMany(ProductVariantImage::class,'product_option_id','id');
    }
    // public function getModelIdAttribute($value){
    //     return jsonContains($value);
    // }
    public function carmake(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
     public function packaging(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    // public function carmodel(){
    //     return $this->hasOne(BrandModel::class,'id','brandmodel_id');
    // }
}
