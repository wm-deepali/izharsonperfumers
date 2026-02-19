<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        // echo "<pre>";
        // print_r($brands);
        // die();
        // $brands->getMeta('key');
        return view('admin.brands.index')->with([
            'brands' => $brands
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.brands.ajax.create')->render(),
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
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'quantity' => 'required',
             'quantity_in' => 'required:in,lit,ml',
        ]);
        if ($validator->passes()) {
            try {
                
                $brand = Brand::create($request->all());
                
                return response()->json([
                    'success' => true,
                    'msgText' => 'Created',
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
            $brand = Brand::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.brands.ajax.edit')->with([
                    'brand' => $brand
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
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'quantity' => 'required',
            'quantity_in' => 'required:in,lit,ml',
        ]);
        if ($validator->passes()) {
            try{
                $brand = Brand::findOrFail($id);
                $brand->update($request->all());
                return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
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
            $brand = Brand::findorFail($id);
            if(isset($brand->image)){
                \File::delete(public_path('brands_images/').$brand->image);
            }
            $brand->delete();
            DB::commit();
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex){
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function changestatus(Request $request,$id){
        
        $brand = Brand::findorFail($id);
        if($brand->status=="active"){
            $brand->update(['status'=>'block']);
        }else{
            $brand->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function show($id){
        try {
            $brand = Brand::withMeta()->findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.brands.ajax.show')->with([
                    'brand' => $brand
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
