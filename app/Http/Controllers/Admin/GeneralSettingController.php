<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GeneralSetting;
use App\Models\State;
use App\Models\HeaderSetting;
use App\Models\FooterSetting;
use App\Models\SocialLinkSetting;
use App\Models\SiteGstSetting;
use App\Models\EmailSetting;
use App\Models\CompanyAddress;
use App\Models\Country;
use App\Models\RazorpayPayment;
use App\Models\BankAccount;
use App\Models\UserPasswordActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Stevebauman\Location\Facades\Location;
use  App\Rules\CheckIfFavicon;
use Maize\EmailDomainRule\EmailDomainRule;
use Maize\EmailDomainRule\Models\EmailDomain;
use Illuminate\Support\Facades\Validator;
class GeneralSettingController extends Controller {
    public function index() {
        $general_setting = GeneralSetting::first();
        $headerData = HeaderSetting::first();
        $footerData = FooterSetting::first();
        $socialData = SocialLinkSetting::first();
        $gstData = SiteGstSetting::first();
        $payment = RazorpayPayment::first();
        
        $states = State::where('country_id',101)->get();
        $cities = City::where('state_id',$general_setting->state_id ?? Null)->get();
        return view('admin.general-setting.index')->with([
            'general_setting' => $general_setting,
            'states' => $states,
            'cities' => $cities,
            'headerData' => $headerData,
            'footerData' => $footerData,
            'socialData' => $socialData,
            'gstData' => $gstData,
            'payment' => $payment,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [      
            'email'=>['required','email',new EmailDomainRule],
            'contact_number' => 'required|digits:10',
            'whatsapp_number' => 'required|digits:10',
            'map_url' => 'required|min:3|max:1000',
            'address' => 'required|min:3|max:1000',
            'heading' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|min:3|max:5000',
            // 'state' => 'required',
            // 'country' => 'nullable',
            // 'header_logo' => 'nullable|image',
            // 'footer_logo' => 'nullable|image',
            // 'footer_content' => 'required',
            // 'facebook' => 'required',
            // 'twitter' => 'required',
            // 'instagram' => 'required',
            // 'youtube' => 'required',
            // 'cgst_percentage' => 'required',
            // 'sgst_percentage' => 'required',
            // 'igst_percentage' => 'required',
        ]);
        
        if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $data = array(
                // 'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'whatsapp_number' => $request->whatsapp_number,
                'map' => $request->map,
                'address' => $request->address,
                'address_ar' => $request->address_ar,
                // 'city_id' => $request->city,
                // 'state_id' => $request->state,
                // 'country_id' => 101,
                // 'footer_content' => $request->footer_content,
                // 'facebook' => $request->facebook,
                // 'twitter' => $request->twitter,
                // 'instagram' => $request->instagram,
                // 'youtube' => $request->youtube,
                // 'cgst_percentage' => $request->cgst_percentage,
                // 'sgst_percentage' => $request->sgst_percentage,
                // 'igst_percentage' => $request->igst_percentage,
            );
            // if($request->hasFile('header_logo')) {
            //     $data['header_logo'] = $request->header_logo->store('logo');
            // }
            // if($request->hasFile('footer_logo')) {
            //     $data['footer_logo'] = $request->footer_logo->store('logo');
            // }
            GeneralSetting::updateOrCreate(['id' => 1],$data);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }

    // save general setting header data 
    public function saveHeaderSetting(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [      
           'email'=>['required','email',new EmailDomainRule],
            'tollfree_number' => 'required|digits:10',
            'whatsapp_number' => 'required|digits:10',    
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'favicon' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico',
            'coupon_code' => 'required',
        //  'meta_keyword' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_description' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_title' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'canonical_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'twitter_cards' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'og_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
             'address' => 'required|min:3|max:765|regex:/^[0-9A-Za-z.\s,-]*$/',
           
        ]);
        if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $data = $request->all();
            $data['show_in_header_tollfree_number']=$request->show_in_header_tollfree_number ? $request->show_in_header_tollfree_number:"off";
            $data['show_in_footer_tollfree_number']=$request->show_in_footer_tollfree_number ? $request->show_in_footer_tollfree_number:"off";
            $data['show_in_header_other_number']=$request->show_in_header_other_number ? $request->show_in_header_other_number:"off";
            $data['show_in_footer_other_number']=$request->show_in_footer_other_number ? $request->show_in_footer_other_number:"off";
            $data['show_in_header_coupon_code']=$request->show_in_header_coupon_code ? $request->show_in_header_coupon_code:"off";
            $data['show_in_footer_coupon_code']=$request->show_in_footer_coupon_code ? $request->show_in_footer_coupon_code:"off";
            $data['show_in_header_whatsapp_number']=$request->show_in_header_whatsapp_number ? $request->show_in_header_whatsapp_number:"off";
            $data['show_in_footer_whatsapp_number']=$request->show_in_footer_whatsapp_number ? $request->show_in_footer_whatsapp_number:"off";
            $data['show_in_header_email']=$request->show_in_header_email ? $request->show_in_header_email:"off";
            $data['show_in_footer_email']=$request->show_in_footer_email ? $request->show_in_footer_email:"off";
            // $data = array(
            //     'email' => $request->email,
            //     'mobile_number' => $request->mobile_number,
            //     'whatsapp_number' => $request->whatsapp_number,
            //     'coupon_code' => $request->coupon_code,
            // );
            if($request->hasFile('header_logo')) {
                $data['header_logo'] = $request->header_logo->store('logo');
            }
            if($request->hasFile('footer_logo')) {
                $data['footer_logo'] = $request->footer_logo->store('logo');
            }
             if($request->hasFile('favicon')) {
                $data['favicon'] = $request->favicon->store('logo');
            }
           
         $header =   HeaderSetting::updateOrCreate(['id' => 1],$data);
             $header->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }

    // save footer Data
    public function saveFooterSetting(Request $request) {
        // dd($request->all());
        $request->validate([          
            'email' => 'required|email',
            'mobile_number' => 'required',
            'whatsapp_number' => 'required',           
            'short_description' => 'required',
            'coupon_code' => 'required',
           
        ]);
        try {
            $data = array(
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'whatsapp_number' => $request->whatsapp_number,
                'coupon_code' => $request->coupon_code,
                'short_description' => $request->short_description,
                'short_desc_ar' => $request->short_desc_ar,
            );
            if($request->hasFile('footer_logo')) {
                $data['footer_logo'] = $request->footer_logo->store('logo');
            }
           
            FooterSetting::updateOrCreate(['id' => 1],$data);
            return redirect(route('admin.manage-general-setting.index'))->with('success','Update Successful');
        } catch (\Exception $ex) {
            return redirect(route('admin.manage-general-setting.index'))->with('error',$ex->getMessage());
        }
    }

    // save social links 
    public function saveSocialLinks(Request $request) {
       $validator = Validator::make($request->all(), [      
             'fb_name' => 'required|url',
             'twit_name' => 'required|url',
             'insta_name' => 'required|url',
             'linkedin_name' => 'required|url',
             'youtube_name' => 'required|url',
                
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $data = array(
                'fb_name' => $request->fb_name,
                'twit_name' => $request->twit_name,
                'insta_name' => $request->insta_name,
                'linkedin_name' => $request->linkedin_name,
                'youtube_name' => $request->youtube_name,
                'show_in_header_fb' => $request->show_in_header_fb,
                'show_in_footer_fb' => $request->show_in_footer_fb,
                  'show_in_header_insta' => $request->show_in_header_insta,
                'show_in_footer_insta' => $request->show_in_footer_insta,
                  'show_in_header_twit' => $request->show_in_header_twit,
                'show_in_footer_twit' => $request->show_in_footer_twit,
                  'show_in_header_linkedin' => $request->show_in_header_linkedin,
                'show_in_footer_linkedin' => $request->show_in_footer_linkedin,
                  'show_in_header_youtube' => $request->show_in_header_youtube,
                'show_in_footer_youtube' => $request->show_in_footer_youtube,

              
            );
          // dd($data);
           
            SocialLinkSetting::updateOrCreate(['id' => 1],$data);
             return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }  

    //save General GST Details
    public function saveGSTDetails(Request $request) {
        $validator = Validator::make($request->all(), [          
            'company_name' => 'required|min:3|max:55|regex:/^[\pL\s\-]+$/u',
            'invoice_address' => 'required|min:3|max:55|regex:/^[0-9A-Za-z.\s,-]*$/',
            'invoice_prefix' => 'required|min:3|max:55|regex:/^[\pL\s\-]+$/u',
             'pan_number' => 'required|regex:/^[[A-Z]{5}[0-9]{4}[A-Z]{1}]*$/',
            'state' => 'required',           
            'city' => 'required',
             'gst_number' => 'required|regex:/^[[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}]*$/',
            'pin_code' => 'required|digits_between:5,6',
            'country' => 'required',
            'cgst_percent' => 'required_if:status,==,enabled|digits_between:1,2',
            'sgst_percent' => 'required_if:status,==,enabled|digits_between:1,2',           
            'igst_percent' => 'required_if:status,==,enabled|digits_between:1,2',
            'vat' => 'required_if:status,==,other|digits_between:1,2',
            'invoice_number' => 'required|digits_between:4,20',    
            // 'financial_year_status' => 'required',
        ]);
        
        if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            if($request->status=="enabled"){
                $gststatus="yes";
                $vatstatus="no";
            }else{
                $gststatus="no";
                $vatstatus="yes";
            }
            
            $data = array(
                'company_name' => $request->company_name,
                'pan_number' => $request->pan_number,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'country_id' => $request->country,
                'pin_code' => $request->pin_code,
                'gst_number' => $request->gst_number,
                'invoice_prefix' => $request->invoice_prefix,
                'invoice_number' => $request->invoice_number,
                'invoice_address' => $request->invoice_address,
                'cgst_percent' => $request->cgst_percent,
                'sgst_percent' => $request->sgst_percent,
                'igst_percent' => $request->igst_percent,
                'cgst_percent_services' => $request->cgst_percent_services,
                'sgst_percent_services' => $request->sgst_percent_services,
                'igst_percent_services' => $request->igst_percent_services,
                'vat' => $request->vat,
                'vat_services' => $request->vat_services,
                'invoice_status' => $request->invoice_status,
                'invoice_number' => $request->invoice_number,
                'financial_year_status' => $request->financial_year_status,              
                'financial_serial_number' => $request->financial_serial_number,
                'gst_status' => $gststatus,
                'vat_status' => $vatstatus,
            );
            
            SiteGstSetting::updateOrCreate(['id' => 1],$data);
             return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
        }
    }

    public function accountSetting() {
        $passwords = UserPasswordActivity::where('user_id',Auth::user()->id)->get();
        $mail=EmailSetting::first();
        $settinggst=SiteGstSetting::first();
       $states = State::where('country_id',$settinggst->country_id)->get();
        $cities = City::where('state_id',$settinggst->state_id ?? Null)->get();
        $countrys = Country::all();
         $datas=CompanyAddress::all();
         $payment = RazorpayPayment::first();
         $bank = BankAccount::first();
        return view('admin.account-setting.index',compact('passwords','mail','states','settinggst','datas','cities','countrys','payment','bank'));
        
    }

    public function saveCODDetails(Request $request) {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'cod' => 'required'
        ]);
        
        if ($validator->fails()) {
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $cod = $request->cod;
            // \DB::enableQueryLog();
            // DB::table('general_settings')->where('id', '1')->update($data);
            DB::statement("update `general_settings` set `cod` = '".$cod."' where `id` = 1");
            // dd(\DB::getQueryLog());

            // GeneralSetting::updateOrCreate(['id' => 1],$data);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
        }
    }
    public function saveLangDetails(Request $request) {
        // return $request->all();
        // $request->validate([
        //     'lan_ar' => 'required'
        // ]);
        try {
            $lang = $request->lan_ar ? $request->lan_ar: 0;
            // \DB::enableQueryLog();
            // DB::table('general_settings')->where('id', '1')->update($data);
            DB::statement("update `general_settings` set `lan_ar` = '".$lang."' where `id` = 1");
            // dd(\DB::getQueryLog());

            // GeneralSetting::updateOrCreate(['id' => 1],$data);
            return redirect(route('admin.manage-general-setting.index'))->with('success','Update Successful');
        } catch (\Exception $ex) {
            return redirect(route('admin.manage-general-setting.index'))->with('error',$ex->getMessage());
        }
    }
    
     public function updatePasswordnew(Request $request)
    {
          
         $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ]);
        if ($validator->fails()) {
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
      
            try {
                $customer = Auth::user();
               
                $customer->update([
                    'password' => Hash::make($request->new_password),
                ]);
                $ip = $request->ip();
                $currentUserInfo = Location::get($ip);
                $countryname=  $currentUserInfo->countryName;
             $cityname= $currentUserInfo->cityName;
            $update=  UserPasswordActivity::create([
                  'user_id'=>$customer->id,
                  'ip_address'=>$ip,
                  'password_update_type'=>'Update by Password',
                  'location'=>$countryname." / ".$cityname,
                  ]);
                  if($update){
                      echo "<script>alert('Password Changed Successfully')</script>";
                  }
                   Auth::logout();
                   return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
            } catch(\Exception $ex) {
                 return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
                ]);
            }
       
    }
public function logout(Request $request){
   Auth::logout();
   return redirect('/login');
}

public function updateadminprofile(Request $request){
    $validator = Validator::make($request->all(), [
        'name'=>'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
        'email'=>['required','email',new EmailDomainRule],
        'phone_number'=>'required|digits:10',
        'alert_email'=>['required','email',new EmailDomainRule],
        'image'=>'nullable|max:2048|mimes:png,jpeg,svg,gif',
        'image_login_page'=>'nullable|max:2048|mimes:png,jpeg,svg,gif',
        'image_header'=>'nullable|max:2048|mimes:png,jpeg,svg,gif',
        
        ]);
        
        if ($validator->fails()) {
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        $data=$request->all();
        if($request->hasFile('image')){
             $data['image']=$request->image->store('images');
        }
        if($request->hasFile('image_login_page')){
            $data['image_login_page']=$request->image_login_page->store('images');
        }
        if($request->hasFile('image_header')){
            $data['image_header']=$request->image_header->store('images');
        }
       
        
        $data['name']=$request->name;
        Auth::user()->update($data);
        return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
}

public function saverazorpay(Request $request)
    {
        $validator = Validator::make($request->all(), [      
            'key'=>'required',
            'secret' => 'required'
        ]);
        
        if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $data = array(
                'key' => $request->key,
                'secret' => $request->secret,
            );
            RazorpayPayment::updateOrCreate(['id' => 1],$data);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }
    public function updatebank(Request $request)
    {
        $validator = Validator::make($request->all(), [      
            'ac_name'=>'required',
            'ac_number' => 'required',
            'bank_name' => 'required',
            'ifsc_code' => 'required',
            'bank_branch' => 'required',
            'payment_image' => 'nullable|image|mimes:png,jpeg,svg,gif|max:2048',
        ]);
        
        if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $data = $request->all();
            if($request->hasFile('payment_image')){
                $data['payment_image'] = $request->payment_image->store('paymentimage');
            }
            BankAccount::updateOrCreate(['id' => 1],$data);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch (\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }
public function updateemailsetting(Request $request){
   $validator = Validator::make($request->all(), [
        'mailer'=>'required',
        'host'=>'required',
        'port'=>'required',
        'username'=>'required',
        'password'=>'required',
        'mail_from'=>'required',
        'encryption'=>'required',
        'name'=>'required',
        
        ]);
        if ($validator->fails()) {
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        $mail=EmailSetting::first();
          $data=$request->all();  
          $mail->update($data);
      
     return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
}



}