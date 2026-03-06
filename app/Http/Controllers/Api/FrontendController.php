<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\BookAppointment;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Team;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\OTP;
use App\Models\Subscriber;
use App\Models\GeneralSetting;
use App\Models\ServiceCategory;
use App\Models\SocialLinkSetting;
use App\Models\HeaderSetting;
use App\Models\FooterSetting;
use App\Models\FleetService;
use App\Models\Services;
use App\Models\Page;
use App\Models\Product;
use App\Models\Category;
use App\Models\Garage;
use App\Models\Career;
use App\Models\ServiceOption;
use App\Models\Coupon;
use App\Models\ContactUs;
use App\Models\Packages;
use App\Models\PackageOption;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BrandModel;
use App\Models\ProductOption;
use App\Models\ShippingCost;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerBillingAddress;
use App\Models\CartDetail;
use App\Models\Cart;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use App\Models\CartService;
use App\Models\CartServiceDetail;
use App\Models\UnAuthCartServiceDetail;
use App\Models\UnAuthCartService;
use App\Models\UnAuthCartDetail;
use App\Models\UnAuthCart;
use App\Models\CarOrigin;
use App\Models\Cylinder;
use App\Models\OilGrade;
use App\Models\GarageFranchise;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\SiteGstSetting;
use App\Models\Pincode;
use App\Models\FreeShiping;
use App\Models\OrderProductReview;
use App\Models\OrderDetailService;
use App\Models\OrderService;
use App\Models\OilgradeOrderServiceDetail;
use App\Models\OilgradeOrderService;
use App\Models\Promotion;
use App\Models\OrderStatus;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use Storage;
use Mail;
use App\Mail\OrderMail;
use App\Mail\SignUpMail;
use App\Mail\AdminOrderMail;
use Maize\EmailDomainRule\EmailDomainRule;
class FrontendController extends Controller
{


    // Content Management - start
    // for all type policies
    public function policies($name)
    {
        $policy = Policy::where('name', $name)->first(['id', 'name', 'title', 'content']);
        return response()->json([
            'status' => true,
            'data' => $policy,
            'message' => "Get successfully!"
        ], 200);
    }


    //  sliders
    public function sliders()
    {
        $sliders = Slider::latest()->where('status', 'active')->get(['id', 'button_link', 'title', 'sub_title', 'content', 'image', 'color']);
        return response()->json([
            'status' => true,
            'data' => $sliders,
            'message' => "Get successfully!"
        ], 200);
    }


    //  about us
    public function about_us()
    {
        $about_us = AboutUs::first();
        $about_us->makeHidden('created_at', 'updated_at');
        return response()->json([
            'status' => true,
            'data' => $about_us,
            'message' => "Get successfully!"
        ], 200);
    }

    //  blogs list
    public function blogs()
    {
        $blogs = Blog::latest()->where('status', 'active')->get(['title', 'url', 'image', 'content', 'author', 'created_at']);
        return response()->json([
            'status' => true,
            'data' => $blogs,
            'message' => "Get successfully!"
        ], 200);
    }
    public function recentblogs()
    {
        $blogs = Blog::latest()->limit(10)->where('status', 'active')->get(['title', 'url', 'image', 'content', 'author', 'created_at']);
        return response()->json([
            'status' => true,
            'data' => $blogs,
            'message' => "Get successfully!"
        ], 200);
    }

    //  blogs detail
    public function blogdetail($slug)
    {
        $blogs = Blog::where('url', $slug)->first(['title', 'url', 'image', 'content', 'author']);
        return response()->json([
            'status' => true,
            'data' => $blogs,
            'message' => "Get successfully!"
        ], 200);
    }
    //  faq list
    public function faqs()
    {
        $faqs = Faq::latest()->get(['id', 'question', 'answer']);
        return response()->json([
            'status' => true,
            'data' => $faqs,
            'message' => "Get successfully!"
        ], 200);
    }

    //  General data of site
    public function sitesettings()
    {
        $objs = GeneralSetting::first(['id', 'name', 'email', 'mobile_number', 'whatsapp_number', 'map', 'address', 'address_ar', 'city_id', 'state_id', 'country_id', 'cod', 'lan_ar']);
        return response()->json([
            'status' => true,
            'data' => $objs,
            'message' => "Get successfully!"
        ], 200);
    }

    // Content Management - end

    //social setting start

    public function social_sett()
    {
        $objs = SocialLinkSetting::first(['id', 'fb_name', 'twit_name', 'insta_name', 'linkedin_name', 'youtube_name', 'show_in_header_fb', 'show_in_footer_fb', 'show_in_header_twit', 'show_in_footer_twit', 'show_in_header_insta', 'show_in_footer_insta', 'show_in_header_linkedin', 'show_in_footer_linkedin', 'show_in_header_youtube', 'show_in_footer_youtube']);
        return response()->json([
            'status' => true,
            'data' => $objs,
            'message' => "Get successfully!"
        ], 200);
    }

    //socaial setting end

    //header setting start

    public function header_sett()
    {
        $objs = HeaderSetting::first();

        $objs['imag_base_url'] = url('storage') . '/';
        return response()->json([
            'status' => true,
            'data' => $objs,
            'message' => "Get successfully!"
        ], 200);
    }

    //header setting end

    //footer setting start
    public function footer_sett()
    {
        $objs = FooterSetting::first();
        $objs['imag_base_url'] = url('storage') . '/';
        $objs->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $objs,
            'message' => "Get successfully!"
        ], 200);
    }


    //footer setting end

    //subscribers start

    public function subscribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|unique:subscribers,email'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'message' => $validator->errors()
            ], 422);
        }
        $objs = Subscriber::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "You successfully Subscribed! "
        ], 200);
    }

    //subscribers end
    // service Management - start

    // service categories
    public function service_management_category()
    {
        $obj = ServiceCategory::where('status', 'active')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }


    // services
    public function service_management_services(Request $request)
    {
        if ($request->cat_id == null) {
            return response()->json([
                'status' => true,
                'data' => [],
                'message' => "Category id needed !"
            ], 200);
        } else {
            $obj = Services::where('status', 'active')->where('service_category_id', $request->cat_id)->get();
            $obj->makeHidden(['created_at', 'updated_at', 'meta_title', 'meta_description', 'meta_keywords', 'canonical_tags', 'twitter_cards', 'og_tags']);

            return response()->json([
                'status' => true,
                'data' => $obj,
                'message' => "Get successfully!"
            ], 200);
        }

    }



    // service Management - end

    //fleet service start

    public function fleet_service()
    {
        $obj = FleetService::first();
        $obj->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    //fleet service end
//contact us start

    public function contact_us(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'required|min:3|max:255',
            'mobile_number' => 'required|min:3|max:255',
            // 'subject'=>'required|min:3|max:255',
            'message' => 'required|min:3|max:255',
        ]);
        $data = $request->all();
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $obj = ContactUs::create($data);
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Thank You for Contact Us"
            ], 200);
        }

    }

    //contact-us end
    public function feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'first_name' => 'required|min:3|max:55|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|min:3|max:55|regex:/^[\pL\s\-]+$/u',
            'email' => ['required', 'email', new EmailDomainRule],
            'mobile_number' => 'required|digits:10',
            'rating' => 'required|integer|between:1,5',
            'message' => 'required|min:3|max:155',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data = $request->all();
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            if ($request->hasFile('image')) {
                $data['image'] = $request->image->store('feedback');
            }

            $data['status'] = 'block';
            $obj = Feedback::create($data);
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Thank You for Feedback"
            ], 200);
        }

    }
    //pages start

    public function pages($id)
    {
        $page = Page::where('url', $id)->where('status', 'active')->first();
        $page->makeHidden(['created_at', 'status', 'updated_at']);
        $page['image_base_url'] = url('storage') . '/';
        if ($page) {
            return response()->json([
                'status' => true,
                'data' => $page,
                'message' => "Get successfully!"
            ], 200);

        } else {
            return response()->json([
                'status' => false,
                'status_code' => 404,
                'data' => '',
                'message' => "Not Found"
            ], 200);

        }

    }


    //pages end

    //country start

    public function country()
    {
        $obj = Country::all();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    //country end

    //state start
    public function state($id)
    {
        $obj = State::where('country_id', $id)->get();
        $obj->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    //state end

    //city start
    public function city($id)
    {
        $obj = City::where('state_id', $id)->get();
        $obj->makeHidden(['created_at', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }


    //city end

    //latest blog start

    public function latestblog()
    {
        $blogs = Blog::latest()->limit(3)->get();
        return response()->json([
            'status' => true,
            'data' => $blogs,
            'message' => "Get successfully!"
        ], 200);
    }

    //latest blog end
//manage brand

    public function managebrands()
    {
        $obj = Brand::with('products')->with('brandmodels')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    //manage brand 
//book appointment start


    public function bookappointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'carmake' => 'required',
            'carmodel' => 'required',
            'fuel_type' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email',
            'description' => 'required',
        ]);
        $data = $request->all();
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $obj = BookAppointment::create($data);
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'message' => "Thank You Your Appointment Booking Done."
            ], 200);
        }

    }
    //book appointment end

    //manage team start

    public function manageteams()
    {
        $obj = Feedback::where('status', 'active')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    //manage team end

    //manage garage start

    public function managegarage()
    {
        $obj = Garage::where('status', 'active')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }



    //manage garage end

    //manage career start

    public function managecareer()
    {
        $obj = Career::where('status', 'active')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    //manage career end
// manage product start

    public function manageproduct(Request $request, $id = '')
    {
        $limit = $request->query('limit');
        $page = $request->query('page');
        $carmake = $request->query('carmake');
        $carmodel = $request->query('carmodel');
        $search = $request->query('search');
        if ($id) {
            $obj = Product::where('slug', $id)->with('product_options')->with('product_option_images', 'product_options.product_variant_images')->where('status', 'active')->with('product_review')->with('categories')->withMeta(['id', 'key', 'value'])->first();
            foreach ($obj['product_review'] as $objs) {

                $customer = Customer::where('id', $objs->customer_id)->first();
                $objs->customer_name = $customer->name;
                $objs->address = $objs->order->shippingaddress->cities->name;
                //  $objs['customer_name']=$customer->name;
            }
            if (isset($obj->fragrance)) {
                $new = [];
                $newid = [];
                foreach (json_decode($obj->fragrance) as $fragrance) {
                    $brand = OilGrade::where('id', $fragrance)->first();
                    $new[] = $brand;
                }
                $obj['fragrance'] = $new;
            }

        } elseif ($search) {
            $obj = Product::where('name', "LIKE", '%' . $search . '%')->with('product_option_images')->where('status', 'active')->with('brand')->with('categories')->latest()->get();
        } else {
            if ($carmake) {
                $obj = Product::limit($limit)->where('status', 'active')->whereHas('product_options', function ($opt) use ($carmake, $carmodel) {
                    $opt->where('brand_id', $carmake);
                    if ($carmodel) {
                        $opt->where('brandmodel_id', $carmodel);
                    }
                })->with('product_options')->latest()->get();
            } elseif ($limit) {
                $obj = Product::limit($limit)->with('product_options')->where('status', 'active')->offset($limit * $page)->latest()->get();
            } else {
                $obj = Product::limit($limit)->with('product_options')->where('status', 'active')->latest()->get();
            }


        }

        foreach ($obj as $key => $data) {
            if (isset($data->fragrance)) {
                $new = [];
                foreach (json_decode($data->fragrance) as $fragrance) {

                    $brand = OilGrade::where('id', $fragrance)->first();
                    $new[] = $brand->title;
                }
                $obj[$key]['fragrance'] = json_encode($new);
            }
        }



        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);

    }
    // manage product end

    //manage product category start

    public function productcategories()
    {
        $obj = Category::where('parent_id', null)->with('direct_childs')->where('status', 'active')->get();
        foreach ($obj as $category) {
            foreach ($category->direct_childs as $child) {
                $child->parent_slug = $category->slug; // Assign the parent slug to the child
            }
        }
        // $obj['image_base_url']=url('storage').'/';

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function productcategoriesforproductpage()
    {
        $obj = Category::where('parent_id', null)->with('direct_childs')->whereHas('productsn')->get();
        // $obj['image_base_url']=url('storage').'/';

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    //manage product category end

    //top rated product start

    public function premiumproduct($id = 0)
    {
        if ($id > 0) {
            $obj = Product::with('product_options')->where('category_id', $id)->where('status', 'active')->where('is_premium', 'yes')->get();

        } else {
            $obj = Product::with('product_options')->where('is_premium', 'yes')->where('status', 'active')->get();

        }
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    //top rated product end

    public function bestdealproduct($id = 0)
    {
        if ($id > 0) {
            $obj = Product::with('product_options')->where('category_id', $id)->where('status', 'active')->where('is_bestSales', 'yes')->get();

        } else {
            $obj = Product::with('product_options')->where('is_bestSales', 'yes')->where('status', 'active')->get();

        }
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    //login

    public function topsellingproduct($id = 0)
    {
        if ($id > 0) {
            $obj = Product::with('product_options')->where('status', 'active')->where('category_id', $id)->where('is_top', 'yes')->get();

        } else {
            $obj = Product::with('product_options')->where('status', 'active')->where('is_top', 'yes')->get();

        }
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function maxdiscountproduct()
    {
        $obj = Product::with('product_options')->orderByDesc('max_discount_percentage')->where('max_discount_percentage', '>', 0)->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function newarrivalproduct($id = 0)
    {
        if ($id > 0) {
            $obj = Product::with('product_options')->where('status', 'active')->where('category_id', $id)->where('new_arrivals', 'yes')->get();

        } else {
            $obj = Product::with('product_options')->where('status', 'active')->where('new_arrivals', 'yes')->get();

        }
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:customers', new EmailDomainRule, 'regex:/^[0-9A-Za-z,.,@]*$/'],
            'password' => 'required',
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = Customer::where('email', $request->email)->first();
        if ($user->is_email_verified != '1') {
            return response()->json([
                'status' => false,
                'flag' => 0,
                'message' => 'Register email address is not verified',
            ], 401);
        }
        //User check
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $token = Auth::guard('customer')->user()->createToken($request->email)->accessToken;
            $user = Auth::guard('customer')->user();
            $name = $user->name;

            $cart = Cart::updateOrCreate(['customer_id' => $user->id]);
            $unauthenticated_cart = UnAuthCart::updateOrCreate(['device_id' => $request->device_id]);
            $unauthenticated_cart_detail = UnAuthCartDetail::where('device_id', $request->device_id)->get();
            if ($unauthenticated_cart_detail) {
                foreach ($unauthenticated_cart_detail as $unauthenticated_cart_detail) {
                    $cartdet = CartDetail::where('customer_id', $user->id)->where('cart_id', $cart->id)->where('product_id', $unauthenticated_cart_detail->product_id)->where('product_option_id', $unauthenticated_cart_detail->product_option_id)->first();
                    if (isset($cartdet)) {
                        $cartdet->update([
                            'customer_id' => $user->id,
                            'cart_id' => $cart->id,
                            'product_id' => $unauthenticated_cart_detail->product_id,
                            'product_option_id' => $unauthenticated_cart_detail->product_option_id,
                            'quantity' => $unauthenticated_cart_detail->quantity,
                        ]);
                    } else {
                        CartDetail::create([
                            'customer_id' => $user->id,
                            'cart_id' => $cart->id,
                            'product_id' => $unauthenticated_cart_detail->product_id,
                            'product_option_id' => $unauthenticated_cart_detail->product_option_id,
                            'quantity' => $unauthenticated_cart_detail->quantity,
                        ]);
                        $productoption = ProductOption::where('id', $unauthenticated_cart_detail->product_option_id)->where('product_id', $unauthenticated_cart_detail->product_id)->first();
                        $cart->update([
                            'total_price' => $cart->total_price + ($productoption->price * $unauthenticated_cart_detail->quantity),
                            'pre_discount' => $cart->pre_discount + ($productoption->discount_amount * $unauthenticated_cart_detail->quantity),
                            'total_price_after_discount' => $cart->total_price + ($productoption->price * $unauthenticated_cart_detail->quantity) - $cart->discount_amount
                        ]);
                    }

                }


            }



            // $cartservice = CartService::updateOrCreate(['customer_id' => $user->id]);
            // $unauthenticated_cartservice = UnAuthCartService::updateOrCreate(['device_id'=>$request->device_id]);
            // $cart_itemservices = UnAuthCartServiceDetail::where('device_id',$request->device_id)->get();
            // if($cart_itemservices){
            //     foreach($cart_itemservices as $cart_itemservice){
            //     CartServiceDetail::create([
            //         'customer_id'=>$user->id,
            //         'service_id'=>$cart_itemservice->service_id,
            //         'service_option_id'=>$cart_itemservice->service_option_id,
            //         'cart_id'=>$cartservice->id,
            //         'quantity'=>1,
            // ]);

            // }
            //  $cartservice->update([
            //      'total_price'=>$cartservice->total_price+$unauthenticated_cartservice->total_price
            //      ]);
            // }
            // UnAuthCartService::where('device_id',$request->device_id)->delete();
            // UnAuthCartServiceDetail::where('device_id',$request->device_id)->delete();
            UnAuthCart::where('device_id', $request->device_id)->delete();
            UnAuthCartDetail::where('device_id', $request->device_id)->delete();


            return response()->json([
                'status' => 'success',
                'message' => "Thank you $name You succesfully Logged In",
                'token' => $token,
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials',

            ]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric|min:10',
            'address' => 'required|min:10|max:255',
            'email' => ['required', 'email', 'unique:customers', new EmailDomainRule, 'regex:/^[0-9A-Za-z,.,-,@]*$/'],
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'mobile_code' => 'required',
            'url' => 'required|url',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'device_id' => 'required',
            'password_confirmation' => 'min:8'

        ], [
            'password.password_confirmation' => 'Enter same conform password ',
            'mobile_number.required' => 'The contact number field is required.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $data['name'] = $data['first_name'] . " " . $data['last_name'];
            $data['address_line_1'] = $data['address'];
            $data['shipping_address'] = $data['address'];
            $data['billing_address'] = $data['address'];
            $data['registration_date'] = date('Y-m-d H:i:s');
            // $data['dob'] = date('Y-m-d',strtotime($request->dob));
            $user = Customer::create($data);

            $cart = Cart::updateOrCreate(['customer_id' => $user->id]);
            $unauthenticated_cart = UnAuthCart::updateOrCreate(['device_id' => $request->device_id]);
            $unauthenticated_cart_detail = UnAuthCartDetail::where('device_id', $request->device_id)->get();
            if ($unauthenticated_cart_detail) {
                foreach ($unauthenticated_cart_detail as $unauthenticated_cart_detail) {
                    $cartdet = CartDetail::where('customer_id', $user->id)->where('cart_id', $cart->id)->where('product_id', $unauthenticated_cart_detail->product_id)->where('product_option_id', $unauthenticated_cart_detail->product_option_id)->first();
                    if (isset($cartdet)) {
                        $cartdet->update([
                            'customer_id' => $user->id,
                            'cart_id' => $cart->id,
                            'product_id' => $unauthenticated_cart_detail->product_id,
                            'product_option_id' => $unauthenticated_cart_detail->product_option_id,
                            'quantity' => $unauthenticated_cart_detail->quantity,
                        ]);
                    } else {
                        CartDetail::create([
                            'customer_id' => $user->id,
                            'cart_id' => $cart->id,
                            'product_id' => $unauthenticated_cart_detail->product_id,
                            'product_option_id' => $unauthenticated_cart_detail->product_option_id,
                            'quantity' => $unauthenticated_cart_detail->quantity,
                        ]);
                        $productoption = ProductOption::where('id', $unauthenticated_cart_detail->product_option_id)->where('product_id', $unauthenticated_cart_detail->product_id)->first();
                        $cart->update([
                            'total_price' => $cart->total_price + ($productoption->price * $unauthenticated_cart_detail->quantity),
                            'pre_discount' => $cart->pre_discount + ($productoption->discount_amount * $unauthenticated_cart_detail->quantity),
                            'total_price_after_discount' => $cart->total_price + ($productoption->price * $unauthenticated_cart_detail->quantity) - $cart->discount_amount
                        ]);
                    }

                }


            }

            // $cartservice = CartService::updateOrCreate(['customer_id' => $user->id]);
            // $unauthenticated_cartservice = UnAuthCartService::updateOrCreate(['device_id'=>$request->device_id]);
            // $cart_itemservices = UnAuthCartServiceDetail::where('device_id',$request->device_id)->get();
            // if($cart_itemservices){
            //     foreach($cart_itemservices as $cart_itemservice){
            //     CartServiceDetail::create([
            //         'customer_id'=>$user->id,
            //         'service_id'=>$cart_itemservice->service_id,
            //         'service_option_id'=>$cart_itemservice->service_option_id,
            //         'cart_id'=>$cartservice->id,
            //         'quantity'=>1,
            // ]);

            // }
            //  $cartservice->update([
            //      'total_price'=>$cartservice->total_price+$unauthenticated_cartservice->total_price
            //      ]);
            // }
            // UnAuthCartService::where('device_id',$request->device_id)->delete();
            // UnAuthCartServiceDetail::where('device_id',$request->device_id)->delete();
            UnAuthCart::where('device_id', $request->device_id)->delete();
            UnAuthCartDetail::where('device_id', $request->device_id)->delete();
            // $token = $user->createToken($request->email)->accessToken;
            // $success['token'] = $token;
            // $success['name'] =  $user->name;
            $admin = User::first();
            $token = Str::random(64);
            // $success['token'] = $token;
            // $success['name'] =  $user->name;
            try {
                Mail::to([$user->email, $admin->alert_email])->send(new SignUpMail($request->url . $token));
            } catch (\Exception $e) {

            }

            $user = Customer::find($user->id);
            $user->update(['token' => $token]);
            $name = $user->name;
            return response()->json([
                'status' => 'success',
                'message' => "Verify link send successfully on your email.",
                'token' => $token,
                'data' => $user
            ]);

        }
    }

    function EmailVerification(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'token' => 'required|exists:customers,token',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 422);
        }

        $user = Customer::where('token', $request->token)->first();
        if (empty($user)) {
            return response()->json([
                'status' => false,
                'message' => "Invalid token!",
            ], 401);
        } else {
            if ($user->is_email_verified == 1) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email is Already Verified.',
                ], 401);
            } else {
                $admin = User::first();
                Mail::send('email.welcomeemail', [], function ($message) use ($user, $admin) {
                    $message->to($user->email);
                    $message->to($admin->alert_email);
                    $message->subject('Welcome Email');
                });

                Customer::where(['token' => $user->token])->first()->update(['is_email_verified' => '1']);
                return response()->json([
                    'status' => true,
                    'message' => "Your account has been Verified successfully.",
                ], 200);
            }


        }
    }

    /*************************** Send Email Verifcation Link********************/
    function sendEmailVerificationLink(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|exists:customers',
                'url' => 'required|url',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 422);
        }

        $user = Customer::where('email', $request->email)->first();
        if ($user->is_email_verified == 1) {
            return response()->json([
                'status' => false,
                'message' => 'Email is Already Verified.',
            ], 401);
        } else {

            $token = Str::random(64);
            Customer::where('email', $request->email)->update([
                'token' => $token,
                // 'token_created_at' => date('Y-m-d H:i:s')
            ]);
            $usertoken = Customer::where('email', $request->email)->first();
            $admin = User::first();
            Mail::to([$usertoken->email, $admin->alert_email])->send(new SignUpMail($request->url . $usertoken->token));//Send email
            return response()->json([
                'status' => true,
                'message' => "Verify link send successfully on your email.",
                'token' => $usertoken->token
            ], 200);
        }
    }
    public function applycoupon(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            try {
                $user = Auth::guard('api')->user();
                // $user = Customer::where('id',$user1->id)->first();
                $cart = Cart::where('customer_id', $user->id)->firstOrFail();
                $cart_details = CartDetail::where('cart_id', $cart->id)->get();

                $cart_details = CartDetail::where('cart_id', $cart->id)->get();
                $cart_product_ids = $cart_details->pluck('product_id')->toArray();
                $cart_categories = Product::whereIn('id', $cart_product_ids)
                    ->select('category_id', 'subcategory_id')
                    ->get();

                $cart_category_ids = [];
                foreach ($cart_categories as $product) {
                    if ($product->category_id)
                        $cart_category_ids[] = $product->category_id;
                    if ($product->subcategory_id)
                        $cart_category_ids[] = $product->subcategory_id;
                }

                $cart_category_ids = array_values(array_unique($cart_category_ids));
                $coupon = Coupon::where('coupon_code', $request->coupon_code)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->where('status', 'active')
                    ->where(function ($query) use ($cart_product_ids, $cart_category_ids) {
                        foreach ($cart_category_ids as $catid) {
                            $query->orWhereRaw("find_in_set(?, categories)", [$catid]);
                        }
                        foreach ($cart_product_ids as $pid) {
                            $query->orWhereRaw("find_in_set(?, products)", [$pid]);
                        }
                    })
                    ->first();

                if ($coupon) {
                    if ($user->orders->count() < $coupon->number_of_use) {
                        if ($coupon->min_order <= $cart->total_price) {
                            $prediscount = $cart->pre_discount ?? 0;

                            $amountafterPrediscount = $cart->total_price - $prediscount;

                            if ($coupon->discount_type == 'amount') {
                                $discount = $coupon->discount_amount;
                            } else {

                                $discount = ($amountafterPrediscount * $coupon->discount_amount) / 100;
                            }
                            $cart->update([
                                'coupon_id' => $coupon->id,
                                'discount_amount' => $discount,
                                'total_price_after_discount' => $amountafterPrediscount - $discount,
                            ]);

                            return response()->json([
                                'success' => true,
                                'data' => [
                                    'cart' => $cart,
                                ],
                            ], 200);
                        } else {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'coupon_code' => [
                                        'Coupon not applicable on total',
                                    ],
                                ],
                            ], 422);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'errors' => [
                                'coupon_code' => [
                                    'This coupon is already availed with the maximum no of limits',
                                ],
                            ],
                        ], 422);
                    }

                } else {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'coupon_code' => [
                                'Invalid Coupon',
                            ],
                        ],
                    ], 422);
                }
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
                ], 400);
            }
        }
    }
    public function pricerange()
    {
        $obj = Product::max('min_price');
        $obj1 = Product::min('min_price');
        $obj4 = Product::max('rating');
        $obj3 = ProductOption::max('discount_percentage');
        return response()->json([
            'status' => true,
            'data' => ['min_price' => $obj1, 'max_price' => (int) $obj, 'discount_percentage' => $obj3, 'rating' => $obj4],
            'message' => "Get successfully!"
        ], 200);
    }

    public function filterproductwithprice(Request $request)
    {
        $obj = Product::where('min_price', '>=', $request->price)->where('status', 'active')->orderBy('min_price', 'ASC')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function filterproductwithbrand(Request $request)
    {
        $brandid = $request->brand_id;
        $obj = ProductOption::orwhereJsonContains('brandmodel_id', [$brandid])->where('product_id', $request->product_id)->first();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function filterproduct(Request $request)
    {
        $query = Product::with(['product_options', 'product_option_images'])
            ->where('status', 'active');

        // Apply filters based on request data
        if ($request->subcategory_id) {
            $query->whereIn('subcategory_id', (array) $request->subcategory_id);
        }

        if ($request->category_id) {
            $query->whereIn('category_id', (array) $request->category_id);
        }

        if ($request->min_price) {
            $query->whereHas('product_options', function ($opt) use ($request) {
                $opt->whereBetween('price', [$request->min_price, $request->max_price]);
            });
        }

        // Paginate the results
        $objs = $query->paginate(15);

        // Filter products with options
        $data = $objs->filter(function ($obj) {
            return $obj->product_options->isNotEmpty();
        });

        // Remove 'data' key from pagination array
        $paginationdata = $objs->toArray();
        unset($paginationdata['data']);

        // Return the response
        return response()->json([
            'status' => true,
            'data' => $data->values(), // Re-index the array keys
            'paginationdata' => $paginationdata,
            'message' => "Get successfully!"
        ], 200);
    }

    public function filterproductbck(Request $request)
    {
        $brandmodel = $request->brandmodel_id;
        $price = $request->min_price;
        $maxprice = $request->max_price;
        $category = $request->subcategory_id;
        $brandid = $request->carmake_id;
        $modelid = $request->carmodel_id;
        $objs = [];
        $no = 15;
        if ($request->subcategory_id) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('subcategory_id', $request->subcategory_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid) {
                    //   $opt->where('mrp','>=',$price)->get();
                }
            ])->paginate($no);
        } else if ($request->category_id) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('category_id', $request->category_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid) {
                    //   $opt->where('mrp','>=',$price)->get();
                }
            ])->paginate($no);
        } else if ($request->min_price) {
            $objs = Product::with('product_options')->where('status', 'active')->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid, $maxprice) {
                    $opt->where('price', '>=', $price)->where('price', '<=', $maxprice)->get();
                }
            ])->paginate($no);
        } else if ($request->subcategory_id && $request->category_id) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('subcategory_id', $request->subcategory_id)->whereIn('category_id', $request->category_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid, $maxprice) {
                    //   $opt->where('mrp','>=',$price)->get();
                }
            ])->paginate($no);
        } else if ($request->subcategory_id && $request->min_price) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('subcategory_id', $request->subcategory_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid, $maxprice) {
                    $opt->where('price', '>=', $price)->where('price', '<=', $maxprice)->get();
                }
            ])->paginate($no);
        } else if ($request->min_price && $request->category_id) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('category_id', $request->category_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid, $maxprice) {
                    $opt->where('price', '>=', $price)->where('price', '<=', $maxprice)->get();
                }
            ])->paginate($no);
        } else if ($request->subcategory_id && $request->category_id && $request->min_price) {
            $objs = Product::with('product_options')->where('status', 'active')->whereIn('subcategory_id', $request->subcategory_id)->whereIn('category_id', $request->category_id)->with('product_option_images')->with([
                'product_options' => function ($opt) use ($brandmodel, $price, $category, $brandid, $maxprice) {
                    $opt->where('price', '>=', $price)->where('price', '<=', $maxprice)->get();
                }
            ])->paginate($no);
            ;
        } else {
            $objs = Product::with('product_options')->where('status', 'active')->paginate($no);
        }

        $data = [];
        if (count($objs) > 0 && isset($objs)) {
            foreach ($objs as $key => $obj) {
                if (isset($obj->product_options) && count($obj->product_options) > 0) {
                    $data[] = $obj;

                } else {

                }

            }
        }
        $objsArray = $objs->toArray();
        unset($objsArray['data']);
        $paginationdata = $objsArray;
        return response()->json([
            'status' => true,
            'data' => $data,
            'paginationdata' => $paginationdata,
            'message' => "Get successfully!"
        ], 200);
    }

    public function filterproductwithcategory($id)
    {
        $obj = Category::where('id', $id)->with('products')->first();
        return response()->json([
            'status' => true,
            'data' => $obj['products'],
            'message' => "Get successfully!"
        ], 200);
    }

    public function carmodel($id)
    {
        $obj = BrandModel::where('brand_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function carmake()
    {
        $obj = Brand::orderByRaw('CONVERT(quantity, SIGNED) asc')->wherehas('products')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function carmodelprice(Request $request)
    {
        $obj = ProductOption::where('product_id', $request->product_id)->where('brandmodel_id', [$request->brandmodel_id])->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function manageshipping()
    {

        $obj = ShippingCost::all();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function getcustomeraddress()
    {
        $user = Auth::guard('api')->user();
        $obj = [];
        $obj['shipping'] = CustomerAddress::where('customer_id', $user->id)->orderBy('id', 'Desc')->with(['country', 'state', 'city'])->get();
        $obj['billing'] = CustomerBillingAddress::where('customer_id', $user->id)->orderBy('id', 'Desc')->with(['country', 'state', 'city'])->get();

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function getcustomerbillingaddress($id)
    {
        $user = Auth::guard('api')->user();
        $obj = CustomerBillingAddress::where('customer_id', $user->id)->where('id', $id)->with(['country', 'state', 'city'])->first();

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function getcustomershippingaddress($id)
    {
        $user = Auth::guard('api')->user();
        $obj = CustomerAddress::where('customer_id', $user->id)->where('id', $id)->with(['country', 'state', 'city'])->first();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function addcustomeraddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name_ship' => 'required',
            'last_name_ship' => 'required',
            'mobile_number_ship' => 'required|numeric|min:10',
            'address_ship' => 'required|min:10|max:255',
            'address_type_ship' => 'required|min:3|max:50',
            'email_ship' => 'email|required',
            'country_ship' => 'required',
            'state_ship' => 'required',
            'city_ship' => 'required',
            'pincode_ship' => 'required',
            'first_name_bil' => 'required',
            'last_name_bil' => 'required',
            'mobile_number_bil' => 'required|numeric|min:10',
            'address_bil' => 'required|min:10|max:255',
            'address_type_bil' => 'required|min:3|max:50',
            'email_bil' => 'email|required',
            'country_bil' => 'required',
            'state_bil' => 'required',
            'city_bil' => 'required',
            'pincode_bil' => 'required',
        ], [




        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $user = Auth::guard('api')->user();
            $customer = CustomerAddress::create([
                'customer_id' => $user->id,
                'name' => $request->first_name_ship . " " . $request->last_name_ship,
                'email' => $request->email_ship,
                'mobile_number' => $request->mobile_number_ship,
                'country' => $request->country_ship,
                'state' => $request->state_ship,
                'city' => $request->city_ship,
                'pincode' => $request->pincode_ship,
                'address' => $request->address_ship,
            ]);
            CustomerBillingAddress::create([
                'customer_id' => $user->id,
                'name' => $request->first_name_bil . " " . $request->last_name_bil,
                'email' => $request->email_bil,
                'mobile_number' => $request->mobile_number_bil,
                'country' => $request->country_bil,
                'state' => $request->state_bil,
                'city' => $request->city_bil,
                'pincode' => $request->pincode_bil,
                'address' => $request->address_bil,
            ]);


            return response()->json([
                'status' => 'success',
                'message' => "Address Added Succesfully",
                'data' => $customer
            ], 200);


        }

    }

    public function updatecustomerbillingaddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            // 'last_name'=>'required',
            'mobile_number' => 'required|digits:10',
            'address' => 'required|min:10|max:255',
            'address_type' => 'required|min:3|max:50',
            'email' => 'email|required|min:10|max:50',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $user = Auth::guard('api')->user();
            $customer = CustomerBillingAddress::where('id', $id)->where('customer_id', $user->id)->update([
                'customer_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'address' => $request->address,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Billing Address Updated Succesfully",
                // 'data' =>  $customer
            ], 200);


        }

    }

    public function updatecustomershippingaddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            // 'last_name'=>'required',
            'mobile_number' => 'required|digits:10',
            'address' => 'required|min:10|max:255',
            'address_type' => 'required|min:3|max:50',
            'email' => 'email|required|min:10|max:50',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required|digits:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $user = Auth::guard('api')->user();
            $customer = CustomerAddress::where('id', $id)->where('customer_id', $user->id)->update([
                'customer_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'address' => $request->address,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Shipping Address Updated Succesfully",
                // 'data' =>  $customer
            ], 200);


        }

    }
    public function updatecustomeraddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric|min:10',
            'address' => 'required|min:10|max:255',
            'address_type' => 'required|min:3|max:50',
            'email' => 'email|required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $user = Auth::guard('api')->user();
            $customer = CustomerAddress::findOrFail($id)->update([
                'customer_id' => $user->id,
                'name' => $request->first_name . " " . $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'address' => $request->address,
                'address_type' => $request->address_type,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Addres updated Succesfully",
                'data' => CustomerAddress::where('id', $id)->get(),
            ]);
        }
    }


    public function deletecustomershippingaddress($id)
    {
        $user = Auth::guard('api')->user();
        $obj = CustomerAddress::where('customer_id', $user->id)->where('id', $id)->first();
        if ($obj) {
            $obj->delete();
            return response()->json([
                'status' => true,
                'data' => $obj,
                'message' => "Deleted successfully!"
            ], 200);
        } else {
            return response()->json([
                'message' => "Not Found"
            ], 400);
        }

    }
    public function deletecustomerbillingaddress($id)
    {
        $user = Auth::guard('api')->user();
        $obj = CustomerBillingAddress::where('customer_id', $user->id)->where('id', $id)->first();
        if ($obj) {
            $obj->delete();
            return response()->json([
                'status' => true,
                'data' => $obj,
                'message' => "Deleted successfully!"
            ], 200);
        } else {
            return response()->json([
                'message' => "Not Found"
            ], 400);
        }

    }
    public function updatecustomerprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        $user = Auth::guard('api')->user();
        $obj = Customer::findOrFail($user->id);
        $data = $request->all();
        if ($request->image) {
            $data['image'] = $request->image->store('customer');
        } else {
            $data['image'] = $obj->image;
        }
        if ($obj) {
            $obj->update($data);
            return response()->json([
                'status' => "success",
                'data' => $obj,
                'message' => "Updated successfully!"
            ], 200);
        } else {
            return response()->json([
                'message' => "Not Found"
            ], 400);
        }
    }




    public function cart(Request $request)
    {
        $customer = Auth::guard('api')->user();
        $cart = Cart::updateOrCreate(['customer_id' => $customer->id]);
        $quantity = $request->quantity;
        $totalprice = $request->total_price;
        $cartitem = $request->cart;
        $discountamount = $request->discount_amount;
        $couponid = $request->coupon_id;
        for ($x = 0; $x < count($cartitem); $x++) {
            $cart_detail = CartDetail::where('cart_id', $cart->id)->where('product_option_id', $request->product_option_id)->first();
            if ($cart_detail) {
                if ($product_option->stock >= $cart_detail->quantity + $quantity) {
                    $cart_detail->update([
                        'quantity' => $cart_detail->quantity + $quantity
                    ]);
                }
            } else {
                CartDetail::create([
                    'customer_id' => $customer->id,
                    'cart_id' => $cart->id,
                    'product_id' => $cartitem[$x]['product_id'],
                    'product_option_id' => $cartitem[$x]['product_option_id'],
                    'quantity' => $cartitem[$x]['quantity'],
                ]);
            }
        }


        $cart->update([
            'coupon_id' => $couponid,
            'total_price' => $totalprice,
            'discount_amount' => $discountamount,
            'total_price_after_discount' => $cart->total_price + $totalprice - $discountamount
        ]);
        return response()->json([
            'success' => true,
            "message" => "Add to cart Succesfully!"
        ]);
    }




    public function valueaddedservice()
    {
        $obj = ServiceCategory::where('value_added_service', '=', 'yes')->with('services')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function otherservices()
    {
        $obj = ServiceCategory::where('other_service', '=', 'yes')->with('services')->get();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function oilgradepackage()
    {
        $obj = Packages::where('status', 'active')->with('package_option')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function getCartservice()
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = CartService::updateOrCreate(['customer_id' => $user->id]);
            $cart_items = CartServiceDetail::where('cart_id', $cart->id)->with('services:id,name,name_ar,image')->with('service_options:id,mrp,price,discount_amount')->get(['id', 'customer_id', 'cart_id', 'service_id', 'service_option_id']);
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                    'cart_details' => $cart_items
                ],
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }
    }

    public function storeCartservice(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = CartService::updateOrCreate(['customer_id' => $user->id]);
            $service = Services::where('id', $request->service_id)->first();
            $serviceoption = ServiceOption::where('id', $request->service_option_id)->where('service_id', $service->id)->first();
            $cartdeatil = CartServiceDetail::where('cart_id', $cart->id)->where('customer_id', $user->id)->where('service_id', $service->id)->where('service_option_id', $serviceoption->id)->first();
            if ($cartdeatil) {

                $msg = "Already Added To Cart";
            } else {
                CartServiceDetail::create([
                    'customer_id' => $user->id,
                    'service_id' => $service->id,
                    'service_option_id' => $serviceoption->id,
                    'cart_id' => $cart->id,
                    'quantity' => 1,
                ]);
                $msg = "Added To Cart Succesfully";

                $cart->update([
                    'total_price' => $cart->total_price + $serviceoption->price,
                    'total_price_after_discount' => $cart->total_price + $serviceoption->price - $cart->discount_amount
                ]);
            }



            $cart_items = CartServiceDetail::where('cart_id', $cart->id)->get();

            return response()->json([
                'success' => true,
                'meassge' => $msg
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }


    public function removeItemFromCartservice($cart_item_id)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = CartService::where('customer_id', $user->id)->first();
            $cart_items = CartServiceDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $serviceoption = ServiceOption::where('id', $cart_items->service_option_id)->first();
            $cart_items->delete();
            $cart->update([
                'total_price' => $cart->total_price - $serviceoption->price,
                'total_price_after_discount' => $cart->total_price - $serviceoption->price - $cart->discount_amount
            ]);
            return response()->json([
                'success' => true,
                'meassge' => "Item removed Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }


    public function applycouponservice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            try {
                $user = Auth::guard('api')->user();
                // $user = Customer::where('id',$user1->id)->first();
                $cart = CartService::where('customer_id', $user->id)->firstOrFail();
                $coupon = Coupon::where('coupon_code', $request->coupon_code)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->where('status', 'active')->first();
                if ($coupon) {
                    if ($user->orders->count() < $coupon->number_of_use) {
                        if ($coupon->min_order <= $cart->total_price) {
                            $cart->update([
                                'coupon_id' => $coupon->id,
                                'discount_amount' => $coupon->discount_amount,
                                'total_price_after_discount' => $cart->total_price - $coupon->discount_amount,
                            ]);

                            return response()->json([
                                'success' => true,
                                'data' => [
                                    'cart' => $cart,
                                ],
                            ], 200);
                        } else {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'coupon_code' => [
                                        'Coupon not applicable on total',
                                    ],
                                ],
                            ], 422);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'errors' => [
                                'coupon_code' => [
                                    'This coupon is already availed with the maximum no of limits',
                                ],
                            ],
                        ], 422);
                    }

                } else {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'coupon_code' => [
                                'Invalid Coupon',
                            ],
                        ],
                    ], 422);
                }
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
                ], 400);
            }
        }
    }

    public function removeCouponservice(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = CartService::where('customer_id', $user->id)->firstOrFail();
            $coupon = Coupon::where('id', $cart->coupon_id)->first();
            if ($coupon) {
                $cart->update([
                    'coupon_id' => Null,
                    'discount_amount' => 0,
                    'total_price_after_discount' => $cart->total_price,
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msgText' => $e->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }
    }
    //product cart start
    public function getCart()
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::updateOrCreate(['customer_id' => $user->id]);
            Cart::where('customer_id', $user->id)->update([
                'total_price_after_discount' => $cart->total_price - $cart->discount_amount
            ]);
            $cart = Cart::where('customer_id', $user->id)->with('coupon:id,coupon_code,end_date,status,products,categories')->first();
            // Check coupon validity
            if ($cart->coupon) {

                // COUPON EXPIRED or DISABLED
                if (($cart->coupon->end_date < now()) || strtolower($cart->coupon->status) !== 'active') {
                    $cart->update([
                        'discount_amount' => 0,
                        'coupon_id' => null
                    ]);
                } else {

                    // Validate category/product match
                    $cart_details = CartDetail::where('cart_id', $cart->id)->get();
                    $cart_product_ids = $cart_details->pluck('product_id')->toArray();

                    // product categories
                    $categories_in_cart = Product::whereIn('id', $cart_product_ids)
                        ->pluck('category_id')
                        ->toArray();

                    // explode coupon attributes
                    $coupon_categories = $cart->coupon->categories ? explode(',', $cart->coupon->categories) : [];
                    $coupon_products = $cart->coupon->products ? explode(',', $cart->coupon->products) : [];

                    // 👉 Default assume valid
                    $valid = false;

                    // 🔍 CATEGORY VALIDATION
                    $foundCategoryMatch = count($coupon_categories) > 0 &&
                        count(array_intersect($categories_in_cart, $coupon_categories)) > 0;

                    // 🔍 PRODUCT VALIDATION
                    $foundProductMatch = count($coupon_products) > 0 &&
                        count(array_intersect($cart_product_ids, $coupon_products)) > 0;


                    // 👉 VALID IF ANY MATCHES
                    if ($foundCategoryMatch || $foundProductMatch) {
                        $valid = true;
                    }

                    // 🚨 NONE MATCH → REMOVE COUPON
                    if (!$valid) {
                        $cart->update([
                            'discount_amount' => 0,
                            'coupon_id' => null
                        ]);
                    }
                }
            }


            $cart_items = CartDetail::where('cart_id', $cart->id)->with('products', 'product_options')->get();

            $price = 0;
            $discount = 0;
            if ($cart_items) {
                foreach ($cart_items as $data) {
                    $price += $data->product_options->mrp * $data->quantity;
                    $discount += $data->product_options->discount_amount * $data->quantity;
                }
                $cart->update([
                    'total_price' => $price,
                    'pre_discount' => $discount,
                    'total_price_after_discount' => $price - $discount - $cart->discount_amount
                ]);
            } else {
                $cart->update([
                    'total_price' => 0,
                    'pre_discount' => 0,
                    'total_price_after_discount' => 0
                ]);
            }

            $cart = Cart::where('customer_id', $user->id)->with('coupon:id,coupon_code')->first();
            $cart['quantity'] = $cart_items->SUM('quantity');
            $cart['item'] = $cart_items->count();
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                    'cart_details' => $cart_items
                ],
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }
    }

    public function storeCart(Request $request)
    {

        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::updateOrCreate(['customer_id' => $user->id]);
            $product = Product::where('id', $request->product_id)->first();
            $productoption = ProductOption::where('id', $request->product_option_id)->where('product_id', $product->id)->first();
            // dd($productoption->toArray());
            $cartdeatil = CartDetail::where('cart_id', $cart->id)->where('customer_id', $user->id)->where('product_id', $product->id)->where('product_option_id', $productoption->id)->first();
            if ($cartdeatil) {

                $msg = "Already Added To Cart";
            } else {
                $quantity = $request->quantity ?? 1;
                CartDetail::create([
                    'customer_id' => $user->id,
                    'product_id' => $product->id,
                    'product_option_id' => $productoption->id,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                ]);
                $msg = "Added To Cart Succesfully";
                $cart->update([
                    'total_price' => $cart->total_price + $productoption->price * $quantity,
                    'pre_discount' => $cart->pre_discount + ($productoption->discount_amount * $quantity),
                    'total_price_after_discount' => $cart->total_price + ($productoption->price * $quantity) - $cart->discount_amount
                ]);
            }
            $cart_items = CartDetail::where('cart_id', $cart->id)->with('products', 'product_options')->get();
            $item = count($cart_items);
            return response()->json([
                'success' => true,
                'meassge' => $msg,
                'item' => $item
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }


    public function removeItemFromCart($cart_item_id)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::where('customer_id', $user->id)->first();
            $cart_items = CartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();

            $cart->update([
                'pre_discount' => $cart->pre_discount - $productoption->discount_amount * $cart_items->quantity,
                'total_price' => $cart->total_price - $productoption->price * $cart_items->quantity,
                'total_price_after_discount' => $cart->total_price - $productoption->price * $cart_items->quantity - $cart->discount_amount
            ]);
            $cart_items->delete();
            return response()->json([
                'success' => true,
                'meassge' => "Item removed Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }
    public function increaseCartItemQuantity($cart_item_id)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::where('customer_id', $user->id)->first();
            $cart_items = CartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();
            $cart_items->update([
                'quantity' => $cart_items->quantity + 1
            ]);
            $cart->update([
                'total_price' => $cart->total_price + $productoption->price,
                'pre_discount' => $cart->pre_discount + $productoption->discount_amount,
                'total_price_after_discount' => $cart->total_price + $productoption->price - $cart->discount_amount
            ]);
            return response()->json([
                'success' => true,
                'meassge' => "Item Quantity Increased Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }
    public function decreaseCartItemQuantity($cart_item_id)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::where('customer_id', $user->id)->first();
            $cart_items = CartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();
            if ($cart_items->quantity > 1) {
                $cart_items->update([
                    'quantity' => $cart_items->quantity - 1
                ]);
                $cart->update([
                    'total_price' => $cart->total_price - $productoption->price,
                    'pre_discount' => $cart->pre_discount - $productoption->discount_amount,
                    'total_price_after_discount' => $cart->total_price - $productoption->price - $cart->discount_amount
                ]);
            }
            return response()->json([
                'success' => true,
                'meassge' => "Item Quantity decreased Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }

    //product cart end
    //unauth product cart start

    public function getCartUnauthenticated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCart::updateOrCreate(['device_id' => $request->device_id]);
            $cart_items = UnAuthCartDetail::where('cart_id', $cart->id)->with('products', 'product_options')->get();
            $price = 0;
            $discount = 0;
            if ($cart_items) {
                foreach ($cart_items as $data) {
                    $price += $data->product_options->price * $data->quantity;
                    $discount += $data->product_options->discount_amount * $data->quantity;
                }
                $cart->update([
                    'total_price' => $price,
                    // 'pre_discount'=>$discount,
                    'total_price_after_discount' => $price - $cart->discount_amount
                ]);
            } else {
                $cart->update([
                    'total_price' => 0,
                    'pre_discount' => 0,
                    'total_price_after_discount' => 0
                ]);
            }
            $cart['quantity'] = $cart_items->SUM('quantity');
            $cart['item'] = count($cart_items);
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                    'cart_details' => $cart_items
                ],
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }
    }

    public function removeCoupon(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $cart = Cart::where('customer_id', $user->id)->firstOrFail();
            $coupon = Coupon::where('id', $cart->coupon_id)->first();
            if ($coupon) {
                $cart->update([
                    'coupon_id' => Null,
                    'discount_amount' => 0,
                    'total_price_after_discount' => $cart->total_price,
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msgText' => $e->getMessage() . '-' . $e->getLine(),
            ], 400);
        }
    }
    public function storeCartUnauthenticated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCart::updateOrCreate(['device_id' => $request->device_id]);
            $product = Product::where('id', $request->product_id)->first();
            $productoption = ProductOption::where('id', $request->product_option_id)->where('product_id', $product->id)->first();
            $cartdeatil = UnAuthCartDetail::where('cart_id', $cart->id)->where('device_id', $request->device_id)->where('product_id', $product->id)->where('product_option_id', $productoption->id)->first();
            if ($cartdeatil) {

                $msg = "Already Added To Cart";
            } else {
                $quantity = $request->quantity ?? 1;
                UnAuthCartDetail::create([
                    'device_id' => $request->device_id,
                    'product_id' => $product->id,
                    'product_option_id' => $productoption->id,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                ]);
                $msg = "Added To Cart Succesfully";
            }

            $quantity = $request->quantity ?? 1;
            $cart->update([
                'total_price' => $cart->total_price + $productoption->price * $quantity,
                // 'pre_discount'=>$cart->pre_discount+$productoption->discount_amount * $quantity,
                'total_price_after_discount' => $cart->total_price + ($productoption->price * $quantity) - $cart->discount_amount
            ]);
            // $cart_items = UnAuthCartServiceDetail::where('cart_id',$cart->id)->get();
            $cart_items = UnAuthCartDetail::where('cart_id', $cart->id)->with('products', 'product_options')->get();
            return response()->json([
                'success' => true,
                'meassge' => $msg,
                'item' => count($cart_items)
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }


    public function removeItemFromCartUnauthenticated(Request $request, $cart_item_id)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCart::where('device_id', $request->device_id)->first();
            $cart_items = UnAuthCartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();

            $cart->update([
                // 'pre_discount'=>$cart->pre_discount-$productoption->discount_amount * $cart_items->quantity,
                'total_price' => $cart->total_price - ($productoption->price * $cart_items->quantity),
                'total_price_after_discount' => $cart->total_price - ($productoption->price * $cart_items->quantity) - $cart->discount_amount
            ]);
            $cart_items->delete();
            return response()->json([
                'success' => true,
                'meassge' => "Item removed Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }

    public function increaseCartItemQuantityUnauthenticated(Request $request, $cart_item_id)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCart::where('device_id', $request->device_id)->first();
            $cart_items = UnAuthCartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();

            $cart_items->update([
                'quantity' => $cart_items->quantity + 1
            ]);
            $cart->update([
                'total_price' => $cart->total_price + $productoption->price
            ]);
            return response()->json([
                'success' => true,
                'meassge' => "Item Quantity Increased Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }
    public function decreaseCartItemQuantityUnauthenticated(Request $request, $cart_item_id)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCart::where('device_id', $request->device_id)->first();
            $cart_items = UnAuthCartDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $productoption = ProductOption::where('id', $cart_items->product_option_id)->first();
            $cart_items->update([
                'quantity' => $cart_items->quantity - 1
            ]);
            $cart->update([
                'total_price' => $cart->total_price - $productoption->price
            ]);
            return response()->json([
                'success' => true,
                'meassge' => "Item Quantity decreased Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }
    //unauth product cart end
    public function getCartserviceUnauthenticated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCartService::updateOrCreate(['device_id' => $request->device_id]);
            $cart_items = UnAuthCartServiceDetail::where('cart_id', $cart->id)->with([
                'services' => function ($query) {
                    $query->select('id', 'name', 'name_ar', 'image');
                }
            ])->with([
                        'service_options' => function ($query1) {
                            $query1->select('id', 'mrp', 'price', 'discount_amount');
                        }
                    ])->get(['id', 'device_id', 'cart_id', 'service_id', 'service_option_id']);
            return response()->json([
                'success' => true,
                'data' => [
                    'cart' => $cart,
                    'cart_details' => $cart_items
                ],
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }
    }

    public function storeCartserviceUnauthenticated(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCartService::updateOrCreate(['device_id' => $request->device_id]);
            $service = Services::where('id', $request->service_id)->first();
            $serviceoption = ServiceOption::where('id', $request->service_option_id)->where('service_id', $service->id)->first();
            $cartdeatil = UnAuthCartServiceDetail::where('cart_id', $cart->id)->where('device_id', $request->device_id)->where('service_id', $service->id)->where('service_option_id', $serviceoption->id)->first();
            if ($cartdeatil) {

                $msg = "Already Added To Cart";
            } else {
                UnAuthCartServiceDetail::create([
                    'device_id' => $request->device_id,
                    'service_id' => $service->id,
                    'service_option_id' => $serviceoption->id,
                    'cart_id' => $cart->id,
                    'quantity' => 1,
                ]);
                $msg = "Added To Cart Succesfully";
            }


            $cart->update([
                'total_price' => $cart->total_price + $serviceoption->price
            ]);
            // $cart_items = UnAuthCartServiceDetail::where('cart_id',$cart->id)->get();

            return response()->json([
                'success' => true,
                'meassge' => $msg
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }




    public function removeItemFromCartserviceUnauthenticated(Request $request, $cart_item_id)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        }
        try {
            $cart = UnAuthCartService::where('device_id', $request->device_id)->first();
            $cart_items = UnAuthCartServiceDetail::where('cart_id', $cart->id)->where('id', $cart_item_id)->first();
            $serviceoption = ServiceOption::where('id', $cart_items->service_option_id)->first();
            $cart_items->delete();
            $cart->update([
                'total_price' => $cart->total_price - $serviceoption->price
            ]);
            return response()->json([
                'success' => true,
                'meassge' => "Item removed Succesfully"
            ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage() . '-' . $ex->getLine(),
            ], 400);
        }

    }
    //google login

    public function redirectToAuth(): JsonResponse
    {
        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function handleAuthCallback(): JsonResponse
    {
        try {
            $socialiteUser = Socialite::driver('google')->stateless()->user();
        } catch (ClientException $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        /** @var User $user */
        $user = Customer::query()
            ->firstOrCreate(
                [
                    'email' => $socialiteUser->getEmail(),
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $socialiteUser->getName(),
                    'google_id' => $socialiteUser->getId(),
                    'avatar' => $socialiteUser->getAvatar(),
                ]
            );

        return response()->json([
            'data' => [
                'access_token' => $user->createToken($socialiteUser->getEmail())->accessToken,
                'user' => $user,
            ],


            // 'token_type' => 'Bearer',
        ]);
    }

    public function carorigin()
    {
        $obj = CarOrigin::where('status', 'active')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function cylinder()
    {
        $obj = Cylinder::where('status', 'active')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function oilgrade()
    {
        $obj = OilGrade::where('status', 'active')->get();
        $obj->makeHidden(['created_at', 'status', 'updated_at']);

        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function addgarage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'garage_name' => 'required|max:255',
            'mobile_number' => 'required',
            'address' => 'required|min:10|max:255',
            'email' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'

        ], [
            'password.password_confirmation' => 'Enter same conform password ',
            'mobile_number.required' => 'The contact number field is required.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $data['email'] = json_encode($data['email']);
            $data['mobile_number'] = json_encode($data['mobile_number']);

            // $data['dob'] = date('Y-m-d',strtotime($request->dob));
            $user = GarageFranchise::create($data);
            $user['email'] = json_decode($user['email']);
            $user['mobile_number'] = json_decode($user['mobile_number']);
            $token = $user->createToken($request->email)->accessToken;
            // $success['token'] = $token;
            // $success['name'] =  $user->name;
            $name = $user->name;
            return response()->json([
                'status' => 'success',
                'message' => "Thank you $name You succesfully Registered Here",
                // 'token'=>  $token,
                'data' => $user
            ]);

        }
    }





    // submit order details 
    public function submitOrder(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // 'address' => 'required',
            'shipping_type' => 'required',
            'billing_id' => 'required',
            'shipping_id' => 'required',
            'payment_mode' => 'required',
            // 'refrence_id' => 'required_if:payment_mode,offline|min:3',
            // 'payment_image' => 'required_if:payment_mode,offline|image:mimes,jpg,png,pneg',
            'payment_image' => 'nullable|image:mimes,jpg,png,pneg',
            'shipping_id' => 'required',
            // 'shippingtype_id' => 'required',
            // 'way_of_billing' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('api')->user();

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
                            $vat_percentage = $GstCharges->vat;
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
                    if ($request->hasFile('payment_image')) {
                        $payment_image = $request->payment_image->store('payment');
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
                        'refrence_id' => $request->refrence_id,
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
                    ini_set('memory_limit', '44M');
                    //             ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
                    $pdf = PDF::loadView('frontend.customer.invoice', compact('terms_and_condition', 'general_setting', 'order', 'gstsetting'));


                    //Storage::put('invoices/invoices'.strtolower($order->order_number).'.pdf', $pdf->output());

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
                    // $emailfrom = $emailsetting->username;
                    // $emailfromname = $emailsetting->name;
                    $pdfurl = $data['pdf_url'];
                    $admin = User::first();
                    //  dispatch(new \App\Jobs\SendEmailJob($customer->email,$datas,$admin->alert_email));
                    //   Mail::to($customer->email)->send(new OrderMail($datas));
                    //   Mail::to($admin->alert_email)->send(new AdminOrderMail($datas));
                    //   print_r(Mail::to([$customer->email,$admin->alert_email])->send(new OrderMail($datas)));
                    //   die();


                    $this->sendAdminmsg($customer->name, $customer->email, $customer->mobile_number, $cart_total_with_shipping);

                    DB::commit();
                    return response()->json([
                        'success' => true,
                        'data' => $data,
                        'pdf' => "acs",
                        'message' => "Get successfully!"
                    ], 200);

                    $data = array('email' => $cus->email, 'password' => $request->password);
                    // Mail::send('website/simple_register',$data, function ($message) use ($emalto) {
                    // $message->from('info@krishnachikanindustry.com', 'Krishna Chikan Industry');
                    // $message->to($emalto)
                    //   ->subject('Order Confirmation');
                    // });


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

    public function garageall()
    {

        $datas = GarageFranchise::latest()->with('country', 'state', 'city')->get();
        foreach ($datas as $key => $data) {
            $data['email'] = json_decode($data['email']);
            $data['mobile_number'] = json_decode($data['mobile_number']);
        }

        return response()->json([
            'status' => true,
            'data' => $datas,
            'message' => "Get successfully!"
        ], 200);
    }

    public function garagesearch(Request $request)
    {

        if ($request->zip_code) {
            $validator = Validator::make($request->all(), [
                'zip_code' => 'required|min:5',
                // 'country' => 'required|exists:zip_code',
                // 'state' => 'required|exists:zip_code',
                // 'city' => 'required|exists:zip_code',
                // 'way_of_billing' => 'required',
            ]);
            if ($validator->passes()) {
                $datas = GarageFranchise::where('zip_code', $request->zip_code)->with('country', 'state', 'city')->latest()->get();
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 422,
                    'errors' => $validator->errors(),
                ]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
            ]);
            if ($validator->passes()) {
                $datas = GarageFranchise::where('country', $request->country_id)->where('state', $request->state_id)->where('city', $request->city_id)->with('country', 'state', 'city')->latest()->get();
            } else {
                return response()->json([
                    'success' => false,
                    'code' => 422,
                    'errors' => $validator->errors(),
                ]);
            }
        }

        foreach ($datas as $key => $data) {
            $data['email'] = json_decode($data['email']);
            $data['mobile_number'] = json_decode($data['mobile_number']);
        }
        if (count($datas) > 0) {
            return response()->json([
                'status' => true,
                'data' => $datas,
                'message' => "Get successfully!"
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "No Garage Found"
            ], 404);
        }


    }

    public function getshippingtype(Request $request)
    {
        $shippingData = ShippingCost::latest()->limit(3)->get(['id', 'name', 'in_state_charge', 'delivery_days_range As maximum_days']);
        foreach ($shippingData as $key => $data) {
            $shippingData[$key]['totalCartAmount'] = $data->in_state_charge + $request->amount;
        }
        $default_shipping_cost = FreeShiping::where('status', 'active')->where('min_order_value_intrastate', '<=', $request->amount)->where('min_order_value_interstate', '<=', $request->amount)->first();
        if (isset($default_shipping_cost)) {
            $shippingData[] = [
                "id" => $default_shipping_cost->id,
                'in_state_charge' => 0,
                'totalCartAmount' => $request->amount,
                'maximum_days' => $default_shipping_cost->day_range_intra_state,
                "name" => $default_shipping_cost->name
            ];
        }

        return response()->json([
            'status' => true,
            'data' => $shippingData,
            'message' => "Get successfully!"
        ], 200);


    }

    // check pincode delivery 
    public function CheckPincodeDelivery(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'pincode' => 'required',
            'pincode_billing' => 'required',
        ]);
        //dd($request->all());
        if ($validator->passes()) {
            $TotalShipCost = 0;
            try {
                $billing_pincode = Pincode::where('pincode', $request->pincode_billing)->first();
                $shipping_pincode = Pincode::where('pincode', $request->pincode)->count();
                // return $shipping_pincode;

                // calculate GST charges for all users 

                $totalQuantity = $request->cart_quantity;
                $totalCartAmount = $request->cart_amount;

                $total_gst_percentage = 0;
                $total_gst_amount = 0;
                $cart_total_with_gst = 0;
                $gst_type = 'GST';
                $shipping_price = 0;
                // end gst charges

                $shippingCosts = ShippingCost::latest()->limit(3)->where('status', 'active')->get();



                $state_id = Pincode::where('pincode', $request->pincode)->firstOrFail();
                $GstCharges = SiteGstSetting::firstOrFail();

                foreach ($shippingCosts as $shippingCost) {
                    if ($shippingCost->status == "active") {
                        // gst charges 
                        if ($GstCharges->gst_status == "yes") {

                            if ($GstCharges->state_id == $state_id->state_id) {
                                if ($shippingCost->in_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                    $TotalShipCost = $shippingCost->max_charges;
                                } else {
                                    $TotalShipCost = $shippingCost->in_state_charge * $totalQuantity;
                                }
                            } else {
                                if ($shippingCost->out_state_charge * $totalQuantity >= $shippingCost->max_charges) {
                                    $TotalShipCost = $shippingCost->max_charges;

                                } else {
                                    $TotalShipCost = $shippingCost->out_state_charge * $totalQuantity;
                                }
                            }

                            if ($GstCharges->state_id == $billing_pincode->state_id) {
                                $cgst_percentage = $GstCharges->cgst_percent;
                                $sgst_percentage = $GstCharges->sgst_percent;
                                $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                                $sgst_amount = ($totalCartAmount + $TotalShipCost) * ($sgst_percentage / 100);
                                $cgst_amount = ($totalCartAmount + $TotalShipCost) * ($cgst_percentage / 100);
                                $total_gst_amount = round($sgst_amount + $cgst_amount, 2);
                                $gst_type = 'CGST + SGST';
                            } else {
                                $igst_percentage = $GstCharges->igst_percent;
                                $total_gst_percentage = $igst_percentage;
                                $igst_amount = ($totalCartAmount + $TotalShipCost) * ($igst_percentage / 100);
                                $total_gst_amount = round($igst_amount, 2);

                                $gst_type = 'IGST';
                            }

                        } else {

                            if ($GstCharges->state_id == $state_id->state_id) {

                                if (($shippingCost->in_state_charge * $totalQuantity) >= $shippingCost->max_charges) {
                                    $TotalShipCost = $shippingCost->max_charges;
                                } else {
                                    $TotalShipCost = $shippingCost->in_state_charge * $totalQuantity;
                                }
                            } else {
                                if (($shippingCost->out_state_charge * $totalQuantity) >= $shippingCost->max_charges) {
                                    $TotalShipCost = $shippingCost->max_charges;

                                } else {
                                    $TotalShipCost = $shippingCost->out_state_charge * $totalQuantity;
                                }
                            }

                            $vat_percentage = $GstCharges->vat;
                            $total_gst_percentage = $vat_percentage;
                            $vatamount = ($totalCartAmount + $TotalShipCost) * ($vat_percentage / 100);
                            $total_gst_amount = round($vatamount, 2);

                            $gst_type = 'VAT';
                        }

                        $toal_cart_amount = round($totalCartAmount + $total_gst_amount + $TotalShipCost, 2);
                        $shippingCost['TotalShipCost'] = $TotalShipCost;
                        $shippingCost['totalCartAmount'] = (string) $toal_cart_amount;
                        $shippingCost['CartAmount'] = $request->cart_amount;
                        $shippingCost['total_gst_amount'] = (string) round($total_gst_amount, 2);
                        $shippingCost['gst_type'] = $gst_type;
                        if ($gst_type == "CGST + SGST") {
                            $shippingCost['cgst_amount'] = $cgst_amount;
                            $shippingCost['sgst_amount'] = $sgst_amount;
                        }
                        $shippingCost['shipping_type'] = "paid";
                        // end gst charges
                    }
                }
                $default_shipping_cost = '';
                if ($GstCharges->state_id == $billing_pincode->state_id) {
                    $default_shipping_cost = FreeShiping::where('status', 'active')->where('min_order_value_intrastate', '<=', $totalCartAmount)->first();
                } else {
                    $default_shipping_cost = FreeShiping::where('status', 'active')->where('min_order_value_interstate', '<=', $totalCartAmount)->first();
                }

                if (isset($default_shipping_cost)) {

                    if ($GstCharges->gst_status == "yes") {
                        if ($GstCharges->state_id == $billing_pincode->state_id) {
                            $cgst_percentage = $GstCharges->cgst_percent;
                            $sgst_percentage = $GstCharges->sgst_percent;
                            $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                            $sgst_amount = $totalCartAmount * ($sgst_percentage / 100);
                            $cgst_amount = $totalCartAmount * ($cgst_percentage / 100);
                            $total_gst_amount = round($sgst_amount + $cgst_amount, 2);

                            $gst_type = 'CGST + SGST';

                            $default_shipping_cost['delivery_days_range'] = $default_shipping_cost->day_range_inter_state;
                        } else {
                            $igst_percentage = $GstCharges->igst_percent;
                            $total_gst_percentage = $igst_percentage;
                            $igst_amount = $totalCartAmount * ($igst_percentage / 100);
                            $total_gst_amount = round($igst_amount, 2);

                            $gst_type = 'IGST';
                            $default_shipping_cost['delivery_days_range'] = $default_shipping_cost->day_range_intra_state;
                        }
                    } else {

                        $vat_percentage = $GstCharges->vat;
                        $total_gst_percentage = $vat_percentage;
                        $vatamount = $totalCartAmount * ($vat_percentage / 100);
                        $total_gst_amount = round($vatamount, 2);

                        $gst_type = 'VAT';
                        $default_shipping_cost['delivery_days_range'] = $default_shipping_cost->day_range_inter_state;
                    }
                    $toal_cart_amount = round($totalCartAmount + $total_gst_amount, 2);
                    $default_shipping_cost['TotalShipCost'] = 0;
                    $default_shipping_cost['CartAmount'] = $request->cart_amount;
                    $default_shipping_cost['gst_type'] = $gst_type;
                    $default_shipping_cost['total_gst_amount'] = (string) round($total_gst_amount, 2);
                    $default_shipping_cost['totalCartAmount'] = (string) $toal_cart_amount;
                    $default_shipping_cost['gst_type'] = $gst_type;

                    $default_shipping_cost['shipping_type'] = "free";
                    if ($gst_type == "CGST + SGST") {
                        $default_shipping_cost['cgst_amount'] = $cgst_amount;
                        $default_shipping_cost['sgst_amount'] = $sgst_amount;
                    }

                    $default_shipping_cost->makeHidden(['created_at', 'updated_at', 'min_order_value_intrastate', 'min_order_value_interstate', 'min_quantity_intrastate', 'min_quantity_interstate', 'status']);
                    $shippingCosts = [$default_shipping_cost];
                }



                // $shippingCosts->makeHidden(['in_state_charge','out_state_charge','max_charges','status','created_at','updated_at','deleted_at']);
                // calculate shipping charges end

                if ($shipping_pincode > 0) {

                    return response()->json([
                        'success' => true,
                        "message" => "Pincode is available for delivery",
                        "shippingCost" => $shippingCosts,
                        // "TotalShipCost"=>  $TotalShipCost,
                        // "default_shipping_cost" =>  $default_shipping_cost ,
                        // "total_gst_amount" => $total_gst_amount,
                        // "totalCartAmount" => $toal_cart_amount,
                    ]);

                } else {
                    return response()->json([
                        'notFound' => true,
                        "message" => "Pincode is not available for delivery",
                        "TotalShipCost" => $TotalShipCost,
                    ]);
                }

            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'NoShippingCost' => true,
                    'message' => 'Pincode is not available for delivery.',
                    "TotalShipCost" => $TotalShipCost,
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

    // submit servicebooking details 
    public function servicebooking(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            // 'shipping_type' => 'required',
            'garage_id' => 'required',
            'fuel_type' => 'required',
            'brand_name' => 'required',
            'brandmodel_name' => 'required',
            'service_type' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('api')->user();

                $way_of_billing = $request->way_of_billing;
                $paymentMethod = $request->payment_mode;

                // for cash on delivery 
                if ($paymentMethod == 'cod') {


                    if ($way_of_billing == 'billing') {
                        $customer_address = CustomerBillingAddress::where('id', $request->address)->where('customer_id', $customer->id)->firstOrFail();
                    } else {
                        $customer_address = CustomerAddress::where('id', $request->address)->where('customer_id', $customer->id)->firstOrFail();
                    }

                    // $shipping_type = ShippingCost::where('id',$request->shipping_type)->firstOrFail();

                    $cart = CartService::where('customer_id', $customer->id)->firstOrFail();
                    $garage = GarageFranchise::where('id', $request->garage_id)->firstOrFail();
                    $cart_details = CartServiceDetail::where('cart_id', $cart->id)->get();
                    $gst_type = 'GST';
                    $igst_percentage = 0;
                    $sgst_percentage = 0;
                    $cgst_percentage = 0;
                    $total_gst_percentage = 0;
                    $igst_amount = 0;
                    $sgst_amount = 0;
                    $cgst_amount = 0;
                    $total_gst_amount = 0;
                    $cart_total_with_gst = 0;
                    $totalQuantity = $cart_details->SUM('quantity');

                    // shipping cost

                    //  $shippingCost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$cart->total_price_after_discount)->firstOrFail();
                    // $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$cart->total_price_after_discount)->where('max_order_value', '>=',$cart->total_price_after_discount)->firstOrFail();  
                    // shipping cost end 


                    if ($general_setting->state_id == $customer_address->state) {

                        $cgst_percentage = $general_setting->cgst_percent;
                        $sgst_percentage = $general_setting->sgst_percent;
                        $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                        $sgst_amount = $cart->total_price_after_discount * ($sgst_percentage / 100);
                        $cgst_amount = $cart->total_price_after_discount * ($cgst_percentage / 100);
                        $total_gst_amount = $sgst_amount + $cgst_amount;
                        $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                        $gst_type = 'CGST + SGST';
                        // $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                    } else {

                        $igst_percentage = $general_setting->igst_percent;
                        $total_gst_percentage = $igst_percentage;
                        $igst_amount = $cart->total_price_after_discount * ($igst_percentage / 100);
                        $total_gst_amount = $igst_amount;
                        $cart_total_with_gst = $cart->total_price_after_discount + $total_gst_amount;
                        $gst_type = 'IGST';
                        // $TotalShipCost =   (float)$shippingCost->out_state_charge *  $totalQuantity;
                    }

                    //  $shipping_price = $TotalShipCost;
                    // $cart_total_with_shipping =  $cart_total_with_gst + $shipping_price;

                    while (true) {
                        $order_number = 'SER' . random_int(100000, 999999);
                        if (!OrderService::where('order_number', $order_number)->exists()) {
                            break;
                        }
                    }
                    if ($request->pickup_delivery_date) {
                        $picstatus = "yes";
                    } else {
                        $picstatus = "no";
                    }
                    $orderData = array(
                        'customer_id' => $customer->id,
                        'order_number' => $order_number,
                        'fuel_type' => $request->fuel_type,
                        'brand_name' => $request->brand_name,
                        'service_type' => $request->service_type,
                        'brandmodel_name' => $request->brandmodel_name,
                        'total_item_count' => $cart_details->SUM('quantity'),
                        'order_amount' => $cart->total_price,
                        'coupon_id' => $cart->coupon_id,
                        'pickup_delivery_time' => $request->pickup_delivery_time,
                        'pickup_delivery_date' => $request->pickup_delivery_date,
                        'pickup_delivery_status' => $picstatus,
                        'coupon_code' => $cart->coupon->coupon_code ?? Null,
                        'discount_amount' => $cart->discount_amount,
                        'order_amount_after_discount' => $cart->total_price_after_discount,
                        'customer_address_id' => $customer_address->id,
                        'name' => $customer_address->name,
                        'garage_id' => $garage->id,
                        'garage_name' => $garage->name,
                        'garage_email' => $garage->email,
                        'garage_mobile_number' => $garage->mobile_number,
                        'garage_address' => $garage->address,
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
                        'total_gst_percentage' => $total_gst_percentage,
                        'igst_amount' => $igst_amount,
                        'cgst_amount' => $cgst_amount,
                        'sgst_amount' => $sgst_amount,
                        'total_gst_amount' => $total_gst_amount,
                        'order_amount_with_gst' => $cart_total_with_gst,
                        // 'shipping_type_id' => $shipping_type->id,
                        // 'shipping_type_name' => $shipping_type->name,
                        // 'shipping_type_maximum_days' => $shipping_type->maximum_days,
                        // 'shipping_type_price' =>    $shipping_price,
                        // 'order_amount_with_shipping' => $cart_total_with_shipping,
                        // 'estimated_delivery_date' => Carbon::now()->addDays($shipping_type->maximum_days)->toDateString(),
                        'delivered_on_date' => Null,
                        'payment_status' => 'cod',
                        'order_status' => 'New Booking',
                        'transaction_number' => 'TRN' . random_int(100000, 999999),
                        'transaction_detail' => 'Dummy Details',
                    );


                    $order = OrderService::create($orderData);
                    foreach ($cart_details as $cart_detail) {
                        $service = Services::findOrFail($cart_detail->service_id);
                        $serviceoption = ServiceOption::findOrFail($cart_detail->service_option_id);
                        $orderDetailData = array(
                            'order_id' => $order->id,
                            'service_id' => $service->id,
                            'service_name' => $service->name,
                            'service_option_id' => $serviceoption->id,
                            'brand_id' => $serviceoption->brand_id,
                            'brand_name' => $serviceoption->carmake->name,
                            'brandmodel_id' => $serviceoption->brand_id,
                            'brandmodel_name' => $serviceoption->carmodel->name,
                            'mrp' => $serviceoption->mrp,
                            'discount_percentage' => $serviceoption->discount_percentage,
                            'discount_amount' => $serviceoption->discount_amount,
                            'price' => $serviceoption->price,
                            'quantity' => $cart_detail->quantity,
                            'total_price' => $serviceoption->price * $cart_detail->quantity,
                        );
                        OrderDetailService::create($orderDetailData);
                        // $product_option->update([
                        //     'stock' => $serviceoption->stock - $cart_detail->quantity
                        // ]);

                        // $product->update([
                        //     'stock' => $product->product_options->SUM('stock')
                        // ]);
                    }
                    $headerdata = HeaderSetting::first();

                    CartServiceDetail::where('cart_id', $cart->id)->delete();
                    $cart->delete();
                    DB::commit();
                    $data['service_id'] = $order->order_number;
                    $data['mobile_number'] = $headerdata->tollfree_number;
                    // $data['delivery_day'] = $order->shipping_type_maximum_days;

                    return response()->json([
                        'success' => true,
                        'data' => $data,
                        'message' => "Get successfully!"
                    ], 200);

                    $data = array('email' => $cus->email, 'password' => $request->password);
                    // Mail::send('website/simple_register',$data, function ($message) use ($emalto) {
                    // $message->from('info@krishnachikanindustry.com', 'Krishna Chikan Industry');
                    // $message->to($emalto)
                    //   ->subject('Order Confirmation');
                    // });

                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 421,
                        'messsge' => 'Something Went Wrong! please try again.',
                        'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
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
            ]);
        }
    }


    public function oilgradeservicebooking(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            // 'shipping_type' => 'required',
            'garage_id' => 'required',
            'package_id' => 'required',
            'package_option_id' => 'required',
            'fuel_type' => 'required',
            'brand_name' => 'required',
            'brandmodel_name' => 'required',
            // 'coupon_code' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $general_setting = SiteGstSetting::firstOrFail();
                $customer = Auth::guard('api')->user();

                $way_of_billing = $request->way_of_billing;
                $paymentMethod = $request->payment_mode;

                // for cash on delivery 
                if ($paymentMethod == 'cod') {


                    if ($way_of_billing == 'billing') {
                        $customer_address = CustomerBillingAddress::where('id', $request->address)->where('customer_id', $customer->id)->firstOrFail();
                    } else {
                        $customer_address = CustomerAddress::where('id', $request->address)->where('customer_id', $customer->id)->firstOrFail();
                    }

                    // $shipping_type = ShippingCost::where('id',$request->shipping_type)->firstOrFail();
                    if ($request->coupon_code) {
                        $coupon = Coupon::where('coupon_code', $request->coupon_code)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->where('status', 'active')->first();
                    }


                    $packageoption = PackageOption::where('id', $request->package_option_id)->firstOrFail();
                    if ($request->coupon_code) {
                        $total_price_after_discount = $packageoption->price - $coupon->discount_amount;

                    } else {
                        $total_price_after_discount = $packageoption->price;

                    }
                    $garage = GarageFranchise::where('id', $request->garage_id)->firstOrFail();
                    $package = Packages::where('id', $request->package_id)->get();
                    $gst_type = 'GST';
                    $igst_percentage = 0;
                    $sgst_percentage = 0;
                    $cgst_percentage = 0;
                    $total_gst_percentage = 0;
                    $igst_amount = 0;
                    $sgst_amount = 0;
                    $cgst_amount = 0;
                    $total_gst_amount = 0;
                    $cart_total_with_gst = 0;
                    $totalQuantity = 1;

                    // shipping cost

                    //  $shippingCost = ShippingCost::where('min_order_value', '<=',$total_price_after_discount)->where('max_order_value', '>=',$total_price_after_discount)->firstOrFail();
                    // $default_shipping_cost = ShippingCost::where('min_order_value', '<=',$total_price_after_discount)->where('max_order_value', '>=',$total_price_after_discount)->firstOrFail();  
                    // shipping cost end 


                    if ($general_setting->state_id == $customer_address->state) {

                        $cgst_percentage = $general_setting->cgst_percent;
                        $sgst_percentage = $general_setting->sgst_percent;
                        $total_gst_percentage = $cgst_percentage + $sgst_percentage;
                        $sgst_amount = $total_price_after_discount * ($sgst_percentage / 100);
                        $cgst_amount = $total_price_after_discount * ($cgst_percentage / 100);
                        $total_gst_amount = $sgst_amount + $cgst_amount;
                        $cart_total_with_gst = $total_price_after_discount + $total_gst_amount;
                        $gst_type = 'CGST + SGST';
                        // $TotalShipCost =   $shippingCost->in_state_charge *  $totalQuantity;
                    } else {

                        $igst_percentage = $general_setting->igst_percent;
                        $total_gst_percentage = $igst_percentage;
                        $igst_amount = $total_price_after_discount * ($igst_percentage / 100);
                        $total_gst_amount = $igst_amount;
                        $cart_total_with_gst = $total_price_after_discount + $total_gst_amount;
                        $gst_type = 'IGST';
                        // $TotalShipCost =   (float)$shippingCost->out_state_charge *  $totalQuantity;
                    }

                    //  $shipping_price = $TotalShipCost;
                    // $cart_total_with_shipping =  $cart_total_with_gst + $shipping_price;

                    while (true) {
                        $order_number = 'SERV' . random_int(100000, 999999);
                        if (!OilgradeOrderService::where('order_number', $order_number)->exists()) {
                            break;
                        }
                    }
                    if ($request->pickup_delivery_date) {
                        $picstatus = "yes";
                    } else {
                        $picstatus = "no";
                    }

                    $orderData = array(
                        'customer_id' => $customer->id,
                        'brand_name' => $request->brand_name,
                        'brandmodel_name' => $request->brandmodel_name,
                        'fuel_type' => $request->fuel_type,
                        'order_number' => $order_number,
                        'total_item_count' => 1,
                        'order_amount' => $packageoption->price,
                        'coupon_id' => Null,
                        'pickup_delivery_time' => $request->pickup_delivery_time,
                        'pickup_delivery_date' => $request->pickup_delivery_date,
                        'pickup_delivery_status' => $picstatus,
                        'coupon_code' => Null,
                        'discount_amount' => 0,
                        'order_amount_after_discount' => $total_price_after_discount,
                        'customer_address_id' => $customer_address->id,
                        'name' => $customer_address->name,
                        'garage_id' => $garage->id,
                        'garage_name' => $garage->name,
                        'garage_email' => $garage->email,
                        'garage_mobile_number' => $garage->mobile_number,
                        'garage_address' => $garage->address,
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
                        'total_gst_percentage' => $total_gst_percentage,
                        'igst_amount' => $igst_amount,
                        'cgst_amount' => $cgst_amount,
                        'sgst_amount' => $sgst_amount,
                        'total_gst_amount' => $total_gst_amount,
                        'order_amount_with_gst' => $cart_total_with_gst,
                        'payment_status' => 'cod',
                        'order_status' => 'New Booking',
                        'transaction_number' => 'TRN' . random_int(100000, 999999),
                        'transaction_detail' => 'Dummy Details',
                    );

                    $order = OilgradeOrderService::create($orderData);
                    foreach ($package as $cart_detail) {
                        $package = Packages::findOrFail($request->package_id);
                        $packageoption = PackageOption::findOrFail($request->package_option_id);
                        $orderDetailData = array(
                            'order_id' => $order->id,
                            'package_id' => $package->id,
                            'package_name' => $package->name,
                            'package_option_id' => $packageoption->id,
                            'oilgrade_id' => $packageoption->oilgrade_id,
                            'oilgrade_name' => $packageoption->oilgrade->title,
                            'brand_name' => $request->brand_name,
                            'cylinder_id' => $packageoption->cylinder_id,
                            'cylinder_name' => $packageoption->cylinder->name,
                            'carorigin_id' => $packageoption->carorigin_id,
                            'carorigin_name' => $packageoption->carorigin->name,
                            'brandmodel_name' => $request->brandmodel_name,
                            'mrp' => $packageoption->mrp,
                            'discount_percentage' => $packageoption->discount_percentage,
                            'discount_amount' => $packageoption->discount_amount,
                            'price' => $packageoption->price,
                            'quantity' => 1,
                            'total_price' => $packageoption->price * $cart_detail->quantity,
                        );
                        OilgradeOrderServiceDetail::create($orderDetailData);
                        // $product_option->update([
                        //     'stock' => $serviceoption->stock - $cart_detail->quantity
                        // ]);
                        // $product->update([
                        //     'stock' => $product->product_options->SUM('stock')
                        // ]);
                    }
                    $headerdata = HeaderSetting::first();

                    //  CartServiceDetail::where('cart_id',1)->delete();
                    //  $cart->delete();
                    // $cart1->delete();
                    DB::commit();
                    $data['service_id'] = $order->order_number;
                    $data['mobile_number'] = $headerdata->tollfree_number;
                    // $data['delivery_day'] = $order->shipping_type_maximum_days;

                    return response()->json([
                        'success' => true,
                        'data' => $data,
                        'message' => "Get successfully!"
                    ], 200);

                    $data = array('email' => $cus->email, 'password' => $request->password);
                    // Mail::send('website/simple_register',$data, function ($message) use ($emalto) {
                    // $message->from('info@krishnachikanindustry.com', 'Krishna Chikan Industry');
                    // $message->to($emalto)
                    //   ->subject('Order Confirmation');
                    // });

                } else {
                    DB::rollback();
                    return response()->json([
                        'success' => false,
                        'code' => 421,
                        'messsge' => 'Something Went Wrong! please try again.',
                        'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
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
            ]);
        }
    }
    // submit order reviews 
    public function submitOrderReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|gt:0',
            'review' => 'required',
            'order_id' => 'required',
            'order_detail_id' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $order_id = $request->order_id;
                $order_detail_id = $request->order_detail_id;
                $customer = Auth::guard('api')->user();
                $order = Order::where('id', $order_id)->where('customer_id', $customer->id)->firstOrFail();
                $order_detail = OrderDetail::where('id', $order_detail_id)->where('order_id', $order->id)->firstOrFail();
                $product = Product::where('id', $order_detail->product_id)->firstOrFail();
                OrderProductReview::updateOrCreate([
                    'order_id' => $order->id,
                    'customer_id' => $customer->id,
                    'order_detail_id' => $order_detail->id,
                    'product_id' => $product->id,
                ], [
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]);
                $product->update([
                    'rating' => round($order->order_product_reviews->avg('rating')),
                ]);
                $order->update([
                    'average_rating' => round($order->order_product_reviews->avg('rating')),
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Thanks for Rating and review'
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


    public function manageproductwithcategory($id = "")
    {
        if ($id) {
            if ($id == "online-store") {
                $obj = Product::with('product_options')->with('product_option_images')->where('status', 'active')->with('categories')->paginate(15);
            } else {
                $category = Category::where('slug', $id)->first();
                if (!$category) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Category Not Found',
                        'data' => [],
                        'paginationdata' => [],
                    ], 404);
                }
                if ($category->parent_id != '') {
                    $obj = Product::where('category_id', $category->parent_id)->where('subcategory_id', $category->id)->with('product_options')->where('status', 'active')->with('product_option_images')->with('categories')->paginate(15);
                } else {
                    $obj = Product::where('category_id', $category->id)->with('product_options')->where('status', 'active')->with('product_option_images')->with('categories')->paginate(15);
                }
            }

        } else {
            $obj = Product::with('product_options')->with('product_option_images')->where('status', 'active')->with('categories')->paginate(15);
        }
        $objsArray = $obj->toArray();
        $data = $objsArray['data'];
        unset($objsArray['data']);

        return response()->json([
            'status' => true,
            'data' => $data,
            'paginationdata' => $objsArray,
            'message' => "Get successfully!"
        ], 200);
    }

    public function filteroilgradepackage(Request $request)
    {
        $obj = PackageOption::where('oilgrade_id', $request->oilgrade_id)->where('cylinder_id', $request->cylinder_id)->where('carorigin_id', $request->carorigin_id)->first();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function getpromotion()
    {
        $obj = Promotion::where('validity', '>=', date('Y-m-d'))->get();
        $obj->makeHidden(['created_at', 'validity', 'updated_at']);
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }

    public function getpincodedata($pincode)
    {
        $obj = Pincode::where('pincode', $pincode)->with('state')->first();
        return response()->json([
            'status' => true,
            'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
    }
    public function applycouponoilgrade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required',
            'total_price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'status_code' => 422,
                'message' => $validator->errors()
            ], 422);
        } else {
            try {
                $user = Auth::guard('api')->user();
                // $user = Customer::where('id',$user1->id)->first();
                // $cart = Cart::where('customer_id',$user->id)->firstOrFail();
                $coupon = Coupon::where('coupon_code', $request->coupon_code)->whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->where('status', 'active')->first();
                if ($coupon) {
                    if ($user->orders->count() < $coupon->number_of_use) {
                        if ($coupon->min_order <= $request->total_price) {
                            $data['coupon_id'] = $coupon->id;
                            $data['discount_amount'] = $coupon->discount_amount;
                            //  $data['coupon_id']=$coupon->id;
                            // $cart->update([
                            //             'coupon_id' => $coupon->id,
                            //             'discount_amount' => $coupon->discount_amount,
                            //             'total_price_after_discount' => $cart->total_price - $coupon->discount_amount,
                            //         ]);

                            return response()->json([
                                'success' => true,
                                'data' => [
                                    'cart' => $data,
                                ],
                            ], 200);
                        } else {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'coupon_code' => [
                                        'Coupon not applicable on total',
                                    ],
                                ],
                            ], 422);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'errors' => [
                                'coupon_code' => [
                                    'This coupon is already availed with the maximum no of limits',
                                ],
                            ],
                        ], 422);
                    }

                } else {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'coupon_code' => [
                                'Invalid Coupon',
                            ],
                        ],
                    ], 422);
                }
            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
                ], 400);
            }
        }
    }

    public function importcity(Request $request)
    {
        $f_pointer = fopen(public_path("Pincode.csv"), 'r');
        $newdata = [];
        while (!feof($f_pointer)) {
            $ar = fgetcsv($f_pointer);
            // print_r($ar);
            if (!empty($ar)) {
                $city1 = $ar[7];
                $pincode = $ar[4];
                $cities = City::where('name', $city1)->first();
                if ($cities) {
                    $data = [
                        'state_id' => $cities->state_id,
                        'city_id' => $cities->id,
                        'pincode' => $pincode,
                    ];
                    $newdata[] = $data;

                }
            }




        }
        Pincode::insert($newdata);
        return response()->json([
            'status' => true,
            // 'data' => $obj,
            'message' => "Get successfully!"
        ], 200);
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


    public function sendMobileOTP(Request $request)
    {
        // Generate a six-digit OTP
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|regex:/^[6-9]\d{9}$/',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => 'Invalid Mobile number'
            ], 422);


        }
        $otp = rand(100000, 999999);
        $mobile_number = $request->mobile;
        OTP::where('mobile', $mobile_number)->delete();

        // Assuming you have a model named OTP for managing OTPs
        OTP::create([
            'mobile' => $mobile_number,
            'otp' => $otp,
            'expiry' => now()->addMinutes(10),
        ]);


        $message = "{$otp} is the OTP to verify your mobile number at https://izharsonperfumers.com, please do not share this OTP with anyone. Regards Izharson Perfumers";

        $dlt_id = '1307175755283644841';
        $pe_id = '1301169510661908409';
        $request_parameter = array(
            'authkey' => '468706Au6g3Hg7oQKn68c3a8c6P1',
            'mobiles' => $mobile_number,
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
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => "Otp Successfully Send on Your mobile number!"
            ], 200);

            // return true;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 422);

            //dd($e->getMessage());
        }
    }


    public function verifyOTP(Request $request)
    {
        $mobile = $request->mobile;
        $otp = $request->otp;

        $isValid = OTP::verifyOTP($mobile, $otp);
        if ($isValid) {
            //OTP::deleteOTP($mobile, $otp);
            return response()->json([
                'success' => true,
                'data' => [],
                'message' => 'Mobile number verified successfully'
            ], 200);

        } else {
            return response()->json([
                'success' => false,
                'errors' => 'Invalid otp'
            ], 422);

        }

    }


    public function manageproductwithcategoryall()
    {

        $obj = Product::with('product_options')->with('product_option_images')->where('status', 'active')->with('categories')->get();



        return response()->json([
            'status' => true,
            'data' => $obj,

            'message' => "Get successfully!"
        ], 200);
    }


}
