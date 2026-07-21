<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProductReview;
use App\Models\ShippingCost;
use App\Models\FreeShiping;
use App\Models\OrderStatus;
use App\Models\OrderCourier;
use App\Models\Reason;
use App\Models\CancelOrder;
use App\Models\OrderRefund;
use App\Models\User;
use App\Models\ReturnOrder;
use App\Models\GeneralSetting;
use App\Models\Policy;
use App\Models\SiteGstSetting;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use PDF;
use Mail; 
use App\Mail\OrderShipmentMail;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

         $orders = Order::latest()->get();
         $cancelreasons=Reason::where('category','e-commerce')->where('type','cancelled')->get();
        return view('admin.order.index',compact('orders','cancelreasons'));
    }


 public function onlinecancellationrefund() {

         $orders = Order::latest()->get();
         $cancelreasons=Reason::where('category','e-commerce')->where('type','cancelled')->get();
        return view('admin.online-cancellation-refund.online-cancellation-refund',compact('orders','cancelreasons'));
    }
    
    
     public function ordercustomerrequest($id)
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.online-cancellation-refund.ordercustomerrequest')->with([
                    'order' => Order::where('id',$id)->first()
                ])->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    
 public function ordercustomerrequestmessage(Request $request){
     $request->validate([
         'message'=>'required'
         ]);
     $order = Order::where('id',$request->order_id)->first();
     if($order->returnorder){
         ReturnOrder::where('id',$order->returnorder->id)->update(['return_reason_admin'=>$request->message]);
         $order->update([
             'order_status'=>'Cancelled'
             ]);
             OrderStatus::create([
                 'order_id'=>$order->id,
                 'order_status'=>'Return Requested'
                 ]);
     }else{
        CancelOrder::where('id',$order->cancelorder->id)->update(['cancellation_reason_admin'=>$request->message]); 
         OrderStatus::create([
                 'order_id'=>$order->id,
                 'order_status'=>'Cancelled'
                 ]);
         $order->update([
             'order_status'=>'Cancelled'
             ]);
     }
     
     return redirect()->route('admin.online-cancellation-refund')->with('success','Approved Successfully');
     
 }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cancelreasons=Reason::where('category','e-commerce')->where('type','cancelled')->get();
        $order = Order::findOrFail($id);
        // dd($order->order_detailss->toArray());
        return view('admin.order.show')->with([
            'order' => $order,
            'cancelreasons' => $cancelreasons,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

// shippingdeatis
    public function viewShippingDetails(){
        $freeshiping = FreeShiping::latest()->limit(1)->get();
        $shippingData = ShippingCost::latest()->limit(3)->get();

        return view('admin.shipping.index', compact('shippingData','freeshiping')); 

    }


 public function EditFreeShippingDetails($id){
        $shippingData = FreeShiping::where('id',$id)->first();

        return view('admin.shipping.editfreeshiping', compact('shippingData')); 

    }
     public function EditShippingDetails($id){
        $shippingData = ShippingCost::where('id',$id)->first();

        return view('admin.shipping.edit', compact('shippingData')); 

    }

     public function addNewShipping(){
       
        return view('admin.shipping.add'); 

    }

        public function addShipping(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
          
            'name' => 'required',
            'min_order_value' => 'required',
            'max_order_value' => 'required',
            'in_state_charge' => 'required',
            'out_state_charge' => 'required',
            'maximum_days' => 'required',
            'status' => 'required',
           
        ]);
        if($validator->passes()) {
            try {
              
                
                ShippingCost::create([
                    'name' => $request->name,
                    'min_order_value' => $request->min_order_value,
                    'max_order_value' => $request->max_order_value,
                    'in_state_charge' => $request->in_state_charge,
                    'out_state_charge' => $request->out_state_charge,
                    'maximum_days' => $request->maximum_days,
                    'max_charges' => $request->max_charges,
                    'status' => $request->status,
                   
                ]);
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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



    public function updateShipping(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
          
            'name' => 'required|min:3|max:35|regex:/^[A-Za-z.\s,-]*$/',
            // 'min_order_value' => 'required',
            'max_charges' => 'required',
            'in_state_charge' => 'required|digits_between:1,4',
            'out_state_charge' => 'required|digits_between:1,4',
            'delivery_days_range' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/',
            'status' => 'required',
           
        ]);
        if($validator->passes()) {
            try {
                $shippingCost = ShippingCost::findOrFail($id);
                // dd($shippingCost);
                $shippingCost->update([
                    'status' => 'block',
                ]);
                ShippingCost::create([
                    'name' => $request->name,
                    'in_state_charge' => $request->in_state_charge,
                    'out_state_charge' => $request->out_state_charge,
                    'delivery_days_range' => $request->delivery_days_range,
                    'max_charges' => $request->max_charges,
                    'status' => $request->status,
                   
                ]);
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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
    
    public function invoice($order_number)
    {
      
        try {
            // $customer = Auth::guard('customer')->user();
            $general_setting = GeneralSetting::firstOrFail();
            $order = Order::where('id',$order_number)->with('order_detailss')->first();
            //dd($order);
            $terms_and_condition = Policy::where('name','terms_and_condition')->first();
            $logo_path = public_path('invoice/logo.svg');
            $logo_content = file_get_contents($logo_path,false);
            $logo_64 = 'data:image/svg;base64,'.base64_encode($logo_content);
            $gstsetting=SiteGstSetting::firstOrFail();
            $data = array(
                'order' => $order,
                'general_setting' => $general_setting,
                'terms_and_condition' => $terms_and_condition,
                'logo_64' => $logo_64,
            );
            ini_set('memory_limit', '512M');
            ini_set('max_execution_time', 180);
            $pdf = PDF::loadView('front.invoice',compact('logo_64','terms_and_condition','general_setting','order','gstsetting'));
            return $pdf->download($order->order_number.'.pdf');
        } catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }
    

     public function updateFreeShipping(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
          
            'min_order_amount_intrastate' => 'required|digits_between:1,4',
            'min_order_amount_interstate' => 'required|digits_between:1,4',
            'day_range_inter_state' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/',
            'day_range_intra_state' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/',
            'status' => 'required',
           
        ]);
        if($validator->passes()) {
            try {
                $shippingCost = FreeShiping::findOrFail($id);
                $shippingCost->update([
                    'status'=>'block'
                    ]);
                // dd($shippingCost);
                FreeShiping::create([
                    'name' => 'Free Shipping',
                    'min_order_value_intrastate' => $request->min_order_amount_intrastate,
                    'min_order_value_interstate' => $request->min_order_amount_interstate,
                    'day_range_inter_state' => $request->day_range_inter_state,
                    'day_range_intra_state' => $request->day_range_intra_state,
                    'status' => $request->status,
                   
                ]);
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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

    public function DeleteShipping($id) {
        try {

            $shippingData = ShippingCost::findOrFail($id);
            //dd($shippingData);
            $shippingData->delete();
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
    
    public function updatetransitorderstatus(Request $request){
         $validator = Validator::make($request->all(), [
          
            'awb_number' => 'required',
            'courier_name' => 'required',
            'date' => 'required',
            'delivery_date' => 'required',
            'tracking_url' => 'required|url',
           
        ]);
        
        if($validator->passes()) {
            try {
                 $id = $request->order_id;
                $status = $request->order_status;
                $orders=Order::find($id);
                 $orders->order_status = $status;
                 
            OrderStatus::create([
            'order_id'=>$id,
            'order_status'=>$status
            ]);
        $admin= User::first();
        $customer = Customer::where('id',$orders->customer_id)->first();
        $data['email'] = $admin->alert_email;
        $data['name'] = $orders->name;
        $data['awb_number'] = $request->awb_number;
        $data['courier_name'] = $request->courier_name;
        $data['date'] = $request->date;
        $data['delivery_date'] = $request->delivery_date;
        $data['order_number'] = $orders->order_number;
        $data['tracking_url'] = $request->tracking_url;
        Mail::to($customer->email)->send(new OrderShipmentMail($data));
        // Mail::send('email.orderstatusupdateemail', ['status' => $status,'order'=>$orders], function($message) use($customer,$admin){
        //       $message->to($customer->email);
        //       $message->to($admin->alert_email);
        //       $message->subject('Order Status Update');
        //   });
            $orders->save();
            OrderCourier::create($request->all());
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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

public function refund(Request $request){
   $validator = Validator::make($request->all(), [
          
            'transaction_id' => 'required',
            'refunded_amount' => 'required',
            'refunded_date' => 'required'
           
        ]);
        
        if($validator->passes()) {
            try {
                // print_r($request->all());
                // die();
                 $id = $request->order_id;
                $status = $request->order_status;
                $orders=Order::find($id);
                 $orders->payment_status = 'refunded';
            // OrderStatus::create([
            // 'order_id'=>$id,
            // 'order_status'=>$status
            // ]);
             $admin= User::first();
        $customer = Customer::where('id',$orders->customer_id)->first();
        Mail::send('email.orderstatusupdateemail', ['status' => $status,'order'=>$orders], function($message) use($customer,$admin){
              $message->to($customer->email);
              $message->to($admin->alert_email);
              $message->subject('Order Status Update');
          });
            $orders->save();
            OrderRefund::create($request->all());
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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

public function updatecancelorderstatus(Request $request){
         $validator = Validator::make($request->all(), [
          
            'reason' => 'required',
            'cancellation_reason_admin' => 'required',
           
        ]);
        
        if($validator->passes()) {
            try {
                 $id = $request->order_id;
                $status = $request->order_status;
                $orders=Order::find($id);
                 $orders->order_status = $status;
                  OrderStatus::create([
            'order_id'=>$id,
            'order_status'=>$status
            ]);
            CancelOrder::create([
            'order_id'=>$id,
            'reason_id'=>$request->reason,
            'cancellation_reason_admin'=>$request->cancellation_reason_admin,
            'cancelled_by'=>'admin',
            ]);
            $admin= User::first();
        $customer = Customer::where('id',$orders->customer_id)->first();
        Mail::send('email.orderstatusupdateemail', ['status' => $status,'order'=>$orders], function($message) use($customer,$admin){
              $message->to($customer->email);
              $message->to($admin->alert_email);
              $message->subject('Order Status Update');
          });
            $orders->save();
                return response()->json([
                    "success" => true,
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    "success" => false,
                    'msgText' => $ex->getMessage(),
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
    public function updateOrderStatus(Request $request) {
        try {
            
            // echo '333';die;
            $id = $request->order_id;
            $status = $request->status;
    if($status!="New Order" && $status!="Return"){
         $orders=Order::find($id);
        $orders->order_status = $status;
         $admin= User::first();
        $customer = Customer::where('id',$orders->customer_id)->first();
        Mail::send('email.orderstatusupdateemail', ['status' => $status,'order'=>$orders], function($message) use($customer,$admin){
              $message->to($customer->email);
              $message->to($admin->alert_email);
              $message->subject('Order Status Update');
          });
        OrderStatus::create([
        'order_id'=>$id,
        'order_status'=>$status
        ]);
            if($orders->save()) {
                echo 200;die;
            } else {
                echo 500;die;
            }
        
    }else{
        echo 400;die;
    }
           
            
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

        public function getrating($id){
    $data = OrderProductReview::where('order_id',$id)->with('product')->get();
    return response()->json($data);
    
}

public function changestatus(Request $request,$id){
        
    $data = ShippingCost::findorFail($id);
    if($data->status=="active"){
        $data->update(['status'=>'block']);
    }else{
        $data->update(['status'=>'active']);
    }
    
    return response()->json(['success'=>'Status changed successfully.']);
}

public function showshipping($id){
    try {
        $shipping = ShippingCost::findOrFail($id);
        return response()->json([
            "success" => true,
            "html" => view('admin.shipping.show')->with([
                'shipping' => $shipping
            ])->render(),
        ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
}

public function viewalltransaction(){
    try {
        $order = Order::all();
        return view('admin.view-all-transactions.index')->with([
                'orders' => $order
            ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
}

public function managecustomerreview(){
    try {
        $order = OrderProductReview::all();
        return view('admin.manage-customer-review.index')->with([
                'orders' => $order
            ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
}
public function managereasonscategory(){
    try {
       $order = CancelOrder::all();
        return view('admin.manage-reasons-category.index')->with([
                'orders' => $order
            ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
}
public function manageticket(){
    try {
       $returnorders = ReturnOrder::all();
       $cancelorders = CancelOrder::all();
        return view('admin.manage-ticket.index')->with([
                'returnorders' => $returnorders,
                'cancelorders' => $cancelorders,
            ]);
    } catch(\Exception $ex) {
        return response()->json([
            "success" => false,
            'msgText' =>$ex->getMessage(),
        ]);
    }
}

public function approvepayment(Request $request,$id){
        
    $data = Order::findorFail($id);
    $data->update(['payment_status'=>'success','payment_approved_date'=>date("Y-m-d H:i:s")]);
    
    return response()->json(['success'=>'Status changed successfully.']);
}
}
