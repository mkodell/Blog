<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::
                with('author', 'category')
                    ->latest('updated_at')
                    ->where('user_id', auth()->user()->id)
                    ->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['status'] == 'draft') {
            $attributes['created_at'] = now();
            $attributes['updated'] = NULL;
        }

        if ($attributes['status'] == 'published') {
            $attributes['created_at'] = now();
            $attributes['published_at'] = now();
            $attributes['updated'] = NULL;
        }

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/admin/posts')->with('success', 'Post Created!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        if ($attributes['status'] == 'published') {
            if ($post->status == 'published') {
                $attributes['updated'] = now();
            } else {
                $attributes['published_at'] = now();
                $attributes['updated'] = NULL;
            }
        } else {
            $attributes['updated'] = NULL;
        }

        $post->update($attributes);

        return redirect('/admin/posts')->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/admin/posts')->with('success', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => $post->exists ? ['required', Rule::unique('posts', 'title')->ignore($post)] : ['required', Rule::unique('posts', 'title')],
            'thumbnail' => $post->exists ? 'image|mimes:jpeg,jpg,png,svg' : 'required|image|mimes:jpeg,jpg,png,svg',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'status' => 'required'
        ]);
    }
}
