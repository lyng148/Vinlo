<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;


Route::get('posts', function (){
    return redirect ('/posts/latest');
});
Route::get('/posts/following', [PostsController::class, 'following'])->middleware('auth');
Route::get('/posts/latest', [PostsController::class, 'latest']);

Route::get('/posts/create', [PostsController::class, 'create'])->middleware('auth');
Route::post('/posts/create', [PostsController::class, 'store'])->middleware('auth');
Route::get('/posts/{post}', [PostsController::class, 'show']);
Route::post('/post/{id}/comment', [CommentsController::class, 'store'])->name('post.comment');
Route::get('posts/{id}/edit', [PostsController::class, 'edit'])->name('post.edit');
Route::post('posts/{id}/edit', [PostsController::class, 'update'])->name('post.update');
Route::get('posts/{id}/delete', [PostsController::class, 'delete'])->name('post.delete');

Route::get('users/{id}', [UsersController::class, 'show']);
Route::get('users/{id}/edit/profile', [UsersController::class, 'edit'])->middleware('auth');
Route::get('users/{id}/edit/email', [UsersController::class, 'edit'])->middleware('auth');
Route::get('users/{id}/edit/password', [UsersController::class, 'edit'])->middleware('auth');
Route::get('users/{id}/edit/avatar', [UsersController::class, 'edit'])->middleware('auth');

Route::post('users/{id}/edit/profile', [UsersController::class, 'updateProfile'])->middleware('auth');
Route::post('users/{id}/edit/email', [UsersController::class, 'updateEmail'])->middleware('auth');
Route::post('users/{id}/edit/password', [UsersController::class, 'updatePassword'])->middleware('auth');
Route::post('users/{id}/edit/avatar', [UsersController::class, 'updateAvatar'])->middleware('auth');

Route::post('/follows/follow', [FollowsController::class, 'store'])->middleware('auth');
Route::post('/follows/unfollow', [FollowsController::class, 'delete'])->middleware('auth');
Route::get('/vote/upvote/{post_id}',[\App\Http\Controllers\VotesController::class, 'upvote'])->middleware('auth');
Route::get('/vote/downvote/{post_id}',[\App\Http\Controllers\VotesController::class, 'downvote'])->middleware('auth');
Route::get('vote/unvote/{post_id}',[\App\Http\Controllers\VotesController::class, 'unvote'])->middleware('auth');
Auth::routes();

Route::get('/home', function () {
    return redirect("/posts/latest");
});
Route::get('/', function () {
    return redirect("/posts/latest");
});
