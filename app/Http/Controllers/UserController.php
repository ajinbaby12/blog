<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $author)
    {
        return view('user.show', [
            'author' => $author
        ]);
    }

    public function followAuthor(Request $request, User $author)
    {
        $user = request()->user();
        $user->follows()->attach($author->id);
        return redirect()->back();
    }

    public function unfollowAuthor(Request $request, User $author)
    {
        $user = auth()->user();
        $user->follows()->detach($author->id);
        return redirect()->back();
    }
}
