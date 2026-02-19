<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AboutUsController extends Controller
{
    public function index()
    {
        $about_us = AboutUs::first();
        return view('admin.about-us.index')->with([
            'about_us' => $about_us
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'title_ar' => 'max:300',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|min:|max:8000',
             'meta_keywords' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'meta_description' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'meta_title' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
         'canonical_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-\/:]*$/',
           'twitter_cards' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'og_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
           
            $data = $request->all();
            if($request->hasFile('image')) {
                $data['image'] = $request->image->store('about-us');
            }
          $about =  AboutUs::updateOrCreate(['id' => 1],$data);
            $about->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                    'description' => $request->description,
                ]);
             return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }
}
