<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    /**
     * Current about-us image (800x533, 94KB) is already close to its
     * rendered size (696x464), so this isn't fixing an existing problem —
     * it's a safety net so a future large upload (phone camera photo, etc.)
     * doesn't get stored as-is. Single file, no thumb needed (one usage).
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @return string  stored relative path
     */
    private function optimizeAndStore($file, string $folder, int $maxWidth = 1000): string
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
        $about_us = AboutUs::first();
        return view('admin.about-us.index')->with([
            'about_us' => $about_us
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'title_ar' => 'max:300',
            // raised to 8MB — resized/compressed server-side before storing
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'content' => 'required|min:|max:8000',
             'meta_keywords' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'meta_description' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'meta_title' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
         'canonical_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-\/:]*$/',
           'twitter_cards' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
           'og_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
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
            if($request->hasFile('image')) {
                $existing = AboutUs::find(1);
                if ($existing) {
                    $this->deleteIfExists($existing->image);
                }

                $data['image'] = $this->optimizeAndStore($request->image, 'about-us');
            }
          $about =  AboutUs::updateOrCreate(['id' => 1],$data);
            $about->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                    'description' => $request->description,
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
}