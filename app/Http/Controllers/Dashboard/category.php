<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\category as dbcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class category extends Controller
{
    public function index()
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }

        $show = dbcategory::all();
        return view('Dashboard.category', compact('show'));
    }

    public function category()
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }

        return view('Dashboard.add-category');
    }

    public function FetchData()
    {
        $categoryes = dbcategory::all();

        return response()->json([
            'categoryes' => $categoryes,
        ]);
    }

    public function submitCategory(Request $request)
    {
        $message = [
            'category_name.required' => 'Please enter a category name.',
            'thumbnail_image.required' => 'Please upload a thumbnail image.',
            'thumbnail_image.mimes' => 'The thumbnail image must be a file of type: jpg, jpeg, png.',
            'thumbnail_image.max' => 'The thumbnail image may not be greater than 20MB.',
        ];

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'thumbnail_image' => 'required|mimes:jpg,png,jpeg|max:20480',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = new dbcategory();
        $category->category_name = $request->input('category_name');

        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('assets/category'), $imageName);
            $category->thumbnail_image = 'assets/category/' . $imageName;
        }

        $category->save();

        return response()->json(['message' => 'Category created successfully!'], 200);
    }

    public function edit($id)
    {
        if (!Session::has('email')) {
            return redirect('/admin')->with('error', 'Please login to access this page.');
        }

        $show = dbcategory::all();
        $new = dbcategory::find($id);
        $url = url('/category-update/' . $id);
        $com = compact('show', 'new', 'url');
        return view('Dashboard.category_edit', $com);
    }

    public function update(Request $request, $id)
    {
        $message = [
            'category_name.required' => 'Please enter a category name.',
            'thumbnail_image.mimes' => 'The thumbnail image must be a file of type: jpg, jpeg, png.',
            'thumbnail_image.max' => 'The thumbnail image may not be greater than 20MB.',
        ];

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|mimes:jpg,png,jpeg|max:20480',
        ], $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = dbcategory::find($id);
        $category->category_name = $request->input('category_name');

        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('assets/category'), $imageName);
            $category->thumbnail_image = 'assets/category/' . $imageName;
        }

        $category->save();

        return response()->json(['message' => 'Category updated successfully!'], 200);
    }

    public function delete($id)
    {
        dbcategory::find($id)->delete();

        return redirect()->back()->with('success', 'Category Deleted Successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid IDs'], 400);
        }

        $ids = array_filter($ids, 'is_numeric');

        dbcategory::destroy($ids);

        return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
    }
}
