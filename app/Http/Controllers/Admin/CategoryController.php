<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Categories already have two separate image fields (image / banner_image)
     * so we don't need a full+thumb split like products — just resize/compress
     * the single uploaded file into one optimized webp and store it.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @param  int  $maxWidth  cap width so nothing oversized ever gets stored
     * @return string  stored relative path
     */
    private function optimizeAndStore($file, string $folder, int $maxWidth = 1200): string
    {
        $uuid = Str::uuid();
        $folder = trim($folder, '/');

        $image = Image::make($file->getRealPath());
        $image->orientate();
        $image->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $path = $folder . '/' . $uuid . '.webp';
        Storage::disk('public')->put($path, (string) $image->encode('webp', 85));

        return $path;
    }

    private function deleteIfExists(?string $path): void
    {
        if (!empty($path) && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.index')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.create')->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            // 'name_ar' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories',
            // raised to 8MB, same as products — resized/compressed server-side before storing
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            //  'meta_title' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'twitter_cards' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_keyword' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'canonical_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_description' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'og_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
        ]);
        if ($validator->passes()) {
            try {
                $imageName = null;
                $imageNamebanner = null;

                if ($request->hasFile('image')) {
                    $imageName = $this->optimizeAndStore($request->image, 'categories_images');
                }

                // FIX: was reading $request->image here before, so banner_image
                // never actually got saved — now correctly uses $request->banner_image
                if ($request->hasFile('banner_image')) {
                    $imageNamebanner = $this->optimizeAndStore($request->banner_image, 'categories_images');
                }

                $category = Category::create([
                    'parent_id' => $request->parent_id ?? Null,
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'image' => $imageName,
                    'banner_image' => $imageNamebanner,
                    'status' => $request->status,
                    'is_premium' => $request->is_premium ?? 0,
                ]);
                if($request->parent_id) {
                    $code = 'Category-'.$request->parent_id.'-'.$category->id;
                } else {
                    $code = 'Category-'.$category->id;
                }
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
                $category->update([
                    'code' => $code
                ]);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Category Created',
                ]);
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

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.edit')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->slug, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
          'name' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            // 'name_ar' => 'required|max:255',
            'slug' => [ "required",Rule::unique('categories')->ignore($id),"max:255"],
            // 'meta_title' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'twitter_cards' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_keyword' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'canonical_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'meta_description' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
            // 'og_tags' => 'required|regex:/^[0-9A-Za-z.\s,-]*$/|min:10|max:550',
        ]);
        if ($validator->passes()) {
            try{
                $category = Category::findOrFail($id);
                $data = array(
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'slug' => $request->slug,
                    'status' => $request->status,
                    'is_premium' => $request->is_premium ?? 0,
                );

                if ($request->hasFile('banner_image')) {
                    $this->deleteIfExists($category->banner_image);
                    $data['banner_image'] = $this->optimizeAndStore($request->banner_image, 'categories_images');
                }

                if ($request->hasFile('image')) {
                    $this->deleteIfExists($category->image);
                    $data['image'] = $this->optimizeAndStore($request->image, 'categories_images');
                }

                $category->update($data);
                $category->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
                return response()->json([
                    'success' => true,
                    'msgText' => 'Category Updated',
                ]);
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
        DB::beginTransaction();
        try {
            $category = Category::findorFail($id);
            if($category->direct_childs->count() > 0 ) {
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'msgText' => 'Delete child categories first',
                ]);
            }

            // FIX: images are stored on the 'public' disk (storage/app/public/...)
            // via optimizeAndStore(), not in public_path('categories_images'),
            // so File::delete(public_path(...)) never actually removed anything.
            $this->deleteIfExists($category->image);
            $this->deleteIfExists($category->banner_image);

            $category->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'name' => $category->name
            ]);
        } catch(\Exception $ex){
            DB::rollback();
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $parent_category = Category::findOrFail($id);
        $categories = Category::where('parent_id',$parent_category->id)->get();
        return view('admin.categories.children')->with([
            'parent_category' => $parent_category,
            'categories' => $categories
        ]);
    }

    public function changestatus(Request $request,$id){
        
        $data = Category::findorFail($id);
        if($data->status=="active"){
            $data->update(['status'=>'block']);
        }else{
            $data->update(['status'=>'active']);
        }
        
        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function showcategory($id){
        try {
            $category = Category::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.categories.ajax.show')->with([
                    'category' => $category
                ])->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
}