<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function __invoke()
    {
        $posts = Post::where('status', 'published')
                        ->latest()
                        ->limit(50)
                        ->get();

        // compact('posts') = ['posts'] => $posts

        return response()->view('rss.feed', compact('posts'))->header('Content-Type', 'application/xml');
    }
}
