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
//Route::get('posts/create', 'PostController@create')->name('posts.create')->middleware('is_author');
//Route::post('posts', 'PostController@store')->name('posts.store')->middleware('is_author');
//Route::patch('posts/{id}', 'PostController@update')->name('posts.update')->middleware('is_author');
Route::get('posts/{slug}', 'PostController@show')->name('posts.show');

Route::resource('comments', 'CommentController')->only(['store', 'destroy'])->middleware('auth');

Route::get('user', 'UserController@show')->name('user.show')->middleware('auth');
Route::patch('user', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('user/posts', 'UserController@showPosts')->name('user.posts')->middleware('is_author');

Auth::routes();
