<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;


class CommentController extends Controller
{
    public function update(Comment $comment): RedirectResponse
    {
        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $attributes['updated_at'] = now();
        $attributes['updated'] = now();

        $comment->update($attributes);

        return back()->with('success', 'Comment Updated!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return back()->with('success', 'Comment Deleted!');
    }
}
