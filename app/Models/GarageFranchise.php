<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
class GarageFranchise extends Model
{
    use HasFactory, HasApiTokens;
    protected $table='garage_franchises';
    
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'garage_name',
        'address',
        'password',
        'status',
        'country',
        'state',
        'city',
        'zip_code',
    ];
    protected $hidden = [
        'password'
    ];
     public function country(){
        return $this->belongsTo(Country::class,'country','id')->select('id','name');
    }
     public function state(){
        return $this->belongsTo(State::class,'state','id')->select('id','name');
    }
     public function city(){
        return $this->belongsTo(City::class,'city','id')->select('id','name');
    }
}
