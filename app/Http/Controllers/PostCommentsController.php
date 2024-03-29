<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class PostCommentsController extends Controller
{
    public function store(Post $post): RedirectResponse
    {
        request()->validate([
            'body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body'),
            'posted' => now(),
            'updated' => NULL,
        ]);

        return back();
    }
}
