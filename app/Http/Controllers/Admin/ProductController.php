<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductOptionImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\BrandModel;
use App\Models\OilGrade;
use App\Models\ProductVariantImage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Resize + compress an uploaded image and store TWO versions:
     * - "full": used on the product detail page (zoom, popup, thumbnail rail)
     * - "thumb": used everywhere the image is shown small (listing/grid cards,
     *   home page, category page, best-seller cards) so the browser never
     *   downloads a 1200px image just to shrink it with CSS.
     *
     * Mimics what platforms like Shopify do server-side so a heavy client
     * upload (2-8MB) never gets served as-is to the storefront.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @return array{full: string, thumb: string}  stored relative paths
     */
    private function optimizeAndStore($file, string $folder): array
    {
        $uuid = Str::uuid();
        $folder = trim($folder, '/');

        // Load once, orientate once — reused for both encodes below
        $source = Image::make($file->getRealPath());
        $source->orientate();

        // ---- Full version (product detail page / zoom) ----
        $full = clone $source;
        $full->resize(1600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $fullPath = $folder . '/' . $uuid . '.webp';
        Storage::disk('public')->put($fullPath, (string) $full->encode('webp', 90));

        // ---- Thumbnail version (listing/grid cards) ----
        $thumb = clone $source;
        $thumb->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbPath = $folder . '/' . $uuid . '-thumb.webp';
        Storage::disk('public')->put($thumbPath, (string) $thumb->encode('webp', 75));

        return ['full' => $fullPath, 'thumb' => $thumbPath];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::latest()->with('product_categories')->with('categories')->get();
            return response()->json([
                "success" => true,
                "html" => view('admin.products.ajax.index')->with([
                    'products' => $products,
                ])->render(),
            ]);
        } else {
            $products = Product::latest()->get();
            return view('admin.products.index')->with([
                'products' => $products
            ]);
        }
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        $brands = Brand::all();
        $attributes = Attribute::whereNull('parent_id')->get();
        $fragrance = OilGrade::where('status', 'active')->get();

        return view('admin.products.create')->with([
            'categories' => $categories,
            'brands' => $brands,
            'attributes' => $attributes,
            'fragrances' => $fragrance
        ]);
    }

    public function generateProductRowByAttributes(Request $request)
    {
        try {
            $attributes = array_filter(explode(',', $request->attribute_options));
            $attribute_name_1 = '';
            $attribute_1_childs = Null;
            $attribute_name_2 = '';
            $attribute_2_childs = Null;
            if (count($attributes) <= 2) {
                if (isset($attributes[0])) {
                    $attribute_1 = Attribute::findOrFail($attributes[0]);
                    $attribute_1_child_ids[] = $attribute_1->all_childs()->pluck('id')->toArray();
                    $all_attribute_1_child_ids = Arr::flatten($attribute_1_child_ids);
                    $attribute_name_1 = $attribute_1->name;
                    $attribute_1_childs = Attribute::whereIn('id', $all_attribute_1_child_ids)->get();
                }
                if (isset($attributes[1])) {
                    $attribute_2 = Attribute::findOrFail($attributes[1]);
                    $attribute_2_child_ids[] = $attribute_2->all_childs()->pluck('id')->toArray();
                    $all_attribute_2_child_ids = Arr::flatten($attribute_2_child_ids);
                    $attribute_name_2 = $attribute_2->name;
                    $attribute_2_childs = Attribute::whereIn('id', $all_attribute_2_child_ids)->get();
                }
                $colors = Color::all();
                return response()->json([
                    'success' => true,
                    'html' => view('admin.products.ajax.product-row')->with([
                        'colors' => $colors,
                        'attribute_name_1' => $attribute_name_1,
                        'attribute_1_childs' => $attribute_1_childs,
                        'attribute_name_2' => $attribute_name_2,
                        'attribute_2_childs' => $attribute_2_childs
                    ])->render()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'code' => '422',
                    'errors' => [
                        'attributes' => [
                            '0' => 'Select Max 2'
                        ]
                    ]
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage() . '-' . $ex->getLine(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'category' => 'required',
            'name' => 'required|min:3|max:155|regex:/^[\pL\s\-]+$/u',
            'slug' => 'required|max:255|unique:products,slug',
            'alert_quantity' => 'required|digits_between:1,4',
            'youtube_code' => 'nullable|url',
            'product_code' => 'required|alpha_num|min:5|max:20',
            // raised to 8MB so the client can still upload a large photo —
            // it gets resized/compressed server-side before it's ever stored
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'status' => 'required',
            'is_premium' => 'required',
            'is_hotDeals' => 'required',
            'is_popular' => 'required',
            'has_cash_on_delivery' => 'required',
            'allow_rating' => 'required',
            'short_description' => 'min:30|max:1555|required|string',
            'description' => 'required|min:30|max:1555|string',
            'additional_information' => 'required|min:30|max:1555|string',
            'shipping_information' => 'required|min:30|max:1555|string',
            'terms_condition' => 'required|min:30|max:1555|string',
            'variant_options' => 'required',
            'stock.*' => 'required',
            'mrp.*' => 'required',
            'price.*' => 'required',
            'discount.*' => 'required',
            'brand.*' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $attribute_1 = Null;
                $attribute_1_id = $request->category;
                $attribute_2 = Null;
                $attribute_2_id = Null;
                $variant_options = json_decode($request->variant_options, true);

                $min_mrp = min($variant_options[0]['mrp']);
                $max_mrp = max($variant_options[0]['mrp']);
                $min_price = min($variant_options[0]['price']);
                $max_price = max($variant_options[0]['price']);
                $min_disc_prcnt = min($variant_options[0]['discount_percentage']);
                $max_disc_prcnt = max($variant_options[0]['discount_percentage']);

                $mainImage = $this->optimizeAndStore($request->image, 'products');

                $product = Product::create([
                    'name' => $request->name,
                    'product_code' => $request->product_code,
                    'slug' => $request->slug,
                    'image' => $mainImage['full'],
                    'image_thumb' => $mainImage['thumb'],
                    'short_description' => $request->short_description,
                    'additional_information' => $request->additional_information,
                    'shipping_information' => $request->shipping_information,
                    'description' => $request->description,
                    'subcategory_id' => $request->subcategory_id,
                    'youtube_code' => $request->youtube_code,
                    'alert_quantity' => $request->alert_quantity,
                    'is_premium' => $request->is_premium,
                    'is_bestSales' => $request->is_bestSales,
                    'top_selling' => $request->top_selling,
                    'is_hotDeals' => $request->is_hotDeals,
                    'is_popular' => $request->is_popular,
                    'new_arrivals' => $request->new_arrivals,
                    'is_top' => $request->is_top,
                    'has_cash_on_delivery' => $request->has_cash_on_delivery,
                    'allow_rating' => $request->allow_rating,
                    'replacement_waranty' => $request->replacement_waranty,
                    'cancellation_allowed' => $request->cancellation_allowed,
                    'express_sheeping' => $request->express_sheeping,
                    'terms_condition' => $request->terms_condition,
                    'part_number' => $request->part_number,
                    'variant_options' => $request->variant_options,
                    'status' => $request->status,
                    'fragrance' => $request->fragrance ? json_encode(explode(",", $request->fragrance)) : NULL,
                    'min_mrp' => $min_mrp,
                    'max_mrp' => $max_mrp,
                    'min_price' => $min_price,
                    'max_price' => $max_price,
                    'category_id' => $request->category,
                    'min_discount_percentage' => $min_disc_prcnt,
                    'max_discount_percentage' => $max_disc_prcnt,
                ]);

                if ($request->hasFile('image')) {
                    $img1 = $this->optimizeAndStore($request->image, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '1',
                        'image' => $img1['full'],
                        'image_thumb' => $img1['thumb'],
                    ]);
                }
                if ($request->hasFile('image2')) {
                    $img2 = $this->optimizeAndStore($request->image2, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '2',
                        'image' => $img2['full'],
                        'image_thumb' => $img2['thumb'],
                    ]);
                }
                if ($request->hasFile('image3')) {
                    $img3 = $this->optimizeAndStore($request->image3, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '3',
                        'image' => $img3['full'],
                        'image_thumb' => $img3['thumb'],
                    ]);
                }
                if ($request->hasFile('image4')) {
                    $img4 = $this->optimizeAndStore($request->image4, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '4',
                        'image' => $img4['full'],
                        'image_thumb' => $img4['thumb'],
                    ]);
                }
                if ($request->hasFile('image5')) {
                    $img5 = $this->optimizeAndStore($request->image5, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '5',
                        'image' => $img5['full'],
                        'image_thumb' => $img5['thumb'],
                    ]);
                }
                if ($request->hasFile('image6')) {
                    $img6 = $this->optimizeAndStore($request->image6, 'product-options');
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'image_no' => '6',
                        'image' => $img6['full'],
                        'image_thumb' => $img6['thumb'],
                    ]);
                }

                $total_stock = 0;
                $mrp = [];
                $price = [];

                $var_count = count($variant_options[0]['brand']);

                $cn = 0;
                $stock = 0;
                for ($x = 0; $x <= $var_count - 1; $x++) {
                    $brand_id = $variant_options[0]['brand'][$x];
                    $category = $request->category;
                    $option_stock = (int) ($variant_options[0]['stock'][$x] ?: 0);
                    $option_mrp = (float) ($variant_options[0]['mrp'][$x] ?: 0);
                    $default_price = $request->default_price;
                    $option_discount_percentage = (float) ($variant_options[0]['discount_percentage'][$x] ?: 0);
                    $option_price = (float) ($variant_options[0]['price'][$x] ?: 0);
                    $stock += $option_stock;
                    $option_image = $variant_options[0]['optionimage'][$x];
                    $discount_amount = 0;

                    if ($option_mrp > 0 && $option_discount_percentage > 0) {
                        $discount_amount = round(($option_mrp * $option_discount_percentage) / 100);
                    }

                    $productOptionData = [
                        'product_id' => $product->id,
                        'brand_id' => (int) $brand_id,
                        'stock' => (int) $option_stock,
                        'mrp' => (float) $option_mrp,
                        'default_price' => (float) $default_price,
                        'discount_percentage' => (float) $option_discount_percentage,
                        'discount_amount' => (float) $discount_amount,
                        'price' => (float) $option_price
                    ];

                    $po = ProductOption::create($productOptionData);

                    if ($option_image > 0) {
                        $files = $request->file('images');
                        if ($request->hasfile('images')) {
                            for ($i = 0; $i < $option_image; $i++) {
                                $variantImg = $this->optimizeAndStore($files[$cn], 'product-options-image');
                                ProductVariantImage::create([
                                    'product_id' => $product->id,
                                    'product_option_id' => $po->id,
                                    'image' => $variantImg['full'],
                                    'image_thumb' => $variantImg['thumb'],
                                ]);
                                $cn += 1;
                            }
                        }
                    }
                }
                $product->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);

                $product->update([
                    'sku' => 'OPAL' . $product->id,
                    'stock' => $stock,
                ]);
                DB::commit();
                return response()->json([
                    'success' => true,
                    'msgText' => 'Product Created',
                ]);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() . ' ' . $ex->getLine(),
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

    public function edit($id)
    {
        try {
            $product = Product::withMeta()->with('product_options')->findOrFail($id);
            $subcategory = Category::where('parent_id', $product->category_id)->get();
            $fragrance = OilGrade::where('status', 'active')->get();

            $categories = Category::whereNull('parent_id')->get();
            $brands = Brand::all();
            return view('admin.products.edit')->with([
                'product' => $product,
                'categories' => $categories,
                'subcategory' => $subcategory,
                'fragrances' => $fragrance,
                'brands' => $brands
            ]);
        } catch (\Exception $ex) {

        }
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'category' => 'required',
            'name' => 'required|min:3|max:155|regex:/^[\pL\s\-]+$/u',
            'slug' => 'required|max:255|unique:products,slug,' . $id,
            'alert_quantity' => 'required|digits_between:1,4',
            'youtube_code' => 'nullable|url',
            'product_code' => 'required|alpha_num|min:5|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'image6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'status' => 'required',
            'is_premium' => 'required',
            'is_hotDeals' => 'required',
            'is_popular' => 'required',
            'has_cash_on_delivery' => 'required',
            'allow_rating' => 'required',
            'short_description' => 'min:30|max:1555|required|string',
            'description' => 'required|min:30|max:1555|string',
            'additional_information' => 'required|min:30|max:1555|string',
            'shipping_information' => 'required|min:30|max:1555|string',
            'terms_condition' => 'required|min:30|max:1555|string',
            'variant_options' => 'required',
            'stock.*' => 'required',
            'mrp.*' => 'required',
            'price.*' => 'required',
            'discount.*' => 'required',
            'brand.*' => 'required',
        ]);
        if ($validator->passes()) {
            DB::beginTransaction();
            try {
                $product = Product::findOrFail($id);
                $attribute_1 = Null;
                $attribute_1_id = $request->category;
                $attribute_2 = Null;
                $attribute_2_id = Null;
                $variant_options = json_decode($request->variant_options, true);
                $min_mrp = min($variant_options[0]['mrp']);
                $max_mrp = max($variant_options[0]['mrp']);
                $min_price = min($variant_options[0]['price']);
                $max_price = max($variant_options[0]['price']);
                $min_disc_prcnt = min($variant_options[0]['discount_percentage']);
                $max_disc_prcnt = max($variant_options[0]['discount_percentage']);
                $productData = array(
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'fabric' => $request->fabric,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'subcategory_id' => $request->subcategory_id,
                    'additional_information' => $request->additional_information,
                    'shipping_information' => $request->shipping_information,
                    'youtube_code' => $request->youtube_code,
                    'alert_quantity' => $request->alert_quantity,
                    'is_featured' => $request->is_featured,
                    'is_premium' => $request->is_premium,
                    'is_bestSales' => $request->is_bestSales,
                    'top_selling' => $request->top_selling,
                    'is_hotDeals' => $request->is_hotDeals,
                    'is_popular' => $request->is_popular,
                    'new_arrivals' => $request->new_arrivals,
                    'is_top' => $request->is_top,
                    'has_cash_on_delivery' => $request->has_cash_on_delivery,
                    'allow_rating' => $request->allow_rating,
                    'variant_options' => $request->variant_options,
                    'replacement_waranty' => $request->replacement_waranty,
                    'cancellation_allowed' => $request->cancellation_allowed,
                    'express_sheeping' => $request->express_sheeping,
                    'terms_condition' => $request->terms_condition,
                    'product_code' => $request->product_code,
                    'fragrance' => $request->fragrance ? json_encode(explode(",", $request->fragrance)) : NULL,
                    'status' => $request->status,
                    'min_mrp' => $min_mrp,
                    'max_mrp' => $max_mrp,
                    'min_price' => $min_price,
                    'max_price' => $max_price,
                    'min_discount_percentage' => $min_disc_prcnt,
                    'max_discount_percentage' => $max_disc_prcnt,
                    'category_id' => (int) $attribute_1_id,
                );
                if ($request->hasFile('image')) {
                    $mainImage = $this->optimizeAndStore($request->image, 'products');
                    $productData['image'] = $mainImage['full'];
                    $productData['image_thumb'] = $mainImage['thumb'];
                    if (Storage::exists($product->image)) {
                        Storage::delete($product->image);
                    }
                    if (!empty($product->image_thumb) && Storage::exists($product->image_thumb)) {
                        Storage::delete($product->image_thumb);
                    }
                }
                $product->update($productData);
                $product->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);

                if ($request->hasFile('image')) {
                    $img1 = $this->optimizeAndStore($request->image, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '1'], [
                        'product_id' => $product->id,
                        'image_no' => '1',
                        'image' => $img1['full'],
                        'image_thumb' => $img1['thumb'],
                    ]);
                }
                if ($request->hasFile('image2')) {
                    $img2 = $this->optimizeAndStore($request->image2, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '2'], [
                        'product_id' => $product->id,
                        'image_no' => '2',
                        'image' => $img2['full'],
                        'image_thumb' => $img2['thumb'],
                    ]);
                }
                if ($request->hasFile('image3')) {
                    $img3 = $this->optimizeAndStore($request->image3, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '3'], [
                        'product_id' => $product->id,
                        'image_no' => '3',
                        'image' => $img3['full'],
                        'image_thumb' => $img3['thumb'],
                    ]);
                }
                if ($request->hasFile('image4')) {
                    $img4 = $this->optimizeAndStore($request->image4, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '4'], [
                        'product_id' => $product->id,
                        'image_no' => '4',
                        'image' => $img4['full'],
                        'image_thumb' => $img4['thumb'],
                    ]);
                }
                if ($request->hasFile('image5')) {
                    $img5 = $this->optimizeAndStore($request->image5, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '5'], [
                        'product_id' => $product->id,
                        'image_no' => '5',
                        'image' => $img5['full'],
                        'image_thumb' => $img5['thumb'],
                    ]);
                }
                if ($request->hasFile('image6')) {
                    $img6 = $this->optimizeAndStore($request->image6, 'product-options/' . $product->id);
                    ProductOptionImage::updateOrCreate(['product_id' => $product->id, 'image_no' => '6'], [
                        'product_id' => $product->id,
                        'image_no' => '6',
                        'image' => $img6['full'],
                        'image_thumb' => $img6['thumb'],
                    ]);
                }

                $var_count = count($variant_options[0]['brand']);
                $stock = 0;
                $cn = 0;
                for ($x = 0; $x <= $var_count - 1; $x++) {
                    $brand_id = $variant_options[0]['brand'][$x];

                    $variantid = $variant_options[0]['variantid'][$x] ?? 0;
                    $category = $request->category;
                    $option_stock = (int) ($variant_options[0]['stock'][$x] ?: 0);
                    $option_mrp = (float) ($variant_options[0]['mrp'][$x] ?: 0);
                    $default_price = $request->default_price;
                    $option_discount_percentage = (float) ($variant_options[0]['discount_percentage'][$x] ?: 0);
                    $option_price = (float) ($variant_options[0]['price'][$x] ?: 0);
                    $stock += $option_stock;

                    $option_image = $variant_options[0]['optionimage'] ? $variant_options[0]['optionimage'][$x] : 0;

                    $discount_amount = 0;

                    if ($option_mrp > 0 && $option_discount_percentage > 0) {
                        $discount_amount = round(($option_mrp * $option_discount_percentage) / 100);
                    }

                    $productOptionData = [
                        'product_id' => $product->id,
                        'brand_id' => (int) $brand_id,
                        'stock' => (int) $option_stock,
                        'mrp' => (float) $option_mrp,
                        'default_price' => (float) $default_price,
                        'discount_percentage' => (float) $option_discount_percentage,
                        'discount_amount' => (float) $discount_amount,
                        'price' => (float) $option_price
                    ];

                    $po = ProductOption::updateOrCreate(['id' => $variantid], $productOptionData);
                    if ($option_image > 0) {

                        if ($request->hasfile('images')) {
                            $files = $request->file('images');
                            for ($i = 0; $i < $option_image; $i++) {

                                $variantImg = $this->optimizeAndStore($files[$cn], 'product-options-image');
                                ProductVariantImage::create([
                                    'product_id' => $product->id,
                                    'product_option_id' => $po->id,
                                    'image' => $variantImg['full'],
                                    'image_thumb' => $variantImg['thumb'],
                                ]);
                                $cn += 1;
                            }
                        }
                    }
                }
                $product->update([
                    'stock' => $stock
                ]);

                $total_stock = 0;
                $mrp = [];
                $price = [];

                DB::commit();
                return response()->json([
                    'success' => true,
                    'msgText' => 'Product Updated',
                ]);
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage() . ' ' . $ex->getLine(),
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

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findorFail($id);
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
            if (!empty($product->image_thumb) && Storage::exists($product->image_thumb)) {
                Storage::delete($product->image_thumb);
            }
            ProductOption::where('product_id', $product->id)->delete();
            ProductCategory::where('product_id', $product->id)->delete();
            $product->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'name' => $product->name
            ]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function productOptionImage($id)
    {
        try {
            $product = Product::with('product_option_images')->findOrFail($id);
            $product_options = ProductOption::where('product_id', $product->id)->with('color')->get();
            return response()->json([
                "success" => true,
                "html" => view('admin.products.ajax.image-upload')->with([
                    'product' => $product,
                    'product_options' => $product_options
                ])->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function uploadOptionImage(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product_option = ProductOption::where('product_id', $product->id)->firstOrFail();
            if ($request->hasFile('gallery')) {
                $images = $request->gallery;
                foreach ($images as $key => $image) {
                    $galleryImg = $this->optimizeAndStore($image, 'product-options/' . $product->id);
                    ProductOptionImage::create([
                        'product_id' => $product->id,
                        'product_option_id' => $product_option->id,
                        'color_id' => 1,
                        'image' => $galleryImg['full'],
                        'image_thumb' => $galleryImg['thumb'],
                    ]);
                }
            }
            return redirect(route('admin.manage-product.index'))->with('success', 'Added');
        } catch (\Exception $ex) {
            print_r($request->all());
            die();
        }
    }

    public function deleteOptionImage($id)
    {
        try {
            $product_option_image = ProductOptionImage::findOrFail($id);
            if (Storage::exists($product_option_image->image)) {
                Storage::delete($product_option_image->image);
            }
            if (!empty($product_option_image->image_thumb) && Storage::exists($product_option_image->image_thumb)) {
                Storage::delete($product_option_image->image_thumb);
            }
            $product_option_image->delete();
            return response()->json([
                "success" => true,
                'product_option_image_id' => $id,
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function deletevariantImage()
    {
        $id = $_GET['id'];
        $product_option_image = ProductVariantImage::findOrFail($id);
        if (Storage::exists($product_option_image->image)) {
            Storage::delete($product_option_image->image);
        }
        if (!empty($product_option_image->image_thumb) && Storage::exists($product_option_image->image_thumb)) {
            Storage::delete($product_option_image->image_thumb);
        }
        $product_option_image->delete();

    }

    public function deleteVariantOptions($id)
    {

        $variantOption = ProductOption::findOrFail($id);
        $product_option_images = ProductVariantImage::where('product_option_id', $variantOption->id)->get();
        foreach ($product_option_images as $product_option_image) {
            if (Storage::exists($product_option_image->image)) {
                Storage::delete($product_option_image->image);
            }
            if (!empty($product_option_image->image_thumb) && Storage::exists($product_option_image->image_thumb)) {
                Storage::delete($product_option_image->image_thumb);
            }
            $product_option_image->delete();
        }
        $variantOption->delete();
        return response()->json([
            "success" => true,
            'variantId' => $id,
        ]);

    }

    public function deletemultiplevariants(Request $request)
    {
        $id = $request->id;
        foreach ($id as $user) {
            User::where('id', $user)->delete();
        }
        return redirect();
    }

    public function allGalleryImage($id)
    {
        $product = Product::findOrFail($id);
        $product_option = ProductOption::where('product_id', $product->id)->firstOrFail();
        $product_option_images = ProductOptionImage::where('product_id', $product->id)->firstOrFail();
        if (count($fleet->galleries)) {
            $data[0] = 1;
            $data[1] = $product_option_images->image;
        }
        return response()->json($data);
    }

    public function getbrandmodel(Request $request)
    {
        $data = BrandModel::where('brand_id', $request->brandid)->get();
        return response()->json($data);
    }
    public function carmodel(Request $request)
    {
        $data = BrandModel::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function deletegallery()
    {
        $id = $_GET['id'];
        $gal = ProductOptionImage::findOrFail($id);
        if (Storage::exists($gal->image)) {
            Storage::delete($gal->image);
        }
        if (!empty($gal->image_thumb) && Storage::exists($gal->image_thumb)) {
            Storage::delete($gal->image_thumb);
        }
        $gal->delete();
    }

    public function fetchsubcategorybycategory(Request $request)
    {
        $data = Category::where('parent_id', $request->id)->get();
        return response()->json($data);
    }

    public function changestatus(Request $request, $id)
    {

        $data = Product::findorFail($id);
        if ($data->status == "active") {
            $data->update(['status' => 'block']);
        } else {
            $data->update(['status' => 'active']);
        }

        return response()->json(['success' => 'Status changed successfully.']);
    }

    public function show($id)
    {
        try {
            $product = Product::withMeta()->findOrFail($id);
            $productoption = ProductOption::where('product_id', $id)->get();
            return view('admin.products.ajax.show', compact('product', 'productoption'));
        } catch (\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function toggleDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($product->is_deal) {
            $product->update([
                'is_deal' => false,
                'deal_start' => null,
                'deal_end' => null,
            ]);

            return response()->json(['success' => true]);
        }

        $hours = (int) $request->hours ?? 24;

        $product->update([
            'is_deal' => true,
            'deal_start' => now(),
            'deal_end' => now()->addHours($hours),
        ]);

        return response()->json(['success' => true]);
    }
}