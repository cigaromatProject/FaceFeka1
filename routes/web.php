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



Auth::routes();

// Order of the routes matters

Route::post('/follow/{user}', 'FollowsController@store');

Route::get('/email', function() {
    return new NewUserWelcomeMail();
});

Route::get('/', 'PostsController@index');
Route::get('/p/create', 'PostsController@create'); // call create() method inside PostsController when that URL is chosen
Route::get('/p/{post}', 'PostsController@show')->name('posts.show');
// due to commentsController
Route::get('/p/{post}/edit', 'PostsController@edit')->name('posts.edit');
Route::post('/p', 'PostsController@store'); // call store() method inside PostsController when that URL is chosen


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::put('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/getSearch/{value}','SearchController@searchAjax'); //search
Route::get('/search','SearchController@search'); //search

// add all resources of comments
Route::post('/comments', 'CommentsController@store');
Route::resource('comments', 'CommentsController');

