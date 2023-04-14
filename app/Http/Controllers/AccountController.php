<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Services\Newsletter;

class AccountController extends Controller
{
    public function show(User $user, Newsletter $newsletter): View
    {
        $email = request()->user()->email;

        try {
            $response = $newsletter->checkStatus($email);

            return view('account.show', [
                'user' => $user,
                'status' => $response->status,
            ]);
        } catch (ClientException $e) {
            return view('account.show', [
                'user' => $user,
                'status' => 'none',
            ]);
        }
    }

    public function edit(User $user): View
    {
        return view('account.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,jpg,png,svg',
            'username' => ['required', Rule::unique('users', 'username')->ignore($user)],
            'password' => '',
            'email' => ['required', Rule::unique('users', 'email')->ignore($user)],
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store('avatars');
        }

        $user->update($attributes);

        return redirect('/account/' . $user->username)->with('success', 'Account Updated!');
    }
}
