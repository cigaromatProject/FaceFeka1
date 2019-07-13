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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Order of the routes matters

Route::post('/follow/{user}', 'FollowsController@store');

Route::get('/p/create', 'PostsController@create'); // call create() method inside PostsController when that URL is chosen
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store'); // call store() method inside PostsController when that URL is chosen


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfilesController@update')->name('profile.update');

