<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class Brand extends Model
{
    use HasFactory,Metable;

    protected $fillable=[
        'quantity',
        'quantity_in',
        'status'
    ];
     public function products()
    {
        return $this->hasMany(ProductOption::class,'brand_id','id');
    }
    public function brandmodels()
    {
        return $this->hasMany(BrandModel::class);
    }
}
