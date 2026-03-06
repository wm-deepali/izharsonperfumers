<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteGstSetting extends Model
{
    use HasFactory;
      protected $fillable = [   
       'company_name',
        'pan_number',
        'gst_number',
        'state_id',
        'city_id',
        'country_id',
        'pin_code',
        'invoice_address',
        'cgst_percent',
        'sgst_percent',
        'igst_percent',
        'invoice_status',
        'invoice_number',
        'financial_year_status',
        'financial_year',
        'financial_serial_number',
        'vat',
        'invoice_prefix',
        'gst_status',
        'vat_status',
    ];
      
      public function city(){
          return $this->belongsTo(City::class,'city_id','id');
      }
      public function countries(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
     public function states(){
        return $this->belongsTo(State::class,'state_id','id');
    }
     public function cities(){
        return $this->belongsTo(City::class,'city_id','id');
    }
}
