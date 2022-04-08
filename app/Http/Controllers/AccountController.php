<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(User $user)
    {
        return view('account.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('account.edit', [
            'user' => $user
        ]);
    }
}
