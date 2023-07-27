<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $posts = Post::all();
    return view('posts', [
        'posts' => $posts
    ]);
});

Route::get('post/{post}', function ($slug) {
    // find a post by it's slug and return it's view
    return view('post', [
        'post' => Post::find($slug)
    ]);

})->where('post', '[a-zA-Z_\-]+');
