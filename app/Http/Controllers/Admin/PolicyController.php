<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PolicyController extends Controller
{
    public function index($name)
    {
        $policy = Policy::where('name',$name)->first();
        return view('admin.policies.index')->with([
            'name' => $name,
            'policy' => $policy,
        ]);
    }


    public function store(Request $request, $name)
    {
     //dd($request->all());
         $validator = Validator::make($request->all(), [
            'content' => 'required|min:3|max:10000|regex:/[a-zA-Z0-9&\s]+/',
             'title' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9&\s]*$/',


        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {

          // Policy::updateOrCreate(
          //           ['name' => $name, 'title' => $request->title],
          //           ['content' => $request->content]
          //       );

        Policy::updateOrCreate(['name' => $name],['content' => $request->content, 'content_ar' => $request->content_ar,'title_ar' => $request->title_ar,'title' => $request->title]);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Created',
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
