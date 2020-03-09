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


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/register', 'RegisterController@create')
	->name('register');

Route::post('register', 'RegisterController@store')
	->name('register.store');

Route::get('/login', 'LoginController@index')
	->name('login');

Route::post('/login', 'LoginController@login')
	->name('login.login');

Route::get('/logout', 'LoginController@logout')
	->name('login.logout');


/*
|--------------------------------------------------------------------------
| Posts
|--------------------------------------------------------------------------
*/

Route::get('/posts', 'PostController@index')
	->name('posts.index');

Route::get('posts/create', 'PostController@create')
	->name('posts.create')
	->middleware('auth');

Route::post('/posts', 'PostController@store')
	->name('posts.store')
	->middleware('auth');

Route::get('/posts/{id}', 'PostController@show')
	->name('posts.show');

Route::get('/posts/{id}/edit', 'PostController@edit')
	->name('posts.edit')
	->middleware('auth');

Route::patch('/posts/{id}', 'PostController@update')
	->name('posts.update')
	->middleware('auth');

Route::delete('/posts/{id}', 'PostController@destroy')
	->name('posts.destroy')
	->middleware('auth');


/*
|--------------------------------------------------------------------------
| Post Likes
|--------------------------------------------------------------------------
*/

Route::get('/posts/{id}/like', 'LikeController@like')
	->name('like')
	->middleware('auth');