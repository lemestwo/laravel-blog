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
Route::resource('posts', 'PostController')->except(['show']);
Route::get('posts/{slug}', 'PostController@show')->name('posts.show');

Route::resource('comments', 'CommentController')->except(['show'])->middleware('auth');

Auth::routes();
