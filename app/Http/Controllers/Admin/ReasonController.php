<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reason;
use Illuminate\Support\Facades\Validator;
class ReasonController extends Controller
{
    public function index(){
         try {
       $reasons = Reason::all();
        return view('admin.manage-reasons-category.index')->with([
                'reasons' => $reasons
            ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
    }
    
    public function show($id){
        try {
            $reason = Reason::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.manage-reasons-category.show')->with([
                    'reason' => $reason
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    
    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'type' => 'required|max:255',
            // 'category' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                // }
                Reason::create($data);
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
            $reason = Reason::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.manage-reasons-category.edit')->with([
                    'reason' => $reason
                ])->render(),
            ]);
        } catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    
     public function update(Request $request, $id)
    {
        $requestData = $request->all();
         $validator = Validator::make($requestData, [
           'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'type' => 'required|max:255',
            // 'category' => 'required|max:255',
            'status' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                $reason = Reason::findOrFail($id);
                $data = $request->all();
                // $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                //     if(isset($career->image) && Storage::exists($career->image)) {
                //         Storage::delete($career->image);
                //     }
                // }
                $reason->update($data);
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
        try {
            $data = Reason::findOrFail($id);
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
        
        $data = Reason::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }
}
