<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OilgradeOrderService;
use App\Models\OrderDetailService;
use App\Models\OrderDetail;
use App\Models\Reason;
use App\Models\CancelOrder;
use App\Models\CancelOrderService;
use App\Models\ReturnOrder;
use App\Models\ReturnOrderImage;
use App\Models\CancellOrderImage;
use App\Models\SellerFeedback;
use App\Models\OrderStatus;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use Storage;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\UnAuthCart;
use App\Models\UnAuthCartDetail;
use App\Models\CartDetail;
use App\Models\CartService;
use App\Models\CartServiceDetail;
use App\Models\UnAuthCartService;
use App\Models\UnAuthCartServiceDetail;
use App\Models\HomepageSetting;
use App\Models\OrderProductReview;
use App\Models\WishlistUnauth;
use App\Models\CompanyAddress;
use App\Models\User;
use App\Models\RazorpayPayment;
use App\Models\BankAccount;
use Razorpay\Api\Api;

class UserController extends Controller
{
    public function googlelogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'required',
            'google_id' => 'required',
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }
        $user = Customer::query()
            ->firstOrCreate(['email' => $request->email], [
                'name' => $request->name,
                'email' => $request->email,
                'google_id' => $request->google_id,
                'device_id' => $request->device_id,
            ]);

        $cart = Cart::updateOrCreate(['customer_id' => $user->id]);
        $unauthenticated_cart = UnAuthCart::updateOrCreate(['device_id' => $request->device_id]);
        $unauthenticated_cart_detail = UnAuthCartDetail::where('device_id', $request->device_id)->get();
        if ($unauthenticated_cart_detail) {
            foreach ($unauthenticated_cart_detail as $unauthenticated_cart_detail) {
                $cartdeatil = CartDetail::where('cart_id', $cart->id)->where('customer_id', $user->id)->where('product_id', $unauthenticated_cart_detail->product_id)->where('product_option_id', $unauthenticated_cart_detail->product_option_id)->first();
                CartDetail::create([
                    'customer_id' => $user->id,
                    'cart_id' => $cart->id,
                    'product_id' => $unauthenticated_cart_detail->product_id,
                    'product_option_id' => $unauthenticated_cart_detail->product_option_id,
                    'quantity' => $unauthenticated_cart_detail->quantity,
                ]);
            }
            $cart->update([
                'total_price' => $cart->total_price + $unauthenticated_cart->total_price,
                'pre_discount' => $cart->pre_discount + $unauthenticated_cart->pre_discount,
                'total_price_after_discount' => $cart->total_price + $unauthenticated_cart->pre_discount
            ]);

        }


        $cartservice = CartService::updateOrCreate(['customer_id' => $user->id]);
        $unauthenticated_cartservice = UnAuthCartService::updateOrCreate(['device_id' => $request->device_id]);
        $cart_itemservices = UnAuthCartServiceDetail::where('device_id', $request->device_id)->get();
        if ($cart_itemservices) {
            foreach ($cart_itemservices as $cart_itemservice) {
                CartServiceDetail::create([
                    'customer_id' => $user->id,
                    'service_id' => $cart_itemservice->service_id,
                    'service_option_id' => $cart_itemservice->service_option_id,
                    'cart_id' => $cartservice->id,
                    'quantity' => 1,
                ]);

            }
            $cartservice->update([
                'total_price' => $cartservice->total_price + $unauthenticated_cartservice->total_price
            ]);
        }
        UnAuthCartService::where('device_id', $request->device_id)->delete();
        UnAuthCartServiceDetail::where('device_id', $request->device_id)->delete();
        UnAuthCart::where('device_id', $request->device_id)->delete();
        UnAuthCartDetail::where('device_id', $request->device_id)->delete();

        //  $user = Customer::where('email',$request->email)->first(); 
        return response()->json([
            'data' => [
                'token' => $user->createToken($request->email)->accessToken,
                'user' => $user,
            ],


            // 'token_type' => 'Bearer',
        ]);
    }

    public function submitForgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:customers',
            'url' => 'required',
        ]);
        if ($validator->passes()) {
            try {

                $token = Str::random(64);
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

                $admin = User::first();

                Mail::send('email.forgetpassword', ['token' => $token, 'url' => $request->url], function ($message) use ($request, $admin) {
                    $message->to($request->email);
                    $message->to($admin->alert_email);
                    $message->subject('Reset Password');
                });
                return response()->json([
                    'status' => true,
                    'token' => $token,
                    'meassge' => "We have e-mailed your password reset link!"
                ]);


            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
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


    public function submitResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //   'email' => 'required|email|exists:customers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($validator->passes()) {
            try {
                $updatePassword = DB::table('password_resets')
                    ->where([
                        // 'email' => $request->email, 
                        'token' => $request->token
                    ])
                    ->first();

                if (!$updatePassword) {
                    return response()->json([
                        'status' => false,
                        'meassge' => "Invalid token!"
                    ], 400);
                }

                $user = Customer::where('email', $updatePassword->email)
                    ->update(['password' => Hash::make($request->password)]);
                $user = Customer::where('email', $updatePassword->email)->first();
                DB::table('password_resets')->where(['token' => $request->token])->delete();
                $admin = User::first();
                Mail::send('email.resetpasswordconfirm', [], function ($message) use ($user, $admin) {
                    $message->to($user->email);
                    $message->to($admin->alert_email);
                    $message->subject('Password Changed Successfully.');
                });
                if ($user) {
                    return response()->json([
                        'status' => true,
                        'meassge' => "Your Password has been Changed!"
                    ]);
                }
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
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

    public function updateProfilePhoto(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png,jpeg,svg',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'code' => 422,
                    'errors' => $validator->errors(),
                ]);
            }
            $user = Auth::guard('api')->user();
            \Storage::delete($user->image);
            $profile_url = $request->image->store('profile');
            $user->update(
                [
                    'image' => $profile_url,
                ]
            );
            $data['image_base_url'] = url('storage') . '/';
            $data['user_info'] = $user;
            return response()->json([
                'status' => true,
                'data' => $data,
                'meassge' => "Profile Updated Successfully."
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }


    public function dashboard()
    {
        $user = Auth::guard('api')->user();
        $order = Order::where('customer_id', $user->id)->count();
        $orderservice = OrderService::where('customer_id', $user->id)->count();
        $oilgradeorderservice = OilgradeOrderService::where('customer_id', $user->id)->count();
        $orderserviceam = OrderService::where('customer_id', $user->id)->where('order_status', 'Service Completed')->sum('order_amount_with_gst');
        $orderam = Order::where('customer_id', $user->id)->where('order_status', 'Delivered')->sum('order_amount_with_shipping');
        $oilgradeorderserviceam = OilgradeOrderService::where('customer_id', $user->id)->where('order_status', 'Service Completed')->sum('order_amount_with_gst');
        $data['total_order'] = $order;
        $data['totalservice_booking'] = (int) $orderservice + (int) $oilgradeorderservice;
        $data['total_transaction'] = round((float) $orderserviceam + (float) $orderam + (float) $oilgradeorderserviceam, 0);
        $data['loyality_rewards'] = 10;
        $oilgradeorderservice = OilgradeOrderService::where('customer_id', $user->id)->latest()->limit(5)->select('id', 'order_number As service_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst As order_amount', 'payment_status', 'service_type', 'pickup_delivery_time', 'pickup_delivery_date', 'created_at As datetime')->get()->toArray();
        $orderservice = OrderService::where('customer_id', $user->id)->latest()->limit(5)->select('id', 'order_number As service_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst As order_amount', 'payment_status', 'service_type', 'pickup_delivery_time', 'pickup_delivery_date', 'created_at As datetime')->get()->toArray();
        $data['services'] = array_merge($oilgradeorderservice, $orderservice);
        return response()->json([
            'status' => true,
            'data' => $data,
            'meassge' => "GET Successfully."
        ]);
    }

    public function orders(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $customer = Auth::guard('api')->user();
            if ($request->order_status != "Delivered" && $request->order_status != "Cancelled") {
                $orders = Order::latest()->where('customer_id', $customer->id)->where('order_status', '!=', 'Delivered')->with('countries:id,name', 'states:id,name', 'cities:id,name')->where('order_status', '!=', 'Cancelled')->with('order_details.product:id,name,image', 'order_details.category:id,name,image')->with('order_details')->get(['id', 'order_number', 'order_amount_with_shipping As order_amount', 'estimated_delivery_date', 'order_status', 'address', 'invoice_number', 'invoice_url', 'created_at as order_date_time', 'payment_status', 'coupon_code', 'order_amount as subtotal', 'discount_amount', 'shipping_type_price as shipping_price', 'total_gst_amount', 'order_amount_with_shipping', 'country', 'state', 'city', 'name', 'address', 'mobile_number', 'email', 'pincode']);
            } else if ($request->order_status == "Cancelled") {
                $orders = Order::latest()->where('customer_id', $customer->id)->where('order_status', $request->order_status)->limit(3)->with('countries:id,name', 'states:id,name', 'cities:id,name')->with('order_details.product:id,name,image', 'order_details.category:id,name,image')->with('order_details', 'cancelorder')->get(['id', 'order_number', 'order_amount_with_shipping As order_amount', 'estimated_delivery_date', 'order_status', 'address', 'payment_status', 'payment_method', 'total_item_count', 'created_at as order_date_time', 'invoice_number', 'invoice_url', 'payment_status', 'coupon_code', 'order_amount as subtotal', 'discount_amount', 'shipping_type_price as shipping_price', 'total_gst_amount', 'order_amount_with_shipping', 'country', 'state', 'city', 'name', 'address', 'mobile_number', 'email', 'pincode']);

            } else {
                $orders = Order::latest()->where('customer_id', $customer->id)->where('order_status', $request->order_status)->limit(3)->with('countries:id,name', 'states:id,name', 'citys:id,name')->with('order_details.product:id,name,image', 'order_details.category:id,name,image')->with('order_details')->get(['id', 'order_number', 'order_amount_with_shipping As order_amount', 'estimated_delivery_date', 'order_status', 'address', 'invoice_number', 'invoice_url', 'created_at as order_date_time', 'payment_status', 'coupon_code', 'order_amount as subtotal', 'discount_amount', 'shipping_type_price as shipping_price', 'total_gst_amount', 'order_amount_with_shipping', 'country', 'state', 'city', 'name', 'address', 'mobile_number', 'email', 'pincode']);
            }

            return response()->json([
                'status' => true,
                'data' => $orders,
                'url' => url('storage'),
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }



    public function order($order_id)
    {
        try {
            $customer = Auth::guard('api')->user();
            $id = $customer->id;
            $orders = OrderDetail::latest()->whereHas('order', function ($obj) use ($id) {
                $obj->where('customer_id', $id);
            })->with('order')->with('product:id,name,image')->where('order_id', $order_id)->first();
            return response()->json([
                'status' => true,
                'data' => $orders,
                'url' => url('storage'),
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }
    public function orderstatus($order_id)
    {
        try {
            $customer = Auth::guard('api')->user();
            $id = $customer->id;
            $orders = OrderStatus::where('order_id', $order_id)->get(['id', 'order_status', 'order_status_date']);
            return response()->json([
                'status' => true,
                'data' => $orders,
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }
    public function orderdata($order_id)
    {
        try {
            $customer = Auth::guard('api')->user();
            $id = $customer->id;
            $orders = Order::where('id', decrypt($order_id))->with('billingaddress', 'shippingaddress')->first();
            if ($orders->payment_method == "offline") {
                $message = "Congratulations! on placing a successful order with us";
            } else if ($orders->payment_method == "online" && $orders->payment_status == "success") {
                $message = "Congratulations! on placing a successful order with us";
            } else {
                $message = "Your Payment is failed! Re-try Now.";
            }
            return response()->json([
                'status' => true,
                'data' => $orders,
                'message' => $message
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function orderservices(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $customer = Auth::guard('api')->user();
            if ($request->order_status != "Service Completed" && $request->order_status != "Cancelled") {
                $orders = OrderService::latest()->where('customer_id', $customer->id)->where('order_status', '!=', 'Service Completed')->where('order_status', '!=', 'Cancelled')->with('order_details.service:id,name,image')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();
                $oilgorders = OilgradeOrderService::latest()->where('customer_id', $customer->id)->where('order_status', '!=', 'Service Completed')->where('order_status', '!=', 'Cancelled')->with('order_details.package:id,name,image')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();
            } else if ($request->order_status == "Cancelled") {
                $orders = OrderService::latest()->where('customer_id', $customer->id)->where('order_status', $request->order_status)->limit(3)->with('order_details.service:id,name,image')->with('order_details', 'cancelorder')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();
                $oilgorders = OilgradeOrderService::latest()->where('customer_id', $customer->id)->where('order_status', '!=', 'Service Completed')->where('order_status', '!=', 'Cancelled')->with('order_details', 'cancelorder')->with('order_details.package:id,name,image')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();


            } else {
                $orders = OrderService::latest()->where('customer_id', $customer->id)->where('order_status', $request->order_status)->limit(3)->with('order_details.service:id,name,image')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();
                $oilgorders = OilgradeOrderService::latest()->where('customer_id', $customer->id)->where('order_status', $request->order_status)->with('order_details.package:id,name,image')->get(['id', 'order_number', 'brand_name', 'brandmodel_name', 'order_amount_with_gst', 'order_status', 'address'])->toArray();


            }
            $data = array_merge($orders, $oilgorders);
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function orderservice($order_id)
    {
        try {
            $customer = Auth::guard('api')->user();
            $id = $customer->id;
            $orders = OrderDetailService::latest()->whereHas('order', function ($obj) use ($id) {
                $obj->where('customer_id', $id);
            })->with('service:id,name,image')->where('order_id', $order_id)->first();
            return response()->json([
                'status' => true,
                'data' => $orders,
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }
    //update password

    public function updatepassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        if (!Hash::check($request->old_password, Auth::guard('api')->user()->password)) {
            return response()->json([
                'status' => 'error',
                'message' => "Old Password Doesn't match!"
            ], 200);
        }
        Customer::whereId(Auth::guard('api')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'status' => "success",
            'message' => "Password changed successfully!"
        ], 200);
    }
    public function getcustomer()
    {
        $customer = Auth::guard('api')->user();
        $data['image_base_url'] = url('storage') . '/';
        $data['customer'] = $customer;
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => "Get successfully!"
        ], 200);
    }


    public function cancelOrder(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'order_id' => 'required|integer',
                'reason' => 'required',
                'reason_id' => 'required',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 422,
                    'message' => $validator->errors()
                ], 422);
            }
            $customer = Auth::guard('api')->user();
            $order = Order::where('id', $request->order_id)->where('customer_id', $customer->id)->first();
            if ($order->order_status == "In-Transit") {
                $deldate = $order->estimated_delivery_date;
                return response()->json([
                    'status' => false,
                    'message' => "Order has already been dispatched and would be reaching you in $deldate"
                ], 200);
            } elseif ($order->order_status == "Delivered") {
                return response()->json([
                    'status' => false,
                    'message' => "Your Order has already delivered so don`t be cancelled"
                ], 200);
            } elseif ($order->order_status == "Reject Order") {
                return response()->json([
                    'status' => false,
                    'message' => "Your Order has rejected so never be cancelled"
                ], 200);
            } elseif ($order->order_status == "Cancelled") {
                return response()->json([
                    'status' => false,
                    'message' => "Your Order has already Cancelled"
                ], 200);
            } else {
                $order->update(
                    [
                        // 'cancellation_reason' => $request->reason,
                        'order_status' => 'Cancelled'
                    ]


                );
                OrderStatus::create([
                    'order_id' => $order->id,
                    'order_status' => 'Cancelled'
                ]);
                $datacancell = CancelOrder::updateOrCreate(['order_id' => $request->order_id], [
                    'cancellation_reason' => $request->reason,
                    'reason_id' => $request->reason_id,
                    'order_id' => $request->order_id,
                ]);
                foreach ($request->image as $image) {
                    CancellOrderImage::create([
                        'cancell_id' => $datacancell->id,
                        'image' => $image->store('cancelorder'),
                    ]);
                }
                return response()->json([
                    'status' => "success",
                    'message' => "Your order cancellation request has been taken, wait you will be notified."
                ], 200);
            }

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }



    public function returnorderproduct(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'order_id' => 'required|integer',
                'order_detail_id' => 'required|integer',
                'return_reason' => 'required',
                'reason_id' => 'required',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 422,
                    'message' => $validator->errors()
                ], 422);
            }
            $customer = Auth::guard('api')->user();
            $order = Order::where('id', $request->order_id)->where('customer_id', $customer->id)->first();
            $orderdetail = OrderDetail::where('id', $request->order_detail_id)->first();
            if ($order->order_status == "Delivered") {


                // $order->update(
                //     [
                //         // 'cancellation_reason' => $request->reason,
                //         'order_status'  => 'Return'
                //     ]

                // );
                $datareturn = ReturnOrder::updateOrCreate(['order_id' => $request->order_id], [
                    'return_reason' => $request->return_reason,
                    'order_detail_id' => $orderdetail->id,
                    'reason_id' => $request->reason_id,
                    'order_id' => $request->order_id,
                    'return_date' => date('Y-m-d'),
                ]);
                if ($request->hasFile('image')) {
                    foreach ($request->image as $image) {
                        ReturnOrderImage::create([
                            'return_id' => $datareturn->id,
                            'image' => $image->store('returnorder'),
                        ]);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => "Your order has been requested for returning a product."
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Your Order has already been returned"
                ], 200);


            }

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function sellerorderfeedback(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_id' => 'required|integer',
            'order_detail_id' => 'required|integer',
            'rating' => 'required',
            'review' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }

        $customer = Auth::guard('api')->user();
        $order = Order::where('id', $request->order_id)->where('customer_id', $customer->id)->where('order_status', 'Delivered')->first();
        $order_detail = OrderDetail::where('id', $request->order_detail_id)->where('order_id', $order->id)->firstOrFail();
        if ($order_detail) {
            SellerFeedback::updateOrCreate(['order_id' => $order->id,], [
                'order_id' => $order->id,
                'order_detail_id' => $request->order_detail_id,
                'rating' => $request->rating,
                'review' => $request->review
            ]);
            return response()->json([
                'status' => true,
                'message' => "Thanks for feedback"
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => "You have not permission to give feedback because your product not yet delivered"
            ], 200);
        }



    }
    public function cancelorderservice(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'order_id' => 'required|integer',
                'reason_id' => 'required|integer',
                'reason' => 'required',
                'service_type' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'status_code' => 422,
                    'message' => $validator->errors()
                ], 422);
            }
            $customer = Auth::guard('api')->user();
            if ($request->service_type == "oil_grade_change") {
                $order = OilgradeOrderService::where('id', $request->order_id)->where('customer_id', $customer->id)->first();

            } else {
                $order = OrderService::where('id', $request->order_id)->where('customer_id', $customer->id)->first();

            }
            $order->update(
                [
                    // 'cancellation_reason' => $request->reason,
                    'order_status' => 'Cancelled'
                ]
            );
            CancelOrderService::create([
                'cancellation_reason' => $request->reason,
                'service_type' => $request->service_type,
                'reason_id' => $request->reason_id,
                'order_id' => $request->order_id,
            ]);
            return response()->json([
                'status' => "success",
                'message' => "Your service cancellation request has been taken, wait you will be notified."
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }



    public function logout()
    {
        try {

            \Auth::guard('api')->user()->token()->revoke();
            return response()->json([
                'status' => "success",
                'message' => "Successfully Logout."
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function reasons(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'required',
            'category' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $data = Reason::where('type', $request->type)->where('category', $request->category)->get(['id', 'title']);

            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => "Get successfully!"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function addtowishlist(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $customer = Auth::guard('api')->user();
            $wishlists = Wishlist::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'customer_id' => $customer->id,
                ],
                [
                    'product_id' => $request->product_id,
                    'customer_id' => $customer->id,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => "Added to your Wishlist!"
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function getwishlist()
    {
        $customer = Auth::guard('api')->user();
        $wishlists = Wishlist::where('customer_id', $customer->id)->with('product:id,name,image', 'product.product_options')->get();
        return response()->json([
            'status' => true,
            'data' => $wishlists,
            'message' => "Get successfully!"
        ], 200);
    }
    public function removfromewishlist(Request $request)
    {
        $customer = Auth::guard('api')->user();
        $wishlists = Wishlist::where('customer_id', $customer->id)->where('product_id', $request->product_id)->delete();
        return response()->json([
            'status' => true,
            'data' => $wishlists,
            'message' => "Removed From Your Wishlist!"
        ], 200);
    }
    public function removefromwishlistunauth(Request $request)
    {
        $customer = Auth::guard('api')->user();
        $wishlists = WishlistUnauth::where('device_id', $request->device_id)->where('product_id', $request->product_id)->delete();
        return response()->json([
            'status' => true,
            'data' => $wishlists,
            'message' => "Removed From Your Wishlist!"
        ], 200);
    }
    public function addtowishlistunauth(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'device_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $wishlists = WishlistUnauth::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'device_id' => $request->device_id
                ],
                [
                    'product_id' => $request->product_id,
                    'device_id' => $request->device_id,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => "Added to your Wishlist!"
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function getwishlistunauth(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'device_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        //   $customer = Auth::guard('api')->user();
        $wishlists = WishlistUnauth::where('device_id', $request->device_id)->with('product:id,name,image', 'product.product_options')->get();
        return response()->json([
            'status' => true,
            'data' => $wishlists,
            'message' => "Get successfully!"
        ], 200);
    }
    public function homepagewidget()
    {

        $data = HomepageSetting::all();
        $datanew['data'] = $data;
        $datanew['image_base_url'] = url('storage') . '/';
        $data->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $datanew,
            'message' => "Get successfully!"
        ], 200);
    }
    public function orderratingfeedback()
    {
        $customer = Auth::guard('api')->user();
        $data = OrderProductReview::select('rating', 'review', 'orders.order_status', 'order_product_reviews.created_at As reviewdate')->join('orders', 'orders.id', 'order_product_reviews.order_id')->where('order_product_reviews.customer_id', $customer->id)->orderByDesc('order_product_reviews.rating')->get();
        // $datanew['data']=$data;
        //  $datanew['image_base_url'] = url('storage').'/';
        // $data->makeHidden(['created_at','updated_at','order_id','order_detail_id','customer_id','product_id']);
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => "Get successfully!"
        ], 200);
    }
    public function companyaddress()
    {

        $data = CompanyAddress::where('status', 'active')->with('countries:id,name', 'states:id,name', 'citys:id,name')->get();
        $data->makeHidden(['status', 'created_at', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => "Get successfully!"
        ], 200);
    }


    public function razorpaydata(Request $request)
    {

        $input = $request->all();
        $data = RazorpayPayment::first();
        // $api = new Api($data->key, $data->secret);
        // $api->order->create(array('receipt' => '123', 'amount' => 500, 'currency' => 'INR', 'notes'=> array('name'=> 'raushan','email'=> 'raushan@gmail.com')));
        // $data->makeHidden(['created_at','updated_at']);
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => "Get successfully!"
        ], 200);
    }

    public function bankaccount()
    {
        $data = BankAccount::first();
        $data['payment_image'] = url('storage') . '/' . $data->payment_image;
        $data->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => "Get successfully!"
        ], 200);
    }


}
