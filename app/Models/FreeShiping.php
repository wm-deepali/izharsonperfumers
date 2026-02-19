<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeShiping extends Model
{
    use HasFactory;
    protected $table="free_shipings";
    protected $fillable = [   
        'name',
        'min_order_value_intrastate',
        'min_order_value_interstate',
        'day_range_inter_state',
        'day_range_intra_state',
        'status',
    ];
    protected $casts = [
        'min_quantity_intrastate' => 'integer',
        'min_quantity_interstate' => 'integer',
    ];
    public function pincodes() {
        return $this->belongsToMany(Pincode::class, 'shipping_type_pincodes');
    }
}
