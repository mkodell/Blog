<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountNewsletterController;
use App\Http\Controllers\AdminCampaignContentController;
use App\Http\Controllers\AdminCampaignController;
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

Route::post('posts/{post:title}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

Route::patch('comments/{comment:id}', [CommentController::class, 'update'])->middleware('auth');
Route::delete('comments/{comment:id}', [CommentController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', [NewsletterController::class, 'subscribe'])->middleware('guest');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('account/{user:username}', [AccountController::class, 'show'])->middleware('auth');
Route::get('account/{user:username}/edit', [AccountController::class, 'edit'])->middleware('auth');
Route::patch('account/{user:username}', [AccountController::class, 'update'])->middleware('auth');

Route::post('account/newsletter', [AccountNewsletterController::class, 'newSubscribe'])->middleware('auth');
Route::post('account/newsletter/resubscribe', [AccountNewsletterController::class, 'resubscribe'])->middleware('auth');
Route::patch('account/newsletter', [AccountNewsletterController::class, 'unsubscribe'])->middleware('auth');

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

Route::get('admin/campaigns', [AdminCampaignController::class, 'index'])->middleware('can:admin');
Route::post('admin/campaigns/{campaign}', [AdminCampaignController::class, 'send'])->middleware('can:admin');
Route::delete('admin/campaigns/{campaign}', [AdminCampaignController::class, 'delete'])->middleware('can:admin');
Route::post('admin/campaigns', [AdminCampaignController::class, 'store'])->middleware('can:admin');
Route::get('admin/campaigns/create', [AdminCampaignController::class, 'create'])->middleware('can:admin');
Route::get('admin/campaigns/{campaign}', [AdminCampaignController::class, 'edit'])->middleware('can:admin');

Route::put('admin/campaigns/{campaign}/content', [AdminCampaignContentController::class, 'store'])->middleware('can:admin');
