<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:title}', [PostController::class, 'show']);

Route::post('posts/{post:title}/comments', [PostCommentsController::class, 'store']);

Route::patch('comments/{comment:id}', [CommentController::class, 'update']);
Route::delete('comments/{comment:id}', [CommentController::class, 'destroy']);

Route::post('newsletter/guestSubscribe', [NewsletterController::class, 'guestSubscribe']);
Route::post('newsletter/userNewSubscribe', [NewsletterController::class, 'userNewSubscribe']);
Route::post('newsletter/userResubscribe', [NewsletterController::class, 'userResubscribe']);
Route::patch('newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('account/{user:username}', [AccountController::class, 'show'])->middleware('auth');
Route::get('account/{user:username}/edit', [AccountController::class, 'edit'])->middleware('auth');
Route::patch('account/{user:username}', [AccountController::class, 'update'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
Route::delete('admin/posts/{post:id}', [AdminPostController::class, 'destroy'])->middleware('can:admin');
Route::get('admin/posts/{post:id}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
Route::patch('admin/posts/{post:id}', [AdminPostController::class, 'update'])->middleware('can:admin');

Route::get('admin/categories', [AdminCategoryController::class, 'index'])->middleware('can:admin');
Route::delete('admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->middleware('can:admin');
Route::get('admin/categories/create', [AdminCategoryController::class, 'create'])->middleware('can:admin');
Route::post('admin/categories', [AdminCategoryController::class, 'store'])->middleware('can:admin');

