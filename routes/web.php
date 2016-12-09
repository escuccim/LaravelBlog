<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* Home and welcome */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
	
/* User pages */
Route::get('/user/profile', 'UserController@profile');
Route::post('/user/profile', 'UserController@update');
Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@edit');

/* About pages */
Route::get('about', 'PagesController@about');
Route::get('about/cv', 'PagesController@cv');
Route::get('about/contact', 'PagesController@contact');
Route::post('about/contact', 'PagesController@sendEmail');

/* Photo Carousel */
Route::get('pictures', 'PhotoController@carousel');
Route::resource('photoadmin', 'PhotoController');
Route::post('photoadmin/order', 'PhotoController@order');
Auth::routes();

Route::get('/home', 'HomeController@index');

/* CV Admin */
Route::resource('cvadmin', 'JobsController');
Route::get('cvadmin/{id}/delete', 'JobsController@delete');
Route::post('cvadmin/order', 'JobsController@order');

/* Blog admin */
Route::get('/blog/labels/{id}', 'BlogController@tags');
Route::resource('blog', 'BlogController');

/* RSS Feed for Blog */
Route::get('feed', 'FeedController@generate');

/* Blog comments */
Route::post('/comment/add', 'BlogCommentsController@store');

