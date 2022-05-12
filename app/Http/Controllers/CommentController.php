<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function update(Comment $comment) {
        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $attributes['updated_at'] = now();
        $attributes['updated'] = now();

        $comment->update($attributes);

        return back()->with('success', 'Comment Updated!');
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return back()->with('success', 'Comment Deleted!');
    }
}
