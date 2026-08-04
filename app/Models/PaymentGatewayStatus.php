<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewayStatus extends Model
{
    protected $table = 'payment_gateway_status';
    protected $fillable = ['gateway', 'is_active'];
}