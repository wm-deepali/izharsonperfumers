<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Packages;
use App\Models\Services;
use App\Models\PackageOption;
use App\Models\Brand;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\CarOrigin;
use App\Models\Cylinder;
use App\Models\OilGrade;

class PackagesController extends Controller
{
    public function index()
    {
        $objs = Packages::orderBy('id', 'DESC')->get();
        return view('admin.packages.index')->with([
            'objs' => $objs
        ]);
    }

    public function create()
    {
        
        try{
            $brands = Brand::all();
            $carorigin = CarOrigin::all();
            $cylinder = Cylinder::all();
            $oilgrade= OilGrade::all();
            $service_cats = ServiceCategory::whereNull('parent_id')->get();
            return view('admin.packages.ajax.create',compact('service_cats','brands','cylinder','oilgrade','carorigin'));
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
        $variant_options = json_decode($request->variant_options,true);
        // echo "<pre>";
        // array_shift($variant_options[0]['mrp'][0]);
        // print_r($variant_options[0]['mrp'][0]);
        // die();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            // 'service_category_id' => 'required',
            // 'service_id' => 'required',
            // 'name' => 'required|max:255',
            'detail_description' => 'required',
            'sub_title' => 'required',
            'short_description' => 'required',
            'currency_type' => 'required',
            // 'price' => 'required',
            // 'discountable_price' => 'required',
            // 'slug' => 'required|max:255|unique:service_categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->passes()) {
            try {

                if($request->hasFile('image')){
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('package_images/'), $imageName);
                }
                $variant_options = json_decode($request->variant_options,true);
                $objs = Packages::create([
                    // 'service_category_id' => $request->service_category_id,
                    // 'service_id' => $request->service_id,
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'sub_title' => $request->sub_title,
                    'sub_title_ar' => $request->sub_title_ar,
                    'currency_type' => $request->currency_type,
                    'price' => $request->price,
                    'service_time' => $request->service_time,
                    'discountable_price' => $request->discountable_price,
                    'slug' => $request->slug,
                    'image' => $imageName,
                    'short_description' => $request->short_description,
                    'detail_description' => $request->detail_description,
                    // 'meta_title' => $request->meta_title,
                    // 'meta_keyword' => $request->meta_keyword,
                    // 'meta_description' => $request->meta_description,
                    // 'meta_title_ar' => $request->meta_title_ar,
                    // 'meta_keyword_ar' => $request->meta_keyword_ar,
                    // 'meta_description_ar' => $request->meta_description_ar,
                    'status' => $request->status,
                ]);
               $var_count = count($variant_options[0]['carorigin']);
                for ($x = 0; $x <= $var_count - 1; $x++) {
                    $carorigin_id = $variant_options[0]['carorigin'][$x];
                    $oilgrade_id = $variant_options[0]['oilgrade'][$x];
                    $category = $request->category;
                    $option_mrp = $variant_options[0]['mrp'][$x];
                    $cylinder_id = $variant_options[0]['cylinder'][$x];
                    $default_price = $request->default_price;
                    $option_discount_percentage = $variant_options[0]['discount_percentage'][$x];
                    $option_price = $variant_options[0]['price'][$x];
                    $productOptionData = array(
                        'package_id' => $objs->id,
                        'carorigin_id' => $carorigin_id,
                        'oilgrade_id' => $oilgrade_id,
                        'cylinder_id' => (int)$cylinder_id,
                        'mrp' => (float)$option_mrp,
                        'default_price' => (float)$default_price,
                        'discount_percentage' => (float)$option_discount_percentage,
                        'discount_amount' => (float)$option_mrp -(float)$option_price,
                        'price' => (float)$option_price
                    );
                   
                   // return $productOptionData;
                   PackageOption::create($productOptionData);
           
               }

                return response()->json([
                    'success' => true,
                    'msgText' => 'Packages Created',
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
            $carorigins = CarOrigin::all();
            $cylinders = Cylinder::all();
            $oilgrades = OilGrade::all();
            $service_cats = ServiceCategory::whereNull('parent_id')->get();
            $package = Packages::findOrFail($id);
            // $serviceoptions = PackageOption::where('package_id',$package->id)->pluck('attribute_1_id')->toArray();
            return view('admin.packages.ajax.edit',compact('package','service_cats','brands','carorigins','cylinders','oilgrades'));
            
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
            // 'slug' => [ "required",Rule::unique('packages')->ignore($id),"max:255"],
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
                $objs = Packages::findOrFail($id);
                $variant_options = json_decode($request->variant_options,true);
                $data = array(
                    // 'service_category_id' => $request->service_category_id,
                    // 'service_id' => $request->service_id,
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'sub_title' => $request->sub_title,
                    'sub_title_ar' => $request->sub_title_ar,
                    'currency_type' => $request->currency_type,
                    'price' => $request->price,
                    'discountable_price' => $request->discountable_price,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'service_time' => $request->service_time,
                    'short_description' => $request->short_description,
                    'detail_description' => $request->detail_description,
                );
                if($request->hasFile('image')){
                    // $data['image'] = $request->image->store('service_categories');
                    // if(isset($objs->image) && Storage::exists($categobjsory->image)){
                    //     Storage::delete($objs->image);
                    // }
                    \File::delete(public_path('package_images/').$objs->image);

                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('package_images/'), $imageName);
                    $data['image'] = $imageName;
                }
                $objs->update($data);
                PackageOption::where('package_id',$objs->id)->delete();
                // PackageOption::create($productOptionData);
                $var_count = count($variant_options[0]['carorigin']);
                for ($x = 0; $x <= $var_count - 1; $x++) {
                    $carorigin_id = $variant_options[0]['carorigin'][$x];
                    $oilgrade_id = $variant_options[0]['oilgrade'][$x];
                    $category = $request->category;
                    $option_mrp = $variant_options[0]['mrp'][$x];
                    $cylinder_id = $variant_options[0]['cylinder'][$x];
                    $default_price = $request->default_price;
                    $option_discount_percentage = $variant_options[0]['discount_percentage'][$x];
                    $option_price = $variant_options[0]['price'][$x];
                    $productOptionData = array(
                        'package_id' => $objs->id,
                        'carorigin_id' => $carorigin_id,
                        'oilgrade_id' => $oilgrade_id,
                        'cylinder_id' => (int)$cylinder_id,
                        'mrp' => (float)$option_mrp,
                        'default_price' => (float)$default_price,
                        'discount_percentage' => (float)$option_discount_percentage,
                        'discount_amount' => (float)$option_mrp -(float)$option_price,
                        'price' => (float)$option_price
                    );
                   
                   // return $productOptionData;
                   PackageOption::create($productOptionData);
           
               }

                return response()->json([
                    'success' => true,
                    'msgText' => 'Packages Updated',
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
            $objs = Packages::findorFail($id);
            PackageOption::where('package_id',$id)->delete();
            if(isset($objs->image)){
                \File::delete(public_path('package_images/').$objs->image);
            }
            $objs->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'name' => $objs->name
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
        $objs = Packages::findOrFail($id);
        return view('admin.packages.children')->with([
            'objs' => $objs
        ]);
    }

    //
    public function GetServicesByCategory($id){
        if ($id) {
            $sData['data'] = Services::where('service_category_id', $id)->where('status', 'active')->get();
            return response()->json($sData);
        }else{
            return 'Id Not Found !';
        }
    }

    public function changestatus(Request $request,$id){
        
        $data = Packages::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }
    public function showpackage($id){
        try {
            $package = Packages::findOrFail($id);
            $packageoption = PackageOption::where('package_id',$id)->get();
            return view('admin.packages.ajax.show',compact('package','packageoption'));
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
