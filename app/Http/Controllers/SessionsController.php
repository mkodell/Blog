<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;


class SessionsController extends Controller
{
    public function create(): View
    {
        return view('sessions.create');
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes))
        {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back!');
        } else {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
