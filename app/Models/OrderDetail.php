<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'category_id',
        'product_name',
        'product_option_id',
        'brand_id',
        'brand_name',
        'mrp',
        'discount_percentage',
        'discount_amount',
        'price',
        'quantity',
        'total_price',
    ];

    // public function order() {
    //     return $this->belongsTo(Order::class);
    // }
     public function order() {
        return $this->belongsTo(Order::class)->with('billingaddress','shippingaddress');
    }
    public function returnorder(){
        return $this->belongsTo(ReturnOrder::class,'id','order_detail_id')->with('images','reasons');
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
public function category() {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function order_product_review()
    {
        return $this->hasOne(OrderProductReview::class,'order_detail_id','id');
    }
}
