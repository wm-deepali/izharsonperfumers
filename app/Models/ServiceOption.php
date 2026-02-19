<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOption extends Model
{
    use HasFactory;
    protected $table='service_options';
    protected $fillable = [
        'service_id',
        'brand_id',
        'attribute_1_id',
        'category_id',
        'attribute_2_id',
        'stock',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'default_price',
        'brandmodel_id',
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

    public function carmake(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }
    public function carmodel(){
        return $this->hasOne(BrandModel::class,'id','brandmodel_id');
    }
    // public function getModelIdAttribute($value){
    //     return jsonContains($value);
    // }
}
