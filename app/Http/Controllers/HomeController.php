<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HeaderSetting;
use App\Models\SocialLinkSetting;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\ProductOptionImage;
use App\Models\Color;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Brand;
use App\Models\Feedback;
use Illuminate\Support\Arr;

use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function homepage(){
         $blogs = Blog::where('status', 1)->orderBy('created_at','DESC')->get();
         $premiumProducts = Product::where('is_premium','=','yes')->where('status','=','active')->get();
         $hotdeals = Product::where('is_hotDeals','=','yes')->where('status','=','active')->orderBy('created_at','DESC')->get();

         $topSoldproduct= Product::where('is_bestSales','=','yes')->where('status','=','active')->orderBy('created_at','DESC')->get();
         $newProducts= Product::where('status','=','active')->orderBy('created_at','DESC')->get();
         $toprated= Product::where('status','=','active')->orderBy('rating','DESC')->get();
         $mostPopular= Product::where('is_popular','=','yes')->where('status','=','active')->orderBy('created_at','DESC')->get();
         $banner = Slider::where('status','=','active')->get();    
         $ourProduct = Category::whereNull('parent_id')->where('status','active')->get();
         $testimonials = DB::table('feedback')
                        ->join('customers', 'customers.id', '=', 'feedback.customer_id')
                        ->get();
                 
    return view('homepage',compact('ourProduct','banner','blogs','premiumProducts','hotdeals','topSoldproduct','newProducts','toprated','mostPopular','testimonials'));
    }

// get all specific category data 
    public function getCatgoryData($id){

            $categoryData = DB::table('product_categories')->where('category_id',$id)->get();
            $productData = DB::table('products')->where('status','active')->get();
        
            
        return view ('frontend.category_data', compact('categoryData','productData'));

    }

 public function listing( Request $request){

    $r = $request->all();
    //dd($r);
     $sidebarData = Category::whereNull('parent_id')->where('status','active')->get();
   
       $filter_search = $request->search ?? Null;
      
            if($filter_search) {
                $request->session()->push('searches', $filter_search);
            }
            $filter_category = $request->category ?? Null;
            $filter_price_range = $request->price_range ?? Null;
         
                 $output = explode("-",$filter_price_range);
                 $filter_price_range_start = current($output);
                 $filter_price_range_end = next($output);
        
        
            $filter_color = $request->color ?? Null;
            $filter_attributes = $request->option_attributes ?? Null;
            $filter_brands = $request->brands ?? Null;
            $filter_fabric = $request->fabric_type ?? Null;
            $filter_discount = $request->discounts ?? Null;
            $filter_rating = $request->rating ?? Null;
// new data for query 
           
        // filter products data start from here 

             $productData = Product::latest()->when($filter_search, function ($query, $filter_search) {
                return $query->where('name', 'like', '%'.$filter_search.'%');
            })->when($filter_category, function ($query, $filter_category) {
                $category = Category::where('slug',$filter_category)->first();
                $category_child_ids[] = $category->active_get_all_childrens()->pluck('id')->toArray();
                $category_child_ids = Arr::prepend($category_child_ids,$category->id);
                $all_category_child_ids = Arr::flatten($category_child_ids);
                return $query->whereHas('categories',function($query) use($all_category_child_ids) {
                    $query->whereIn('category_id',$all_category_child_ids);
                });
            })->when($filter_fabric, function ($query, $filter_fabric) {
                return $query->where('fabric','=',$filter_fabric);
            })->when($filter_color, function ($query, $filter_color) {
                return $query->whereHas('product_options',function($query) use($filter_color) {
                    $query->whereIn('color_id',explode(',',$filter_color));
                });
            })->when($filter_attributes, function ($query, $filter_attributes) {
                return $query->whereHas('product_options',function($query) use($filter_attributes) {
                    $query->whereIn('attribute_1_id',explode(',',$filter_attributes))->orWhere(function($query) use($filter_attributes){
                        $query->whereIn('attribute_2_id',explode(',',$filter_attributes));
                    });
                });
            })->when($filter_price_range_start, function ($query, $filter_price_range_start) {
                return $query->where('min_price','>=',$filter_price_range_start);
            })->when($filter_price_range_end, function ($query, $filter_price_range_end) {
                return $query->where('min_price','<=',$filter_price_range_end);
            })->when($filter_rating, function ($query, $filter_rating) {
                return $query->where('rating',$filter_rating);
            })->when($filter_brands, function ($query, $filter_brands) {
                return $query->whereIn('brand_id',explode(',',$filter_brands));
            })->where('status','active')->get();


            $product_ids = [];
            $brand_ids = [];
            $parent_attribute_ids = [];
            $color_ids = [];
            $attribute_ids = [];
            foreach($productData as $product) {
                $product_ids[] = $product->id;
                $brand_ids[] = $product->brand_id;
                $parent_attribute_ids[] = $product->attribute_1_id;
                $parent_attribute_ids[] = $product->attribute_2_id;
                $product_options = ProductOption::where('product_id',$product->id)->get();
                foreach($product_options as $product_option) {
                    $color_ids[] = $product_option->color_id;
                    $attribute_ids[] = $product_option->attribute_1_id;
                    $attribute_ids[] = $product_option->attribute_2_id;
                }
            }
           
          $colors = Color::wherenotNull('code')->get();
          $fabrics = Product::select('fabric')->distinct()->get();
        
          $brands = Brand::where('status','active')->get();

          $attributes = Attribute::wherenotNull('parent_id')->get();
        
// end here 
           
         
        return view ('frontend.category_data', compact('sidebarData','productData','filter_category','fabrics','filter_fabric','filter_price_range','filter_color','colors','filter_attributes','attributes','brands','filter_brands'));


    }

// get the single product details
    public function productsdetails($slug){     
        
            $product = Product::where('slug',$slug)->where('status','active')->firstOrFail();
            $images = ProductOptionImage::where('product_id',$product->id)->get();
            $product_category_ids = ProductCategory::where('product_id',$product->id)->pluck('category_id')->toArray();
            $default_product_option = ProductOption::where('product_id',$product->id)->orderBy('price','ASC')->where('stock','>',0)->first();
            $product_options = ProductOption::where('product_id',$product->id)->get();

            $parent_attribute_ids = array_filter([$product->attribute_1_id,$product->attribute_2_id]);

            $attribute_ids = [];
            foreach($product_options as $product_option) {
                $attribute_ids[] = $product_option->attribute_1_id;
                $attribute_ids[] = $product_option->attribute_2_id;
            }

            $color_ids = [];
            foreach($product_options as $product_option) {
                $color_ids[] = $product_option->color_id;
                
            }

            $colors = Color::whereIn('id',$color_ids)->get();
            $attributes = Attribute::whereIn('id',$parent_attribute_ids)->with(['direct_childs' => function($query) use($attribute_ids){
                $query->whereIn('id',array_values(array_filter($attribute_ids)));
            }])->get();
            $searched_products = [];
       
        $recentProducts= Product::where('status','=','active')->orderBy('id','DESC')->take(4)->get();
        $relatedProduct = ProductCategory::where('category_id', $product_category_ids)
                 ->where('product_id', '!=', $product->id)
                 ->inRandomOrder()->take(4)->get();
    
    
         return view('frontend.product_details',compact('product','default_product_option','colors','attributes','searched_products','recentProducts','images','relatedProduct'));

    }

//get best selling products 
    public function getBestSales( Request $request){
              
                // filter data
                 $filter_search = $request->search ?? Null;
      
            if($filter_search) {
                $request->session()->push('searches', $filter_search);
            }
            $filter_category = $request->category ?? Null;
            $filter_price_range = $request->price_range ?? Null;
         
                 $output = explode("-",$filter_price_range);
                 $filter_price_range_start = current($output);
                 $filter_price_range_end = next($output);
        
        
            $filter_color = $request->color ?? Null;
            $filter_attributes = $request->option_attributes ?? Null;
            $filter_brands = $request->brands ?? Null;
            $filter_fabric = $request->fabric_type ?? Null;
            $filter_discount = $request->discounts ?? Null;
            $filter_rating = $request->rating ?? Null;


              $productData = Product::latest()->when($filter_search, function ($query, $filter_search) {
                return $query->where('name', 'like', '%'.$filter_search.'%');
            })->when($filter_category, function ($query, $filter_category) {
                $category = Category::where('slug',$filter_category)->first();
                $category_child_ids[] = $category->active_get_all_childrens()->pluck('id')->toArray();
                $category_child_ids = Arr::prepend($category_child_ids,$category->id);
                $all_category_child_ids = Arr::flatten($category_child_ids);
                return $query->whereHas('categories',function($query) use($all_category_child_ids) {
                    $query->whereIn('category_id',$all_category_child_ids);
                });
            })->when($filter_fabric, function ($query, $filter_fabric) {
                return $query->where('fabric','=',$filter_fabric);
            })->when($filter_color, function ($query, $filter_color) {
                return $query->whereHas('product_options',function($query) use($filter_color) {
                    $query->whereIn('color_id',explode(',',$filter_color));
                });
            })->when($filter_attributes, function ($query, $filter_attributes) {
                return $query->whereHas('product_options',function($query) use($filter_attributes) {
                    $query->whereIn('attribute_1_id',explode(',',$filter_attributes))->orWhere(function($query) use($filter_attributes){
                        $query->whereIn('attribute_2_id',explode(',',$filter_attributes));
                    });
                });
            })->when($filter_price_range_start, function ($query, $filter_price_range_start) {
                return $query->where('min_price','>=',$filter_price_range_start);
            })->when($filter_price_range_end, function ($query, $filter_price_range_end) {
                return $query->where('min_price','<=',$filter_price_range_end);
            })->when($filter_rating, function ($query, $filter_rating) {
                return $query->where('rating',$filter_rating);
            })->when($filter_brands, function ($query, $filter_brands) {
                return $query->whereIn('brand_id',explode(',',$filter_brands));
            })->where('status','active')->get();


            $product_ids = [];
            $brand_ids = [];
            $parent_attribute_ids = [];
            $color_ids = [];
            $attribute_ids = [];
            foreach($productData as $product) {
                $product_ids[] = $product->id;
                $brand_ids[] = $product->brand_id;
                $parent_attribute_ids[] = $product->attribute_1_id;
                $parent_attribute_ids[] = $product->attribute_2_id;
                $product_options = ProductOption::where('product_id',$product->id)->get();
                foreach($product_options as $product_option) {
                    $color_ids[] = $product_option->color_id;
                    $attribute_ids[] = $product_option->attribute_1_id;
                    $attribute_ids[] = $product_option->attribute_2_id;
                }
            }
           
         $colors = Color::wherenotNull('code')->get();
         $attributes = Attribute::wherenotNull('parent_id')->get();
          $brands = Brand::where('status','active')->get();

                //end filter data 

               
                $sidebarData = Category::whereNull('parent_id')->where('status','active')->get();
                 $fabrics = Product::select('fabric')->distinct()->get();
                $bestSelling= Product::where('is_bestSales','=','yes')->where('status','=','active')->orderBy('created_at','DESC')->get();  
            return view('frontend.best_selling', compact('bestSelling','sidebarData','fabrics','filter_category','filter_fabric','filter_price_range','filter_color','filter_attributes','colors','attributes','brands','filter_brands')) ;

                
       }

// fetch product by size
    public function fetchProductOptionByAttribute(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'child_attribute_ids' => 'required',
        ]);
        if ($validator->passes()) {
            try {
                $product = Product::findOrFail($request->product_id);
                $product_options = ProductOption::where('product_id',$product->id)->get();
                $images = ProductOptionImage::where('product_id',$product->id)->get();
              
                $child_attribute_ids = explode(',',$request->child_attribute_ids);           
                 $default_product_option = ProductOption::where('product_id',$product->id)->where('attribute_1_id',$child_attribute_ids)->orderBy('price','ASC')->where('stock','>',0)->first();

                    $color_ids = [];
            foreach($product_options as $product_option) {
                $color_ids[] = $product_option->color_id;
                
            }

                $colors = Color::whereIn('id',$color_ids)->get();


                return response()->json([
                    'success' => true,
                    'color_id' => $default_product_option->color_id,
                    'images' =>  $images,
                    'parent_attribute_1_id' => $default_product_option->attribute_1->parent_id,
                    'attribute_1_id' => $default_product_option->attribute_1_id,
                    'parent_attribute_2_id' => $default_product_option->attribute_2->parent_id ?? Null,
                    'attribute_2_id' => $default_product_option->attribute_2_id,
                    'stock' => $default_product_option->stock,
                    "image_html" => view('frontend.product.ajax.image-slider-options')->with([
                        'images' => $images,
                    ])->render(),
                    "price_html" => view('frontend.product.ajax.product-price')->with([
                        'default_product_option' => $default_product_option
                    ])->render(),
                    "color_html" => view('frontend.product.ajax.product-color')->with([
                        'colors' => $colors,
                        'default_product_option' => $default_product_option,
                    ])->render(),
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

    // // getProduct by color 
   public function fetchProductOptionByColor(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'child_attribute_ids' => 'required',
        ]);
        //dd($request->all());
        if ($validator->passes()) {
            try {
                $product = Product::findOrFail($request->product_id);
                $color = Color::findOrFail($request->color_id);
                $child_attribute_ids = explode(',',$request->child_attribute_ids);
                 $images = ProductOptionImage::where('product_id',$product->id)->get();
            
                 $default_product_option = ProductOption::where('product_id',$product->id)->where('color_id',$color->id)->where('stock','>',0)->orderBy('price','ASC')->first();
             

                return response()->json([
                    'success' => true,
                    'parent_attribute_1_id' => $default_product_option->attribute_1->parent_id,
                    'attribute_1_id' => $default_product_option->attribute_1_id,
                    'parent_attribute_2_id' => $default_product_option->attribute_2->parent_id ?? Null,
                    'attribute_2_id' => $default_product_option->attribute_2_id,
                    'stock' => $default_product_option->stock,
                    "image_html" => view('frontend.product.ajax.image-slider-options')->with([
                        'images' =>  $images
                    ])->render(),
                    "price_html" => view('frontend.product.ajax.product-price')->with([
                        'default_product_option' => $default_product_option
                    ])->render(),
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
   

}
