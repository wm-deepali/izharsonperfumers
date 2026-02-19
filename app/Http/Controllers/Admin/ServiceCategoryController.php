<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::latest()->whereNull('parent_id')->get();
        return view('admin.service_categories.index')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.service_categories.ajax.create')->render(),
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'slug' => 'required|max:255|unique:service_categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // 'meta_title' => 'required|max:60',
            // 'meta_keyword' => 'required|max:255',
            // 'meta_description' => 'required|max:160',
            // 'meta_title_ar' => 'required|max:60',
            // 'meta_keyword_ar' => 'required|max:255',
            // 'meta_description_ar' => 'required|max:160',
        ]);
        if ($validator->passes()) {
            try {

                if($request->hasFile('image')){
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('service_cat_images/'), $imageName);
                }

                $category = ServiceCategory::create([
                    'parent_id' => $request->parent_id ?? Null,
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'image' => $imageName ?? null,
                    'description'=>$request->description,
                    'description_ar'=>$request->description_ar,
                    'status' => $request->status,
                    'other_service' => $request->other_service,
                    'value_added_service' => $request->value_added_service,
                ]);
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    // 'canonical_tags' => $request->canonical_tags,
                    // 'twitter_cards' => $request->twitter_cards,
                    // 'og_tags' => $request->og_tags,
                ]);
                if($request->parent_id) {
                    $code = 'ServiceCategory-'.$request->parent_id.'-'.$category->id;
                } else {
                    $code = 'ServiceCategory-'.$category->id;
                }
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
            $category = ServiceCategory::withMeta()->findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.service_categories.ajax.edit')->with([
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
            'name' => 'required|max:255',
            // 'name_ar' => 'required|max:255',
            'slug' => [ "required",Rule::unique('categories')->ignore($id),"max:255"],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'meta_title' => 'required|max:60',
            // 'meta_keyword' => 'required|max:255',
            // 'meta_description' => 'required|max:160',
            // 'meta_title_ar' => 'required|max:60',
            // 'meta_keyword_ar' => 'required|max:255',
            // 'meta_description_ar' => 'required|max:160',
        ]);
        if ($validator->passes()) {
            try{
                $category = ServiceCategory::findOrFail($id);
                $data = array(
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'description' => $request->description,
                    'description_ar' => $request->description_ar,
                    'other_service' => $request->other_service,
                    'value_added_service' => $request->value_added_service,
                );
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    // 'canonical_tags' => $request->canonical_tags,
                    // 'twitter_cards' => $request->twitter_cards,
                    // 'og_tags' => $request->og_tags,
                ]);

                if($request->hasFile('image')){
                    \File::delete(public_path('service_cat_images/').$category->image);
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('service_cat_images/'), $imageName);
                    $data['image'] = $imageName;
                }


                $category->update($data);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Service Category Updated',
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
            $category = ServiceCategory::findorFail($id);
            if($category->direct_childs->count() > 0 ) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'msgText' => 'Delete child categories first',
                ]);
            }
            if(isset($category->image) && Storage::exists($category->image)){
                Storage::delete($category->image);
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
        $parent_category = ServiceCategory::findOrFail($id);
        $categories = ServiceCategory::where('parent_id',$parent_category->id)->get();
        return view('admin.service_categories.children')->with([
            'parent_category' => $parent_category,
            'categories' => $categories
        ]);
    }

    public function changestatus(Request $request,$id){
        
        $data = ServiceCategory::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function showservice($id){
        try {
            $category = ServiceCategory::withMeta()->findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.service_categories.ajax.show')->with([
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
