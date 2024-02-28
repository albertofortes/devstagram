<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

/*
Route::get('/', function () {
    return view('index');
});
*/

//Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', HomeController::class)->name('home');

// Register 
//

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// User
//

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');

// Image
//

Route::post('image', [ImageController::class, 'store'])->name('image.store');

// Post
//

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Comments
//

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comments.store');


// Likes
//

Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');


// Profile
//

Route::get('{user:username}/edit', [ProfileController::class, 'index'])->name('profile.index');
Route::post('{user:username}/edit', [ProfileController::class, 'store'])->name('profile.store');

// follow user
//

Route::post('{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
