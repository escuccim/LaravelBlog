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

/* Auth */
Auth::routes();

/* Blog admin */
Route::get('/blog/labels/{id}', 'BlogController@tags');
Route::resource('blog', 'BlogController');

/* RSS Feed for Blog */
Route::get('feed', 'FeedController@generate');

/* Blog comments */
Route::post('/comment/add', 'BlogCommentsController@store');

/* Site maps */
Route::get('sitemap', 'SiteMapController@index');
Route::get('sitemap/blog', 'SiteMapController@blog');
Route::get('sitemap/labels', 'SiteMapController@labels');
Route::get('sitemap/pages', 'SiteMapController@pages');
