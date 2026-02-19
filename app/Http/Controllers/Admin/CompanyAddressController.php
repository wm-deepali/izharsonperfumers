<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyAddress;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Maize\EmailDomainRule\EmailDomainRule;
use Illuminate\Validation\Rule;
class CompanyAddressController extends Controller
{
    
    
    public function create()
    {
        try{
            $countrys = Country::all();
            return response()->json([
                "success" => true,
                "html" => view('admin.account-setting.create',compact('countrys'))->render(),
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
        $validator = Validator::make($requestData, [
            'name' => 'required||min:3|max:255|unique:company_address,name|regex:/^[\pL\s\-]+$/u',
            'country' => 'required',
            'state' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'email'=>['required','email',new EmailDomainRule],
            'contact_number' => 'required|digits:10',
            'whatsapp_number' => 'required|digits:10',
            'map_url' => 'required|min:3|max:765',
            'address' => 'required|min:3|max:765|regex:/^[0-9A-Za-z.\s,-]*$/',
            'status' => 'required',
            // 'city' => 'max:300',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->passes()) {
            try {
                $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                // }
                CompanyAddress::create($data);
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
            $companyaddress = CompanyAddress::findOrFail($id);
            $countrys = Country::all();
            return response()->json([
                "success" => true,
                "html" => view('admin.account-setting.edit')->with([
                    'companyaddress' => $companyaddress,
                    'countrys'=> $countrys
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
            'name' => 'required|min:3|max:255||regex:/^[\pL\s\-]+$/u|unique:company_address,name,'.$id,
            'country' => 'required',
            'state' => 'required',
            'zip_code' => 'required|min:5|max:6',
            'email'=>['required','email',new EmailDomainRule],
            'email' => 'required|unique:company_address,email,'.$id,
            'contact_number' => 'required|digits:10',
            'whatsapp_number' => 'required|digits:10',
            'map_url' => 'required|min:3|max:765',
            'address' => 'required|min:3|max:2365|regex:/^[0-9A-Za-z.\s,-]*$/',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $company = CompanyAddress::findOrFail($id);
                $data = $request->all();
                // $data = $request->all();
                // if($request->hasFile('image')) {
                //     $data['image'] = $request->image->store('career');
                //     if(isset($career->image) && Storage::exists($career->image)) {
                //         Storage::delete($career->image);
                //     }
                // }
                $company->update($data);
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
            $data = CompanyAddress::findOrFail($id);
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
    
    public function show($id){
        try {
            $companyaddress = CompanyAddress::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.account-setting.show')->with([
                    'companyaddress' => $companyaddress
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    
    
     public function changestatus(Request $request,$id){
        
        $data = CompanyAddress::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }
}
