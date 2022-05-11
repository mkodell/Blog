<?php

namespace App\Http\Controllers;

use App\Models\Comment;


class CommentController extends Controller
{
    public function edit(Comment $comment) {
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Comment $comment) {
        $attributes = request()->validate([
            'body' => 'required',
            'updated_at' => now(),
            'updated' => now(),
        ]);

        $comment->update($attributes);

        return redirect('/')->with('success', 'Comment Updated!');
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return back()->with('success', 'Comment Deleted!');
    }
}
