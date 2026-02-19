<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;
    protected $table='company_address';
    protected $fillable=[
        'name','country','state','city','zip_code','email','contact_number','map_url','address','status','whatsapp_number'
        ];
        
         public function countries(){
        return $this->belongsTo(Country::class,'country','id');
    }
    
     public function states(){
        return $this->belongsTo(State::class,'state','id');
    }
     public function citys(){
        return $this->belongsTo(City::class,'city','id');
    }
}
