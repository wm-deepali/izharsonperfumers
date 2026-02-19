<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\OilgradeOrderService;
use App\Models\OrderProductReview;
use Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        $customer = Customer::count();
        $today = Carbon\Carbon::now()->format('Y-m-d').'%';
        $ordertotal = Order::where('order_status','Delivered')->count();
        $ordertotalpending = Order::where('order_status','!=','Delivered')->count();
        $ordertoday = Order::where('created_at', 'like', $today)->get();
        $customertoday = Customer::where('created_at', 'like', $today)->get();
        $servicetoday = OrderService::where('created_at', 'like', $today)->get();
        $oilservicetoday = OilgradeOrderService::where('created_at', 'like', $today)->get();
        $servicetotal = OrderService::where('order_status','Service Completed')->count() + OilgradeOrderService::where('order_status','Service Completed')->count();
        $ordertotalamount = Order::where('order_status','Delivered')->sum('order_amount_with_shipping');
        $orderreview = OrderProductReview::where('created_at', 'like', $today)->get();
        $categorysale = DB::table('orders')
                ->select(DB::raw("(sum(orders.total_gst_amount)) as total_gst_amount"),'categories.name as category_name','orders.created_at',DB::raw("(sum(orders.order_amount)) as total_sales"),DB::raw("(sum(orders.order_amount_with_shipping)) as order_amount_with_shipping"),DB::raw("(sum(orders.shipping_type_price)) as shipping_type_price"))
                ->join('order_details','orders.id','=','order_details.order_id')
                ->join('categories','order_details.category_id','=','categories.id')
                ->groupBy('order_details.category_id')
                ->where('orders.created_at', '>=', \Carbon\Carbon::today()->subDays(7))
                ->get();
                $producttopsale = DB::table('orders')
                ->select(DB::raw("(sum(orders.total_gst_amount)) as total_gst_amount"),'order_details.product_name','orders.created_at',DB::raw("(sum(orders.order_amount)) as total_sales"),DB::raw("(sum(orders.order_amount_with_shipping)) as order_amount_with_shipping"),DB::raw("(sum(orders.shipping_type_price)) as shipping_type_price"))
                ->join('order_details','orders.id','=','order_details.order_id')
                ->groupBy('order_details.product_id')
                ->where('orders.created_at', '>=', \Carbon\Carbon::today()->subDays(7))
                ->get();
                // print_r($categorysale);
                // die();
        return view('admin.dashboard.index',compact('customer','producttopsale','ordertotalpending','ordertotal','servicetotal','ordertotalamount','ordertoday','customertoday','servicetoday','oilservicetoday','orderreview','categorysale'));
    }
}
//return view('admin.index', compact('products', 'orders', 'categories'));
