<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index')->with([
            'sliders' => $sliders
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.sliders.ajax.create')->render(),
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'sub_title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required',
            'button_link' => 'required',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try{
            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'title_ar' => $request->title_ar,
                'button_link' => $request->button_link,
                'sub_title_ar' => $request->sub_title_ar,
                'content' => $request->content,
                'color' => $request->color,
                'image' => $request->image->store('sliders'),
                'status' => $request->status
            ]);
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
    }

    public function edit($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.sliders.ajax.edit')->with([
                    'slider' => $slider
                ])->render(),
            ]);
        } catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
       $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'sub_title' => 'required|min:3|max:255',
            'content' => 'required|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'status' => 'required',
            'button_link' => 'required',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $slider = Slider::findOrFail($id);
            $data = array(
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'title_ar' => $request->title_ar,
                'sub_title_ar' => $request->sub_title_ar,
                'status' => $request->status,
                 'color' => $request->color,
                 'content' => $request->content,
                'button_link' => $request->button_link,
            );
            if($request->hasFile('image')) {
                $data['image'] = $request->image->store('sliders');
                if(isset($slider->image) && Storage::exists($slider->image)) {
                    Storage::delete($slider->image);
                }
            }
            $slider->update($data);
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
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            if(isset($slider->image) && Storage::exists($slider->image)) {
                Storage::delete($slider->image);
            }
            $slider->delete();
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
}
