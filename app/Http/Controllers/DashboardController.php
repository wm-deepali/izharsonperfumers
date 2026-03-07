<?php

namespace App\Http\Controllers;

use App\Models\CancellOrderImage;
use App\Models\CancelOrder;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\CustomerBillingAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderProductReview;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function myOrders()
    {
        $customer = auth()->guard('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login');
        }

        $orders = Order::where('customer_id', $customer->id)
            ->with('order_details')
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }

    public function orderDetails($id)
    {
        $customer = auth()->guard('customer')->user();

        $order = Order::where('customer_id', $customer->id)
            ->with([
                'order_details.product',
                'cities',
                'states',
                'countries',
                'order_details.order_product_review'
            ])
            ->findOrFail($id);

        $cancelReasons = Reason::where('type', 'cancelled')
            ->where('category', "e-commerce")
            ->get(['id', 'title']);

        return view('customer.orders.details', compact('order', 'cancelReasons'));
    }

    public function cancelOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'reason' => 'required',
            'reason_id' => 'required',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {

            $customer = Auth::guard('customer')->user();

            $order = Order::where('id', $request->order_id)
                ->where('customer_id', $customer->id)
                ->firstOrFail();

            if ($order->order_status == "In-Transit") {

                $deldate = $order->estimated_delivery_date;

                return back()->with(
                    'error',
                    "Order has already been dispatched and would be reaching you in $deldate"
                );

            } elseif ($order->order_status == "Delivered") {

                return back()->with(
                    'error',
                    "Your order has already been delivered so it cannot be cancelled."
                );

            } elseif ($order->order_status == "Reject Order") {

                return back()->with(
                    'error',
                    "Your order has been rejected so it cannot be cancelled."
                );

            } elseif ($order->order_status == "Cancelled") {

                return back()->with(
                    'error',
                    "Your order has already been cancelled."
                );

            }

            // Update order status
            $order->update([
                'order_status' => 'Cancelled'
            ]);

            OrderStatus::create([
                'order_id' => $order->id,
                'order_status' => 'Cancelled'
            ]);

            $cancel = CancelOrder::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'cancellation_reason' => $request->reason,
                    'reason_id' => $request->reason_id,
                    'order_id' => $order->id,
                ]
            );

            if ($request->hasFile('image')) {

                foreach ($request->file('image') as $image) {

                    CancellOrderImage::create([
                        'cancell_id' => $cancel->id,
                        'image' => $image->store('cancelorder')
                    ]);
                }
            }

            return back()->with(
                'success',
                "Your order cancellation request has been taken. You will be notified."
            );

        } catch (\Exception $ex) {

            return back()->with('error', $ex->getMessage());
        }
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'rating' => 'required|gt:0',
            'review' => 'required',
            'order_id' => 'required',
            'order_detail_id' => 'required',
        ]);

        try {

            $customer = Auth::guard('customer')->user();

            $order = Order::where('id', $request->order_id)
                ->where('customer_id', $customer->id)
                ->firstOrFail();

            $order_detail = OrderDetail::where('id', $request->order_detail_id)
                ->where('order_id', $order->id)
                ->firstOrFail();

            $product = Product::findOrFail($order_detail->product_id);

            OrderProductReview::updateOrCreate(
                [
                    'order_id' => $order->id,
                    'customer_id' => $customer->id,
                    'order_detail_id' => $order_detail->id,
                    'product_id' => $product->id,
                ],
                [
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]
            );

            // Update product rating
            $product->update([
                'rating' => round($product->order_product_reviews()->avg('rating'))
            ]);

            // Update order average rating
            $order->update([
                'average_rating' => round($order->order_product_reviews()->avg('rating'))
            ]);

            return back()->with('success', 'Thanks for rating and review!');

        } catch (\Exception $ex) {

            return back()->with('error', $ex->getMessage());
        }
    }

    public function invoices()
    {
        $customer = auth()->guard('customer')->user();

        $orders = Order::where('customer_id', $customer->id)
            ->whereNotNull('invoice_number')
            ->with('order_details.product')
            ->latest()
            ->get();

        return view('customer.invoices.index', compact('orders'));
    }

    public function accountDetails()
    {
        $customer = auth()->guard('customer')->user();

        return view('customer.account-details', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = auth()->guard('customer')->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
        ]);

        $data = $request->only([
            'name',
            'email',
            'mobile_number',
            'gender',
            'dob',
            'address_line_1',
            'address_line_2'
        ]);

        if ($request->hasFile('image')) {

            // Delete previous image
            if ($customer->image && Storage::exists($customer->image)) {
                Storage::delete($customer->image);
            }

            // Upload new image
            $data['image'] = $request->file('image')->store('customers');
        }

        $customer->update($data);

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $customer = auth()->guard('customer')->user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $customer->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password updated successfully');
    }

    public function accountAddress()
    {
        $customer = auth()->guard('customer')->user();

        $shippingAddresses = CustomerAddress::with('countries', 'states', 'cities')->where('customer_id', $customer->id)->get();
        $billingAddresses = CustomerBillingAddress::with('countries', 'states', 'cities')->where('customer_id', $customer->id)->get();
        $countries = Country::all();

        return view('customer.account-address', compact('shippingAddresses', 'billingAddresses', 'countries'));
    }
}


