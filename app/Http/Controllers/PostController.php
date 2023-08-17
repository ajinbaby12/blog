<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Providers\PublishedPost;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        // \Illuminate\Support\Facades\DB::listen(function ($query) {
        //     logger($query->sql, $query->bindings); // logs all queries in /storage/logs/laravel.log
        // });
        // return response()->json((Post::latest()
        // ->with('category', 'author')
        // ->filter(request(['search', 'category', 'author']))
        // ->get()), 200, [], JSON_PRETTY_PRINT);

        return view('posts.index', [
            // 'posts' => Post::all() // N+1 problem arises here
            'posts' => Post::latest()
                ->where('status', 'published')
                ->with('category', 'author')
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)->withQueryString(),
            // filter() is defined in Post Model as scopeFilter()
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
        $post->increment('view_count');

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function store()
    {
        $user = Post::create(array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
        ]));

        PublishedPost::dispatch($user->user_id);

        return redirect('/');
    }

    public function update(Post $post)
    {
        $post->update($this->validatePost($post));

        return back()->with('success', 'Post Updated!');
    }

    protected function validatePost(Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'status' => 'required'
        ]);
    }
}
