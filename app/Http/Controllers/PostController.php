<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query) {
        //     logger($query->sql, $query->bindings); // logs all queries in /storage/logs/laravel.log
        // });
        return view('posts', [
            // 'posts' => Post::all() // N+1 problem arises here
            'posts' => Post::latest()->with('category', 'author')->filter(request(['search', 'category']))->get(),
            // Post::latest() = SELECT * FROM `posts` ORDER BY `created_at` DESC
            // latest() orders the Post by it's created_at column
            // Load all posts and all the categories and authors that are referenced by posts.
            // request('search') returns a string of what is searched. request(['search]) returns an array with key 'search' and value of what is searched
            'categories' => Category::all(),
            'currentCategory' => Category::firstWhere('slug', request('category')) // firstWhere() is same as calling first() after where()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post
        ]);
    }
}