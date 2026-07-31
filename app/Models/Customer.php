<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;
class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'mobile_code',
        'registration_date',
        'image',
        'dob',
        'gender',
        'country',
        'state',
        'city',
        'shipping_address',
        'billing_address',
        'address_line_1',
        'address_line_2',
        'password',
        'referral_code',
        'google_id',
        'email_verified_at',
        'status',
        'token',
        'is_email_verified',
        'country_code',
        'mobile_verified_at',
    ];
    protected $hidden = [
        'password'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function services()
    {
        return $this->hasMany(OrderService::class);
    }
    public function oilgradeservices()
    {
        return $this->hasMany(OilgradeOrderService::class);
    }
    public function billing()
    {
        return $this->hasMany(CustomerBillingAddress::class)->with('country');
    }
    public function shipping()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function cart_details()
    {
        return $this->hasMany(CartDetail::class);
    }
    public function setDOBDateAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d');
    }
    public function getDOBDateAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
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

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}

