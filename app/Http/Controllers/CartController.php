<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductOption;
use App\Helpers\ShippingHelper;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    public function index()
    {
        try {

            // 👉 replace with auth later
            $user = Customer::find(284);

            // create cart if not exists
            $cart = Cart::firstOrCreate(['customer_id' => $user->id]);

            // load coupon relation
            $cart->load('coupon:id,coupon_code,end_date,status,products,categories');

            // cart items
            $cartItems = CartDetail::where('cart_id', $cart->id)
                ->with('products', 'product_options')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | VALIDATE COUPON
            |--------------------------------------------------------------------------
            */

            if ($cart->coupon) {

                // ❌ expired OR inactive
                if (
                    \Carbon\Carbon::parse($cart->coupon->end_date)->isPast() ||
                    strtolower($cart->coupon->status) !== 'active'
                ) {
                    $cart->update([
                        'discount_amount' => 0,
                        'coupon_id' => null
                    ]);
                } else {

                    $cartProductIds = $cartItems->pluck('product_id')->toArray();

                    // collect category & subcategory ids
                    $cartCategories = Product::whereIn('id', $cartProductIds)
                        ->select('category_id', 'subcategory_id')
                        ->get();

                    $categoryIds = [];

                    foreach ($cartCategories as $product) {
                        if ($product->category_id)
                            $categoryIds[] = $product->category_id;
                        if ($product->subcategory_id)
                            $categoryIds[] = $product->subcategory_id;
                    }

                    $categoryIds = array_unique($categoryIds);

                    /*
                    |--------------------------------------------------------------------------
                    | FIND COUPON
                    |--------------------------------------------------------------------------
                    */
                    $coupon = Coupon::where('coupon_code', $cart->coupon->coupon_code)
                        ->whereDate('start_date', '<=', now())
                        ->whereDate('end_date', '>=', now())
                        ->where('status', 'active')
                        ->where(function ($query) use ($cartProductIds, $categoryIds) {

                            foreach ($categoryIds as $cat) {
                                $query->orWhereRaw("find_in_set(?, categories)", [$cat]);
                            }

                            foreach ($cartProductIds as $pid) {
                                $query->orWhereRaw("find_in_set(?, products)", [$pid]);
                            }

                        })
                        ->first();

                    if (!$coupon) {
                        $cart->update([
                            'discount_amount' => 0,
                            'coupon_id' => null
                        ]);
                    }
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CALCULATE TOTALS
            |--------------------------------------------------------------------------
            */

            $subtotal = 0;
            $preDiscount = 0;
            $quantity = 0;

            foreach ($cartItems as $item) {

                $subtotal += $item->product_options->mrp * $item->quantity;

                $preDiscount +=
                    ($item->product_options->discount_amount ?? 0)
                    * $item->quantity;

                $quantity += $item->quantity;
            }

            // remove coupon if cart empty
            if ($quantity == 0) {
                $cart->update([
                    'coupon_id' => null,
                    'discount_amount' => 0
                ]);
            }

            $totalAfterDiscount = max(
                0,
                $subtotal - $preDiscount - ($cart->discount_amount ?? 0)
            );

            // update only if changed (avoid unnecessary queries)
            if (
                $cart->total_price != $subtotal ||
                $cart->pre_discount != $preDiscount ||
                $cart->total_price_after_discount != $totalAfterDiscount
            ) {
                $cart->update([
                    'total_price' => $subtotal,
                    'pre_discount' => $preDiscount,
                    'total_price_after_discount' => $totalAfterDiscount
                ]);
            }

            // set runtime values
            $cart->quantity = $quantity;
            $cart->items_count = $cartItems->count();

            /*
            |--------------------------------------------------------------------------
            | SHIPPING CALCULATION
            |--------------------------------------------------------------------------
            */

            $shippingData = ShippingHelper::calculate(
                $user->shipping_pincode ?? '226026',
                $user->billing_pincode ?? '226026',
                $cart->quantity,
                $cart->total_price_after_discount
            );

            return view('front.cart', compact('cart', 'cartItems', 'shippingData'));

        } catch (\Exception $e) {

            return back()->with('error', 'Unable to load cart.');
        }
    }
    /**
     * Add product to cart
     */
    public function storeCart(Request $request)
    {
        try {

            // ✅ ensure logged in
            // if (!Auth::check()) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Please login first'
            //     ], 401);
            // }

            // $user = Auth::user();

            $user = Customer::find(284);

            // validate request
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'product_option_id' => 'required|exists:product_options,id',
                'quantity' => 'nullable|integer|min:1'
            ]);

            $quantity = $request->quantity ?? 1;

            // get product & option
            $product = Product::findOrFail($request->product_id);

            $productOption = ProductOption::where('id', $request->product_option_id)
                ->where('product_id', $product->id)
                ->firstOrFail();

            // create or get cart
            $cart = Cart::firstOrCreate(
                ['customer_id' => $user->id],
                [
                    'total_price' => 0,
                    'pre_discount' => 0,
                    'discount_amount' => 0,
                    'total_price_after_discount' => 0
                ]
            );

            // check existing cart item
            $cartDetail = CartDetail::where([
                'cart_id' => $cart->id,
                'customer_id' => $user->id,
                'product_id' => $product->id,
                'product_option_id' => $productOption->id
            ])->first();

            if ($cartDetail) {

                // 🔥 increase quantity instead of duplicate
                $cartDetail->quantity += $quantity;
                $cartDetail->save();

                $message = "Quantity updated in cart";

            } else {

                CartDetail::create([
                    'customer_id' => $user->id,
                    'product_id' => $product->id,
                    'product_option_id' => $productOption->id,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                ]);

                $message = "Added to cart successfully";
            }

            // 🔥 recalculate totals safely
            $cartItems = CartDetail::where('cart_id', $cart->id)
                ->with('product_options')
                ->get();

            $totalPrice = 0;
            $preDiscount = 0;

            foreach ($cartItems as $item) {
                $totalPrice += $item->product_options->price * $item->quantity;
                $preDiscount += ($item->product_options->discount_amount ?? 0) * $item->quantity;
            }

            $cart->update([
                'total_price' => $totalPrice,
                'pre_discount' => $preDiscount,
                'total_price_after_discount' => $totalPrice - $cart->discount_amount
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartItems->count(),
                'total_price' => $cart->total_price
            ]);

        } catch (\Exception $ex) {

            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine()
            ], 500);
        }
    }

    public function updateQty(Request $request, $id)
    {
        $item = CartDetail::findOrFail($id);
        $item->quantity += $request->change;

        if ($item->quantity < 1) {
            $item->delete();
        } else {
            $item->save();
        }

        return response()->json(['success' => true]);
    }

    public function removeItem($id)
    {
        CartDetail::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon code is required'
            ], 422);
        }

        try {

            // $user = auth()->user();
            $user = Customer::find(284);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $cart = Cart::where('customer_id', $user->id)->firstOrFail();

            $cartDetails = CartDetail::where('cart_id', $cart->id)->get();

            $cartProductIds = $cartDetails->pluck('product_id')->toArray();

            // collect category & subcategory ids
            $cartCategories = Product::whereIn('id', $cartProductIds)
                ->select('category_id', 'subcategory_id')
                ->get();

            $categoryIds = [];

            foreach ($cartCategories as $product) {
                if ($product->category_id)
                    $categoryIds[] = $product->category_id;
                if ($product->subcategory_id)
                    $categoryIds[] = $product->subcategory_id;
            }

            $categoryIds = array_unique($categoryIds);

            /*
            |--------------------------------------------------------------------------
            | FIND COUPON
            |--------------------------------------------------------------------------
            */
            $coupon = Coupon::where('coupon_code', $request->coupon_code)
                ->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now())
                ->where('status', 'active')
                ->where(function ($query) use ($cartProductIds, $categoryIds) {

                    foreach ($categoryIds as $cat) {
                        $query->orWhereRaw("find_in_set(?, categories)", [$cat]);
                    }

                    foreach ($cartProductIds as $pid) {
                        $query->orWhereRaw("find_in_set(?, products)", [$pid]);
                    }

                })
                ->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon'
                ], 422);
            }

            // usage limit
            if ($user->orders()->count() >= $coupon->number_of_use) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon usage limit reached'
                ], 422);
            }

            if ($coupon->min_order > $cart->total_price) {
                return response()->json([
                    'success' => false,
                    'message' => 'Minimum order not met'
                ], 422);
            }

            /*
            |--------------------------------------------------------------------------
            | CALCULATE DISCOUNT
            |--------------------------------------------------------------------------
            */

            $prediscount = $cart->pre_discount ?? 0;
            $amountAfterPreDiscount = $cart->total_price - $prediscount;

            if ($coupon->discount_type == 'amount') {
                $discount = $coupon->discount_amount;
            } else {
                $discount = ($amountAfterPreDiscount * $coupon->discount_amount) / 100;
            }

            $discount = min($discount, $amountAfterPreDiscount);

            $cart->update([
                'coupon_id' => $coupon->id,
                'discount_amount' => $discount,
                'total_price_after_discount' => $amountAfterPreDiscount - $discount
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully',
                'discount' => $discount
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function removeCoupon()
    {
        try {

            // $user = auth()->user();
            $user = Customer::find(284);

            $cart = Cart::where('customer_id', $user->id)->firstOrFail();

            $cart->update([
                'coupon_id' => null,
                'discount_amount' => 0,
                'total_price_after_discount' => $cart->total_price - ($cart->pre_discount ?? 0)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Coupon removed'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}