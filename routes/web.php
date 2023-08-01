<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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
    // \Illuminate\Support\Facades\DB::listen(function ($query) {
    //     logger($query->sql, $query->bindings);
    // });
    $posts = Post::latest()->with('category', 'author');
    // latest() orders the Post by it's created_at column
    // Load all posts and all the categories and authors that are referenced by posts.
    if (request('search')) { // if user has searched something
        $posts
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
    }
    return view('posts', [
        // 'posts' => Post::all() // N+1 problem arises here
        'posts' => $posts->get(),
        'categories' => Category::all()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts->sortByDesc('created_at')->load('category', 'author'),
        'categories' => Category::all()
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts->sortByDesc('created_at')->load('category', 'author')
    ]);
});
