<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index')->with([
            'coupons' => $coupons
        ]);
    }

  public function create()
{
    $categories = Category::whereNull('parent_id')
        ->with([
            'all_childs.direct_childs',
            'productssn', // products under subcategory
            'productsn',  // products under category
        ])
        ->get();

    return view('admin.coupons.create', compact('categories'));
}


public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'coupon_code'      => 'required|min:3|max:30|unique:coupons|regex:/^[0-9A-Za-z.\s,-]*$/',
        'description'      => 'required',
        'discount_type'    => 'required',
        'discount_amount'  => 'required|gte:0',
        'maximum_discount' => 'required|gte:0',
        'start_date'       => 'required|after:today',
        'end_date'         => 'required|date|after:start_date',
        'subtotal_start'   => 'required|gt:0',
        'subtotal_end'     => 'required|gt:0',
        'limit_use'        => 'required',
        'number_of_use'    => 'required|gte:0',
        'categories'       => 'required', // array or string, we’ll normalize
        'status'           => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'code'    => 422,
            'errors'  => $validator->errors(),
        ]);
    }

    try {
        // Normalize categories to array
        $selected = is_array($request->categories)
            ? $request->categories
            : explode(',', $request->categories);

        $categoryIds = [];
        $productIds  = [];

        foreach ($selected as $val) {
            if (str_starts_with($val, 'product-')) {
                $productIds[] = str_replace('product-', '', $val);
            } else {
                $categoryIds[] = $val;
            }
        }

        Coupon::create([
            'coupon_code'      => $request->coupon_code,
            'description'      => $request->description,
            'discount_type'    => $request->discount_type,
            'discount_amount'  => $request->discount_amount,
            'maximum_discount' => $request->maximum_discount,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'subtotal_start'   => $request->subtotal_start,
            'subtotal_end'     => $request->subtotal_end,
            'limit_use'        => $request->limit_use,
            'number_of_use'    => $request->number_of_use,
            'categories'       => implode(',', $categoryIds), // save as CSV
            'products'         => implode(',', $productIds),  // save as CSV
            'status'           => $request->status,
        ]);

        return response()->json([
            "success" => true,
        ]);
    } catch (\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' => $ex->getMessage(),
        ]);
    }
}


    public function edit($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $categories = Category::whereNull('parent_id')->get();
            return view('admin.coupons.edit')->with([
                'coupon' => $coupon,
                'categories' => $categories,
            ]);
        } catch(\Exception $ex) {
            return redirect(route('admin.manage-coupon.index'))->with('error','Error Encountered '.$ex->getMessage());
        }
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        "coupon_code"      => ["required", Rule::unique('coupons')->ignore($id), "max:255", "regex:/^[0-9A-Za-z.\s,-]*$/"],
        'description'      => 'required',
        'discount_type'    => 'required',
        'discount_amount'  => 'required|gte:0',
        'maximum_discount' => 'required|gte:0',
        'start_date'       => 'required|after:today',
        'end_date'         => 'required|date|after:start_date',
        'subtotal_start'   => 'required|gt:0',
        'subtotal_end'     => 'required|gt:0',
        'limit_use'        => "required",
        'number_of_use'    => 'required|gte:0',
        'categories'       => 'required', // array or string
        'status'           => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'code'    => 422,
            'errors'  => $validator->errors(),
        ]);
    }

    try {
        $coupon = Coupon::findOrFail($id);

        // Normalize categories to array
        $selected = is_array($request->categories)
            ? $request->categories
            : explode(',', $request->categories);

        $categoryIds = [];
        $productIds  = [];

        foreach ($selected as $val) {
            if (str_starts_with($val, 'product-')) {
                $productIds[] = str_replace('product-', '', $val);
            } else {
                $categoryIds[] = $val;
            }
        }

        $coupon->update([
            'coupon_code'      => $request->coupon_code,
            'description'      => $request->description,
            'discount_type'    => $request->discount_type,
            'discount_amount'  => $request->discount_amount,
            'maximum_discount' => $request->maximum_discount,
            'start_date'       => $request->start_date,
            'end_date'         => $request->end_date,
            'subtotal_start'   => $request->subtotal_start,
            'subtotal_end'     => $request->subtotal_end,
            'limit_use'        => $request->limit_use,
            'number_of_use'    => $request->number_of_use,
            'categories'       => implode(',', $categoryIds), // save as CSV
            'products'         => implode(',', $productIds),  // save as CSV
            'status'           => $request->status,
        ]);

        return response()->json([
            "success" => true,
        ]);
    } catch (\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' => $ex->getMessage(),
        ]);
    }
}


    public function destroy($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
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
