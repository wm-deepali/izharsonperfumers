<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistUnauth extends Model
{
    use HasFactory;

protected $table="wishlists_unauth";
    protected $fillable = [
        'device_id',
        'product_id',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
