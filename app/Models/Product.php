<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class Product extends Model
{
    use HasFactory, Metable;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'sku',
        'image',
        'fabric',
        'short_description',
        'description',
        'shipping_information',
        'additional_information',
        'youtube_code',
        'alert_quantity',
        'is_featured',
        'is_premium',
        'is_top',
        'new_arrivals',
        'is_hotDeals',
        'is_popular',
        'has_cash_on_delivery',
        'min_discount_percentage',
        'max_discount_percentage',
        'allow_rating',
        'variant_options',
        'stock',
        'min_mrp',
        'max_mrp',
        'min_price',
        'max_price',
        'rating',
        'status',
        'has_cash_on_delivery',
        'allow_rating',
        'replacement_waranty',
        'cancellation_allowed',
        'express_sheeping',
        'terms_condition',
        'product_code',
        'fragrance',
    ];

    // public function brand()
    // {
    //     return $this->hasOne(Brand::class,'id','brand_id');
    // }


    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function subcategories()
    {
        return $this->hasOne(Category::class, 'id', 'subcategory_id');
    }

    public function product_options()
    {
        return $this->hasMany(ProductOption::class)->with('packaging');
    }
    public function product_review()
    {
        // return $this->hasOneThrough(OrderProductReview::class, Customer::class);
        return $this->hasMany(OrderProductReview::class);
    }


    public function product_option_images()
    {
        return $this->hasMany(ProductOptionImage::class);
    }
    public function product_categories()
    {
        return $this->hasOne(ProductCategory::class);
    }

    public function getAvgRatingAttribute()
    {
        return round($this->product_review()->avg('rating'), 1);
    }
    public function getReviewCountAttribute()
    {
        return $this->product_review()->count();
    }

}
