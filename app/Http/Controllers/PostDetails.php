<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostDetails extends Controller
{
    public function index(){
        $post = DB::table('post')
        ->leftJoin('category', 'post.category', '=', 'category.id')
        ->select('post.*', 'category.category_name')
        ->get();
        $compact= compact('post');
        return view('PostDetails' , $compact);     
    }
}
