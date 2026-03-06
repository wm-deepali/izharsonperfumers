<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Services;
use App\Models\ServiceBookings;
use App\Models\OrderService;
use App\Models\OilgradeOrderService;
use App\Models\CustomerBillingAddress;
use App\Models\CustomerAddress;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Storage;
use Maize\EmailDomainRule\EmailDomainRule;
class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::with('orders')->with('services')->latest()->get();
        return view('admin.customer.index', compact('customers'));
    }

    public function viewcustomer($id) {
        $customer = Customer::findOrFail($id);
        $ordersall = Order::where('customer_id',$id)->get();
        $data['orders']= Order::where('customer_id',$id)->count();
        $data['delivered_orders']= Order::where('customer_id',$id)->where('order_status','Delivered')->count();
        $data['pending_orders']= Order::where('customer_id',$id)->where('order_status','!=','Delivered')->where('order_status','!=','Cancelled')->count();
        $data['cancelled_orders']= Order::where('customer_id',$id)->where('order_status','Cancelled')->count();
        $data['amount']= Order::where('customer_id',$id)->where('order_status','Delivered')->sum('order_amount_with_shipping');
        $services = OrderService::where('customer_id',$id);
         $oilgradeservices = OilgradeOrderService::where('customer_id',$id);
         $dataservices['services']=OrderService::where('customer_id',$id)->count()+OilgradeOrderService::where('customer_id',$id)->count();
          $dataservices['completed']= OrderService::where('customer_id',$id)->where('order_status','Service Completed')->count()+OilgradeOrderService::where('customer_id',$id)->where('order_status','Service Completed')->count();
          $dataservices['cancelled']= OrderService::where('customer_id',$id)->where('order_status','Cancelled')->count()+OilgradeOrderService::where('customer_id',$id)->where('order_status','Cancelled')->count();
          $dataservices['pending']= OrderService::where('customer_id',$id)->where('order_status','!=','Cancelled')->where('order_status','!=','Service Completed')->count()+OilgradeOrderService::where('customer_id',$id)->where('order_status','!=','Cancelled')->where('order_status','!=','Service Completed')->count();
          $dataservices['amount']= OrderService::where('customer_id',$id)->where('order_status','Service Completed')->sum('order_amount_with_gst')+OilgradeOrderService::where('customer_id',$id)->where('order_status','Service Completed')->sum('order_amount_with_gst');
           $orderservices = OrderService::latest()->where('customer_id',$id)->get()->toArray();
           $oilgradeorderservices = OilgradeOrderService::latest()->where('customer_id',$id)->get()->toArray();
            $dataservicesall = array_merge($orderservices,$oilgradeorderservices);
            $shippings=CustomerAddress::where('customer_id',$customer->id)->get();
                $countries = Country::get(["name", "id"]);
        return view('admin.customer.show',compact('customer','data','dataservicesall','oilgradeservices','dataservices','ordersall','shippings','countries'));
        // try {
        //     $customer = Customer::findOrFail($id);
        //     return response()->json([
        //         "success" => true,
        //         "html" => view('admin.customer.ajax.edit')->with([
        //             'customer' => $customer
        //         ])->render(),
        //     ]);
        // } catch(\Exception $ex) {
        //     return response()->json([
        //         "success" => false,
        //         'msgText' =>$ex->getMessage(),
        //     ]);
        // }
    }
    
     public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }
    
     public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["name", "id"]);
                                      
        return response()->json($data);
    }
    
    public function editcustomerbilling($id){
        $customer = CustomerBillingAddress::where('id',$id)->with('countries','states','cities')->first();
        return response()->json($customer);
    }
    public function updatecustomerbilling(Request $request){
         $validator = Validator::make($request->all(), [ 
             'mobile_number'=>'required|digits:10',
             'pincode'=>'required|digits_between:5,6',
             'country'=>'required',
             'state'=>'required',
              'email'=>['required','email',new EmailDomainRule],
            ]);
            
            if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
       $data = $request->except(['_token']);
    //   print_r($data);
    //   die();
        CustomerBillingAddress::find($request->id)->update($data);
       return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
    }
     public function updatecustomershipping(Request $request){
        $validator = Validator::make($request->all(), [  
             'mobile_number'=>'required|digits:10',
             'pincode'=>'required|digits_between:5,6',
             'country'=>'required',
             'state'=>'required',
              'email'=>['required','email',new EmailDomainRule],
            ]);
            if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
          $data = $request->except(['_token']);
         CustomerAddress::find($request->id)->update($data);
          return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
    }
     public function updatecustomerprofile(Request $request){
          $validator = Validator::make($request->all(), [  
        'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
        'image'=>'nullable|mimes:png,jpeg,svg,gif|dimensions:min_width=500,min_height=500,max_width=500,max_height=500',
         'email'=>['required','email',new EmailDomainRule],
        // 'pincode'=>'required|digits_between:5,10',
        'country'=>'required',
        'mobile_number'=>'required|digits:10',
        'state'=>'required',
        'gender'=>'required|in:male,female',
        'dob'=>'required|date_format:Y-m-d|before:today',
        // 'registration_date'=>'required|date_format:Y-m-d|before:today',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
          $data = $request->except(['_token']);
          $customer=Customer::find($request->id);
           if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('profile');
                    if(Storage::exists($customer->image)) {
                        Storage::delete($customer->image);
                    }
        }
        // print_r($data);
        //   die();
         $customer->update($data);
         return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
    }
    
     public function editcustomershipping($id){
        $customer = CustomerAddress::where('id',$id)->with('countries','states','cities')->first();
        return response()->json($customer);
    }
    
   public function changepassword(Request $request,$id){
         $validator = Validator::make($request->all(), [
        // 'old_password' => 'required',
        'new_password' => 'required|confirmed|min:8',
        'new_password_confirmation' => 'required|min:8',
    ]);
    if($validator->fails()){
        return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
    }
    $customer = Customer::find($id);
    $customer->update([
        'password' => Hash::make($request->new_password)
    ]);
   return response()->json([
                        'success' => true,
                        'msgText' => 'Password Update Succesfully.',
                    ]);
        
    }

    public function cutomerOrders($id) {
        $orders = Order::where('customer_id',$id)->orderBy('id','DESC')->paginate(10);
        return view('admin.customer.order.index', compact('orders'));
    }
    
    public function updateCustomer(Request $request , $id) {
        // echo '<pre>';print_r($_POST);die;
        $requestData = $request->all();
        // return $requestData;
        
        $validator = Validator::make($requestData, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
            'status' => 'required',
        ]);
        
        if ($validator->passes()) {
            try{
                $brand = Customer::findOrFail($id);
                // $data = array(
                //     'name' => $request->name,
                //     'email' => $request->email,
                //     'mobile_number' => $request->mobile,
                //     'status' => $request->status,
                // );
                $brand->name = $request->name;
                $brand->email = $request->email;
                $brand->mobile_number = $request->mobile;
                $brand->status = $request->status;
                
                $password = trim($request->password);
                if(!empty($password)) {
                    $brand->password = Hash::make($password);
                }
                
                // $brand->update($data);
                if($brand->save()) {
                    return response()->json([
                        'success' => true,
                        'msgText' => 'Updated',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'code' => 400,
                        'msgText' => 'Updation failed!',
                    ]);
                }
                    
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
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

    public function destroy($id)
    {
        
        try {
            $brand = Customer::findorFail($id);
            if(isset($brand->image) && Storage::exists($brand->image)){
                Storage::delete($brand->image);
            }
            $brand->delete();
           
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex){
           
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
    
    public function show($id){
        die($id);
    }

}
