<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!auth()->attempt($attributes)) {
            // auth failed
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Email or password is incorrect'
                ]);

            // throw ValidationException::withMessages([
            //     'email' => 'Email or password is incorrect'
            // ]); // functionally equivalent to the above return back()
        }
        // auth passed
        // to prevent session fixation
        session()->regenerate();
        return redirect('/')->with('success', 'Welcome Back!');

    }

    public function destroy()
    {
        auth()->logout();

        session()->regenerate();

        return redirect('/')->with('success', "You have been logged out");
    }
}
