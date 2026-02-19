<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $appends = ['full_image'];

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'color',
        'button_link',
        'content',
        'status'
    ];

    public function getFullImageAttribute()
    {
        if($this->image){
            return asset('slider_images/'.$this->image);
        }else{
            return 'No Image Found !';
        }

    }
}
