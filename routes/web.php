<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostController@index')->name('home');
Route::resource('posts', 'PostController')->only(['index', 'edit']);
Route::resource('posts', 'PostController')->only(['create', 'store', 'update', 'destroy'])->middleware('is_author');
Route::get('posts/{slug}', 'PostController@show')->name('posts.show');

Route::resource('comments', 'CommentController')->only(['store', 'destroy'])->middleware('auth');

Route::get('user', 'UserController@show')->name('user.show')->middleware('auth');
Route::patch('user', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('user/posts', 'UserController@showPosts')->name('user.posts')->middleware('is_author');

Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::get('home', 'AdminController@home')->name('admin.home');
    Route::get('posts', 'AdminController@posts')->name('admin.posts');
    Route::delete('posts/{post}', 'AdminController@postsDestroy')->name('admin.posts.destroy');
    Route::get('comments', 'AdminController@comments')->name('admin.comments');
    Route::delete('comments/{comment}', 'AdminController@commentsDestroy')->name('admin.comments.destroy');
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::delete('users/{user}', 'AdminController@userDestroy')->name('admin.users.destroy');
    Route::patch('users/{user}', 'AdminController@userUpdate')->name('admin.users.update');
});

Auth::routes();
