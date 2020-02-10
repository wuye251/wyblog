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


//路由前缀
Route::prefix('blog')->group(function(){
	
	Route::get('create', 'Blog\CreateBlogController@createBlog');

	Route::get('delete', function () {
    	return 'Hello delete';
	});

	Route::get('show', function () {
    	return 'Hello show';
	});
});
