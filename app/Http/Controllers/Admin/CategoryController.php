<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.index')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.create')->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            // 'name_ar' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //  'meta_title' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'twitter_cards' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_keyword' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'canonical_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_description' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'og_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
        ]);
        if ($validator->passes()) {
            try {
                if($request->hasFile('image')){
                  
                  $imageName=  $request->image->store('categories_images');
                }
                if($request->hasFile('banner_image')){
                    
                    $imageNamebanner = $request->image->store('categories_images');
                   
                }
                $category = Category::create([
                    'parent_id' => $request->parent_id ?? Null,
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'image' => $imageName ?? null,
                    'banner_image' => $imageNamebanner ?? null,
                    'status' => $request->status,
                    'is_premium' => $request->is_premium ?? 0,
                ]);
                if($request->parent_id) {
                    $code = 'Category-'.$request->parent_id.'-'.$category->id;
                } else {
                    $code = 'Category-'.$category->id;
                }
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
                $category->update([
                    'code' => $code
                ]);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Category Created',
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.edit')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
          'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'name_ar' => 'required|max:255',
            'slug' => [ "required",Rule::unique('categories')->ignore($id),"max:255"],
            // 'meta_title' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'twitter_cards' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_keyword' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'canonical_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_description' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'og_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
        ]);
        if ($validator->passes()) {
            try{
                $category = Category::findOrFail($id);
                $data = array(
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'is_premium' => $request->is_premium ?? 0,
                );
                
                if($request->hasFile('banner_image')){
                   $data['banner_image'] = $request->banner_image->store('categories_images');
                }
                if($request->hasFile('image')){
                    if(Storage::exists($category->image)) {
                        Storage::delete($category->image);
                    }
                    $data['image'] = $request->image->store('categories_images');
                }
                $category->update($data);
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Category Updated',
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findorFail($id);
            if($category->direct_childs->count() > 0 ) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'msgText' => 'Delete child categories first',
                ]);
            }
            if(isset($category->image)){
                \File::delete(public_path('categories_images/').$category->image);
            }
            $category->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'name' => $category->name
            ]);
        } catch(\Exception $ex){
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $parent_category = Category::findOrFail($id);
        $categories = Category::where('parent_id',$parent_category->id)->get();
        return view('admin.categories.children')->with([
            'parent_category' => $parent_category,
            'categories' => $categories
        ]);
    }

    public function changestatus(Request $request,$id){
        
        $data = Category::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function showcategory($id){
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.show')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
}
