<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\login;
use App\Http\Controllers\Dashboard\index;
use App\Http\Controllers\Dashboard\SendMail;
use App\Http\Controllers\index As IndexController;
use App\Http\Controllers\PostDetails;
use App\Http\Controllers\CacheClear;
use App\Http\Controllers\Api;
use App\Http\Controllers\Dashboard\post;
use App\Http\Controllers\Dashboard\category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',[IndexController::class,'index']);
// Route::get('/post-details',[PostDetails::class,'index']);

// login
Route::get('/admin',[login::class,'index']);
Route::post('/LoginCheck',[login::class,'LoginCheck']);
Route::get('/logout',[login::class,'logout']);

Route::get('/dashboard',[index::class,'index']);

// post routes
Route::get('/post',[post::class,'index']);
Route::get('/post-details/{id}', [post::class, 'post_details'])->name('post.details');
Route::get('/add-post',[post::class,'post']);
Route::post('/SubmitPost',[post::class,'SubmitPost']);
Route::get('/post-delete/{id}',[post::class,'delete'])->name('post.delete');
Route::get('/post-edit/{id}',[post::class,'edit'])->name('post.edit');
Route::post('/post-update/{id}',[post::class,'update'])->name('post.update');
Route::post('/bulk-delete', [post::class, 'bulkDelete']);
Route::get('/fetch-data',[post::class,'FetchData']);
Route::post('/search', [post::class, 'search']);

// Route::post('/Insert-All-Article', [post::class, 'store']);
Route::get('/fetch-articles', [post::class, 'fetchArticles'])->name('fetch.articles');


//category routes
Route::get('/category',[category::class,'index']);
Route::get('/add-category',[category::class,'category']);
Route::post('/SubmitCategory',[category::class,'SubmitCategory']);
Route::get('/category-delete/{id}',[category::class,'delete']);
Route::get('/category-edit/{id}',[category::class,'edit']);
Route::post('/category-update/{id}',[category::class,'update'])->name('category.update');
Route::post('/bulk-delete-category', [category::class, 'bulkDelete']);
Route::get('/fetch-category',[category::class,'FetchData']);

// send Mail
Route::get('/send-mail',[SendMail::class,'index']);
Route::post('/Mail-Send',[SendMail::class,'MailSend']);

// cache clear
Route::get('/Cache-Setting',[CacheClear::class,'index']);
Route::get('/cache-clear', [CacheClear::class, 'clearCache'])->name('cache.clear');
Route::get('/route-cache-clear', [CacheClear::class, 'clearRouteCache'])->name('route.cache.clear');
Route::get('/config-cache-clear', [CacheClear::class, 'clearConfigCache'])->name('config.cache.clear');
Route::get('/view-cache-clear', [CacheClear::class, 'clearViewCache'])->name('view.cache.clear');
Route::get('/compiled-cache-clear', [CacheClear::class, 'clearCompiledCache'])->name('compiled.cache.clear');
Route::get('/optimize-cache-clear', [CacheClear::class, 'optimizeCache'])->name('optimize.cache.clear');