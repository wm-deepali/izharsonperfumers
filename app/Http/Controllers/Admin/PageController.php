<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index')->with([
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.pages.ajax.create')->render(),
            ]);
        }
        catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'title' => 'required|max:255',
            'title_ar' => 'max:300',
            'url' => 'required|max:255|unique:blogs',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
            'author' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                Page::create([
                    'title' => $request->title,
                    'title_ar' => $request->title_ar,
                    'url' => $request->url,
                    'image' => $request->image->store('pages'),
                    'content' => $request->content,
                    'content_ar' => $request->content_ar,
                    'author' => $request->author,
                    'status' => $request->status,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'meta_keywords' => $request->meta_keywords,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags
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
        } else {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $page = Page::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.pages.ajax.edit')->with([
                    'page' => $page
                ])->render(),
            ]);
        } catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $requestData = $request->all();
        // $requestData['url'] = Str::slug($request->url, '-');
        // $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'title' => 'required|max:255',
            'title_ar' => 'max:300',
            // 'url' => [ "required",Rule::unique('pages')->ignore($id),"max:255"],
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
            'author' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            try {
                $page = Page::findOrFail($id);
                $data = array(
                    'title' => $request->title,
                    'title_ar' => $request->title_ar,
                    // 'url' => $request->url,
                    'content' => $request->content,
                    'content_ar' => $request->content_ar,
                    'author' => $request->author,
                    'status' => $request->status,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'meta_keywords' => $request->meta_keywords,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags
                );
                // $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('pages');
                    if(isset($page->image) && Storage::exists($page->image)) {
                        Storage::delete($page->image);
                    }
                }
                $page->update($data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        try {
            $blog = Page::findOrFail($id);
            if(isset($blog->image) && Storage::exists($blog->image)) {
                Storage::delete($blog->image);
            }
            $blog->delete();
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
