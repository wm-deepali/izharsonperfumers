<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AboutUs;
use App\Models\Feedback;
use App\Models\Blog;
use App\Models\GeneralSetting;
use App\Models\ContactUs;
use App\Models\Policy;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ContentController extends Controller
{

    // Show Faq In Home Page 
    public function getFaqs(){

      $faq_categories = FaqCategory::all();
         return view('frontend.faq', compact('faq_categories'));
       
    }

    // show about us 
    public function aboutUs(){
        $about_us = AboutUs::first();
         return view('frontend.about_us', compact('about_us'));
    }

// show feedback form 
  public function getFeedback(){
        
         return view('frontend.feedback');
    }
// Save feedback data 
      public function postFeedback(Request $request)
    
 {
     
        $validator = Validator::make($request->all(), [
           'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric',
            'message' => 'required',
             'email' => 'required',
              'customer_id' => 'required',
              'rating' => 'required'
             ],
             [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'mobile_number.required' => 'Please enter your phone number.',
            'message.required' => 'Please write your feedback. ',
              'email.required' => 'Please enter  your email-id. ',
               'rating.required' => 'Please choose rating between 1 to 5. ',
             ]
        );
        if ($validator->passes()) {
            try {
                $customer = Auth::guard('customer')->user();
                
                    Feedback::create([
                    'customer_id' => $customer->id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,    
                     'message' => $request->message,             
                    'rating' => $request->rating,
                  
                ]); 
               
          
              return response()->json([
                    'success' => true,
                    'withInfo' => 'Thankyou for your valuabe feedback!!',
                    
                ]);
            } catch(\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() .'-'.$ex->getLine(),
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




// show blog data
    public function getBlogData(){
    
         $blogData = Blog::where('status', 1)->orderBy('created_at','DESC')->get();
        return view('frontend.show_blog',compact('blogData'));

    }

    // get single blog details 

     public function getBlogDetails($slug){
    
         $blogDetails = Blog::where('url',$slug)->first();
         $blogs = Blog::where('status', 1)->orderBy('created_at','DESC')->get();
        return view('frontend.blog_details',compact('blogDetails','blogs'));

    }

//show contact form 
     public function getContactUsForm(){
        $siteData = GeneralSetting::all();
        return view('frontend.contact_us',compact('siteData'));

    }

// save contact us data
        public function postContactData(Request $request){
           
         $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric',
            'message' => 'required',
             'email' => 'required',
             ],
             [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'mobile_number.required' => 'Please enter your phone number.',
            'message.required' => 'Please write your message. ',
              'email.required' => 'Please enter  your email-id. ',
             ]
         );

        $contact = New ContactUs;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->mobile_number = $request->mobile_number;
        $contact->email = $request->email;     
        $contact->message = $request->message;
      
        $contact->save();
       return back()->withInfo('Thankyou ! we will get back to you soon.');            
         
    }

    public function getRefundCancellation(){

        $data = Policy::where('name','=','refund_policy')->get();
             
        return view('frontend.refund_cancellation_form',compact('data'));
    } 

    public function getPrivacyPolicy(){

      $data = Policy::where('name','=','privacy_policy')->get();
        return view('frontend.privacy_policy',compact('data'));
    } 
    

  public function getCookiePolicy(){

      $data = Policy::where('name','=','cookie_policy')->get();
        return view('frontend.cookie_policy',compact('data'));
    } 
    

     public function getTermsConditions(){

      $data = Policy::where('name','=','terms_and_condition')->get();
        return view('frontend.cookie_policy',compact('data'));
    }
    

}


