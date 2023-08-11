<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(50)
        ]);
    }

    // public function store()
    // {
    //     Post::create(array_merge($this->validatePost(), [
    //         'user_id' => request()->user()->id,
    //     ]));

    //     return redirect('/');
    // }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $post->update(array_merge($this->validatePost($post), [
            'user_id' => request('user_id')
        ]));

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted!');
    }

    public function changeStatus()
    {
        $postId = $_POST['postId'];
        $newStatus = $_POST['statusDropdown'];

        $post = Post::find($postId);
        if ($post) {
            $post->update(['status' => $newStatus]);

        }
        return back();
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
