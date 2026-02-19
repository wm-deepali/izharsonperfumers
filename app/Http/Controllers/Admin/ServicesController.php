<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Services;
use App\Models\ServiceOption;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $categories = Services::latest()->get();

        return view('admin.services.index')->with([
            'categories' => $categories

        ]);
    }

    public function create()
    {
        $brands = Brand::all();
        $service_cats = ServiceCategory::whereNull('parent_id')->get();
        return view('admin.services.ajax.create',compact('service_cats','brands'));
        // try{
        //     // $service_cats = ServiceCategory::whereNull('parent_id')->get();
        //     return response()->json([
        //         "success" => true,
        //         "html" => view('admin.services.ajax.create')->render(),
        //     ]);
        // }
        // catch(\Exception $ex){
        //     return response()->json([
        //         "success" => false,
        //         'msgText' =>$ex->getMessage(),
        //     ]);
        // }
    }


    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            'name_ar' => 'required|max:255',
            'service_category_id' => 'required',
            // 'slug' => 'required|max:255|unique:services',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            // 'meta_title' => 'required|max:60',
            // 'meta_keyword' => 'required|max:255',
            // 'meta_description' => 'required|max:160',
            // 'meta_title_ar' => 'required|max:60',
            // 'meta_keyword_ar' => 'required|max:255',
            // 'meta_description_ar' => 'required|max:160',
            'service_time' => 'required',
        ]);
        if ($validator->passes()) {
            try {

                if($request->hasFile('image')){
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('services_images/'), $imageName);
                }
                $variant_options = json_decode($request->variant_options,true);
                $min_mrp = min($variant_options[0]['mrp'][0]);
                $max_mrp = max($variant_options[0]['mrp'][0]);
                $min_price = min($variant_options[0]['price'][0]);
                $max_price = max($variant_options[0]['price'][0]);
                $brand_id = $variant_options[0]['brand'][0];
                $attribute_1_id = $request->category;
                $service = Services::create([
                    'service_category_id' => $request->service_category_id ?? Null,
                    'name' => $request->name,
                    'service_time' => $request->service_time,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'image' => $imageName ?? null,
                    'status' => $request->status,
                    'description' => strip_tags((string)$request->description),
                    'description_ar' => $request->description_ar,
                    'variant_options' => $request->variant_options,
                    'min_mrp' => $min_mrp,
                    'max_mrp' => $max_mrp,
                    'min_price' => $min_price,
                    'max_price' => $max_price,
                    'brand_id' => $brand_id,
                    'category_id' => (int)$attribute_1_id,
                ]);
                 $var_count = count($variant_options[0]['brand']);
                 for ($x = 0; $x <= $var_count - 1; $x++) {
                    $brandmodel_count = count($variant_options[0]['brandmodel'][$x]);
                    for($y=0;$y<=$brandmodel_count-1;$y++){
                        $brand_id = $variant_options[0]['brand'][$x];
                        $brandmodel_id = $variant_options[0]['brandmodel'][$x][$y];
                        $category = $request->category;
                        // $option_stock =  $variant_options[0]['stock'][$x][$y];
                        $option_mrp = $variant_options[0]['mrp'][$x][$y];
                        $default_price = $request->default_price;
                        $option_discount_percentage = $variant_options[0]['discount_percentage'][$x][$y];
                        $option_price = $variant_options[0]['price'][$x][$y];
                       // $option_discount_amount = $option_mrp - $option_price;
                        $productOptionData = array(
                            'service_id' => $service->id,
                            'brand_id' => (int)$brand_id,
                            'brandmodel_id' => $brandmodel_id,
                            'category_id' => (int)$attribute_1_id,
                            'attribute_1_id' => (int)$category,
                            // 'stock' => (int)$option_stock,
                            'mrp' => (float)$option_mrp,
                            'default_price' => (float)$default_price,
                            'discount_percentage' => (float)$option_discount_percentage,
                            'discount_amount' => 0.00,
                            'price' => (float)$option_price
                        );
                       
                       // return $productOptionData;
                    ServiceOption::create($productOptionData);
                   
                    }
            
                }
                // if($request->parent_id) {
                //     $code = 'Services-'.$request->parent_id.'-'.$category->id;
                // } else {
                    $code = 'service-'.$service->id;
                // }
                $service->update([
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
            $brands = Brand::all();
            $service = Services::findOrFail($id);
            $service_cats = ServiceCategory::whereNull('parent_id')->get();
            return view('admin.services.ajax.edit',compact('service','service_cats','brands'));
            // return response()->json([
            //     "success" => true,
            //     "html" => view('admin.services.ajax.edit')->with([
            //         'category' => $category
            //     ])->render(),
            // ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
        // dd($request->variant_options);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            'name_ar' => 'required|max:255',
            // 'service_category_id' => 'required',
            // 'slug' => [ "required",Rule::unique('categories')->ignore($id),"max:255"],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_time' => 'required',
        ]);
        if ($validator->passes()) {
            try{
                $service = Services::findOrFail($id);
                $attribute_1_id = $request->category;
                 $variant_options = json_decode($request->variant_options,true);
                 $min_mrp = min($variant_options[0]['mrp'][0]);
                $max_mrp = max($variant_options[0]['mrp'][0]);
                $min_price = min($variant_options[0]['price'][0]);
                $max_price = max($variant_options[0]['price'][0]);
                $brand_id = $variant_options[0]['brand'][0];
                $data = array(
                    'name' => $request->name,
                    'service_time' => $request->service_time,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'service_category_id' => $request->service_category_id,
                    'status' => $request->status,
                    'variant_options' => $request->variant_options,
                    'description' => strip_tags((string)$request->description),
                    'description_ar' => $request->description_ar,
                    'min_mrp' => (int)$min_mrp,
                    'max_mrp' => (int)$max_mrp,
                    'min_price' => (int)$min_price,
                    'max_price' => (int)$max_price,
                    'category_id' => (int)$attribute_1_id,
                    'brand_id' => (int)$brand_id,
                );
                if($request->hasFile('image')){
                    \File::delete(public_path('services_images/').$category->image);
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('services_images/'), $imageName);
                    $data['image'] = $imageName;
                }
                
                $service->update($data);
                ServiceOption::where('service_id',$service->id)->delete();
                $var_count = count($variant_options[0]['brand']);
                 for ($x = 0; $x <= $var_count - 1; $x++) {
                    $brandmodel_count = count($variant_options[0]['brandmodel'][$x]);
                    for($y=0;$y<=$brandmodel_count-1;$y++){
                        $brand_id = $variant_options[0]['brand'][$x];
                        $brandmodel_id = $variant_options[0]['brandmodel'][$x][$y];
                        $category = $request->category;
                        // $option_stock =  $variant_options[0]['stock'][$x][$y];
                        $option_mrp = $variant_options[0]['mrp'][$x][$y];
                        $default_price = $request->default_price;
                        $option_discount_percentage = $variant_options[0]['discount_percentage'][$x][$y];
                        $option_price = $variant_options[0]['price'][$x][$y];
                       // $option_discount_amount = $option_mrp - $option_price;
                        $productOptionData = array(
                            'service_id' => $service->id,
                            'brand_id' => (int)$brand_id,
                            'brandmodel_id' => $brandmodel_id,
                            'category_id' => (int)$attribute_1_id,
                            'attribute_1_id' => (int)$category,
                            // 'stock' => (int)$option_stock,
                            'mrp' => (float)$option_mrp,
                            'default_price' => (float)$default_price,
                            'discount_percentage' => (float)$option_discount_percentage,
                            'discount_amount' => 0.00,
                            'price' => (float)$option_price
                        );
                       
                       // return $productOptionData;
                    ServiceOption::create($productOptionData);
                   
                    }
            
                }
                return response()->json([
                    'success' => true,
                    'msgText' => 'Service Updated',
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
            $category = Services::findorFail($id);
            // if($category->direct_childs->count() > 0 ) {
            //     DB::rollback();
            //     return response()->json([
            //         'success' => false,
            //         'msgText' => 'Delete child categories first',
            //     ]);
            // }
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
        $parent_category = Services::findOrFail($id);
        ServiceOption::where('service_id',$parent_category->id)->delete();
        $categories = Services::where('parent_id',$parent_category->id)->get();
        return view('admin.services.children')->with([
            'parent_category' => $parent_category,
            'categories' => $categories
        ]);
    }

    public function changestatus(Request $request,$id){
        
        $data = Services::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function showservices($id){
        try {
            $service = Services::findOrFail($id);
            $serviceoption = ServiceOption::where('service_id',$id)->get();
            return view('admin.services.ajax.show',compact('service','serviceoption'));
            // return response()->json([
            //     "success" => true,
            //     "html" => view('admin.products.ajax.show')->with([
            //         'product' => $product,
            //         'productoption' => $productoption,
            //     ])->render(),
            // ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
}
