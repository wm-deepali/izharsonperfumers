<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OilgradeOrderService extends Model
{
    use HasFactory;
     protected $table='oilgrade_order_services';
    protected $fillable = [
        'customer_id',
        'order_number',
        'total_item_count',
        'order_amount',
        'coupon_id',
        'coupon_code',
        'discount_amount',
        'order_amount_after_discount',
        'customer_address_id',
        'name',
        'garage_id',
        'garage_name',
        'garage_email',
        'garage_mobile_number',
        'garage_address',
        'email',
        'mobile_number',
        'country',
        'state',
        'city',
        'pincode',
        'pickup_delivery_date',
        'pickup_delivery_time',
        'pickup_delivery_status',
        'brand_name',
        'brandmodel_name',
        'fuel_type',
        'address',
        'address_type',
        'gst_type',
        'igst_percentage',
        'cgst_percentage',
        'sgst_percentage',
        'total_gst_percentage',
        'igst_amount',
        'cgst_amount',
        'sgst_amount',
        'total_gst_amount',
        'order_amount_with_gst',
        'delivered_on_date',
        'payment_status',
        'order_status',
        'transaction_number',
        'transaction_detail',
        // 'shipping_type',
        // 'shipping_id',
        // 'shipping_name',
        // 'shipping_mobile_number',
        'tracking_number',
        'tracking_detail',
        'average_rating',
    ];

public function getServiceTypeAttribute($value)
    {
        return ucwords(str_replace("_"," ",$value));
    }
    
     public function cancelorder(){
        return $this->belongsTo(CancelOrderService::class,'id','order_id')->with('reasons');
    }
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function order_details() {
        return $this->hasMany(OilgradeOrderServiceDetail::class,'order_id','id');
    }

    public function order_product_reviews()
    {
        return $this->hasMany(OrderProductReview::class);
    }
}
