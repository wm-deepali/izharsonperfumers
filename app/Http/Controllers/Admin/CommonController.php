<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommonController extends Controller
{
    public function citiesByState($id)
    {
        try{
            $state = State::findOrFail($id);
            $cities = City::where('state_id',$state->id)->get();
            return response()->json([
                "success" => true,
                "html" => view('common.city-options')->with([
                    'cities' => $cities
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function fetchChildsByAttributes(Request $request)
    {
        try {
            $attributes = array_filter(explode(',',$request->attribute_options));
            $attribute_name_1 = '';
            $attribute_1_childs = Null;
            $attribute_name_2 = '';
            $attribute_2_childs = Null;
            if(count($attributes) <= 2) {
                if(isset($attributes[0])) {
                    $attribute_1 = Attribute::findOrFail($attributes[0]);
                    $attribute_1_child_ids[] = $attribute_1->all_childs()->pluck('id')->toArray();
                    $all_attribute_1_child_ids = Arr::flatten($attribute_1_child_ids);
                    $attribute_name_1 = $attribute_1->name;
                    $attribute_1_childs = Attribute::whereIn('id',$all_attribute_1_child_ids)->get();
                }
                if(isset($attributes[1])){
                    $attribute_2 = Attribute::findOrFail($attributes[1]);
                    $attribute_2_child_ids[] = $attribute_2->all_childs()->pluck('id')->toArray();
                    $all_attribute_2_child_ids = Arr::flatten($attribute_2_child_ids);
                    $attribute_name_2 = $attribute_2->name;
                    $attribute_2_childs = Attribute::whereIn('id',$all_attribute_2_child_ids)->get();
                }
                return response()->json([
                    'success' => true,
                    'attribute_name_1' => $attribute_name_1,
                    'attribute_1_childs' => view('common.attribute-options')->with([
                        'attribute_childs' => $attribute_1_childs
                    ])->render(),
                    'attribute_name_2' => $attribute_name_2,
                    'attribute_2_childs' => view('common.attribute-options')->with([
                        'attribute_childs' => $attribute_2_childs
                    ])->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'code' => '422',
                    'errors' => [
                        'attributes' => [
                            '0' => 'Select Max 2'
                        ]
                    ]
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }
}
