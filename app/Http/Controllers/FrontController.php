<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\HomepageSetting;
use App\Models\OilGrade;
use App\Models\OrderDetail;
use App\Models\Packages;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Subscriber;
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
            ->with([
                'productsn',              // products in parent
                'direct_childs.productssn' // products in subcategories
            ])
            ->get()
            ->map(function ($category) {

                $subcategoryProducts =
                    $category->direct_childs->sum(fn($child) => $child->productssn->count());

                $category->items_count =
                    $subcategoryProducts + $category->productsn->count();

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
            'maxDealEnd'
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
        $perPage = $request->perPage ?? 20;
        $products = $products->latest()
            ->paginate($perPage)
            ->withQueryString();

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
            ->whereHas('order', fn($q) => $q->where('created_at', '>=', now()->subDays(30)))
            ->selectRaw('SUM(quantity) as total_sold')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->with('product.product_options')
            ->limit(20)
            ->get()
            ->pluck('product');

        // filter best sellers
        if ($currentSubcategory) {
            $bestSellers = $bestSellers->where('subcategory_id', $currentSubcategory->id);
        } elseif ($currentCategory) {
            $bestSellers = $bestSellers->filter(
                fn($p) =>
                $p->category_id == $currentCategory->id ||
                $p->subcategory_id == $currentCategory->id
            );
        }

        $bestSellers = $bestSellers->take(4)->values();

        /*
        |--------------------------------------------------------------------------
        | Filter Data for Sidebar
        |--------------------------------------------------------------------------
        */
        $packSizes = Brand::where('status', 'active')->get();
        $fragranceTypes = OilGrade::where('status', 'active')->get();
        $shopBanners = HomepageSetting::where('page', 'shop')->get();
        // dd($shopBanners->toArray());
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
            'shopBanners'
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

        return view('front.product-details', compact(
            'product',
            'relatedProducts',
            'recommendedProducts'
        ));
    }

    public function aboutUs()
    {
        return view('front.about-us');
    }

}
