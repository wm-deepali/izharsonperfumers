<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Sliders are full-width hero banners (background-image), so — same as
     * categories — we only need one optimized file, no separate thumb.
     * Width is capped higher (1920) since it has to stay sharp stretched
     * across the full viewport, not just a card/listing image.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @return string  stored relative path
     */
    private function optimizeAndStore($file, string $folder, int $maxWidth = 1920): string
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
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index')->with([
            'sliders' => $sliders
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.sliders.ajax.create')->render(),
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
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|min:3|max:255',
            'sub_title' => 'nullable|min:3|max:255',
            'content' => 'nullable|min:3|max:255',
            // raised to 8MB — client can upload a large banner photo, it gets
            // resized/compressed server-side before it's ever stored
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'status' => 'required',
            'button_link' => 'nullable',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try{
            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'title_ar' => $request->title_ar,
                'button_link' => $request->button_link,
                'sub_title_ar' => $request->sub_title_ar,
                'content' => $request->content,
                'color' => $request->color,
                'image' => $this->optimizeAndStore($request->image, 'sliders'),
                'status' => $request->status
            ]);
           return response()->json([
                    'success' => true,
                    'msgText' => 'Created',
                ]);
        } catch(\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }

    public function edit($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.sliders.ajax.edit')->with([
                    'slider' => $slider
                ])->render(),
            ]);
        } catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function update(Request $request , $id)
    {
       $validator = Validator::make($request->all(), [
            'title' => 'nullable|min:3|max:255',
            'sub_title' => 'nullable|min:3|max:255',
            'content' => 'nullable|min:3|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192',
            'status' => 'required',
            'button_link' => 'nullable',
        ]);
        
         if ($validator->fails()) {
             
              return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
             
         }
        try {
            $slider = Slider::findOrFail($id);
            $data = array(
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'title_ar' => $request->title_ar,
                'sub_title_ar' => $request->sub_title_ar,
                'status' => $request->status,
                 'color' => $request->color,
                 'content' => $request->content,
                'button_link' => $request->button_link,
            );
            if($request->hasFile('image')) {
                $this->deleteIfExists($slider->image);
                $data['image'] = $this->optimizeAndStore($request->image, 'sliders');
            }
            $slider->update($data);
            return response()->json([
                    'success' => true,
                    'msgText' => 'Updated',
                ]);
        } catch(\Exception $ex) {
            return response()->json([
                    'success' => false,
                    'code' => 400,
                    'msgText' => $ex->getMessage(),
                ]);
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $this->deleteIfExists($slider->image);
            $slider->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'success' => false,
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}