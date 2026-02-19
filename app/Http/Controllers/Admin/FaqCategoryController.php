<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FaqCategoryController extends Controller
{
    public function index()
    {
        $faq_categories = FaqCategory::latest()->get();
        return view('admin.faq-categories.index')->with([
            'faq_categories' => $faq_categories
        ]);
    }


    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.faq-categories.ajax.create')->render(),
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
            'name' => 'required|unique:faq_categories,name|min:3|max:255',
        ]);
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try{
            FaqCategory::create([
                'name' => $request->name,
                'name_ar' => $request->name_ar
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
            $faq_category = FaqCategory::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.faq-categories.ajax.edit')->with([
                    'faq_category' => $faq_category
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
            'name' => 'required|min:3|max:255|unique:faq_categories,name,'.$id,
        ]);
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $faq_category = FaqCategory::findOrFail($id);
            $faq_category->update([
                'name' => $request->name,
                'name_ar' => $request->name_ar
            ]);
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
            $faq_category = FaqCategory::findOrFail($id);
            $faq_category->delete();
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
