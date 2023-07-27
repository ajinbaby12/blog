<?php

use Illuminate\Support\Facades\Cache;
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
    return view('posts');
});


Route::get('post/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (! file_exists($path)){
        return redirect('/');
    }

    $post = Cache::remember("posts.{$slug}", 5, function () use($path) {
        return file_get_contents($path);
    }); // caches the file. Thus file_get_contents is only called after the expiry of the cache(5 seconds here)

     // this function is expensive and is called each time a user accesses the post.

    return view('post', [
        'post' => $post
    ]);
})->where('post', '[a-zA-Z_\-]+');
