<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailService extends Model
{
    use HasFactory;
    protected $table='order_detail_services';
    protected $fillable = [
        'order_id',
        'service_id',
        'service_name',
        'service_option_id',
        'brand_id',
        'brand_name',
        'brandmodel_name',
        'brandmodel_id',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'quantity',
        'total_price',
    ];

    public function order() {
        return $this->belongsTo(OrderService::class);
    }

    public function service() {
        return $this->belongsTo(Services::class);
    }

    public function order_product_review()
    {
        return $this->hasOne(OrderProductReview::class);
    }
}
