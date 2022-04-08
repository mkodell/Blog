<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function show(User $user)
    {
        return view('account.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('account.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'avatar' => 'image',
            'username' => ['required', Rule::unique('users', 'username')->ignore($user)],
            'password' => 'required',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user)],
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store('avatar');
        }

        $user->update($attributes);

        return redirect('/account/' . $user->username)->with('success', 'Account Updated!');
    }
}
