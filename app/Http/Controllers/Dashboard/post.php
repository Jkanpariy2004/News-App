<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\category as dbcategory;
use App\Models\post as dbpost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class post extends Controller
{
    public function index()
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }
        $categorys = dbcategory::all();
        return view('Dashboard.post', compact('categorys'));
    }

    public function FetchData()
    {
        $posts = DB::table('post')
            ->leftJoin('category', 'post.category', '=', 'category.id')
            ->select('post.*', 'category.category_name')
            ->get();
        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function post()
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }
        $categorys = dbcategory::all();
        return view('Dashboard.add-post', compact('categorys'));
    }

    public function SubmitPost(Request $request)
    {
        $message = [
            'title.required' => 'Please Enter Your Post Title.',
            'title.min' => 'Please Enter 8 Char Post Title.',
            'description.required' => 'Please Enter Your Post Description.',
            'category.required' => 'Please Select a Category.',
            'thumbnail_image.required' => 'Please Upload a Thumbnail Image.',
            'thumbnail_image.mimes' => 'The Thumbnail image please upload this extension: jpg, png, jpeg.',
            'thumbnail_image.max' => 'The Thumbnail Image may not be greater than 20MB.',
            'auther_name.required' => 'Please Enter the Author Name.',
            'publish_date.required' => 'Please Enter the Publish Date.',
            'post_type.required' => 'Please Select a Post Type.',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'description' => 'required',
            'category' => 'required',
            'thumbnail_image' => 'required|mimes:jpg,png,jpeg|max:20480',
            'auther_name' => 'required',
            'publish_date' => 'required',
            'post_type' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = new dbpost();

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->category = $request->input('category');
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('assets/post'), $imageName);
            $post->thumbnail_image = 'assets/post/' . $imageName;
        }
        $post->auther_name = $request->input('auther_name');
        $post->publish_date = $request->input('publish_date');
        $post->post_type = $request->input('post_type');

        $post->save();
        return response()->json(['message' => 'Post published successfully!'], 200);
    }

    public function edit($id)
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }
        $categories = dbcategory::all();
        $show = dbpost::all();
        $new = dbpost::find($id);
        $url = url('/post-update/' . $id);
        $com = compact('show', 'new', 'url', 'categories');
        return view('Dashboard.post_edit', $com);
    }

    public function update(Request $request, $id)
    {
        $message = [
            'title.required' => 'Please Enter the Title.',
            'description.required' => 'Please Enter the Description.',
            'category.required' => 'Please Select a Category.',
            'thumbnail_image.mimes' => 'The thumbnail image must be a file of type: jpg, png, jpeg.',
            'thumbnail_image.max' => 'The thumbnail image may not be greater than 20MB.',
            'auther_name.required' => 'Please Enter the Author Name.',
            'publish_date.required' => 'Please Enter the Publish Date.',
            'post_type.required' => 'Please Select a Post Type.',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'thumbnail_image' => 'nullable|mimes:jpg,png,jpeg|max:20480',
            'auther_name' => 'required',
            'publish_date' => 'required',
            'post_type' => 'required',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = dbpost::find($id);

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->category = $request->input('category');
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('assets/post'), $imageName);
            $post->thumbnail_image = 'assets/post/' . $imageName;
        }
        $post->auther_name = $request->input('auther_name');
        $post->publish_date = $request->input('publish_date');
        $post->post_type = $request->input('post_type');

        $post->save();
        return response()->json(['message' => 'Post updated successfully!'], 200);
    }

    public function delete($id)
    {
        $post = dbpost::find($id);
        if ($post) {
            $post->delete();
            return response()->json(['status' => 'success', 'message' => 'Post deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Post not found.'], 404);
        }
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'content' => 'nullable|string',
    //         'image' => 'nullable|url',
    //         'author' => 'nullable|string',
    //         'publish_date' => 'nullable|string',
    //     ]);

    //     $imagePath = null;
    //     if ($validatedData['image']) {
    //         $imageUrl = $validatedData['image'];
    //         $imageName = basename(parse_url($imageUrl, PHP_URL_PATH));
    //         $imagePath = 'assets/post/api_image_'. $imageName;

    //         $directory = public_path('assets/post');
    //         if (!is_dir($directory)) {
    //             mkdir($directory, 0755, true);
    //         }

    //         $imageContents = file_get_contents($imageUrl);
    //         if ($imageContents === false) {
    //             return response()->json(['message' => 'Failed to download image'], 500);
    //         }

    //         $imageFullPath = public_path($imagePath);
    //         file_put_contents($imageFullPath, $imageContents);
    //     }

    //     $post = new dbpost();
    //     $post->title = $validatedData['title'];
    //     $post->description = $validatedData['description'];
    //     $post->category = $validatedData['content'];
    //     $post->thumbnail_image = $imagePath;
    //     $post->auther_name = $validatedData['author'];
    //     $post->publish_date = $validatedData['publish_date'];
    //     $post->save();

    //     return response()->json(['message' => 'Article inserted successfully']);
    // }

    public function fetchArticles()
    {
        try {
            $articles = fetchArticlesFromApi();

            $insertArticle = function ($article) {
                dbpost::create([
                    'title' => $article['title'],
                    'description' => $article['description'],
                    'category' => 'Api Data',
                    'thumbnail_image' => $article['urlToImage'],
                    'auther_name' => $article['author'],
                    'post_type' => 'N/A',
                    'publish_date' => $article['publishedAt'],
                ]);
            };

            collect($articles)->each($insertArticle);

            return response()->json(['message' => 'Articles inserted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch or insert articles: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid IDs'], 400);
        }
        $ids = array_filter($ids, 'is_numeric');
        dbpost::destroy($ids);
        return response()->json(['status' => 'success', 'message' => 'Posts deleted successfully']);
    }

    public function post_details($id)
    {
        $post_details = dbpost::find($id);
        $post = DB::table('post')
            ->leftJoin('category', 'post.category', '=', 'category.id')
            ->select('post.*', 'category.category_name')
            ->get();
        $compact = compact('post', 'post_details');

        return view('PostDetails', $compact);
    }

    public function search(Request $request)
    {
        $message = [
            'category.required' => 'Please Select Post Category To Search.',
            'post_title.required' => 'Please Enter Post Title To Search.',
            'post_date.required' => 'Please Select Date To Search.',
        ];

        $request->validate([
            'post_title' => 'required|string|max:255',
            'category' => 'required',
            'post_date' => 'required|string',
        ], $message);

        $query = dbpost::query();

        if ($request->filled('category')) {
            $query->where('category', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('post_title')) {
            $query->where('title', 'like', '%' . $request->post_title . '%');
        }

        if ($request->filled('post_date')) {
            $dates = explode(' to ', $request->post_date);
            if (count($dates) === 2) {
                $query->whereBetween('publish_date', [trim($dates[0]), trim($dates[1])]);
            }
        }

        $posts = $query->leftJoin('category', 'post.category', '=', 'category.id')
            ->select('post.*', 'category.category_name')
            ->get();

        return response()->json([
            'data' => $posts,
        ]);
    }
}
