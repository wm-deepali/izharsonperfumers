<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Promotion::all();
        return view('admin.promotion.index',compact('datas'));
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
                "html" => view('admin.promotion.ajax.create')->render(),
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
        $validator = Validator::make($requestData, [
           'name' => 'required|min:3|max:35|regex:/^[A-Za-z.\s,-]*$/',
            'detail' => 'required|min:20|max:1200',
            'validity' => 'required|after:today',
            'url' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=500,min_height=500,max_width=500,max_height=500|max:2048'
        ]);
        if ($validator->passes()) {
            try {
                $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('promotion');
                }
                Promotion::create($data);
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
     * @param  \App\Models\OilGrade  $oilGrade
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try {
            $promotion = Promotion::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.promotion.ajax.show')->with([
                    'promotion' => $promotion
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OilGrade  $oilGrade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       try {
            $promotion = Promotion::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.promotion.ajax.edit')->with([
                    'promotion' => $promotion
                ])->render(),
            ]);
        } catch(\Exception $ex){
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
     * @param  \App\Models\OilGrade  $oilGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|min:3|max:255|regex:/^[A-Za-z.\s,-]*$/',
            'detail' => 'required|min:20|max:1200',
            'validity' => 'required|after:today',
            'url' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=500,min_height=500,max_width=500,max_height=500|max:2048'
        ]);
        if ($validator->passes()) {
            try {
                $promotion = Promotion::findOrFail($id);
                $data = $request->all();
                // $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('promotion');
                    if(isset($promotion->image) && Storage::exists($promotion->image)) {
                        Storage::delete($promotion->image);
                    }
                }else{
                    $data['image']=$promotion->image;
                }
                $promotion->update($data);
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
     * @param  \App\Models\OilGrade  $oilGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Promotion::findOrFail($id);
            if(isset($data->image) && Storage::exists($data->image)) {
                Storage::delete($data->image);
            }
            $data->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
    public function changestatus(Request $request,$id){
        
        $data = Promotion::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

}
