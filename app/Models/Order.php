<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_number',
        'total_item_count',
        'order_amount',
        'coupon_id',
        'coupon_code',
        'payment_approved_date',
        'discount_amount',
        'order_amount_after_discount',
        'customer_address_id',
        'customer_billing_address_id',
        'name',
        'email',
        'mobile_number',
        'country',
        'state',
        'city',
        'pincode',
        'address',
        'address_type',
        'gst_type',
        'igst_percentage',
        'cgst_percentage',
        'sgst_percentage',
        'vat_percentage',
        'total_gst_percentage',
        'igst_amount',
        'cgst_amount',
        'sgst_amount',
        'total_gst_amount',
        'order_amount_with_gst',
        'shipping_type_id',
        'shipping_type_name',
        'shipping_type_maximum_days',
        'shipping_type_price',
        'order_amount_with_shipping',
        'estimated_delivery_date',
        'delivered_on_date',
        'payment_status',
        'order_status',
        'transaction_number',
        'transaction_detail',
        'shipping_type',
        'shipping_id',
        'shipping_name',
        'shipping_mobile_number',
        'tracking_number',
        'tracking_detail',
        'payment_method',
        'paymentid',
        'average_rating',
        'invoice_number',
        'invoice_url',
        'refrence_id',
        'payment_image',
        'sendmailstatus',
        'payment_message',
    ];
    
     public function countries(){
        return $this->belongsTo(Country::class,'country','id');
    }
     public function states(){
        return $this->belongsTo(State::class,'state','id');
    }
     public function cities(){
        return $this->belongsTo(City::class,'city','id');
    }
    
    public function billingaddress(){
         return $this->belongsTo(CustomerBillingAddress::class,'customer_billing_address_id','id')->with('countries','states','cities');
    }
    public function shippingaddress(){
         return $this->belongsTo(CustomerAddress::class,'customer_address_id','id')->with('countries','states','cities');
    }
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    
    public function cancelorder(){
        return $this->belongsTo(CancelOrder::class,'id','order_id')->with('reasons');
    }
     public function returnorder(){
        return $this->belongsTo(ReturnOrder::class,'id','order_id')->with('images','reasons');
    }
    
     public function refundorder(){
        return $this->belongsTo(OrderRefund::class,'id','order_id');
    }
      public function courierorder(){
        return $this->belongsTo(OrderCourier::class,'id','order_id');
    }

    public function order_details() {
        return $this->hasMany(OrderDetail::class)->with('order_product_review','returnorder')->select(['order_id','product_id','quantity','price','brand_name As size','id']);
    }
     public function order_detailss() {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_product_reviews()
    {
        return $this->hasMany(OrderProductReview::class);
    }
}
