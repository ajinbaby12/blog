<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:7', 'max:255', Rule::unique('users', 'username')], // can also just 'unique:users,username'
                                                                                               // users is the table name and username is the column
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255']
        ]);
        // control reaches here if all validation is passed. Else the register.create view is loaded again with the $errors variable passed to it

        $user = User::create($attributes);

        auth()->login($user); // calling the login method with the user instance and logging an existing user instance

        // session()->flash('success', 'Your account has been created');

        return redirect('/')->with('success', 'Your account has been created'); // redirect to the homepage 'with' the key value pairs flashed to the session
    }
}
