<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category as dbcategory;
use App\Models\post as dbpost;
use Illuminate\Support\Facades\DB;

class index extends Controller
{
    public function index(){
        $category = dbcategory::all();
        $post = DB::table('post')
        ->leftJoin('category', 'post.category', '=', 'category.id')
        ->select('post.*', 'category.category_name')
        ->get();
        return view('index',compact('category','post'));
    }
}