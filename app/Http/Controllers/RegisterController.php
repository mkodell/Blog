<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('register.create');
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3|unique:users,username',
            'avatar' => 'required|image|mimes:jpeg,jpg,png,svg',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7',
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['avatar'] = request()->file('avatar')->store('avatars');

        $user = User::create($attributes);

        auth()->login($user);

        return redirect("/")->with('success', 'Your account has been created.');
    }
}
