<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show(User $author)
    {
        return view('user.show', [
            'author' => $author
        ]);
    }

    public function edit(User $author)
    {
        Gate::authorize('view', $author);
        return view('user.edit', [
            'user' => $author
        ]);
    }

    public function update(User $author)
    {
        Gate::authorize('update', $author);
        $attributes = request()->validate([
            'username' => ['required', 'min:7', 'max:255']
        ]);

        $author = tap($author)->update($attributes);

        return redirect('/profile/' . $author->username . '/edit')->with('success', 'Account Updated!');
    }

    public function followAuthor(Request $request, User $author)
    {
        $user = request()->user();

        if ($user->id !== $author->id) { // if author and user is different
            $user->follows()->attach($author->id);
            return redirect()->back();
        }
    }

    public function unfollowAuthor(Request $request, User $author)
    {
        $user = request()->user();

        if ($user->id !== $author->id) {
            $user->follows()->detach($author->id);
            return redirect()->back();
        }
    }
}
