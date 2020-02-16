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
	//入口页面
	Route::get('/', function(){
		// return view('blog/template');
		return view('blog/createBlog');
		// return view('blog/html', ['id' => 'www.alalalala.com']);
		// return view('blog/css', ['id' => 'www.alalalala.com']);
		// return view('blog/blog');
	});

	Route::get('create', 'Blog\CreateBlogController@createBlog');

	Route::get('delete/{blogId}', 'Blog\DeleteBlogController@deleteBlog');

	Route::get('show/{blogId}', 'Blog\ShowBlogController@showBlog');

	Route::get('update', 'Blog\UpdateBlogController@updateBlog');
});


