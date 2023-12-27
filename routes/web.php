<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define a separate route for the home page
Route::resource('/',PostController::class);

// Resource route for posts
Route::resource('posts', PostController::class);

// Custom route to increase likes for a post
Route::patch('posts/{post}/increase-likes', [PostController::class, 'increaseLikes'])->name('posts.increaseLikes');

// Resource route for comments (only the 'store' method)
Route::resource('comments', CommentController::class)->only(['store']);




