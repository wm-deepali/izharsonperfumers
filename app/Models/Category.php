<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Zoha\Metable;
class Category extends Model
{
    use HasFactory,Metable;

    protected $fillable=[
        'parent_id',
        'name',
        'banner_image',
        'code',
        'slug',
        'image',
        'status'
    ];

    public function parent(){
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function direct_childs(){
        return $this->hasMany(Category::class,'parent_id','id')->where('status','active');
    }
public function direct_childss(){
        return $this->hasMany(Category::class,'parent_id','id')->whereHas('productssn');
    }
    public function all_childs(){
        return $this->hasMany(Category::class,'parent_id','id')->with('direct_childs');
    }

    public function active_direct_childs(){
        return $this->hasMany(Category::class,'parent_id','id')->where('status','active');
    }


    public function active_all_childs(){
        return $this->hasMany(Category::class,'parent_id','id')->with('active_direct_childs')->where('status','active');
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
    public function productsn()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
    public function productssn()
    {
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
    public function products() {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
