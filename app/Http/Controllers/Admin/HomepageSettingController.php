<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;
use Storage;

class HomepageSettingController extends Controller
{
    /**
     * Homepage widget/banner images render fairly small (rendered ~696px wide
     * in the current templates) but were being uploaded straight through at
     * full camera/export resolution (e.g. 1536x1024, ~900KB). Same
     * single-file optimize pattern as categories/sliders — no thumb needed,
     * each widget only ever shows one image.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  storage/app/public/{folder}
     * @return string  stored relative path
     */
    private function optimizeAndStore($file, string $folder, int $maxWidth = 1400): string
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
        $homepage_setting = HomepageSetting::all();
        return view('admin.homepage-setting.index')->with([
            'homepage_setting' => $homepage_setting,
        ]);
    }
    
    public function edit($id){
        $homepage_setting = HomepageSetting::find($id);
        return view('admin.homepage-setting.edit')->with([
            'homepage_setting' => $homepage_setting,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            // 'heading' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-,!]*$/',
            // 'content' => 'min:3|max:3000',
            'url_txt' => 'nullable|min:3|max:255|regex:/^[0-9A-Za-z.\s,-,!]*$/',
            'url'=>'nullable|url',
            // raised to 8MB — large export gets resized/compressed server-side
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:8192'
        ]);
        if ($validator->passes()) {
            try {
                $home = HomepageSetting::findOrFail($id);
                $data = $request->all();
                if($request->hasFile('image')) {
                    $this->deleteIfExists($home->image);
                    $data['image'] = $this->optimizeAndStore($request->image, 'homewidget');
                }else{
                    $data['image']=$home->image;
                }
                $home->update($data);
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
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }
}