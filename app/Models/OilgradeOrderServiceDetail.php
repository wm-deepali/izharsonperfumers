<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilgradeOrderServiceDetail extends Model
{
    use HasFactory;
    protected $table='oilgrade_order_service_details';
    protected $fillable = [
        'order_id',
        'package_id',
        'package_name',
        'package_option_id',
        'oilgrade_id',
        'oilgrade_name',
        'brand_name',
        'cylinder_id',
        'cylinder_name',
        'carorigin_id',
        'carorigin_name',
        'brandmodel_name',
        // 'brandmodel_id',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'quantity',
        'total_price',
    ];

    public function order() {
        return $this->belongsTo(Product::class);
    }

    public function package() {
        return $this->belongsTo(Packages::class);
    }

    public function order_product_review()
    {
        return $this->hasOne(OrderProductReview::class);
    }
}
