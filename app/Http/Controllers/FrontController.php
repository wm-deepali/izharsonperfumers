<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ContactUsController;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CompanyAddress;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Feedback;
use App\Models\HomepageSetting;
use App\Models\OilGrade;
use App\Models\OrderDetail;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\Wishlist;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        $banner = HomepageSetting::where('id', 2)->first();
        $deliveryBanner1 = HomepageSetting::where('id', 3)->first();
        $deliveryBanner2 = HomepageSetting::where('id', 7)->first();

        $features = \App\Models\HomeFeature::where('status', 1)
            ->orderBy('position')
            ->get();

        $sliders = Slider::latest()
            ->where('status', 'active')
            ->get(['id', 'button_link', 'title', 'sub_title', 'content', 'image', 'color']);

        $categories = Category::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['direct_childs'])
            ->get()
            ->map(function ($category) {

                $childIds = $category->direct_childs->pluck('id');

                $count = Product::where('status', 'active')
                    ->where(function ($q) use ($category, $childIds) {
                        $q->where('category_id', $category->id)
                            ->orWhereIn('subcategory_id', $childIds);
                    })
                    ->count();

                $category->items_count = $count;

                return $category;
            });


        // Premium New Arrivals
        $premiumNewArrivals = Product::with('product_options')
            ->where('is_premium', 'yes')
            ->where('status', 'active')
            ->latest()
            ->take(20)
            ->get();


        // Premium Best Sellers (last 30 days)
        $premiumBestSellers = OrderDetail::select('product_id')
            ->whereHas('order', function ($q) {
                $q->where('created_at', '>=', Carbon::now()->subDays(30));
            })
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product.product_options')
            ->get()
            ->pluck('product')
            ->filter(fn($p) => $p && $p->is_premium === 'yes')
            ->values();


        // Premium Best Rated
        $premiumBestRated = Product::with('product_options', 'product_review')
            ->where('is_premium', 'yes')
            ->where('status', 'active')
            ->get()
            ->sortByDesc(fn($p) => $p->product_review->avg('rating'))
            ->take(20)
            ->values();

        $bestSellers = OrderDetail::select('product_id')
            ->whereHas('order', function ($q) {
                $q->where('created_at', '>=', Carbon::now()->subDays(30));
            })
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with(['product.product_options', 'product.categories'])
            ->take(20)
            ->get()
            ->pluck('product');


        // Attars category best sellers
        $attarBestSellers = $bestSellers->filter(function ($product) {
            return optional($product->categories)->name === 'Attars';
        });

        // Perfumes category best sellers
        $perfumeBestSellers = $bestSellers->filter(function ($product) {
            return optional($product->categories)->name === 'Perfumes';
        });

        // get 3 categories for tabs
        $tabCategories = Category::whereIn('name', ['Attars', 'Perfumes', 'Gifts and Kits'])
            ->where('status', 'active')
            ->get();

        $categoryProducts = [];

        foreach ($tabCategories as $category) {
            $categoryProducts[$category->id] = Product::where('category_id', $category->id)
                ->where('status', 'active')
                ->with('product_options')
                ->latest()
                ->take(12)   // ✅ 12 per category from DB
                ->get();
        }

        $newArrivals = Product::with('product_options')
            ->where('new_arrivals', 'yes')
            ->where('status', 'active')
            ->latest()
            ->take(12)
            ->get();

        $topSellingArrivals = OrderDetail::select('product_id')
            ->whereHas('order', function ($q) {
                $q->where('created_at', '>=', Carbon::now()->subDays(30));
            })
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product.product_options')
            ->take(12)
            ->get()
            ->pluck('product');

        $attarArrivals = Product::with('product_options')
            ->whereHas('categories', function ($q) {
                $q->where('name', 'Attars');
            })
            ->where('status', 'active')
            ->latest()
            ->take(12)
            ->get();

        $dealProducts = Product::activeDeals()
            ->with('product_options')
            ->where('status', 'active')
            ->latest()
            ->take(12)
            ->get();

        $maxDealEnd = $dealProducts->max('deal_end');

        $wishlistIds = [];

        if (auth()->guard('customer')->check()) {
            $wishlistIds = Wishlist::where('customer_id', auth()->guard('customer')->id())
                ->pluck('product_id')
                ->map(fn($id) => (int) $id)
                ->toArray();
        }
        return view('front.index', compact(
            'banner',
            'deliveryBanner1',
            'deliveryBanner2',
            'features',
            'sliders',
            'categories',
            'premiumNewArrivals',
            'premiumBestSellers',
            'premiumBestRated',
            'bestSellers',
            'attarBestSellers',
            'perfumeBestSellers',
            'tabCategories',
            'categoryProducts',
            'newArrivals',
            'topSellingArrivals',
            'attarArrivals',
            'dealProducts',
            'maxDealEnd',
            'wishlistIds'
        ));
    }

    public function suggestions(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->q . '%')
            ->with('product_options')
            ->where('status', 'active')
            ->take(5)
            ->get(['name', 'slug', 'image', 'min_price']);

        return response()->json($products);
    }

    public function productList(Request $request, $categorySlug = null, $subSlug = null)
    {
        /*
        |--------------------------------------------------------------------------
        | Parent Categories (Top Menu)
        |--------------------------------------------------------------------------
        */
        $categories = Category::whereNull('parent_id')
            ->where('status', 'active')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Detect Category & Subcategory
        |--------------------------------------------------------------------------
        */
        $currentCategory = null;
        $currentSubcategory = null;

        if ($categorySlug) {
            $currentCategory = Category::where('slug', $categorySlug)->first();
        }

        if ($subSlug && $currentCategory) {
            $currentSubcategory = Category::where('slug', $subSlug)
                ->where('parent_id', $currentCategory->id)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Base Product Query
        |--------------------------------------------------------------------------
        */
        $products = Product::where('status', 'active')
            ->with('product_options');

        /*
        |--------------------------------------------------------------------------
        | Category Filtering
        |--------------------------------------------------------------------------
        */
        if ($currentSubcategory) {

            $products->where('subcategory_id', $currentSubcategory->id);

        } elseif ($currentCategory) {

            $childIds = $currentCategory->active_direct_childs()->pluck('id');

            $products->where(function ($q) use ($currentCategory, $childIds) {
                $q->where('category_id', $currentCategory->id)
                    ->orWhereIn('subcategory_id', $childIds);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | 🔎 SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->q) {
            $products->where('name', 'LIKE', '%' . $request->q . '%');
        }

        /*
        |--------------------------------------------------------------------------
        | 💰 PRICE FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->price) {
            $products->where(function ($q) use ($request) {
                foreach ($request->price as $range) {

                    if ($range == '0-500') {
                        $q->orWhereBetween('min_price', [0, 500]);
                    }

                    if ($range == '500-1000') {
                        $q->orWhereBetween('min_price', [500, 1000]);
                    }

                    if ($range == '1000-3000') {
                        $q->orWhereBetween('min_price', [1000, 3000]);
                    }

                    if ($range == '3000+') {
                        $q->orWhere('min_price', '>', 3000);
                    }
                }
            });
        }

        /*
        |--------------------------------------------------------------------------
        | 🏷 BRAND FILTER
        |--------------------------------------------------------------------------
        */
        // if ($request->brand) {
        //     $products->whereHas('product_options', function ($q) use ($request) {
        //         $q->whereIn('brand_id', $request->brand);
        //     });
        // }

        /*
        |--------------------------------------------------------------------------
        | 📦 PACK SIZE FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->size) {
            $products->whereHas('product_options.packaging', function ($q) use ($request) {
                $q->whereIn('id', $request->size);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | 🌸 FRAGRANCE FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->fragrance) {
            $products->whereJsonContains('fragrance', $request->fragrance);
        }

        /*
        |--------------------------------------------------------------------------
        | 🔥 DEAL FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->deal) {
            $products->activeDeals();
        }

        /*
        |--------------------------------------------------------------------------
        | ⭐ RATING FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->rating) {
            $products->where('rating', '>=', $request->rating);
        }

        /*
|--------------------------------------------------------------------------
| Sorting
|--------------------------------------------------------------------------
*/
        if ($request->sort == 'latest') {
            $products->latest();
        }

        if ($request->sort == 'price_low') {
            $products->orderBy('min_price', 'asc');
        }

        if ($request->sort == 'price_high') {
            $products->orderBy('min_price', 'desc');
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $perPage = $request->perPage ?? 12;
        $products = $products->latest()
            ->paginate($perPage)
            ->withQueryString();

        // dd($products->toArray());
        /*
        |--------------------------------------------------------------------------
        | Sidebar Subcategories
        |--------------------------------------------------------------------------
        */
        $subcategories = collect();

        if ($currentCategory) {
            $subcategories = $currentCategory->active_direct_childs()
                ->withCount('productssn')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | ⭐ BEST SELLERS (Optimized)
        |--------------------------------------------------------------------------
        */
        $bestSellers = OrderDetail::select('product_id')
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->whereHas('product', function ($q) use ($currentCategory, $currentSubcategory) {

                if ($currentSubcategory) {
                    $q->where('subcategory_id', $currentSubcategory->id);
                } elseif ($currentCategory) {
                    $q->where(function ($sub) use ($currentCategory) {
                        $sub->where('category_id', $currentCategory->id)
                            ->orWhere('subcategory_id', $currentCategory->id);
                    });
                }

            })
            ->with('product.product_options')
            ->limit(6)
            ->get()
            ->pluck('product')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Filter Data for Sidebar
        |--------------------------------------------------------------------------
        */
        $packSizes = Brand::where('status', 'active')
            ->orderByRaw('CAST(quantity AS DECIMAL(10,2)) ASC')
            ->get();

        $fragranceTypes = OilGrade::where('status', 'active')->get();
        $shopBanners = HomepageSetting::where('page', 'shop')->get();

        $wishlistIds = [];

        if (auth()->guard('customer')->check()) {
            $wishlistIds = Wishlist::where('customer_id', auth()->guard('customer')->id())
                ->pluck('product_id')
                ->map(fn($id) => (int) $id)
                ->toArray();
        }
        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view('front.shop', compact(
            'categories',
            'currentCategory',
            'currentSubcategory',
            'subcategories',
            'bestSellers',
            'products',
            'packSizes',
            'fragranceTypes',
            'shopBanners',
            'wishlistIds'
        ));
    }

    public function subscribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json([
            'status' => true,
            'message' => "You successfully subscribed!"
        ]);
    }

    public function productDetails($slug)
    {
        $product = Product::with(['product_options', 'categories', 'subcategories'])
            ->where('slug', $slug)
            ->firstOrFail();

        // dd($product->toArray());

        /*
        |--------------------------------------------------------------------------
        | Related Products (same subcategory/category)
        |--------------------------------------------------------------------------
        */
        $relatedProducts = Product::where('status', 'active')
            ->where('id', '!=', $product->id)
            ->when($product->subcategory_id, function ($q) use ($product) {
                $q->where('subcategory_id', $product->subcategory_id);
            }, function ($q) use ($product) {
                $q->where('category_id', $product->category_id);
            })
            ->latest()
            ->take(12)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | You May Also Like (random products)
        |--------------------------------------------------------------------------
        */
        $recommendedProducts = Product::where('status', 'active')
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(12)
            ->get();

        $wishlistIds = [];

        if (auth()->guard('customer')->check()) {
            $wishlistIds = Wishlist::where('customer_id', auth()->guard('customer')->id())
                ->pluck('product_id')
                ->map(fn($id) => (int) $id)
                ->toArray();
        }
        // dd($relatedProducts->toArray());

        $canReview = false;
        $orderId = null;
        $orderDetailId = null;

        if (auth()->guard('customer')->check()) {

            $customerId = auth()->guard('customer')->id();

            $orderDetail = OrderDetail::whereHas('order', function ($q) use ($customerId) {
                $q->where('customer_id', $customerId);
                // ->where('order_status', 'Delivered'); // optional
            })
                ->where('product_id', $product->id)
                ->latest() // get latest purchase (important)
                ->first();

            if ($orderDetail) {
                $canReview = true;
                $orderId = $orderDetail->order_id;
                $orderDetailId = $orderDetail->id;
            }
        }

        return view('front.product-details', compact(
            'product',
            'relatedProducts',
            'recommendedProducts',
            'wishlistIds',
            'canReview',
            'orderId',
            'orderDetailId',
        ));
    }

    public function aboutUs()
    {
        $about = AboutUs::first();
        $team = Team::get();
        $feedbacks = Feedback::get();
        $features = \App\Models\HomeFeature::where('status', 1)
            ->orderBy('position')
            ->get();
        // dd($feedback->toArray());
        return view('front.about-us', compact('about', 'team', 'feedbacks', 'features'));
    }


    public function faqs()
    {
        $faqs = Faq::with('faq_category')
            ->latest()
            ->get()
            ->groupBy(function ($faq) {
                return $faq->faq_category->name ?? 'General';
            });

        return view('front.faqs', compact('faqs'));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->where('status', 'active')->paginate(9);
        return view('front.blogs', compact('blogs'));
    }

    public function blogDetail($url)
    {
        $blog = Blog::where('url', $url)->firstOrFail();

        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(5)
            ->get();

        return view('front.blog_detail', compact('blog', 'recentBlogs'));
    }

    public function addtoWishlist(Request $request)
    {
        $customerId = auth()->guard('customer')->id();

        if (!$customerId) {
            return response()->json([
                'status' => 'login_required'
            ]);
        }

        $productId = $request->product_id;

        $wishlist = Wishlist::where([
            'customer_id' => $customerId,
            'product_id' => $productId
        ])->first();

        if ($wishlist) {

            $wishlist->delete();

            return response()->json([
                'status' => 'removed'
            ]);

        } else {

            Wishlist::create([
                'customer_id' => $customerId,
                'product_id' => $productId
            ]);

            return response()->json([
                'status' => 'added'
            ]);
        }
    }

    public function wishlist()
    {
        $customerId = auth()->guard('customer')->id();

        if (!$customerId) {
            return redirect()->route('customer.login');
        }

        $wishlistItems = Wishlist::where('customer_id', $customerId)
            ->with('product.product_options')
            ->get();

        return view('customer.wishlist', compact('wishlistItems'));
    }

    public function removeFromWishlist(Request $request)
    {
        $wishlist = Wishlist::where('customer_id', auth()->guard('customer')->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function contactUs()
    {
        $branches = CompanyAddress::where('status', 'active')
            ->with('countries:id,name', 'states:id,name', 'cities:id,name')
            ->get();

        $features = \App\Models\HomeFeature::where('status', 1)
            ->orderBy('position')
            ->get();

        $faqs = Faq::latest()
            ->get();

        $settings = \App\Models\HeaderSetting::first();
        $socialLinks = \App\Models\SocialLinkSetting::first();

        // dd($branches->toArray());
        return view('front.contact-us', compact('branches', 'features', 'faqs', 'settings', 'socialLinks'));
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile_number' => 'required|digits:10',
            'message' => 'required'
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function feedback()
    {
        return view('front.feedback');
    }

    public function feedbackStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile_number' => 'required',
            'rating' => 'required',
            'message' => 'required'
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('feedback', 'public');
        }

        Feedback::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'rating' => $request->rating,
            'image' => $image,
            'message' => $request->message,
            'status' => 'block'
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function privacyPolicy()
    {
        $policy = Policy::where('name', 'privacy_policy')->first();
        return view('front.privacy-policy', compact('policy'));
    }

    public function termsConditions()
    {
        $policy = Policy::where('name', 'terms_and_condition')->first();
        return view('front.terms', compact('policy'));
    }

    public function refundPolicy()
    {
        $policy = Policy::where('name', 'refund_policy')->first();
        return view('front.refund-policy', compact('policy'));
    }

    public function cookiePolicy()
    {
        $policy = Policy::where('name', 'cookie_policy')->first();
        return view('front.cookie-policy', compact('policy'));
    }

    public function shipppingPolicy()
    {
        $policy = Policy::where('name', 'shipping_policy')->first();
        return view('front.shipping-policy', compact('policy'));
    }

}


