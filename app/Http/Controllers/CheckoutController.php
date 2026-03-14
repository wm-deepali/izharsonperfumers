<?php

namespace App\Http\Controllers;

use App\Mail\AdminPaymentMail;
use App\Models\BankAccount;
use App\Models\CCAvenue;
use App\Models\City;
use App\Models\Country;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\HeaderSetting;
use App\Models\GeneralSetting;
use App\Models\Policy;
use App\Models\User;
use App\Models\FreeShiping;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerBillingAddress;
use App\Models\Order;
use App\Models\ShippingCost;
use App\Models\SiteGstSetting;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductOption;
use App\Helpers\ShippingHelper;
use Illuminate\Support\Facades\DB;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {

        // ✅ require login
        if (!Auth::guard('customer')->check()) {
            return redirect()
                ->route('customer.login')
                ->with('error', 'Please login to continue checkout');
        }

        $user = Auth::guard('customer')->user();

        $cart = Cart::where('customer_id', $user->id)->firstOrFail();

        $cartItems = CartDetail::where('cart_id', $cart->id)
            ->with('products', 'product_options')
            ->get();

        $shippingData = ShippingHelper::calculate(
            $user->shipping_pincode ?? '226026',
            $user->billing_pincode ?? '226026',
            $cartItems->sum('quantity'),
            $cart->total_price_after_discount
        );

        $shippingAddresses = CustomerAddress::with('countries', 'states', 'cities')->where('customer_id', $user->id)->get();
        $billingAddresses = CustomerBillingAddress::with('countries', 'states', 'cities')->where('customer_id', $user->id)->get();
        $countries = Country::all();
        $bank = BankAccount::first();

        // dd($shippingAddresses->toArray(), $billingAddresses->toArray());
        return view('front.checkout', compact(
            'cart',
            'cartItems',
            'shippingData',
            'shippingAddresses',
            'billingAddresses',
            'countries',
            'bank'
        ));
    }

    public function states($countryId)
    {
        $states = State::where('country_id', $countryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($states);
    }

    // GET CITIES BY STATE
    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($cities);
    }

    public function saveBilling(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required'
        ]);

        $data['customer_id'] = auth()->id();

        CustomerBillingAddress::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return response()->json(['success' => true]);
    }

    public function saveShipping(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required'
        ]);

        $data['customer_id'] = auth()->id();

        CustomerAddress::updateOrCreate(
            ['id' => $request->id],
            $data
        );

        return response()->json(['success' => true]);
    }


    public function copyBillingToShipping(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $billing = CustomerBillingAddress::where('id', $request->billing_id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        // check if same shipping address already exists
        $existingShipping = CustomerAddress::where('customer_id', $customer->id)
            ->where('name', $billing->name)
            ->where('mobile_number', $billing->mobile_number)
            ->where('country', $billing->country)
            ->where('state', $billing->state)
            ->where('city', $billing->city)
            ->where('pincode', $billing->pincode)
            ->where('address', $billing->address)
            ->first();

        if ($existingShipping) {
            return response()->json([
                'success' => true,
                'shipping_id' => $existingShipping->id,
                'exists' => true
            ]);
        }

        // otherwise create new shipping
        $shipping = CustomerAddress::create([
            'customer_id' => $customer->id,
            'name' => $billing->name,
            'mobile_number' => $billing->mobile_number,
            'country' => $billing->country,
            'state' => $billing->state,
            'city' => $billing->city,
            'pincode' => $billing->pincode,
            'address' => $billing->address,
            'address_type' => 'shipping'
        ]);

        return response()->json([
            'success' => true,
            'shipping_id' => $shipping->id,
            'exists' => false
        ]);
    }

    public function placeOrder(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'shipping_type' => 'required',
            'billing_id' => 'required',
            'shipping_id' => 'required',
            'payment_mode' => 'required',
            'payment_proof' => 'nullable|image:mimes,jpg,png,pneg',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('customer')->user();

                //   $way_of_billing = $request->way_of_billing;
                $paymentMethod = $request->payment_mode;

                // for cash on delivery 
                if ($paymentMethod) {


                    // if($way_of_billing == 'billing'){
                    $customer_billing_address = CustomerBillingAddress::where('id', $request->billing_id)->where('customer_id', $customer->id)->firstOrFail();
                    //   }else{
                    $customer_address = CustomerAddress::where('id', $request->shipping_id)->where('customer_id', $customer->id)->firstOrFail();
                    //  }

                    if ($request->iscountryindia != "false") {
                        $shipping_type = FreeShiping::orderBy('id', 'desc')->first();
                        if ($shipping_type->id == $request->shipping_type) {
                            $shipping_type = FreeShiping::orderBy('id', 'desc')->first();
                        } else {
                            $shipping_type = ShippingCost::where('id', $request->shipping_type)->firstOrFail();

                        }
                    }
                    $cart = Cart::where('customer_id', $customer->id)->firstOrFail();
                    $cart_details = CartDetail::where('cart_id', $cart->id)->get();
                    $gst_type = 'GST';
                    $igst_percentage = 0;
                    $vat_percentage = 0;
                    $sgst_percentage = 0;
                    $cgst_percentage = 0;
                    $total_gst_percentage = 0;
                    $igst_amount = 0;
                    $sgst_amount = 0;
                    $cgst_amount = 0;
                    $total_gst_amount = 0;
                    $cart_total_with_gst = 0;
                    $totalQuantity = $cart_details->SUM('quantity');
                    $TotalShipCost = 0;
                    $deliveryday = "";
                    // shipping cost
                    if ($request->iscountryindia != "false") {
                        $shippingCost = ShippingCost::find($request->shipping_type);
                    }
                    $default_shipping_cost = FreeShiping::orderBy('id', 'desc')->first();

                    if ($default_shipping_cost->id == $request->shipping_type) {
                        if ($general_setting->gst_status == "yes") {
                            if ($general_setting->state_id == $customer_address->state_id) {
                                $cgst_percentage = $general_setting->cgst_percent;
                                $sgst_percentage = $general_setting->sgst_percent;
                                $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                                $sgst_amount = $cart->total_price_after_discount * ($sgst_percentage / 100);
                                $cgst_amount = $cart->total_price_after_discount * ($cgst_percentage / 100);
                                $total_gst_amount = round($sgst_amount + $cgst_amount, 2);
                                $TotalShipCost = 0;
                                $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                                $gst_type = 'CGST + SGST';
                                $deliveryday = $default_shipping_cost->day_range_inter_state;
                            }
                            if ($general_setting->state_id != $customer_address->state_id) {
                                $igst_percentage = $general_setting->igst_percent;
                                $total_gst_percentage = $igst_percentage;
                                $igst_amount = $cart->total_price_after_discount * ($igst_percentage / 100);
                                $total_gst_amount = round($igst_amount, 2);
                                $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                                $gst_type = 'IGST';
                                $TotalShipCost = 0;
                                $deliveryday = $default_shipping_cost->day_range_intra_state;
                            }
                        } else {
                            $vat_percentage = $general_setting->vat;
                            $total_gst_percentage = $vat_percentage;
                            $vatamount = $cart->total_price_after_discount * ($vat_percentage / 100);
                            $total_gst_amount = round($vatamount, 2);
                            $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                            $gst_type = 'VAT';
                            $TotalShipCost = 0;
                            $deliveryday = $default_shipping_cost->day_range_inter_state;
                        }
                    }
                    // shipping cost end 
                    if ($default_shipping_cost->id != $request->shipping_type) {
                        if ($general_setting->gst_status == "yes") {
                            if ($general_setting->state_id == $customer_address->state) {
                                $cgst_percentage = (int) $general_setting->cgst_percent;
                                $sgst_percentage = (int) $general_setting->sgst_percent;
                                if ($request->iscountryindia != "false") {
                                    if ($shippingCost->in_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                        $TotalShipCost = $shippingCost->max_charges;
                                    } else {
                                        $TotalShipCost = $shippingCost->in_state_charge * $totalQuantity;
                                    }
                                }
                                if ($request->iscountryindia == "false") {
                                    $TotalShipCost = 3500;
                                }


                                $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                                $sgst_amount = ($cart->total_price_after_discount + $TotalShipCost) * ($sgst_percentage / 100);
                                $cgst_amount = ($cart->total_price_after_discount + $TotalShipCost) * ($cgst_percentage / 100);
                                $total_gst_amount = $sgst_amount + $cgst_amount;
                                $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                                $gst_type = 'CGST + SGST';

                                $deliveryday = $shipping_type->delivery_days_range;
                            }

                            if ($general_setting->state_id != $customer_address->state) {

                                $igst_percentage = $general_setting->igst_percent;
                                $total_gst_percentage = $igst_percentage;
                                if ($request->iscountryindia != "false") {
                                    if ($shippingCost->out_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                        $TotalShipCost = $shippingCost->max_charges;
                                    } else {
                                        $TotalShipCost = $shippingCost->out_state_charge * $totalQuantity;
                                    }
                                }
                                if ($request->iscountryindia == "false") {
                                    $TotalShipCost = 3500;
                                } else {
                                    $deliveryday = $shipping_type->delivery_days_range;
                                }
                                $igst_amount = ($cart->total_price_after_discount + $TotalShipCost) * ($igst_percentage / 100);
                                $total_gst_amount = $igst_amount;
                                $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                                $gst_type = 'IGST';


                            }
                        } else {
                            $vat_percentage = $general_setting->vat;
                            $total_gst_percentage = $vat_percentage;
                            if ($general_setting->state_id == $customer_address->state) {
                                if ($request->iscountryindia != "false") {
                                    if ($shippingCost->in_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                        $TotalShipCost = $shippingCost->max_charges;
                                    } else {
                                        $TotalShipCost = $shippingCost->in_state_charge * $totalQuantity;
                                    }
                                }
                                if ($request->iscountryindia == "false") {
                                    $TotalShipCost = 3500;
                                }
                            } else {
                                if ($request->iscountryindia != "false") {
                                    if ($shippingCost->out_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                        $TotalShipCost = $shippingCost->max_charges;
                                    } else {
                                        $TotalShipCost = $shippingCost->out_state_charge * $totalQuantity;
                                    }
                                } else {
                                    $deliveryday = $shipping_type->delivery_days_range;
                                }
                                if ($request->iscountryindia == "false") {
                                    $TotalShipCost = 3500;
                                } else {
                                    $deliveryday = $shipping_type->delivery_days_range;
                                }
                            }
                            // $TotalShipCost =   (float)$shippingCost->vat *  $totalQuantity;
                            $igst_amount = ($cart->total_price_after_discount + $TotalShipCost) * ($vat_percentage / 100);
                            $total_gst_amount = $igst_amount;
                            $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                            $gst_type = 'VAT';


                        }
                    }

                    if ($request->iscountryindia == "false") {
                        $TotalShipCost = 3500;
                    }
                    $shipping_price = $TotalShipCost;
                    $cart_total_with_shipping = $cart_total_with_gst + $shipping_price;

                    while (true) {
                        $order_number = 'ORD' . random_int(100000, 999999);
                        if (!Order::where('order_number', $order_number)->exists()) {
                            break;
                        }
                    }
                    if ($request->hasFile('payment_proof')) {
                        $payment_image = $request->payment_proof->store('payment');
                    } else {
                        $payment_image = "";
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
                        'customer_billing_address_id' => $customer_billing_address->id,
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
                        'vat_percentage' => $vat_percentage,
                        'total_gst_percentage' => $total_gst_percentage,
                        'igst_amount' => $igst_amount,
                        'cgst_amount' => $cgst_amount,
                        'sgst_amount' => $sgst_amount,
                        'total_gst_amount' => $total_gst_amount,
                        'order_amount_with_gst' => $cart_total_with_gst,
                        'shipping_type_id' => $request->iscountryindia != "false" ? $shipping_type->id : "",
                        'shipping_type_name' => $request->iscountryindia != "false" ? $shipping_type->name : "",
                        'payment_image' => $payment_image,
                        'shipping_type_maximum_days' => $request->iscountryindia != "false" ? $deliveryday : "7 - 10 Days",
                        'shipping_type_price' => $request->iscountryindia != "false" ? $shipping_price : 3500,
                        'order_amount_with_shipping' => $cart_total_with_shipping,
                        'estimated_delivery_date' => Carbon::now()->addDays(10)->toDateString(),
                        'delivered_on_date' => Null,
                        'payment_status' => 'pending',
                        'payment_method' => $paymentMethod,
                        'paymentid' => $request->paymentid,
                        'refrence_id' => $request->reference_id ?? null,
                        'order_status' => 'New Order',
                        'sendmailstatus' => 0,
                        'transaction_number' => 'TRN' . random_int(100000, 999999),
                        'transaction_detail' => 'Dummy Details',
                    );
                    //   dd( $orderData);
                    $order = Order::create($orderData);
                    OrderStatus::create([
                        'order_id' => $order->id,
                        'order_status' => 'New Order'
                    ]);
                    foreach ($cart_details as $cart_detail) {
                        $product = Product::findOrFail($cart_detail->product_id);
                        $product_option = ProductOption::findOrFail($cart_detail->product_option_id);
                        $orderDetailData = array(
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'category_id' => $product->category_id,
                            'product_name' => $product->name,
                            'product_option_id' => $product_option->id,
                            'brand_id' => $product_option->brand_id,
                            'brand_name' => $product_option->carmake->quantity . $product_option->carmake->quantity_in,
                            'mrp' => $product_option->mrp,
                            'discount_percentage' => $product_option->discount_percentage,
                            'discount_amount' => $product_option->discount_amount,
                            'price' => $product_option->price,
                            'quantity' => $cart_detail->quantity,
                            'total_price' => $product_option->price * $cart_detail->quantity,
                        );
                        // dd($orderDetailData);
                        OrderDetail::create($orderDetailData);
                        $product_option->update([
                            'stock' => $product_option->stock - $cart_detail->quantity
                        ]);
                        $product->update([
                            'stock' => $product->product_options->SUM('stock')
                        ]);
                    }
                    $headerdata = HeaderSetting::first();
                    CartDetail::where('cart_id', $cart->id)->delete();
                    $cart->delete();
                    $data['order_id'] = $order->order_number;
                    $data['customer_name'] = $customer->name;
                    $data['mobile_number'] = $headerdata->tollfree_number;
                    $data['delivery_day'] = $order->shipping_type_maximum_days;
                    $data['ordersid'] = encrypt($order->id);


                    $general_setting = GeneralSetting::firstOrFail();
                    $order = Order::where('id', $order->id)->with('order_detailss')->first();
                    //dd($order);
                    $terms_and_condition = Policy::where('name', 'terms_and_condition')->first();
                    $gstsetting = SiteGstSetting::firstOrFail();
                    set_time_limit(120);
                    ini_set('max_execution_time', 120);
                    ini_set('memory_limit', '512M');

                    $pdf = Pdf::loadView('frontend.customer.invoice', compact(
                        'terms_and_condition',
                        'general_setting',
                        'order',
                        'gstsetting'
                    ));
                    $content = $pdf->download()->getOriginalContent();
                    Storage::put('invoices/invoices' . strtolower($order->order_number) . '.pdf', $content);

                    $data['pdf_url'] = url('storage') . '/invoices/invoices' . strtolower($order->order_number) . '.pdf';
                    $order->update([
                        'invoice_number' => $gstsetting->invoice_prefix . "-" . $gstsetting->financial_year . "/" . $gstsetting->invoice_number,
                        'invoice_url' => '/invoices/invoices' . strtolower($order->order_number) . '.pdf',
                    ]);

                    $datas = array(
                        'email' => $customer->email,
                        'mobile_number' => $customer->mobile_number,
                        'name' => $customer->name,
                        'order_id' => $order->order_number,
                        'pdf_url' => $data['pdf_url'],
                        'order' => $order,

                    );
                    ;
                    $pdfurl = $data['pdf_url'];
                    $admin = User::first();
                    $this->sendAdminmsg($customer->name, $customer->email, $customer->mobile_number, $cart_total_with_shipping);

                    DB::commit();

                    // decide redirect based on payment method
                    if ($paymentMethod === 'online') {

                        return response()->json([
                            'success' => true,
                            'payment_url' => route('customer.payment.request', $order->id),
                            'message' => 'Redirecting to payment gateway'
                        ]);

                    } else {

                        return response()->json([
                            'success' => true,
                            'redirect_url' => url('/customer/order-success/' . $order->id),
                            'message' => 'Order placed successfully'
                        ]);
                    }
                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 421,
                        'messsge' => 'Something Went Wrong! please try again.',
                        // 'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                    ]);

                }
                //for cash on delivery option ended 

            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
                ]);
            }
        } else {
            DB::rollback();
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }
    }


    public function sendAdminmsg($name, $email, $mobile, $amount)
    {


        $message = "Received an order from {$name}, Mob: {$mobile}, and Email: {$email} today, Billed Amount {$amount}, \nThanks & Regards \nIzharsons Perfumers";

        $dlt_id = '1307175755306351640';
        $pe_id = '1301169510661908409';
        $request_parameter = array(
            'authkey' => '468706Au6g3Hg7oQKn68c3a8c6P1',
            'mobiles' => '8188983264',
            'sender' => 'IZHARS',
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
            //'unicode'   => '1',
        );
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach ($request_parameter as $key => $val) {
            $url .= $key . '=' . $val . '&';
        }
        $url .= 'DLT_TE_ID=' . $dlt_id . '&PE_ID=' . $pe_id;
        $url = rtrim($url, "&");

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //get response
            $output = curl_exec($ch);

            curl_close($ch);

            // return true;
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
    }



    public function request($orderId)
    {
        $order = Order::findOrFail($orderId);
        $customer = Customer::findOrFail($order->customer_id);

        // generate unique transaction id
        $transactionId = 'TXN' . time();

        /*
        |--------------------------------------------------------------------------
        | STORE PAYMENT INITIATION
        |--------------------------------------------------------------------------
        */
        CCAvenue::updateOrCreate(
            [
                'order_id' => $order->order_number,
                'status' => 'active'
            ],
            [
                'user_id' => $customer->id,
                'billing_id' => $order->customer_billing_address_id,
                'shipping_id' => $order->customer_address_id,
                'shipping_type' => $order->shipping_type_id,
                'payment_mode' => 'online',
                'transaction_id' => $transactionId,
                'amount' => $order->order_amount_with_shipping,
                'payment_status' => 'pending'
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PREPARE CC AVENUE REQUEST DATA
        |--------------------------------------------------------------------------
        */

        // If city/state stored as relation, adjust accordingly
        $city = $order->city ?? '';
        $state = $order->state ?? '';
        $country = "India";

        $data = [

            // REQUIRED
            "merchant_id" => config('ccavenue.merchant_id'),
            "order_id" => $order->order_number,
            "amount" => $order->order_amount_with_shipping,
            "currency" => "INR",
            "redirect_url" => route('customer.payment.response'),
            "cancel_url" => route('customer.payment.response'),
            "language" => "EN",

            // BILLING DETAILS
            "billing_name" => $order->name,
            "billing_address" => $order->address,
            "billing_city" => $city,
            "billing_state" => $state,
            "billing_zip" => $order->pincode,
            "billing_country" => $country,
            "billing_tel" => $order->mobile_number,
            "billing_email" => $order->email,

            // DELIVERY DETAILS
            "delivery_name" => $order->name,
            "delivery_address" => $order->address,
            "delivery_city" => $city,
            "delivery_state" => $state,
            "delivery_zip" => $order->pincode,
            "delivery_country" => $country,
            "delivery_tel" => $order->mobile_number,
            "delivery_email" => $order->email,
        ];

        /*
        |--------------------------------------------------------------------------
        | ENCRYPT DATA
        |--------------------------------------------------------------------------
        */
        $encrypted = encryptCCavenue($data);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT TO CC AVENUE (POST FORM)
        |--------------------------------------------------------------------------
        */
        return view('front.ccavenue_redirect', compact('encrypted'));
    }


    public function response(Request $request)
    {
        $response = decryptCCavenue($request->encResp);

        $order = Order::where('order_number', $response['order_id'])->first();
        $ccavenue = CCAvenue::where('order_id', $response['order_id'])->first();

        if (!$order) {
            return redirect('/')->with('error', 'Order not found');
        }

        if ($response['order_status'] === "Success") {

            $ccavenue->update(['payment_status' => $response['order_status'], 'status' => 'completed']);
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'Confirmed',
                'transaction_number' => $response['tracking_id'] ?? null,
                'payment_message' => $response['status_message'] ?? null
            ]);

            $admin = User::first();
            Mail::to($admin->alert_email)->send(new AdminPaymentMail($order));

            return redirect('/customer/order-success/' . $order->id);

        } else {

            $ccavenue->update(['payment_status' => $response['order_status']]);
            $order->update([
                'payment_status' => 'failed',
                'payment_message' => $response['status_message'] ?? null
            ]);

            return redirect('/order-failed');
        }
    }

    public function success($orderId)
    {

        $order = Order::with('order_detailss')
            ->findOrFail($orderId);
        return view('front.order_success', compact('order'));
    }

}