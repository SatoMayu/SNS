<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register-form', 'Auth\RegisterController@registerForm');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');
Route::post('/profile/update','UsersController@profileUpdate');


Route::get('/search-form','UsersController@index');
Route::post('/search','UsersController@search');

Route::get('/follow-list','PostsController@followList');
Route::get('/follower-list','PostsController@followerList');

Route::post('posts/create','PostsController@create');

Route::get('posts/{id}/delete','PostsController@delete');
Route::post('posts/{id}/update','PostsController@update');

Route::get('/logout','Auth\LoginController@logout');

Route::post('users/{id}/follow','UsersController@follow')->name('follow');

Route::delete('users/{id}/unfollow','UsersController@unfollow')->name('unfollow');

Route::get('users/{id}/users_profile','UsersController@showUsersProfile');
