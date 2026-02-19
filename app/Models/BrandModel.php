<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;
class BrandModel extends Model
{
    use HasFactory,Metable;
    protected $tables='brand_models';
    protected $fillable=[
        'name',
        'name_ar',
        'fueltype',
        'brand_id',
        'image',
        'status',
        'cylinder',
        'cylinder_name',
        
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function cylinder()
    {
        return $this->belongsTo(Cylinder::class);
    }
}
