<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Pincode;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PincodeController extends Controller
{
    public function index()
    {
        $pincodes = Pincode::latest()->get();
        return view('admin.pincodes.index')->with([
            'pincodes' => $pincodes
        ]);
    }

    public function create()
    {
        try {
            $states = State::where('country_id',101)->get();
            return response()->json([
                "success" => true,
                "html" => view('admin.pincodes.ajax.create')->with([
                    'states' => $states,
                ])->render(),
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
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6|unique:pincodes',
        ]);
        if ($validator->passes()) {
            try{
                Pincode::create([
                    'state_id' => $request->state,
                    'city_id' => $request->city,
                    'pincode' => $request->pincode,
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
            $pincode = Pincode::findOrFail($id);
            $states = State::where('country_id',101)->get();
            $cities = City::where('state_id',$pincode->state_id)->get();
            return response()->json([
                "success" => true,
                "html" => view('admin.pincodes.ajax.edit')->with([
                    'pincode' => $pincode,
                    'states' => $states,
                    'cities' => $cities,
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
            'state' => 'required',
            'city' => 'required',
            'pincode' => ["required",Rule::unique('pincodes')->ignore($id),'digits:6'],
        ]);
        if ($validator->passes()) {
            try {
                $pincode = Pincode::findOrFail($id);
                $pincode->update([
                    'state_id' => $request->state,
                    'city_id' => $request->city,
                    'pincode' => $request->pincode,
                ]);
                return response()->json([
                    'success' => true,
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
        try{
            $pincode = Pincode::findOrFail($id);
            $pincode->delete();
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