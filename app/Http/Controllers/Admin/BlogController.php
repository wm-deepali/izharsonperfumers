<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index')->with([
            'blogs' => $blogs
        ]);
    }

    public function create()
    {
        try{
            return response()->json([
                "success" => true,
                "html" => view('admin.blogs.ajax.create')->render(),
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
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'title_ar' => 'max:300',
            'url' => 'required|max:255|unique:blogs',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required|min:3',
            'author' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
        //     'meta_keyword' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_description' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_title' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'canonical_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'twitter_cards' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'og_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        ]);
        if ($validator->passes()) {
            try {
             $blog =   Blog::create([
                    'title' => $request->title,
                    'title_ar' => $request->title_ar,
                    'url' => $request->url,
                    'image' => $request->image->store('blogs'),
                    'content' => $request->content,
                    'content_ar' => $request->content_ar,
                    'author' => $request->author,
                    'status' => $request->status,
                ]);
                $blog->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
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

    public function edit($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            return response()->json([
                "success" => true,
                "html" => view('admin.blogs.ajax.edit')->with([
                    'blog' => $blog
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
        $requestData = $request->all();
        $requestData['url'] = Str::slug($request->url, '-');
        $request->replace($requestData);
        $validator = Validator::make($requestData, [
            'title' => 'required|min:3|max:255|regex:/^[\pL\s\-]+$/u',
            'title_ar' => 'max:300',
            'url' => 'required|alpha_dash|max:255|unique:blogs,url,'.$id,
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required|min:3',
            'author' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
        //     'meta_keyword' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_description' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'meta_title' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'canonical_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'twitter_cards' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        //   'og_tags' => 'required|min:3|max:255|regex:/^[0-9A-Za-z.\s,-]*$/',
        ]);
        if ($validator->passes()) {
            try {
                $blog = Blog::findOrFail($id);
                $data = array(
                    'title' => $request->title,
                    'title_ar' => $request->title_ar,
                    'url' => $request->url,
                    'content' => $request->content,
                    'content_ar' => $request->content_ar,
                    'author' => $request->author,
                    'status' => $request->status,
                );
                // $data = $request->all();
                if($request->hasFile('image')) {
                    $data['image'] = $request->image->store('blogs');
                    if(isset($blog->image) && Storage::exists($blog->image)) {
                        Storage::delete($blog->image);
                    }
                }
                $blog->update($data);
                $blog->setMeta([
                    'meta_title' => $request->meta_title,
                    'meta_keyword' => $request->meta_keyword,
                    'meta_description' => $request->meta_description,
                    'canonical_tags' => $request->canonical_tags,
                    'twitter_cards' => $request->twitter_cards,
                    'og_tags' => $request->og_tags,
                ]);
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

    public function destroy($id)
    {
        try {
            $blog = Blog::findOrFail($id);
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
