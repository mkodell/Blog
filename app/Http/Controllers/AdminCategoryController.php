<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::with('posts')->paginate(10),
            'posts' => Post::with('author'),
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category Deleted!');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store()
    {
        $attributes = $this->validateCategory();

        Category::create($attributes);

        return redirect('/admin/categories');
    }

    protected function validateCategory(?Category $category = null): array
    {
        $category ??= new Category();

        return request()->validate([
            'name' => 'required',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($category)],
        ]);
    }
}
