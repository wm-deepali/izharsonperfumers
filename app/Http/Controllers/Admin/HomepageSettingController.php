<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Validator;
use Storage;
class HomepageSettingController extends Controller
{
    public function index()
    {
        $homepage_setting = HomepageSetting::all();
        return view('admin.homepage-setting.index')->with([
            'homepage_setting' => $homepage_setting,
        ]);
    }
    
    public function edit($id){
        $homepage_setting = HomepageSetting::find($id);
        return view('admin.homepage-setting.edit')->with([
            'homepage_setting' => $homepage_setting,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            // 'heading' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-,!]*$/',
            // 'content' => 'min:3|max:3000',
            'url_txt' => 'nullable|min:3|max:255|regex:/^[0-9A-Za-z.\s,-,!]*$/',
            'url'=>'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->passes()) {
            try {
                $home = HomepageSetting::findOrFail($id);
                $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('homewidget');
                    if(isset($home->image) && Storage::exists($home->image)) {
                        Storage::delete($home->image);
                    }
                }else{
                    $data['image']=$home->image;
                }
                $home->update($data);
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
}