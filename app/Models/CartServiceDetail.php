<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'cart_id',
        'service_id',
        'service_option_id',
        'quantity',
    ];
    public function service_options()
    {
        return $this->hasOne(ServiceOption::class,'id','service_option_id');
    }
    public function services()
    {
        return $this->hasOne(Services::class,'id','service_id');
    }
}
