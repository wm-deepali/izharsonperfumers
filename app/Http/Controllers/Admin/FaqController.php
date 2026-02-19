<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faqs.index')->with([
            'faqs' => $faqs
        ]);
    }

    public function create()
    {
        try {
            $faq_categories = FaqCategory::all();
            return response()->json([
                "success" => true,
                "html" => view('admin.faqs.ajax.create')->with([
                    'faq_categories' => $faq_categories
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
       $validator = Validator::make($request->all(), [
            'faq_category' => "required",
            'question' => 'required|min:3|max:1000',
            'answer' => 'required|min:3|max:1000',
        ]);
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            Faq::create([
                'faq_category_id' => $request->faq_category,
                'question' => $request->question,
                'answer' => $request->answer,
                'question_ar' => $request->question_ar,
                'answer_ar' => $request->answer_ar,
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
            $faq_categories = FaqCategory::all();
            $faq = Faq::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.faqs.ajax.edit')->with([
                    'faq_categories' => $faq_categories,
                    'faq' => $faq
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'faq_category' => "required",
            'question' => 'required|min:3|max:1000',
            'answer' => 'required|min:3|max:1000',
        ]);
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $faq = Faq::findOrFail($id);
            $faq->update([
                'faq_category_id' => $request->faq_category,
                'question' => $request->question,
                'answer' => $request->answer,
                'question_ar' => $request->question_ar,
                'answer_ar' => $request->answer_ar,
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
            $faq = Faq::findOrFail($id);
            $faq->delete();
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
