<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Attribute;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Color;
use App\Models\ContactUs;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\FaqCategory;
use App\Models\Feedback;
use App\Models\GeneralSetting;
use App\Models\HomepageSetting;
use App\Models\Order;
use App\Models\City;
use App\Models\State;
use App\Models\OrderDetail;
use App\Models\OrderProductReview;
use App\Models\Pincode;
use App\Models\Policy;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ShippingType;
use App\Models\Slider;
use App\Models\SiteGstSetting;
use App\Models\ShippingCost;
use App\Models\Wishlist;
use App\Models\CustomerBillingAddress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

use PDF;
class CartController extends Controller {
    // add to cart and save details to database

    public function addToCart(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'attribute_detail' => 'required',
            'quantity' => 'required|gte:1',
        ]);
        if ($validator->passes()) {
            try {
                $quantity = $request->quantity;
                $product = Product::findOrFail($request->product_id);
                $color = Color::findOrFail($request->color_id);
                $attribute_details = json_decode($request->attribute_detail,true);


                $child_attribute_1_id = (isset($attribute_details[0])) ? $attribute_details[0]['child_attribute_id'] : Null;
                $child_attribute_2_id = (isset($attribute_details[1])) ? $attribute_details[1]['child_attribute_id'] : Null;
                $product_option = ProductOption::where('product_id',$product->id)
                ->where('color_id',$color->id)
                ->where('attribute_1_id',$child_attribute_1_id)
                ->when($child_attribute_2_id, function ($query, $child_attribute_2_id) {
                    return $query->where('attribute_2_id',$child_attribute_2_id);
                })->firstOrFail();

                 
                if($product_option->stock > 0) {
                    if(Auth::guard('customer')->check()) {
                        $customer = Auth::guard('customer')->user();
                        $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
                        $cart_detail = CartDetail::where('cart_id',$cart->id)->where('product_option_id',$product_option->id)->first();
                        if($cart_detail) {
                            if($product_option->stock >= $cart_detail->quantity + $quantity) {
                                $cart_detail->update([
                                    'quantity' => $cart_detail->quantity + $quantity
                                ]);
                            }
                        } else {
                            CartDetail::create([
                                'customer_id' => $customer->id,
                                'cart_id' => $cart->id,
                                'product_id' => $product->id,
                                'product_option_id' => $product_option->id,
                                'quantity' => $quantity,
                            ]);
                        }
                        $cart->update([
                            'coupon_id' => Null,
                            'discount_amount' => 0,
                            'total_price_after_discount' => $cart->total_price,
                        ]);
                    } else {
                        $carts = $request->session()->get('cart');
                        if(isset($carts) && count($carts)>0) {
                            for($i=0;$i<count($carts);$i++) {
                                if($product_option->id == $carts[$i]['product_option_id']) {
                                    if($product_option->stock >= $carts[$i]['quantity'] + $quantity) {
                                        $carts[$i]['quantity'] = $carts[$i]['quantity'] + $quantity;
                                        $request->session()->forget('cart');
                                        $request->session()->put('cart', array_values($carts));
                                    }
                                } else {
                                    $cartArray = array();
                                    $cartArray = array(
                                        'id' => $product_option->id,
                                        'product_id' => $product->id,
                                        'product_option_id' => $product_option->id,
                                        'quantity' => $quantity,
                                    );
                                    $request->session()->push('cart', $cartArray);
                                }
                            }
                        } else {
                            $cartArray = array();
                            $cartArray = array(
                                'id' => $product_option->id,
                                'product_id' => $product->id,
                                'product_option_id' => $product_option->id,
                                'quantity' => $quantity,
                            );
                            $request->session()->push('cart', $cartArray);
                        }
                    }
                    return response()->json([
                        'success' => true,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'code' => 400,
                        'msgText' => 'Out of Stock',
                    ]);
                }
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

    public function buyNowProcess(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'attribute_detail' => 'required',
            'quantity' => 'required|gte:1',
        ]);
        if ($validator->passes()) {
            try {
                $quantity = $request->quantity;
                $product = Product::findOrFail($request->product_id);
                $color = Color::findOrFail($request->color_id);
                $attribute_details = json_decode($request->attribute_detail,true);

                $child_attribute_1_id = (isset($attribute_details[0])) ? $attribute_details[0]['child_attribute_id'] : Null;
                $child_attribute_2_id = (isset($attribute_details[1])) ? $attribute_details[1]['child_attribute_id'] : Null;
                $product_option = ProductOption::where('product_id',$product->id)
                ->where('color_id',$color->id)
                ->where('attribute_1_id',$child_attribute_1_id)
                ->when($child_attribute_2_id, function ($query, $child_attribute_2_id) {
                    return $query->where('attribute_2_id',$child_attribute_2_id);
                })->firstOrFail();
                 
                if($product_option->stock > 0) {
                    // if(Auth::guard('customer')->check()) {
                        $customer = Auth::guard('customer')->user();
                        $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
                        $cart_detail = CartDetail::where('cart_id',$cart->id)->where('product_option_id',$product_option->id)->first();
                        if($cart_detail) {
                            if($product_option->stock >= $cart_detail->quantity + $quantity) {
                                $cart_detail->update([
                                    'quantity' => $cart_detail->quantity + $quantity
                                ]);
                            }
                        } else {
                            CartDetail::create([
                                'customer_id' => $customer->id,
                                'cart_id' => $cart->id,
                                'product_id' => $product->id,
                                'product_option_id' => $product_option->id,
                                'quantity' => $quantity,
                            ]);
                        }
                        $cart->update([
                            'coupon_id' => Null,
                            'discount_amount' => 0,
                            'total_price_after_discount' => $cart->total_price,
                        ]);

                        $address = DB::table('customer_addresses')->where('customer_id', $customer->id)->first();
                        if(!empty($address)) {
                            $shipping_pincode  = Pincode::where('pincode',$address->pincode)->count();
                            if($shipping_pincode > 0){
                                return response()->json([
                                    'success' => true,
                                ]);
                                
                            } else {
                                return response()->json([
                                    'success' => false,
                                    "msgText" => "Pincode is not available for delivery",
                                    "TotalShipCost" =>  $TotalShipCost,
                                ]);
                            }
                            
                        } else {
                            return response()->json([
                                'success' => false,
                                'code' => 400,
                                'msgText' => 'Pincode required',
                            ]);
                        }
                    // }
                    // return response()->json([
                    //     'success' => true,
                    // ]);


                } else {
                    return response()->json([
                        'success' => false,
                        'code' => 400,
                        'msgText' => 'Out of Stock',
                    ]);
                }
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

    // cart details data 
    public function cart(Request $request) {
        try {
            $GstCharges = SiteGstSetting::where('invoice_status','on')->where('financial_year_status','on')->first();
            if(Auth::guard('customer')->check()) {
                //dd($request->all());
                $customer = Auth::guard('customer')->user();
                $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
               

                $cart_details = CartDetail::where('cart_id',$cart->id)->get();
                //dd($cart_details);
                if(isset($cart_details) && count($cart_details)>0) {
                    $cart_datas = [];
                    $is_cart_updated = 'no';

                    foreach($cart_details as $cart_detail) {
                        $product = Product::findOrFail($cart_detail->product_id);
                          // check for product option if exist in cart detils n product option table 
                             $countProductOptioId = ProductOption::where('id',$cart_detail->product_option_id)->get();                             
                             if(count($countProductOptioId) == 0){
                                CartDetail::where('product_id',$product->id)->where('product_option_id',$cart_detail->product_option_id)->delete();
                             }
                           // end check 

                        $product_option = ProductOption::where('product_id',$product->id)->where('id',$cart_detail->product_option_id)->where('stock','>',0)->first();
                        if($product_option) {
                            $quantity = $cart_detail->quantity;
                            if($product_option->stock < $quantity) {
                                $is_cart_updated = 'yes';
                                $quantity = $product_option->stock;
                                CartDetail::where('cart_id',$cart->id)->where('product_option_id',$product_option->id)->update([
                                    'quantity' => $quantity
                                ]);
                            } else {
                                $cart_datas[] = array(
                                    'id' => $product_option->id,
                                    'product_id' => $product->id,
                                    'name' => $product->name,
                                    'image' => $product->image,
                                    'parent_attribute_1_name' => $product->attribute_1->name,
                                    'parent_attribute_2_name' => $product->attribute_2->name ?? Null,
                                    'product_option_id' => $product_option->id,
                                    'color_name' => $product_option->color->name,
                                    'attribute_1_name' => $product_option->attribute_1->name,
                                    'attribute_2_name' => $product_option->attribute_2->name ?? Null,
                                    'price' => $product_option->price,
                                    'quantity' => $quantity,
                                    'available_quantity' => $product_option->stock,
                                    'pre_discount_price' => $product_option->discount_amount * $quantity,
                                    'total_price' => $product_option->price * $quantity,
                                );
                            }
                        } else {
                            $is_cart_updated = 'yes';
                            CartDetail::where('cart_id',$cart->id)->where('product_option_id',$product_option->id)->delete();
                        }
                    }

                    $cart_total = array_sum(array_column($cart_datas, 'total_price'));
                    $preDiscountAmount = array_sum(array_column($cart_datas, 'pre_discount_price'));
                    $cart_quantity =array_sum(array_column($cart_datas, 'quantity'));
                    if($is_cart_updated == 'yes') {
                        $cart->update([
                            'total_price' => $cart_total,
                            'discount_amount' => 0,
                            'total_price_after_discount' => $cart_total,
                        ]);
                    } else {
                        $cart->update([
                            'total_price' => $cart_total,
                            'total_price_after_discount' => $cart_total - $cart->discount_amount,
                        ]);
                    }
                    $discount_amount = $cart->discount_amount;
                    return view('frontend.cart.index')->with([
                        'cart_datas' => $cart_datas,
                        'cart_total' => $cart_total,
                        'discount_amount' => $discount_amount,
                        'cart_final' => $cart->total_price_after_discount,
                        'cart_quantity' => $cart_quantity,
                         'preDiscountAmount' => $preDiscountAmount,
                         'GstCharges' => $GstCharges,

                    ]);
                } else {
                    return redirect(url('/'));
                }
            } else {
                $carts = $request->session()->get('cart');
               // dd($carts);
                if(isset($carts) && count($carts)>0) {
                    $cart_datas = [];
                    $cart_item_removed = 'no';
                    for($i=0;$i<count($carts);$i++) {
                        $product = Product::findOrFail($carts[$i]['product_id']);
                        $product_option = ProductOption::where('product_id',$product->id)->where('id',$carts[$i]['product_option_id'])->where('stock','>',0)->first();
                        if($product_option) {
                            $quantity = $carts[$i]['quantity'];
                            if($product_option->stock < $quantity) {
                                $quantity = $product_option->stock;
                                $carts[$i]['quantity'] = $quantity;
                                $request->session()->forget('cart');
                                $request->session()->put('cart', array_values($carts));
                            }
                            $cart_datas[] = array(
                                'id' => $carts[$i]['id'],
                                'product_id' => $product->id,
                                'name' => $product->name,
                                'image' => $product->image,
                                'parent_attribute_1_name' => $product->attribute_1->name,
                                'parent_attribute_2_name' => $product->attribute_2->name ?? Null,
                                'product_option_id' => $product_option->id,
                                'color_name' => $product_option->color->name,
                                'attribute_1_name' => $product_option->attribute_1->name,
                                'attribute_2_name' => $product_option->attribute_2->name ?? Null,
                                'price' => $product_option->price,
                                'quantity' => $quantity,
                                'available_quantity' => $product_option->stock,
                                'pre_discount_price' => $product_option->discount_amount * $quantity,
                                'total_price' => $product_option->price * $quantity,
                            );
                        } else {
                            unset($carts[$i]);
                            $cart_item_removed = 'yes';
                        }
                    }
                    if($cart_item_removed == 'yes') {
                        $request->session()->forget('cart');
                        $request->session()->put('cart', array_values($carts));
                    }
                    $preDiscountAmount = array_sum(array_column($cart_datas, 'pre_discount_price'));
                    $cart_total = array_sum(array_column($cart_datas, 'total_price'));
                   $cart_quantity =array_sum(array_column($cart_datas, 'quantity'));
                    $discount_amount = 0;
                    return view('frontend.cart.index')->with([
                        'cart_datas' => $cart_datas,
                        'cart_total' => $cart_total,
                        'discount_amount' => $discount_amount,
                        'cart_final' => $cart_total,
                        'cart_quantity'=>$cart_quantity,
                        'preDiscountAmount' => $preDiscountAmount,
                        'GstCharges' => $GstCharges,

                    ]);
                } else {
                    return redirect(url('/'));
                }
            }
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }
// decrease cart quantity
     public function decreaseCartItemQuantity(Request $request,$cart_id,$quantity)
    {
        try {
            if(Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();
                $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
                $cart_detail = CartDetail::where('cart_id',$cart->id)->where('product_option_id',$cart_id)->firstOrFail();
                if($cart_detail->quantity > 1) {
                    $cart_detail->update([
                        'quantity' => $cart_detail->quantity - 1,
                    ]);
                } else {
                    $cart_detail->delete();
                }
                $cart->update([
                    'coupon_id' => Null,
                    'discount_amount' => 0,
                    'total_price_after_discount' => $cart->total_price,
                ]);
            } else {
                $carts = $request->session()->get('cart');
                for($i=0;$i<count($carts);$i++) {
                    if($cart_id == $carts[$i]['id']) {
                        if($quantity > 1) {
                            $carts[$i]['quantity'] = $quantity - 1;
                        } else {
                            unset($carts[$i]);
                        }
                    }
                }
                $request->session()->forget('cart');
                $request->session()->put('cart', array_values($carts));
            }
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }
// increase cart quantity 
    public function increaseCartItemQuantity(Request $request,$cart_id,$quantity)
    {
        try {
            if(Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();
                $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
                $cart_detail = CartDetail::where('cart_id',$cart->id)->where('product_option_id',$cart_id)->firstOrFail();
                $product_option = ProductOption::where('id',$cart_detail->product_option_id)->where('product_id',$cart_detail->product_id)->first();
                if($product_option->stock > $quantity) {
                    $cart_detail->update([
                        'quantity' => $cart_detail->quantity + 1,
                    ]);
                }
                $cart->update([
                    'coupon_id' => Null,
                    'discount_amount' => 0,
                    'total_price_after_discount' => $cart->total_price,
                ]);
            } else {
                $carts = $request->session()->get('cart');
                for($i=0;$i<count($carts);$i++) {
                    if($cart_id == $carts[$i]['id']) {
                        $product_option = ProductOption::where('id',$carts[$i]['product_option_id'])->where('product_id',$carts[$i]['product_id'])->first();
                        if($product_option->stock > $quantity) {
                            $carts[$i]['quantity'] = $quantity + 1;
                        }
                    }
                }
                $request->session()->forget('cart');
                $request->session()->put('cart', array_values($carts));
            }
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }

    // remove cart items 

 public function removeFromCart(Request $request , $cart_id)
    {
        try {
            if(Auth::guard('customer')->check()) {
                $customer = Auth::guard('customer')->user();
                $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
                CartDetail::where('cart_id',$cart->id)->where('product_option_id',$cart_id)->delete();
                $cart->update([
                    'coupon_id' => Null,
                    'discount_amount' => 0,
                    'total_price_after_discount' => $cart->total_price,
                ]);
            } else {
                $carts = $request->session()->get('cart');
                for($i=0;$i<count($carts);$i++) {
                    if($cart_id == $carts[$i]['id']) {
                        unset($carts[$i]);
                    }
                }
                $request->session()->forget('cart');
                $request->session()->put('cart', array_values($carts));
            }
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }

    // applu coupon code 
 public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
                $cart_details = CartDetail::where('cart_id',$cart->id)->get();
                 $cart_detail_product_ids = $cart_details->pluck('product_id')->toArray();
                 $cart_detail_product_category_ids = array_values(array_unique(ProductCategory::whereIn('product_id',$cart_detail_product_ids)->pluck('category_id')->toArray()));
                 //print_r($cart_detail_product_category_ids[0]);
                  $catid=$cart_detail_product_category_ids[0];
                //$coupon = Coupon::where('coupon_code',$request->coupon_code)->where('number_of_use','>',0)->whereDate('start_date','<=',now())->whereDate('end_date','>=',now())->where('status','active')->first();
               
                $coupon = \DB::table("coupons")->where('coupon_code',$request->coupon_code)->where('number_of_use','>',0)->whereDate('start_date','<=',now())->whereDate('end_date','>=',now())->where('status','active')->whereRaw("find_in_set($catid,categories)")->first();
                //print_r($coupon);
                if($coupon) {
                    if($coupon->subtotal_start <= $cart->total_price) {
                        
                        // $coupon_categories = Category::whereIn('id',explode(',',$coupon->categories))->get();
                        // $category_child_ids = [];
                        // foreach($coupon_categories as $coupon_category) {
                        //     $category_child_ids[] = $coupon_category->active_get_all_childrens()->pluck('id')->toArray();
                        //     $category_child_ids[] = Arr::prepend($category_child_ids,$coupon_category->id);
                        // }
                        // $all_category_child_ids = array_values(array_unique(Arr::flatten($category_child_ids)));

                        // if(count(array_intersect($cart_detail_product_category_ids, $all_category_child_ids)) == count($all_category_child_ids)) {
                            $discount_amount = 0;
                            $total_price_after_discount = $cart->total_price;
                            if($coupon->discount_type == 'percentage') {
                                $discount_amount = $total_price_after_discount - ($total_price_after_discount * ( $coupon->discount_amount ) / 100);
                              
                                if($discount_amount > $coupon->maximum_discount) {
                                    $discount_amount = $coupon->maximum_discount;
                                    $total_price_after_discount = $total_price_after_discount - $discount_amount;
                                } else {
                                    $total_price_after_discount = $total_price_after_discount - $discount_amount;
                                }
                            } else {
                                $discount_amount = $coupon->discount_amount;
                                $total_price_after_discount = $total_price_after_discount - $discount_amount;
                            }
                            $cart->update([
                                'coupon_id' => $coupon->id,
                                'discount_amount' => $discount_amount,
                                'total_price_after_discount' => $total_price_after_discount,
                            ]);
                            return response()->json([
                                'success' => true,
                            ]);
                            
                        // } else {
                        //     return response()->json([
                        //         'success' => false,
                        //         'code' => 422,
                        //         'errors' => [
                        //             'coupon_code' => [
                        //                 'Coupon not applicable',
                        //             ],
                        //         ],
                        //     ]);
                        // }
                        
                    } else {
                        return response()->json([
                            'success' => false,
                            'code' => 423,
                            'errors' => [
                                'coupon_code' => [
                                    'Coupon not applicable',
                                ],
                            ],
                        ]);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'code' => 422,
                        'errors' => [
                            'coupon_code' => [
                                'Invalid Coupon',
                            ],
                        ],
                    ]);
                }
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

// get registration form 

    public function registrationForm(){

        return view ('frontend.customer.registrationForm');
    }
    // register user 
        public function register(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
           
           
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'password' => Hash::make($request->password)
                ]);
                $customer->update([
                    'referral_code' => 'CUST'.$customer->id,
                ]);
                Auth::guard('customer')->login($customer);
                $session_cart = $request->session()->get('cart');
                if(isset($session_cart) && count($session_cart)>0) {
                    $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
                    for($i=0;$i<count($session_cart);$i++) {
                        $product_option = ProductOption::where('product_id',$session_cart[$i]['product_id'])->where('id',$session_cart[$i]['product_option_id'])->where('stock','>=',$session_cart[$i]['quantity'])->first();
                        if($product_option) {
                            CartDetail::create([
                                'customer_id' => $customer->id,
                                'cart_id' => $cart->id,
                                'product_id' => $product_option->product_id,
                                'product_option_id' => $product_option->id,
                                'quantity' => $session_cart[$i]['quantity'],
                            ]);
                        }
                    }
                    $cart_details = CartDetail::where('cart_id',$cart->id)->get();
                    $cart_total = 0;
                    foreach($cart_details as $cart_detail) {
                        $product_option = ProductOption::findOrFail($cart_detail->product_option_id);
                        $cart_total = $cart_total + ($product_option->price * $cart_detail->quantity);
                    }
                    $cart->update([
                        'coupon_id' => Null,
                        'discount_amount' => 0,
                        'total_price_after_discount' => $cart_total,
                    ]);
                }
                $request->session()->forget('cart');
                DB::commit();
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

// signIn 

    public function signInForm(){
        return view ('frontend.customer.signInForm');
    }

    public function signIn(Request $request) {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $credentials = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 'active',
                ];
                if (Auth::guard('customer')->attempt($credentials)) {
                    $customer = Auth::guard('customer')->user();
                    $session_cart = $request->session()->get('cart');
                    if(isset($session_cart) && count($session_cart)>0) {
                        $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
                        for($i=0;$i<count($session_cart);$i++) {
                            $cart_detail = CartDetail::where('customer_id',$customer->id)->where('product_id',$session_cart[$i]['product_id'])->where('product_option_id',$session_cart[$i]['product_option_id'])->first();
                            if($cart_detail) {
                                $product_option = ProductOption::where('product_id',$session_cart[$i]['product_id'])->where('id',$session_cart[$i]['product_option_id'])->where('stock','>',0)->first();
                                if($product_option) {
                                    if($product_option->stock >= $cart_detail->quantity + $session_cart[$i]['quantity']) {
                                        $cart_detail->update([
                                            'quantity' => $cart_detail->quantity + $session_cart[$i]['quantity'],
                                        ]);
                                    } else {
                                        $cart_detail->update([
                                            'quantity' => $product_option->stock,
                                        ]);
                                    }
                                } else {
                                    $cart_detail->delete();
                                }
                            } else {
                                $product_option = ProductOption::where('product_id',$session_cart[$i]['product_id'])->where('id',$session_cart[$i]['product_option_id'])->where('stock','>=',$session_cart[$i]['quantity'])->first();
                                if($product_option) {
                                    CartDetail::create([
                                        'customer_id' => $customer->id,
                                        'cart_id' => $cart->id,
                                        'product_id' => $product_option->product_id,
                                        'product_option_id' => $product_option->id,
                                        'quantity' => $session_cart[$i]['quantity'],
                                    ]);
                                }
                            }
                        }
                        $cart_details = CartDetail::where('cart_id',$cart->id)->get();
                        $cart_total = 0;
                        foreach($cart_details as $cart_detail) {
                            $product_option = ProductOption::findOrFail($cart_detail->product_option_id);
                            $cart_total = $cart_total + ($product_option->price * $cart_detail->quantity);
                        }
                        $cart->update([
                            'coupon_id' => Null,
                            'discount_amount' => 0,
                            'total_price_after_discount' => $cart_total,
                        ]);
                    }
                    $request->session()->forget('cart');
                    DB::commit();
                    return response()->json([
                        'success' => true,
                    ]);
                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 422,
                        'errors' => [
                            'email' => [
                                'Invalid Credential'
                            ]
                        ]
                    ]);
                }
            } catch(\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }
    
    public function signInCustomer() {
        return view ('frontend.customer.signInCustomer');
    }

    public function signInBuyNow(Request $request) {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $credentials = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 'active',
                ];
                if (Auth::guard('customer')->attempt($credentials)) {
                    $customer = Auth::guard('customer')->user();
                    // $customer->id
                    $cart_detail = CartDetail::where('customer_id',$customer->id)->get();

                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'cart_detail' => $cart_detail
                    ]);
                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 422,
                        'errors' => [
                            'email' => [
                                'Invalid Credential'
                            ]
                        ]
                    ]);
                }
            } catch(\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function logOut(Request $request) {
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
         return redirect('login')->with(Auth::logout());
    }

    public function checkout() {
        try {
            $customer = Auth::guard('customer')->user();
            $customer_addresses = CustomerAddress::where('customer_id',$customer->id)->get();
             $customer_addr = CustomerAddress::where('customer_id',$customer->id)->first();
           
            $billing_addresses = CustomerBillingAddress::where('customer_id',$customer->id)->get();
            $general_setting = SiteGstSetting::firstOrFail();

            $states = State::where('country_id',101)->get();
            $cities = City::where('state_id',$general_setting->state_id ?? Null)->get();
            $countries = Country::where('id',101)->get();

             

            // $customer_pincode_ids = [];
            // foreach($customer_addresses as $customer_address) {
            //     $pincode = Pincode::where('pincode',$customer_address->pincode)->first();
            //     if($pincode) {
            //         $customer_pincode_ids[] = $pincode->id;
            //     }
            // }
            $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
            $cart_details = CartDetail::where('cart_id',$cart->id)->get();

            $totalQuantity = CartDetail::where('cart_id',$cart->id)->sum('quantity');
            $totalCartAmount = Cart::where('id',$cart->id)->first();

// for shipping cost 
            $shippingCost = ShippingCost::where('min_order_value', '<=',$totalCartAmount->total_price_after_discount)->where('max_order_value', '>=',$totalCartAmount->total_price_after_discount)->firstOrFail();
                  
            $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$totalCartAmount->total_price_after_discount)->where('max_order_value', '>=',$totalCartAmount->total_price_after_discount)->first(); 
            if(isset($customer_addresses) && count( $customer_addresses)){
                 if($general_setting->state_id == $customer_addr->state) {
                    $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                } else {
                    $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
                }
            }else{
                $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
            }
           
           
     // end shipping cost          
 //dd($default_shipping_cost);
       
            if(count($cart_details)>0) {
                return view('frontend.customer.checkout')->with([
                   
                    'cart' => $cart,
                    'cart_details' => $cart_details,
                    'customer_addresses' => $customer_addresses,
                     'billing_addresses' => $billing_addresses,                   
                     'shippingCost' => $shippingCost,
                     'default_shipping_cost' => $default_shipping_cost,
                    'states' =>$states,
                    'cities' =>$cities,
                    'countries'=> $countries,
                    'general_setting' => $general_setting,
                     'TotalShipCost' => $TotalShipCost,
                  
                ]);
            } else {
                return redirect(url('/'));
            }
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

// save customer address 
    public function submitCustomerAddress(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'address_type' => 'required',
            'addressFor' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                $forship = $request->addressFor;
                $dataSameBill = $request->sameBillShip;
               
                if ($forship == 'shipping' && $dataSameBill == 'undefined' ) {
                    CustomerAddress::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]);
                }else if($forship == 'billing'  && $dataSameBill == 'undefined'){
                    CustomerBillingAddress::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]); 
                }else if( $dataSameBill == 1){

                    CustomerBillingAddress::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]);

                 CustomerAddress::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]); 
               
                }
               
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

    // save billing address 
        public function submitBillingAddress(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'address_type' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                CustomerBillingAddress::create([
                    'customer_id' => $customer->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]);
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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
    // delete customer shipping address
     public function deleteCustomerAddress($id)
    {
        try {
            $customer = Auth::guard('customer')->user();
            CustomerAddress::where('id',$id)->where('customer_id',$customer->id)->delete();
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
    // delete billing addresss
  public function deleteCustomerBillingAddress($id)
    {
        try {
            $customer = Auth::guard('customer')->user();
            CustomerBillingAddress::where('id',$id)->where('customer_id',$customer->id)->delete();
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

// calculate cart total 
        public function calculateCartTotal(Request $request)
    {
        try {
            $customer = Auth::guard('customer')->user();
            $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
            $way_of_billing = $request->way_of_billing;
            if($way_of_billing == 'billing'){
                  $customer_address = CustomerBillingAddress::where('id',$request->address)->where('customer_id',$customer->id)->first();

            }else{
                  $customer_address = CustomerAddress::where('id',$request->address)->where('customer_id',$customer->id)->first();
            }
           
           
            //dd($customer_address->id);
            $general_setting = SiteGstSetting::firstOrFail();
            $total_gst_percentage = 0;
            $total_gst_amount = 0;
            $cart_total_with_gst = 0;
            $gst_type = 'GST';
            $shipping_price = 0;
           
              //shippngCost

            $totalQuantity = CartDetail::where('cart_id',$cart->id)->sum('quantity');
            $totalCartAmount = Cart::where('id',$cart->id)->first();

             $shippingCost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$cart->total_price_after_discount)->firstOrFail();
                  
             $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$totalCartAmount)->first();  

             

            // end shiipn //

            if($customer_address) {
              
                if($general_setting->state_id == $customer_address->state) {
                  
                    $cgst_percentage = $general_setting->cgst_percent;
                    $sgst_percentage = $general_setting->sgst_percent;
                    $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                    $sgst_amount = $cart->total_price_after_discount * ($sgst_percentage/100);
                    $cgst_amount = $cart->total_price_after_discount * ($cgst_percentage/100);
                    $total_gst_amount = round($sgst_amount + $cgst_amount,2);
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = "Taxes :<small>(CGST@ $cgst_percentage %,SGST@$cgst_percentage %)</small>";
                    $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                } else {
                   
                    $igst_percentage = $general_setting->igst_percent;
                    $total_gst_percentage = $igst_percentage;
                    $igst_amount = $cart->total_price_after_discount * ($igst_percentage/100);
                    $total_gst_amount = round($igst_amount,2);
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = "Taxes:<small> (IGST@ $igst_percentage %)</small>";
                    $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
                }
            }

          

        
            $cart_total_with_shipping = round($cart_total_with_gst + $TotalShipCost,2);
            return response()->json([
                'success' => true,
             
                'total_gst_percentage' => $total_gst_percentage,
                'total_gst_amount' => $total_gst_amount,
                'cart_total_with_gst' => $cart_total_with_gst,
                'gst_type' => $gst_type,
                'TotalShipCost' => $TotalShipCost,
                'cart_total_with_shipping' => $cart_total_with_shipping,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }

// submit order details 
    public function submitOrder(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'shipping_type' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('customer')->user();
             
                  $way_of_billing = $request->way_of_billing;
                  $paymentMethod =  $request->payment_mode;

                  // for cash on delivery 
                  if(  $paymentMethod == 'cash_on_delivery'){
                  
                       //dd($request->all());
                if($way_of_billing == 'billing'){
                  $customer_address = CustomerBillingAddress::where('id',$request->address)->where('customer_id',$customer->id)->firstOrFail();
                  }else{
                  $customer_address = CustomerAddress::where('id',$request->address)->where('customer_id',$customer->id)->firstOrFail();
                 }
                
                $shipping_type = ShippingCost::where('id',$request->shipping_type)->firstOrFail();
                $cart = Cart::where('customer_id',$customer->id)->firstOrFail();
                $cart_details = CartDetail::where('cart_id',$cart->id)->get();
                $gst_type = 'GST';
                $igst_percentage = 0;
                $sgst_percentage = 0;
                $cgst_percentage = 0;
                $total_gst_percentage = 0;
                $igst_amount = 0;
                $sgst_amount = 0;
                $cgst_amount = 0;
                $total_gst_amount = 0;
                $cart_total_with_gst = 0;
                $totalQuantity = $cart_details->SUM('quantity');
              
                // shipping cost
                 $shippingCost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$cart->total_price_after_discount)->firstOrFail();
                  
                $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$cart->total_price_after_discount)->first();  

                // shipping cost end 

               

                if($general_setting->state_id == $customer_address->state) {
               
                    $cgst_percentage = $general_setting->cgst_percent;
                    $sgst_percentage = $general_setting->sgst_percent;
                    $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                    $sgst_amount = $cart->total_price_after_discount * ($sgst_percentage/100);
                    $cgst_amount = $cart->total_price_after_discount * ($cgst_percentage/100);
                    $total_gst_amount = $sgst_amount + $cgst_amount;
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = 'CGST + SGST';
                    $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                } else {
                 
                    $igst_percentage = $general_setting->igst_percent;
                    $total_gst_percentage = $igst_percentage;
                    $igst_amount = $cart->total_price_after_discount * ($igst_percentage/100);
                    $total_gst_amount = $igst_amount;
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = 'IGST';
                    $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
                }

                 $shipping_price = $TotalShipCost;
                $cart_total_with_shipping =  $cart_total_with_gst + $shipping_price;

                while(true) {
                    $order_number = 'ORD'.random_int(100000,999999);
                    if (!Order::where('order_number',$order_number)->exists()) {
                        break;
                    }
                }
                $orderData = array(
                    'customer_id' => $customer->id,
                    'order_number' => $order_number,
                    'total_item_count' => $cart_details->SUM('quantity'),
                    'order_amount' => $cart->total_price,
                    'coupon_id' => $cart->coupon_id,
                    'coupon_code' => $cart->coupon->coupon_code ?? Null,
                    'discount_amount' => $cart->discount_amount,
                    'order_amount_after_discount' => $cart->total_price_after_discount,
                    'customer_address_id' => $customer_address->id,
                    'name' => $customer_address->name,
                    'email' => $customer_address->email,
                    'mobile_number' => $customer_address->mobile_number,
                    'country' => $customer_address->country,
                    'state' => $customer_address->state,
                    'city' => $customer_address->city,
                    'pincode' => $customer_address->pincode,
                    'address' => $customer_address->address,
                    'address_type' => $customer_address->address_type,
                    'gst_type' => $gst_type,
                    'igst_percentage' => $igst_percentage,
                    'cgst_percentage' => $cgst_percentage,
                    'sgst_percentage' => $sgst_percentage,
                    'total_gst_percentage' => $total_gst_percentage,
                    'igst_amount' => $igst_amount,
                    'cgst_amount' => $cgst_amount,
                    'sgst_amount' => $sgst_amount,
                    'total_gst_amount' => $total_gst_amount,
                    'order_amount_with_gst' => $cart_total_with_gst,
                    'shipping_type_id' => $shipping_type->id,
                    'shipping_type_name' => $shipping_type->name,
                    'shipping_type_maximum_days' => $shipping_type->maximum_days,
                    'shipping_type_price' =>    $shipping_price,
                    'order_amount_with_shipping' => $cart_total_with_shipping,
                    'estimated_delivery_date' => Carbon::now()->addDays($shipping_type->maximum_days)->toDateString(),
                    'delivered_on_date' => Null,
                    'payment_status' => 'success',
                    'order_status' => 'processing',
                    'transaction_number' => 'TRN'.random_int(100000,999999),
                    'transaction_detail' => 'Dummy Details',
                );
               //dd( $orderData);
                $order = Order::create($orderData);
                foreach($cart_details as $cart_detail) {
                    $product = Product::findOrFail($cart_detail->product_id);
                    $product_option = ProductOption::findOrFail($cart_detail->product_option_id);
                    $orderDetailData = array(
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_option_id' => $product_option->id,
                        'color_id' => $product_option->color_id,
                        'color_name' => $product_option->color->name,
                        'color_code' => $product_option->color->code,

                        'parent_attribute_1_id' => $product->attribute_1_id,
                        'parent_attribute_1_name' => $product->attribute_1->name,

                        'attribute_1_id' => $product_option->attribute_1_id,
                        'attribute_1_name' => $product_option->attribute_1->name,

                        'parent_attribute_2_id' => $product->attribute_2_id ?? Null,
                        'parent_attribute_2_name' => $product->attribute_2->name ?? Null,

                        'attribute_2_id' => $product_option->attribute_2_id ?? Null,
                        'attribute_2_name' => $product_option->attribute_2->name ?? Null,

                        'mrp' => $product_option->mrp,
                        'discount_percentage' => $product_option->discount_percentage,
                        'discount_amount' => $product_option->discount_amount,
                        'price' => $product_option->price,
                        'quantity' => $cart_detail->quantity,
                        'total_price' => $product_option->price * $cart_detail->quantity,
                    );
                    OrderDetail::create($orderDetailData);
                    $product_option->update([
                        'stock' => $product_option->stock - $cart_detail->quantity
                    ]);
                    $product->update([
                        'stock' => $product->product_options->SUM('stock')
                    ]);
                }
                CartDetail::where('cart_id',$cart->id)->delete();
                $cart->delete();
                DB::commit();
                return response()->json([
                    'success' => true,
                ]);
                
                $data=array('email' => $cus->email, 'password' => $request->password);
            Mail::send('website/simple_register',$data, function ($message) use ($emalto) {
                $message->from('info@krishnachikanindustry.com', 'Krishna Chikan Industry');
                $message->to($emalto)
                   ->subject('Order Confirmation');
            });

          }else{
             DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 421,
                    'messsge' => 'Something Went Wrong! please try again.',
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);

          }
                  //for cash on delivery option ended 
         
            } catch(\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }
    // thankyou after order confirmation
    public function ThankYou(){
  try {
           
            $customer = Auth::guard('customer')->user();
           
            $orders = Order::where('customer_id',$customer->id)->latest()->first();
            return view('frontend.customer.thank-you')->with([
                'customer' => $customer,
             
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

// customer dashboard 
      public function dashboard() {
        try {
           
            $customer = Auth::guard('customer')->user();
            $recent_orders = Order::latest()->where('customer_id',$customer->id)->take(5)->get();
            $orders = Order::where('customer_id',$customer->id)->take(5)->get();
            return view('frontend.customer.dashboard')->with([
                'customer' => $customer,
                'recent_orders' => $recent_orders,
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }


    // my orders details 

     public function myOrders() {
        try {
      
            $customer = Auth::guard('customer')->user();
            $orders = Order::latest()->where('customer_id',$customer->id)->get();
         
            return view('frontend.customer.myOrders')->with([
                'customer' => $customer,
                'orders' => $orders,
              
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    // get order product details
      public function orderDetails($order_id) {
        try {
      
          
            $orderDetails = OrderDetail::latest()->where('order_id',$order_id)->get();
            return view('frontend.customer.order-details')->with([
               'orderDetails' => $orderDetails,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }
// getorderInvoice

     public function invoice($order_number)
    {
        try {
            $customer = Auth::guard('customer')->user();
            $general_setting = GeneralSetting::firstOrFail();
            $order = Order::where('order_number',$order_number)->where('customer_id',$customer->id)->firstOrFail();
            //dd($order);
            $terms_and_condition = Policy::where('name','terms_and_condition')->first();
            $logo_path = public_path('invoice/logo.svg');
            $logo_content = file_get_contents($logo_path,false);
            $logo_64 = 'data:image/svg;base64,'.base64_encode($logo_content);
            $data = array(
                'order' => $order,
                'general_setting' => $general_setting,
                'terms_and_condition' => $terms_and_condition,
                'logo_64' => $logo_64,
            );
            $pdf = PDF::loadView('frontend.customer.invoice',$data);
            return $pdf->download($order->order_number.'.pdf');
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }



// track Order 
      public function trackOrder()
    {
        try {
           
            $customer = Auth::guard('customer')->user();
            $orders = Order::latest()->where('customer_id',$customer->id)->get();
            return view('frontend.customer.track-order')->with([
             
                'customer' => $customer,
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }
// order Reviews
     public function orderReviews()
    {
        try {
           
            $customer = Auth::guard('customer')->user();
            $orders = Order::latest()->where('customer_id',$customer->id)->get();
            return view('frontend.customer.order-reviews')->with([
                'customer' => $customer,
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

// submit order reviews 
       public function submitOrderReview(Request $request,$order_id,$order_detail_id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|gt:0',
            'review' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                $order = Order::where('id',$order_id)->where('customer_id',$customer->id)->firstOrFail();
                $order_detail = OrderDetail::where('id',$order_detail_id)->where('order_id',$order->id)->firstOrFail();
                $product = Product::where('id',$order_detail->product_id)->firstOrFail();
                OrderProductReview::updateOrCreate([
                    'order_id' => $order->id,
                    'order_detail_id' => $order_detail->id,
                    'product_id' => $product->id,
                ],[
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]);
                $product->update([
                    'rating' => round($order->order_product_reviews->avg('rating')),
                ]);
                $order->update([
                    'average_rating' => round($order->order_product_reviews->avg('rating')),
                ]);
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

    // my activities  details 
     public function myActivities()
    {
        try {
         
            $customer = Auth::guard('customer')->user();
          
                $activityDetail = Order::join('order_details', 'order_details.order_id', '=', 'orders.id')->take(5)->get();
               
            return view('frontend.customer.my_activities')->with([
                'customer' => $customer,
                'activityDetail' => $activityDetail,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

// my enquiries
     public function myEnquiries()
    {
        try {
         
            $customer = Auth::guard('customer')->user();
            $orders = Order::latest()->where('customer_id',$customer->id)->get();
            return view('frontend.customer.my-enquiries')->with([
                'customer' => $customer,
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

// my wishlist
      public function myWishlist()
    {
        try {
           
            $customer = Auth::guard('customer')->user();
            $wishlists = Wishlist::where('customer_id',$customer->id)->get();
            return view('frontend.customer.my-wishlist')->with([
                'customer' => $customer,
                'wishlists' => $wishlists,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }



    // update/delete wishlist data 
 

     public function updateWishlist(Request $request, $id)
    {
        try {
            $customer = Auth::guard('customer')->user();
            $product = Product::findOrFail($id);
            $wishlist = Wishlist::where('customer_id',$customer->id)->where('product_id',$product->id)->first();
            // dd(  $wishlist);
            $code = 200;
            if($wishlist) {
                $wishlist->delete();
                $code = 201;
            } else {
                Wishlist::create([
                    'customer_id' => $customer->id,
                    'product_id' => $product->id
                ]);
            }
            return response()->json([
                'success' => true,
                'code' => $code,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
            ]);
        }
    }

    // myaddress book 

  public function myAddressBook()
    {
        try {
          
            $customer = Auth::guard('customer')->user();
            $customer_addresses = CustomerAddress::latest()->where('customer_id',$customer->id)->get();
            return view('frontend.customer.my-address-book')->with([
                'customer' => $customer,
                'customer_addresses' => $customer_addresses,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function addCustomerAddress()
    {
        try {
            return response()->json([
                "success" => true,
                "html" => view('frontend.customer.ajax.add-address')->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function editCustomerAddress($id)
    {
        try {
            $customer = Auth::guard('customer')->user();
            $customer_address = CustomerAddress::where('id',$id)->where('customer_id',$customer->id)->firstOrFail();
            return response()->json([
                "success" => true,
                "html" => view('frontend.customer.ajax.edit-address')->with([
                    'customer_address' => $customer_address
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function updateCustomerAddress(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'address_type' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                $customer_address = CustomerAddress::where('id',$id)->where('customer_id',$customer->id)->firstOrFail();
                $customer_address->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'pincode' => $request->pincode,
                    'address' => $request->address,
                    'address_type' => $request->address_type,
                ]);
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

    // my account data 

  public function myAccount()
    {
        try {
          
            $customer = Auth::guard('customer')->user();
            $orders = Order::latest()->where('customer_id',$customer->id)->get();
            return view('frontend.customer.my-account')->with([
             
                'customer' => $customer,
                'orders' => $orders,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }
// update my account 
       public function updateMyAccount(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'email' => [ "required",Rule::unique('customers')->ignore(Auth::guard('customer')->user()->id),"email"],
            'mobile_number' => [ "required",Rule::unique('customers')->ignore(Auth::guard('customer')->user()->id)],
        ],
        [
            'name.required' => 'Please enter your name.',
            'image.required' => 'Please upload  profile image.',
            'email.required' => 'Please enter your email-id.',
            'mobile_number.required' => 'Please enter your phone number. ',
        ]
    );

        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();

                 $data = array(
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                   
                );
                if($request->hasFile('image')){
                    $data['image'] = $request->image->store('customer');
                    if(isset($customer->image) && Storage::exists($customer->image)){
                        Storage::delete($customer->image);
                    }
                }
                $customer->update($data);
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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
    
    
 public function changePassword()
    {
        try {
           
            $customer = Auth::guard('customer')->user();
            return view('frontend.customer.change_password')->with([
                'customer' => $customer,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                $customer->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return response()->json([
                    'success' => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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
    
    
    

    // invite friends
    public function inviteFriends() {
        try {
            $customer = Auth::guard('customer')->user();
            return view('frontend.customer.invite-friends')->with([
                'customer' => $customer,
            ]);
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    // check pincode delivery 
    public function CheckPincodeDelivery(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'pincode' => 'required',
        ]);
        //dd($request->all());
        if ($validator->passes()) {
            $TotalShipCost = 0;
            try {
                //$shipping_pincode1 = Pincode::where('pincode',$request->pincode)->get();
                $shipping_pincode  = Pincode::where('pincode',$request->pincode)->count();
                // return $shipping_pincode;
              
                // calculate GST charges for all users 

                $totalQuantity = $request->cartQuantity;
                $totalCartAmount = $request->cartAmount;

                $total_gst_percentage = 0;
                $total_gst_amount = 0;
                $cart_total_with_gst = 0;
                $gst_type = 'GST';
                $shipping_price = 0;           
                // end gst charges

                $shippingCost = ShippingCost::where('min_order_value', '<=',$totalCartAmount)->where('max_order_value', '>=',$totalCartAmount)->firstOrFail();
              
                $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$totalCartAmount)->where('max_order_value', '>=',$totalCartAmount)->first();  

                $state_id = Pincode::where('pincode',$request->pincode)->firstOrFail();
                $GstCharges = SiteGstSetting::firstOrFail();

     
                // gst charges 
                if($GstCharges->state_id == "$state_id->state_id") {
                    $cgst_percentage = $GstCharges->cgst_percent;
                    $sgst_percentage = $GstCharges->sgst_percent;
                    $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                    $sgst_amount = $totalCartAmount * ($sgst_percentage/100);
                    $cgst_amount = $totalCartAmount * ($cgst_percentage/100);
                    $total_gst_amount = round($sgst_amount + $cgst_amount ,2);
                   
                    $gst_type = 'CGST + SGST';
                    $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity ;
                } else {
                    $igst_percentage = $GstCharges->igst_percent;
                    $total_gst_percentage = $igst_percentage;
                    $igst_amount =$totalCartAmount * ($igst_percentage/100);
                    $total_gst_amount = round($igst_amount,2);
                
                    $gst_type = 'IGST';
                    $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
                }
                $toal_cart_amount = round($totalCartAmount + $total_gst_amount + $TotalShipCost,2);
                // end gst charges

                // calculate shipping charges end

                if($shipping_pincode > 0){
                    return response()->json([
                        'success' => true,
                        "message" => "Pincode is available for delivery",
                        "shippingCost" => $shippingCost,
                        "TotalShipCost"=>  $TotalShipCost,
                        "default_shipping_cost" =>  $default_shipping_cost ,
                        "total_gst_amount" => $total_gst_amount,
                        "totalCartAmount" => $toal_cart_amount,
                    ]);

                }else{
                    return response()->json([
                        'notFound' => true,
                        "message" => "Pincode is not available for delivery",
                        "TotalShipCost" =>  $TotalShipCost,
                    ]);
                }
           
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'NoShippingCost' => true,
                    'message' => 'Pincode is not available for delivery.',
                    "TotalShipCost" =>  $TotalShipCost,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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

}