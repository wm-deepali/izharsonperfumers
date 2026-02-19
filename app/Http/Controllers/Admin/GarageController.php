<?php

namespace App\Http\Controllers\Admin;

use App\Models\Garage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Garage::all();
        return view('admin.garage.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.garage.ajax.create')->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'title' => 'required|max:255',
            'title_ar' => 'max:300',
            'url' => 'required|max:255|unique:blogs',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('garage');
                }
                Garage::create($data);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function show(Garage $garage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Garage::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.garage.ajax.edit')->with([
                    'garage' => $data
                ])->render(),
            ]);
        } catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'title' => 'required|max:255',
            'title_ar' => 'max:300',
            'url' => 'required|max:255|unique:blogs',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $team = Garage::findOrFail($id);
                $data = $request->all();
                // $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('garage');
                    if(isset($team->image) && Storage::exists($team->image)) {
                        Storage::delete($team->image);
                    }
                }
                $team->update($data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Garage  $garage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Garage::findOrFail($id);
            if(isset($data->image) && Storage::exists($data->image)) {
                Storage::delete($data->image);
            }
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
}
