<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Zoha\Metable;
class ServiceCategory extends Model
{
    use HasFactory,Metable;

    protected $table = 'service_categories';

    protected $fillable=[
        'parent_id',
        'name',
        'name_ar',
        'code',
        'slug',
        'image',
        'other_service',
        'value_added_service',
        'status',
        'description',
        'description_ar'
    ];

public function services(){
    return $this->hasMany(Services::class,'service_category_id','id')->with('service_options');
}
    public function parent(){
        return $this->hasOne(ServiceCategory::class,'id','parent_id');
    }

    public function direct_childs(){
        return $this->hasMany(ServiceCategory::class,'parent_id','id');
    }

    public function all_childs(){
        return $this->hasMany(ServiceCategory::class,'parent_id','id')->with('direct_childs');
    }

    public function active_direct_childs(){
        return $this->hasMany(ServiceCategory::class,'parent_id','id')->where('status','active');
    }


    public function active_all_childs(){
        return $this->hasMany(ServiceCategory::class,'parent_id','id')->with('active_direct_childs')->where('status','active');
    }

    public function get_all_childrens(){
        $categories = new Collection();
        foreach ($this->direct_childs as $category) {
            $categories->push($category);
            $categories = $categories->merge($category->get_all_childrens());
        }
        return $categories;
    }

    public function active_get_all_childrens(){
        $categories = new Collection();
        foreach ($this->active_direct_childs as $category) {
            $categories->push($category);
            $categories = $categories->merge($category->active_get_all_childrens());
        }
        return $categories;
    }


}
