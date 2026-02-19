<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->get();
        return view('admin.colors.index')->with([
            'colors' => $colors
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.colors.ajax.create')->render(),
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
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try {
            Color::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect(route('admin.manage-color.index'))->with('success','Add Successfull');
        } catch(\Exception $ex) {
            return redirect(route('admin.manage-color.index'))->with('error','Error Encountered '.$ex->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $color = Color::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.colors.ajax.edit')->with([
                    'color' => $color
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
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try {
            $color = Color::findOrFail($id);
            $color->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect(route('admin.manage-color.index'))->with('success','Update Successfull');
        } catch(\Exception $ex) {
            return redirect(route('admin.manage-color.index'))->with('error','Error Encountered '.$ex->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $color = Color::findOrFail($id);
            $color->delete();
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
