<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomepageSetting;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'attarArrivals'
        ));
    }

    public function aboutUs()
    {
        return view('front.about-us');
    }

    public function productDetails()
    {
        return view('front.product-details');
    }

}
