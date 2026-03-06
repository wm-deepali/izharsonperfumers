<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBillingAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'mobile_number',
        'country',
        'state',
        'city',
        'pincode',
        'address',
        'address_type',
        'status',
    ];
    public function countries()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }
    public function states()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
    public function cities()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

}
