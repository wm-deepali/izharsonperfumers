<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use App\Models\Brand;
use App\Models\Cylinder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
class BrandModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brandmodels = BrandModel::latest()->with('brand')->get();
        return view('admin.brandmodels.index')->with([
            'brandmodels' => $brandmodels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.brandmodels.ajax.create')->with([
                    'brands' => Brand::all()
                ])->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            'name_ar' => 'required|max:255',
            // 'url' => 'required|max:255|unique:brands',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            
        ]);
        if ($validator->passes()) {
            try {
                if($request->hasFile('image')){
                    $imageName = time().'.'.$request->image->extension();
                    $requestData['image'] = $imageName;
                    $request->image->move(public_path('brands_imagesmodel/'), $imageName);
                }
                $requestData['fueltype']=json_encode(explode(",",$requestData['fueltype']));
                $requestData['cylinder']=json_encode(explode(",",$requestData['cylinder']));
                $brand = BrandModel::create($requestData);
                // $brand->update([
                //     'code' => 'BrandModel-'.$brand->id,
                // ]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $brandmodel = BrandModel::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.brandmodels.ajax.edit')->with([
                    'brandmodel' => $brandmodel,
                    'brands' => Brand::all()
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        // $requestData['url'] = Str::slug($request->url, '-');
        // $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            // 'url' => [ "required",Rule::unique('brands')->ignore($id),"max:255"],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        if ($validator->passes()) {
            try{
                $brand = BrandModel::findOrFail($id);
                $data = $request->all();
                
                 $data['fueltype']=json_encode(explode(",",$data['fueltype']));
                 $data['cylinder']=json_encode(explode(",",$data['cylinder']));

                 $cylindername=[];
                 $cylinder=explode(",",$request->cylinder);
                for($x=0;$x<count($cylinder) ;$x++){
                    $cylindername=Cylinder::find($cylinder[$x])->pluck('title');
                }
                 $data['cylinder_name']=json_encode($cylindername);


                if($request->hasFile('image')){
                    \File::delete(public_path('brands_imagesmodel/').$brand->image);
                    $imageName = time().'.'.$request->image->extension();
                    $request->image->move(public_path('brands_imagesmodel/'), $imageName);
                    $data['image'] = $imageName;
                }else{
                    $data['image'] = $brand->image;
                }
                $brand->update($data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $brand = BrandModel::findorFail($id);
            if(isset($brand->image)){
                \File::delete(public_path('brands_imagesmodel/').$brand->image);
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
        
        $brand = BrandModel::findorFail($id);
        if($brand->status=="active"){
            $brand->update(['status'=>'block']);
        }else{
            $brand->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function show($id){
        try {
            $brand = BrandModel::withMeta()->findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.brandmodels.ajax.show')->with([
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
