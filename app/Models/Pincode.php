<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id',
        'city_id',
        'pincode',
    ];
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'state_id','state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
