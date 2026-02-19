<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::whereNull('parent_id')->get();
        return view('admin.attributes.index')->with([
            'attributes' => $attributes
        ]);
    }

    public function create()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('admin.attributes.ajax.create')->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                $attribute = Attribute::create([
                    'parent_id' => $request->parent_id ?? Null,
                    'name' => $request->name,
                ]);
                if($request->parent_id) {
                    $code = 'Attribute-'.$request->parent_id.'-'.$attribute->id;
                } else {
                    $code = 'Attribute-'.$attribute->id;
                }
                $attribute->update([
                    'code' => $code
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
            $attribute = Attribute::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.attributes.ajax.edit')->with([
                    'attribute' => $attribute
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                $attribute = Attribute::findOrFail($id);
                $attribute->update([
                    'name' => $request->name,
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
            $attribute = Attribute::findOrFail($id);
            if($attribute->direct_childs->count() > 0 ) {
                return response()->json([
                    'success' => false,
                    'msgText' => 'Delete child categories first',
                ]);
            }
            $attribute->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex){
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $parent_attribute = Attribute::findOrFail($id);
        $attributes = Attribute::where('parent_id',$parent_attribute->id)->get();
        return view('admin.attributes.children')->with([
            'parent_attribute' => $parent_attribute,
            'attributes' => $attributes
        ]);
    }
}
