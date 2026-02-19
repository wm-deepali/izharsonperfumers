<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceBookings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $objs = ServiceBookings::orderBy('id', 'DESC')->get();
        return view('admin.bookings.index')->with([
            'objs' => $objs
        ]);
    }
    public function customerservice($id)
    {
        $objs = ServiceBookings::orderBy('id', 'DESC')->where('customer_id',$id)->get();
        return view('admin.bookings.index')->with([
            'objs' => $objs
        ]);
    }
public function show($id)
    {
            $objs = ServiceBookings::findOrFail($id);
            return view('admin.bookings.show')->with([
            'objs' => $objs
        ]);
    }
    
    // public function create()
    // {
    //     try{
    //         return response()->json([
    //             "success" => true,
    //             "html" => view('admin.packages.ajax.create')->render(),
    //         ]);
    //     }
    //     catch(\Exception $ex){
    //         return response()->json([
    //             "success" => false,
    //             'msgText' =>$ex->getMessage(),
    //         ]);
    //     }
    // }

    // public function store(Request $request)
    // {
    //     $requestData = $request->all();
    //     $requestData['slug'] = Str::slug($request->slug, '-');
    //     $request->replace($requestData);
    //     $validator = Validator::make($requestData, [
    //         'name' => 'required|max:255',
    //         'sub_title' => 'required',
    //         'currency_type' => 'required',
    //         'price' => 'required',
    //         'discountable_price' => 'required',
    //         'pkg_features' => 'required',
    //         'slug' => 'required|max:255|unique:service_categories',
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
    //         'meta_title' => 'required|max:60',
    //         'meta_keyword' => 'required|max:255',
    //         'meta_description' => 'required|max:160',
    //     ]);
    //     if ($validator->passes()) {
    //         try {

    //             if($request->hasFile('image')){
    //                 $imageName = time().'.'.$request->image->extension();
    //                 $request->image->move(public_path('package_images/'), $imageName);
    //             }

    //             $objs = Packages::create([
    //                 'name' => $request->name,
    //                 'sub_title' => $request->sub_title,
    //                 'currency_type' => $request->currency_type,
    //                 'price' => $request->price,
    //                 'discountable_price' => $request->discountable_price,
    //                 'pkg_features' => $request->pkg_features,
    //                 'slug' => $request->slug,
    //                 'image' => $imageName,
    //                 'meta_title' => $request->meta_title,
    //                 'meta_keyword' => $request->meta_keyword,
    //                 'meta_description' => $request->meta_description,
    //                 'status' => $request->status,
    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'msgText' => 'Packages Created',
    //             ]);
    //         } catch(\Exception $ex) {
    //             return response()->json([
    //                 'success' => false,
    //                 'code' => 400,
    //                 'msgText' => $ex->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'code' => 422,
    //             'errors' => $validator->errors(),
    //         ]);
    //     }
    // }

    // public function edit($id)
    // {
    //     try {
    //         $objs = Packages::findOrFail($id);
    //         return response()->json([
    //             "success" => true,
    //             "html" => view('admin.packages.ajax.edit')->with([
    //                 'objs' => $objs
    //             ])->render(),
    //         ]);
    //     } catch(\Exception $ex) {
    //         return response()->json([
    //             "success" => false,
    //             'msgText' =>$ex->getMessage(),
    //         ]);
    //     }
    // }

    // public function update(Request $request , $id)
    // {
    //     $requestData = $request->all();
    //     $requestData['slug'] = Str::slug($request->slug, '-');
    //     $request->replace($requestData);
    //     $validator = Validator::make($requestData, [
    //         'name' => 'required|max:255',
    //         'slug' => [ "required",Rule::unique('categories')->ignore($id),"max:255"],
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'meta_title' => 'required|max:60',
    //         'meta_keyword' => 'required|max:255',
    //         'meta_description' => 'required|max:160',
    //     ]);
    //     if ($validator->passes()) {
    //         try{
    //             $objs = Packages::findOrFail($id);
    //             $data = array(
    //                 'name' => $request->name,
    //                 'sub_title' => $request->sub_title,
    //                 'currency_type' => $request->currency_type,
    //                 'price' => $request->price,
    //                 'discountable_price' => $request->discountable_price,
    //                 'pkg_features' => $request->pkg_features,
    //                 'slug' => $request->slug,
    //                 //'image' => $imageName,
    //                 'meta_title' => $request->meta_title,
    //                 'meta_keyword' => $request->meta_keyword,
    //                 'meta_description' => $request->meta_description,
    //                 'status' => $request->status,
    //             );
    //             if($request->hasFile('image')){
    //                 // $data['image'] = $request->image->store('service_categories');
    //                 // if(isset($objs->image) && Storage::exists($categobjsory->image)){
    //                 //     Storage::delete($objs->image);
    //                 // }
    //                 \File::delete(public_path('package_images/').$objs->image);

    //                 $imageName = time().'.'.$request->image->extension();
    //                 $request->image->move(public_path('package_images/'), $imageName);
    //                 $data['image'] = $imageName;
    //             }
    //             $objs->update($data);
    //             return response()->json([
    //                 'success' => true,
    //                 'msgText' => 'Packages Updated',
    //             ]);
    //         } catch(\Exception $ex) {
    //             return response()->json([
    //                 'success' => false,
    //                 'code' => 400,
    //                 'msgText' => $ex->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'code' => 422,
    //             'errors' => $validator->errors(),
    //         ]);
    //     }
    // }

    // public function destroy($id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $objs = Packages::findorFail($id);
    //         if(isset($objs->image)){
    //             \File::delete(public_path('package_images/').$objs->image);
    //         }
    //         $objs->delete();
    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'name' => $objs->name
    //         ]);
    //     } catch(\Exception $ex){
    //         DB::rollback();
    //         return response()->json([
    //             'success' => false,
    //             'msgText' => $ex->getMessage(),
    //         ]);
    //     }
    // }

    // public function show($id)
    // {
    //     $objs = Packages::findOrFail($id);
    //     return view('admin.packages.children')->with([
    //         'objs' => $objs
    //     ]);
    // }
}
