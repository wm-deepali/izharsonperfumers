<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'code',
    ];

    public function parent(){
        return $this->hasOne(Attribute::class,'id','parent_id');
    }

    public function direct_childs(){
        return $this->hasMany(Attribute::class,'parent_id','id');
    }

    public function all_childs(){
        return $this->hasMany(Attribute::class,'parent_id','id')->with('direct_childs');
    }
}
