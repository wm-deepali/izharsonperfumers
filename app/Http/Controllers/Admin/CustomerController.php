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
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Storage;
use Maize\EmailDomainRule\EmailDomainRule;
class CustomerController extends Controller
{
    /**
     * Same as the front-facing DashboardController::optimizeAvatarAndStore —
     * customer avatar, single square-cropped webp, no thumb needed.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @return string  stored relative path
     */
    private function optimizeAvatarAndStore($file, string $folder, int $size = 400): string
    {
        $uuid = Str::uuid();
        $folder = trim($folder, '/');

        $image = Image::make($file->getRealPath());
        $image->orientate();
        $image->fit($size, $size); // crop-to-square around the center

        $path = $folder . '/' . $uuid . '.webp';
        Storage::disk('public')->put($path, (string) $image->encode('webp', 85));

        return $path;
    }

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
        // dimensions rule removed — image is now resized + center-cropped to
        // a square server-side, so the customer can upload any photo shape
        // instead of being forced to pre-crop to exactly 500x500.
        'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
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
                    if($customer->image && Storage::disk('public')->exists($customer->image)) {
                        Storage::disk('public')->delete($customer->image);
                    }
                    $data['image'] = $this->optimizeAvatarAndStore($request->file('image'), 'profile');
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
            if(isset($brand->image) && Storage::disk('public')->exists($brand->image)){
                Storage::disk('public')->delete($brand->image);
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