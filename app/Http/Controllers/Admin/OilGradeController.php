<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OilGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OilGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = OilGrade::all();
        return view('admin.oilgrade.index',compact('datas'));
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
                "html" => view('admin.oilgrade.ajax.create')->render(),
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
           'title' => 'required|unique:oil_grades,title|min:3|max:20|regex:/^[A-Za-z.\s,-]*$/',
            // 'content' => 'max:300',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->passes()) {
            try {
                $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                // }
                OilGrade::create($data);
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
            $carorigin = OilGrade::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.oilgrade.ajax.show')->with([
                    'carorigin' => $carorigin
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
            $carorigin = OilGrade::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.oilgrade.ajax.edit')->with([
                    'carorigin' => $carorigin
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
            'title' => 'required|min:3|max:20|regex:/^[A-Za-z.\s,-]*$/|unique:oil_grades,title,'.$id,
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->passes()) {
            try {
                $career = OilGrade::findOrFail($id);
                $data = $request->all();
                // $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                //     if(isset($career->image) && Storage::exists($career->image)) {
                //         Storage::delete($career->image);
                //     }
                // }
                $career->update($data);
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
            $data = OilGrade::findOrFail($id);
            // if(isset($data->image) && Storage::exists($data->image)) {
            //     Storage::delete($data->image);
            // }
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
        
        $data = OilGrade::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

}
