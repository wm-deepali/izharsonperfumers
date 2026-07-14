<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
use Carbon\Carbon;

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

        // ✅ DEAL FIELDS
        'is_deal',
        'deal_start',
        'deal_end',
    ];

    protected $casts = [
        'is_deal' => 'boolean',
        'deal_start' => 'datetime',
        'deal_end' => 'datetime',
    ];

    /* ================= RELATIONSHIPS ================= */

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

    /* ================= ATTRIBUTES ================= */

    public function getAvgRatingAttribute()
    {
        return round($this->product_review()->avg('rating'), 1);
    }

    public function getReviewCountAttribute()
    {
        return $this->product_review()->count();
    }

    /**
     * Check if deal is currently active
     */
    public function getIsDealActiveAttribute()
    {
        if (!$this->is_deal) {
            return false;
        }

        if ($this->deal_start && Carbon::now()->lt($this->deal_start)) {
            return false;
        }

        if ($this->deal_end && Carbon::now()->gt($this->deal_end)) {
            return false;
        }

        return true;
    }

    /**
     * Get remaining deal time in seconds
     */
    public function getDealTimeLeftAttribute()
    {
        if (!$this->is_deal_active || !$this->deal_end) {
            return null;
        }

        return Carbon::now()->diffInSeconds($this->deal_end, false);
    }

    /**
     * Human readable remaining time
     */
    public function getDealTimeLeftHumanAttribute()
    {
        if (!$this->is_deal_active || !$this->deal_end) {
            return null;
        }

        return Carbon::now()->diffForHumans($this->deal_end, true) . ' left';
    }

    /* ================= SCOPES ================= */

    public function scopeActiveDeals($query)
    {
        return $query->where('is_deal', true)
            ->where(function ($q) {
                $q->whereNull('deal_start')
                    ->orWhere('deal_start', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('deal_end')
                    ->orWhere('deal_end', '>', now());
            });
    }

   public function getFragranceNamesAttribute()
{
    if (empty($this->fragrance)) {
        return [];
    }

    // Ensure it's always an array
    $fragranceIds = is_array($this->fragrance)
        ? $this->fragrance
        : json_decode($this->fragrance, true);

    if (empty($fragranceIds)) {
        return [];
    }

    return \App\Models\OilGrade::whereIn('id', $fragranceIds)
        ->pluck('title')
        ->toArray();
}

    public function getRatingBreakdownAttribute()
    {
        $total = $this->product_review()->count();

        if ($total == 0) {
            return [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        }

        $ratings = $this->product_review()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        $result = [];

        for ($i = 5; $i >= 1; $i--) {
            $count = $ratings[$i] ?? 0;
            $result[$i] = round(($count / $total) * 100);
        }

        return $result;
    }
}