<?php

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

use App\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/posts', function () {
    $listPosts = Post::all()->toArray();
    return response()->json([
        'data' => $listPosts,
    ]);
});

Route::post('/post/search', function () {
    $query = request()->q;
    $listPosts = Post::where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->get();
    return response()->json([
        'posts' => $listPosts,
    ]);
});
