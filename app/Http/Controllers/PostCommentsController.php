<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([             // '$post->comments()' auto set post_id of comment to corresponding id of post
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        // can also use request()->user()->id and request('body') instead

        return back();
    }
}
