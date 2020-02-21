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

Route::get('/', 'Home\IndexController@index');

//路由前缀
Route::prefix('blog')->group(function(){
	/*php逻辑处理*/
	Route::get('/{home?}', 'Home\IndexController@index');
	
	Route::get('showAll/', 'Blog\ShowBlogController@showAll');

	Route::get('create', 'Blog\CreateBlogController@createBlog');

	Route::get('delete/{blogId}', 'Blog\DeleteBlogController@deleteBlog');

	Route::get('show/{blogId}', 'Blog\ShowBlogController@showBlog');

	Route::get('update', 'Blog\UpdateBlogController@updateBlog');

	/*视图界面*/
	Route::prefix('view')->group(function(){
		// Route::view('home', 'blog/showAllBlog');
		Route::view('showAll', 'blog/showAllBlog');
		Route::view('create', 'blog/createBlog');
		Route::view('update', 'blog/updateBlog');
	});
});



