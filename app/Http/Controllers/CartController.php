<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\UnAuthCart;
use App\Models\FreeShiping;
use App\Models\UnAuthCartDetail;
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

    public function index(Request $request)
    {
        try {

            /*
            |--------------------------------------------------------------------------
            | ✅ CHECK LOGIN
            |--------------------------------------------------------------------------
            */
            if (Auth::guard('customer')->check()) {

                $user = Auth::guard('customer')->user();

                $cart = Cart::firstOrCreate(['customer_id' => $user->id]);

                $cart->load('coupon:id,coupon_code,end_date,status,products,categories');

                $cartItems = CartDetail::where('cart_id', $cart->id)
                    ->with('products', 'product_options')
                    ->get();

            } else {

                /*
                |--------------------------------------------------------------------------
                | ✅ GUEST CART
                |--------------------------------------------------------------------------
                */
                $deviceId = $request->device_id ?? session('device_id');

                if (!$deviceId) {
                    return view('front.cart', [
                        'cart' => null,
                        'cartItems' => collect(),
                        'shippingData' => null
                    ]);
                }

                $cart = UnAuthCart::where('device_id', $deviceId)->first();

                if (!$cart) {
                    return view('front.cart', [
                        'cart' => null,
                        'cartItems' => collect(),
                        'shippingData' => null
                    ]);
                }

                $cartItems = UnAuthCartDetail::where('cart_id', $cart->id)
                    ->with('products', 'product_options')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | ✅ CALCULATE TOTALS (WORKS FOR BOTH)
            |--------------------------------------------------------------------------
            */
            $subtotal = 0;
            $preDiscount = 0;
            $quantity = 0;

            foreach ($cartItems as $item) {
                $subtotal += $item->product_options->mrp * $item->quantity;
                $preDiscount += ($item->product_options->discount_amount ?? 0) * $item->quantity;
                $quantity += $item->quantity;
            }

            if ($cart) {
                $totalAfterDiscount = max(
                    0,
                    $subtotal - $preDiscount - ($cart->discount_amount ?? 0)
                );

                $cart->update([
                    'total_price' => $subtotal,
                    'pre_discount' => $preDiscount,
                    'total_price_after_discount' => $totalAfterDiscount
                ]);

                $cart->quantity = $quantity;
                $cart->items_count = $cartItems->count();
            }

            /*
            |--------------------------------------------------------------------------
            | ✅ SHIPPING (ONLY FOR LOGGED USERS)
            |--------------------------------------------------------------------------
            */
            $shippingData = null;

            if (Auth::guard('customer')->check()) {
                $shippingData = ShippingHelper::calculate(
                    $user->shipping_pincode ?? '226026',
                    $user->billing_pincode ?? '226026',
                    $quantity,
                    $cart->total_price_after_discount ?? 0
                );
            }

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

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'product_option_id' => 'required|exists:product_options,id',
                'quantity' => 'nullable|integer|min:1',
                'device_id' => 'nullable|string'
            ]);

            $quantity = $request->quantity ?? 1;

            $product = Product::findOrFail($request->product_id);

            $productOption = ProductOption::where('id', $request->product_option_id)
                ->where('product_id', $product->id)
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | ✅ IF USER LOGGED IN → NORMAL CART
            |--------------------------------------------------------------------------
            */
            if (Auth::guard('customer')->check()) {

                $user = Auth::guard('customer')->user();

                $cart = Cart::firstOrCreate(
                    ['customer_id' => $user->id],
                    [
                        'total_price' => 0,
                        'pre_discount' => 0,
                        'discount_amount' => 0,
                        'total_price_after_discount' => 0
                    ]
                );

                $cartDetail = CartDetail::where([
                    'cart_id' => $cart->id,
                    'customer_id' => $user->id,
                    'product_id' => $product->id,
                    'product_option_id' => $productOption->id
                ])->first();

                if ($cartDetail) {
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

                $cartItems = CartDetail::where('cart_id', $cart->id)
                    ->with('product_options')
                    ->get();

            }
            /*
            |--------------------------------------------------------------------------
            | ✅ GUEST USER → UNAUTH CART
            |--------------------------------------------------------------------------
            */ else {

                if (!$request->device_id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Device ID missing'
                    ], 422);
                }

                $cart = UnAuthCart::firstOrCreate([
                    'device_id' => $request->device_id
                ]);

                $cartDetail = UnAuthCartDetail::where([
                    'cart_id' => $cart->id,
                    'device_id' => $request->device_id,
                    'product_id' => $product->id,
                    'product_option_id' => $productOption->id
                ])->first();

                if ($cartDetail) {
                    $cartDetail->quantity += $quantity;
                    $cartDetail->save();
                    $message = "Quantity updated in cart";
                } else {
                    UnAuthCartDetail::create([
                        'device_id' => $request->device_id,
                        'product_id' => $product->id,
                        'product_option_id' => $productOption->id,
                        'cart_id' => $cart->id,
                        'quantity' => $quantity,
                    ]);
                    $message = "Added to cart successfully";
                }

                $cartItems = UnAuthCartDetail::where('cart_id', $cart->id)
                    ->with('product_options')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | ✅ RECALCULATE TOTALS (WORKS FOR BOTH)
            |--------------------------------------------------------------------------
            */
            $totalPrice = 0;
            $preDiscount = 0;

            foreach ($cartItems as $item) {
                $totalPrice += $item->product_options->price * $item->quantity;
                $preDiscount += ($item->product_options->discount_amount ?? 0) * $item->quantity;
            }

            $cart->update([
                'total_price' => $totalPrice,
                'pre_discount' => $preDiscount,
                'total_price_after_discount' => $totalPrice - ($cart->discount_amount ?? 0)
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => count($cartItems),
                'total_price' => $totalPrice
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
        if (Auth::guard('customer')->check()) {

            $item = CartDetail::with('product_options')->findOrFail($id);
            $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();

        } else {

            $item = UnAuthCartDetail::with('product_options')->findOrFail($id);
            $cart = UnAuthCart::where('id', $item->cart_id)->first();
        }

        // update quantity
        $item->quantity += $request->change;

        if ($item->quantity < 1) {
            $item->delete();
        } else {
            $item->save();
        }

        /*
        |------------------------------------------
        | Re-fetch items AFTER update
        |------------------------------------------
        */

        if (Auth::guard('customer')->check()) {

            $items = CartDetail::where('cart_id', $cart->id)
                ->with('product_options')
                ->get();

        } else {

            $items = UnAuthCartDetail::where('cart_id', $cart->id)
                ->with('product_options')
                ->get();
        }

        $total = 0;
        $discount = 0;

        foreach ($items as $i) {
            $total += $i->product_options->price * $i->quantity;
            $discount += ($i->product_options->discount_amount ?? 0) * $i->quantity;
        }

        if ($cart) {
            $cart->update([
                'total_price' => $total,
                'pre_discount' => $discount,
                'total_price_after_discount' => $total - ($cart->discount_amount ?? 0)
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function setQuantity(Request $request, $id)
    {
        try {

            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            $qty = $request->quantity;

            /*
            |--------------------------------------------------------------------------
            | GET ITEM
            |--------------------------------------------------------------------------
            */

            if (Auth::guard('customer')->check()) {

                $item = CartDetail::with('product_options')->findOrFail($id);
                $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();

            } else {

                $item = UnAuthCartDetail::with('product_options')->findOrFail($id);
                $cart = UnAuthCart::where('id', $item->cart_id)->first();
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE QUANTITY
            |--------------------------------------------------------------------------
            */

            $item->quantity = $qty;
            $item->save();

            /*
            |--------------------------------------------------------------------------
            | RECALCULATE TOTALS
            |--------------------------------------------------------------------------
            */

            if (Auth::guard('customer')->check()) {

                $items = CartDetail::where('cart_id', $cart->id)
                    ->with('product_options')
                    ->get();

            } else {

                $items = UnAuthCartDetail::where('cart_id', $cart->id)
                    ->with('product_options')
                    ->get();
            }

            $total = 0;
            $discount = 0;
            $cartQty = 0;

            foreach ($items as $i) {

                $total += $i->product_options->price * $i->quantity;

                $discount += ($i->product_options->discount_amount ?? 0) * $i->quantity;

                $cartQty += $i->quantity;
            }

            if ($cart) {

                $cart->update([
                    'total_price' => $total,
                    'pre_discount' => $discount,
                    'total_price_after_discount' => $total - ($cart->discount_amount ?? 0)
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | RETURN RESPONSE
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'quantity' => $qty,
                'row_total' => number_format($item->product_options->price * $qty, 2),
                'cart_total' => number_format($cart->total_price_after_discount, 2),
                'cart_count' => $cartQty
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function removeItem($id)
    {
        if (Auth::guard('customer')->check()) {

            $item = CartDetail::findOrFail($id);
            $cart = Cart::where('customer_id', Auth::guard('customer')->id())->first();
            $item->delete();

            $items = CartDetail::where('cart_id', $cart->id)->with('product_options')->get();

        } else {

            $item = UnAuthCartDetail::findOrFail($id);
            $cart = UnAuthCart::where('id', $item->cart_id)->first();
            $item->delete();

            $items = UnAuthCartDetail::where('cart_id', $cart->id)->with('product_options')->get();
        }

        $total = 0;

        foreach ($items as $i) {
            $total += $i->product_options->price * $i->quantity;
        }

        if ($cart) {
            $cart->update([
                'total_price' => $total,
                'total_price_after_discount' => $total - ($cart->discount_amount ?? 0)
            ]);
        }

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
            $user = Auth::guard('customer')->user();

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
            $user = Auth::guard('customer')->user();

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


    public static function mergeGuestCart($customerId, $deviceId)
    {
        if (!$deviceId) {
            return;
        }

        // Find guest cart
        $guestCart = UnAuthCart::where('device_id', $deviceId)->first();

        if (!$guestCart) {
            return;
        }

        // Get or create user cart
        $cart = Cart::firstOrCreate([
            'customer_id' => $customerId
        ]);

        $guestItems = UnAuthCartDetail::where('cart_id', $guestCart->id)->get();

        foreach ($guestItems as $item) {

            $existing = CartDetail::where([
                'cart_id' => $cart->id,
                'product_id' => $item->product_id,
                'product_option_id' => $item->product_option_id
            ])->first();

            if ($existing) {

                // If item already exists in user cart → increase quantity
                $existing->quantity += $item->quantity;
                $existing->save();

            } else {

                // Otherwise create new cart item
                CartDetail::create([
                    'customer_id' => $customerId,
                    'cart_id' => $cart->id,
                    'product_id' => $item->product_id,
                    'product_option_id' => $item->product_option_id,
                    'quantity' => $item->quantity
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Recalculate Cart Totals
        |--------------------------------------------------------------------------
        */

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
            'total_price_after_discount' => $totalPrice - ($cart->discount_amount ?? 0)
        ]);

        /*
        |--------------------------------------------------------------------------
        | Delete Guest Cart
        |--------------------------------------------------------------------------
        */

        UnAuthCartDetail::where('cart_id', $guestCart->id)->delete();
        $guestCart->delete();
    }


    public function miniCart()
    {
        if (Auth::guard('customer')->check()) {

            $cart = Cart::with('cart_details.product_options', 'cart_details.products')
                ->where('customer_id', Auth::guard('customer')->id())
                ->first();

        } else {

            $deviceId = session('device_id');

            $cart = UnAuthCart::with('cart_details.product_options', 'cart_details.products')
                ->where('device_id', $deviceId)
                ->first();
        }

        $items = $cart ? $cart->cart_details : collect();

        $total = $cart->total_price_after_discount ?? 0;

        /*
        |---------------------------------------
        | FREE SHIPPING
        |---------------------------------------
        */

        $freeShipping = FreeShiping::where('status', 'active')->first();

        $freeLimit = $freeShipping->min_order_value_intrastate ?? 0;

        $remaining = max(0, $freeLimit - $total);

        return response()->json([
            'items' => $items,
            'total' => $total,
            'count' => $items->sum('quantity'),
            'free_shipping_limit' => $freeLimit,
            'free_shipping_remaining' => $remaining
        ]);
    }
}