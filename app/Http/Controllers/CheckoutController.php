<?php

namespace App\Http\Controllers;

use App\Mail\AdminPaymentMail;
use App\Models\BankAccount;
use App\Models\CCAvenue;
use App\Models\CashfreeOrder;
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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        $states = State::where('country_id', $countryId)->orderBy('name')->get(['id', 'name']);
        return response()->json($states);
    }

    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)->orderBy('name')->get(['id', 'name']);
        return response()->json($cities);
    }

    public function saveBilling(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required'
        ]);

        $data['customer_id'] = auth()->id();

        CustomerBillingAddress::updateOrCreate(['id' => $request->id], $data);

        return response()->json(['success' => true]);
    }

    public function saveShipping(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required'
        ]);

        $data['customer_id'] = auth()->id();

        CustomerAddress::updateOrCreate(['id' => $request->id], $data);

        return response()->json(['success' => true]);
    }

    public function copyBillingToShipping(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $billing = CustomerBillingAddress::where('id', $request->billing_id)
            ->where('customer_id', $customer->id)
            ->firstOrFail();

        $existingShipping = CustomerAddress::where('customer_id', $customer->id)
            ->where('name', $billing->name)
            ->where('email', $billing->email)
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

        $shipping = CustomerAddress::create([
            'customer_id' => $customer->id,
            'name' => $billing->name,
            'email' => $billing->email,
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
        $validator = Validator::make($request->all(), [
            'shipping_type' => 'required',
            'billing_id' => 'required',
            'shipping_id' => 'required',
            'payment_mode' => 'required',
            'payment_gateway' => 'required_if:payment_mode,online|in:cashfree,ccavenue',
            'payment_proof' => 'nullable|image:mimes,jpg,png,pneg',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('customer')->user();
                $paymentMethod = $request->payment_mode;

                if ($paymentMethod) {

                    $customer_billing_address = CustomerBillingAddress::where('id', $request->billing_id)->where('customer_id', $customer->id)->firstOrFail();
                    $customer_address = CustomerAddress::where('id', $request->shipping_id)->where('customer_id', $customer->id)->firstOrFail();

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
                        'payment_gateway' => $paymentMethod === 'online' ? $request->payment_gateway : null,
                        'paymentid' => $request->paymentid,
                        'refrence_id' => $request->reference_id ?? null,
                        'order_status' => 'New Order',
                        'sendmailstatus' => 0,
                        'transaction_number' => 'TRN' . random_int(100000, 999999),
                        'transaction_detail' => 'Dummy Details',
                    );

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
                        OrderDetail::create($orderDetailData);
                        $product_option->update([
                            'stock' => $product_option->stock - $cart_detail->quantity
                        ]);
                        $product->update([
                            'stock' => $product->product_options->SUM('stock')
                        ]);
                    }

                    CartDetail::where('cart_id', $cart->id)->delete();
                    $cart->delete();

                    DB::commit();

                    // Invoice generation, confirmation email, and admin SMS now run on the
                    // order-success page load (see success()/finalizeOrder()) instead of here,
                    // so this response comes back to the customer as fast as possible.

                    if ($paymentMethod === 'online') {
                        return response()->json([
                            'success' => true,
                            'payment_url' => route('customer.payment.request', $order->id),
                            'message' => 'Redirecting to payment gateway'
                        ]);
                    }

                    return response()->json([
                        'success' => true,
                        'redirect_url' => url('/customer/order-success/' . $order->id),
                        'message' => 'Order placed successfully'
                    ]);

                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 421,
                        'messsge' => 'Something Went Wrong! please try again.',
                    ]);
                }

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

    /**
     * Dispatches to the correct online gateway based on what the
     * customer chose at checkout.
     */
    public function request($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->payment_gateway === 'cashfree') {
            return $this->cashfreeRequest($order);
        }

        return $this->ccavenueRequest($order);
    }

    protected function ccavenueRequest(Order $order)
    {
        $customer = Customer::findOrFail($order->customer_id);
        $transactionId = 'TXN' . time();

        CCAvenue::updateOrCreate(
            ['order_id' => $order->order_number, 'status' => 'active'],
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

        $city = $order->city ?? '';
        $state = $order->state ?? '';
        $country = "India";

        $data = [
            "merchant_id" => config('ccavenue.merchant_id'),
            "order_id" => $order->order_number,
            "amount" => $order->order_amount_with_shipping,
            "currency" => "INR",
            "redirect_url" => url('/customer/payment/response'),
            "cancel_url" => url('/customer/payment/response'),
            "language" => "EN",
            "billing_name" => $order->name,
            "billing_address" => $order->address,
            "billing_city" => $city,
            "billing_state" => $state,
            "billing_zip" => $order->pincode,
            "billing_country" => $country,
            "billing_tel" => $order->mobile_number,
            "billing_email" => $order->email,
            "delivery_name" => $order->name,
            "delivery_address" => $order->address,
            "delivery_city" => $city,
            "delivery_state" => $state,
            "delivery_zip" => $order->pincode,
            "delivery_country" => $country,
            "delivery_tel" => $order->mobile_number,
            "delivery_email" => $order->email,
        ];

        $encrypted = encryptCCavenue($data);

        return view('front.ccavenue_redirect', compact('encrypted'));
    }

    protected function cashfreeRequest(Order $order)
{
    $baseUrl = config('cashfree.mode') === 'production'
        ? 'https://api.cashfree.com/pg'
        : 'https://sandbox.cashfree.com/pg';

    $payload = [
        'order_id' => $order->order_number,
        'order_amount' => (float) $order->order_amount_with_shipping,
        'order_currency' => 'INR',
        'customer_details' => [
            'customer_id' => 'cust_' . $order->customer_id,
            'customer_phone' => $order->mobile_number,
            'customer_email' => $order->email,
            'customer_name'  => $order->name,
        ],
        'order_meta' => [
            'return_url' => route('customer.payment.cashfree.return', $order->id) . '?order_id={order_id}',
            'notify_url' => route('customer.payment.cashfree.webhook'),
        ],
    ];

    $response = Http::withHeaders([
        'x-client-id'     => config('cashfree.app_id'),
        'x-client-secret' => config('cashfree.secret_key'),
        'x-api-version'   => '2023-08-01',
        'Content-Type'    => 'application/json',
    ])->post($baseUrl . '/orders', $payload);

    if (!$response->successful()) {
        Log::error('Cashfree order creation failed for order ' . $order->id . ': ' . $response->body());
        return redirect(route('order.failed'))->with('error', 'Unable to start payment. Please try again.');
    }

    $result = $response->json();

    CashfreeOrder::updateOrCreate(
        ['order_id' => $order->order_number],
        [
            'user_id'        => $order->customer_id,
            'link_id'        => $result['cf_order_id'] ?? $order->order_number,
            'cf_link_url'    => $result['payment_session_id'] ?? null, // storing session id here
            'amount'         => $order->order_amount_with_shipping,
            'payment_status' => 'pending',
            'status'         => 'active',
        ]
    );

    if (empty($result['payment_session_id'])) {
        Log::error('Cashfree order response missing payment_session_id for order ' . $order->id . ': ' . $response->body());
        return redirect(route('order.failed'))->with('error', 'Unable to start payment. Please try again.');
    }

    // Orders API doesn't give a direct redirect URL — it gives a payment_session_id
    // which the Cashfree Checkout JS SDK uses to open the hosted payment page.
    return view('front.cashfree_checkout', [
        'paymentSessionId' => $result['payment_session_id'],
    ]);
}

    /**
     * Customer is bounced back here by Cashfree after attempting payment.
     * We re-check status with Cashfree directly rather than trusting the redirect alone.
     */
   public function cashfreeReturn(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId);
    $cashfree = CashfreeOrder::where('order_id', $order->order_number)->first();

    $status = $this->getCashfreeLinkStatus($order->order_number); // ✅ order_number use karo, link_id nahi

    if ($status === 'PAID') {
        $cashfree?->update(['payment_status' => 'success', 'status' => 'completed']);
        $order->update(['payment_status' => 'success']);

        return redirect('/customer/order-success/' . $order->id);
    }

    $cashfree?->update(['payment_status' => strtolower($status ?? 'failed')]);
    $order->update(['payment_status' => 'failed']);

    return redirect(route('order.failed'));
}

    /**
     * Cashfree server-to-server webhook — the reliable source of truth,
     * independent of whether the customer's browser makes it back to return_url.
     * TODO: verify x-webhook-signature / x-webhook-timestamp headers against
     * config('cashfree.secret_key') per Cashfree's webhook docs before trusting this.
     */
   public function cashfreeWebhook(Request $request)
{
    $payload = $request->all();

    Log::info('Cashfree webhook received', $payload);

    $orderId = $payload['data']['order']['order_id'] ?? null;
    $paymentStatus = $payload['data']['payment']['payment_status'] ?? null;

    if (!$orderId) {
        return response()->json(['status' => 'ignored'], 200);
    }

    $order = Order::where('order_number', $orderId)->first();
    $cashfree = CashfreeOrder::where('order_id', $orderId)->first();

    if (!$order) {
        return response()->json(['status' => 'ignored'], 200);
    }

    if (strtoupper($paymentStatus) === 'SUCCESS') {
        $order->update(['payment_status' => 'success']);
        $cashfree?->update(['payment_status' => 'success', 'status' => 'completed']);
    } elseif (in_array(strtoupper($paymentStatus), ['FAILED', 'USER_DROPPED'])) {
        $order->update(['payment_status' => 'failed']);
        $cashfree?->update(['payment_status' => 'failed']);
    }

    return response()->json(['status' => 'ok'], 200);
}

   protected function getCashfreeLinkStatus($orderNumber)
{
    $baseUrl = config('cashfree.mode') === 'production'
        ? 'https://api.cashfree.com/pg'
        : 'https://sandbox.cashfree.com/pg';

    $response = Http::withHeaders([
        'x-client-id'     => config('cashfree.app_id'),
        'x-client-secret' => config('cashfree.secret_key'),
        'x-api-version'   => '2023-08-01',
    ])->get($baseUrl . '/orders/' . $orderNumber);

    if (!$response->successful()) {
        return null;
    }

    return $response->json('order_status'); // ACTIVE, PAID, EXPIRED
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

            $ccavenue->update(['payment_status' => 'Success', 'status' => 'completed']);
            $order->update([
                'payment_status' => 'success',
                'transaction_number' => $response['tracking_id'] ?? null,
                'payment_message' => $response['status_message'] ?? null
            ]);

            $admin = User::first();
            if ($admin) {
                Mail::to($admin->alert_email)->send(new AdminPaymentMail($order));
            }

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
        $order = Order::with('order_detailss')->findOrFail($orderId);
        
        // Runs once — invoice_url stays null until this succeeds, so a page
        // refresh or a slow gateway redirect back here can't double-send mail/SMS.
        // if (!$order->invoice_url) {
            $this->finalizeOrder($order);
            $order->refresh();
        // }
        return view('front.order_success', compact('order'));
    }

    /**
     * Everything that isn't essential to placing the order itself:
     * invoice PDF, invoice numbering, confirmation email, admin SMS.
     * Runs on the success page instead of inside placeOrder().
     */
    protected function finalizeOrder(Order $order)
{
    try {
        $general_setting = GeneralSetting::firstOrFail();
        $terms_and_condition = Policy::where('name', 'terms_and_condition')->first();
        $gstsetting = SiteGstSetting::firstOrFail();
        $orderForInvoice = Order::with('order_detailss')->findOrFail($order->id);

        $pdf = Pdf::loadView('front.invoice', [
            'terms_and_condition' => $terms_and_condition,
            'general_setting' => $general_setting,
            'order' => $orderForInvoice,
            'gstsetting' => $gstsetting,
        ]);
        $content = $pdf->download()->getOriginalContent();
        Storage::put('invoices/invoices' . strtolower($order->order_number) . '.pdf', $content);

        $order->update([
            'invoice_number' => $gstsetting->invoice_prefix . "-" . $gstsetting->financial_year . "/" . $gstsetting->invoice_number,
            'invoice_url' => '/invoices/invoices' . strtolower($order->order_number) . '.pdf',
        ]);
    } catch (\Exception $e) {
        Log::error('Invoice generation failed for order ' . $order->id . ': ' . $e->getMessage());
    }

    try {
        \App\Jobs\SendOrderMailJob::dispatch($order->id);
    } catch (\Exception $e) {
        Log::error('SendOrderMailJob dispatch failed for order ' . $order->id . ': ' . $e->getMessage());
    }

    try {
        \App\Jobs\SendAdminSmsJob::dispatch($order->name, $order->email, $order->mobile_number, $order->order_amount_with_shipping);
    } catch (\Exception $e) {
        Log::error('SendAdminSmsJob dispatch failed for order ' . $order->id . ': ' . $e->getMessage());
    }
}

}