<?php

namespace App\Http\Controllers;



use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingType;
use App\Models\Slider;
use App\Models\SiteGstSetting;
use App\Models\ShippingCost;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\ProductOption;
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

use PDF;
use Razorpay\Api\Api;
use Session;
use Redirect;

class PaymentController extends Controller
{
 
// proceed to razor pay  
    public function ProceedToPay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'shipping_type' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
            
                $customer = Auth::guard('customer')->user();
                $general_setting = SiteGstSetting::firstOrFail();
                  $way_of_billing = $request->way_of_billing;
                  $paymentMethod =  $request->payment_mode;

                  // for online payment 
                  if(  $paymentMethod == 'pay_online'){
                  
                 $apiKey = env('RAZOR_KEY');
    
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
                    $total_gst_amount = round($sgst_amount + $cgst_amount,2);
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = 'CGST + SGST';
                    $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                } else {
                 
                    $igst_percentage = $general_setting->igst_percent;
                    $total_gst_percentage = $igst_percentage;
                    $igst_amount = $cart->total_price_after_discount * ($igst_percentage/100);
                    $total_gst_amount =round($igst_amount,2);
                    $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                    $gst_type = 'IGST';
                    $TotalShipCost =   $shippingCost->out_state_charge *  $totalQuantity;
                }

                
                $cart_total_with_shipping =  round($cart_total_with_gst + $TotalShipCost,2);

                $totalQuantity = $cart_details->SUM('quantity');


                return response()->json([
                    'success' => true,
                    'apiKey' =>  $apiKey,
                    'customer' => $customer->name,
                    'totalQuantity' => $totalQuantity,
                    'totalAmount' => $cart_total_with_shipping,
                  
                ]);

          }else{
                return response()->json([
                    'success' => false,
                    'code' => 421,
                    'messsge' => 'Something Went Wrong! please try again.',
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);

          }
                  //online on delivery option ended 
         
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

// palce order 
   public function PlaceOrder(Request $request)
    {
        //dd($request->all());
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
                  if(  $paymentMethod == 'pay_online'){
                  
                    $transaction_detail = $request->razorpay_payment_id;
                     $razorpay_order_id = $request->razorpay_order_id;

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
                    'transaction_detail' => $transaction_detail,
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
                    'order_number' => $order_number,
                ]);

          }else{
             DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 421,
                    'messsge' => 'Something Went Wrong! please try again.',
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);

          }
                  //for online  option payment ended 
         
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


}
