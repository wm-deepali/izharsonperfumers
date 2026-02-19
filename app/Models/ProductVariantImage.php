<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends Model
{
    use HasFactory;
    protected $table = 'product_variant_images';
    protected $fillable = [
        'product_id',
        'image',
        'product_option_id',
    ];
}
