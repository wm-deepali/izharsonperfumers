<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCost extends Model
{
    use HasFactory, SoftDeletes;
     protected $fillable = [        
        'name',
        'in_state_charge',
        'out_state_charge',
        'delivery_days_range',
        'status',
        'max_charges',
    ];
    protected $casts = [
        'in_state_charge' => 'integer',
        'out_state_charge' => 'integer',
    ];
    public function pincodes() {
        return $this->belongsToMany(Pincode::class, 'shipping_type_pincodes');
    }
}
