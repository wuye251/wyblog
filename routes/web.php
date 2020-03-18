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



//网站入口首页
Route::get('/', 'Home\IndexController@index');

//blog路由
Route::prefix('blog')->group(function(){
	/*php逻辑处理*/
	Route::get('index', 'Home\IndexController@index');
	//当前分类下所有的博文展示
	Route::get('tag', 'Blog\ShowBlogController@showAll');
	//当前博文的内容
	Route::get('article/{article}', 'Blog\ShowBlogController@showBlog');


	Route::get('create', 'Blog\CreateBlogController@createBlog');

	Route::get('delete/{blogId}', 'Blog\DeleteBlogController@deleteBlog');

	Route::get('show/{blogId}', 'Blog\ShowBlogController@showBlog');

	Route::get('update', 'Blog\UpdateBlogController@updateBlog');

	/*视图界面*/
	Route::prefix('view')->group(function(){
		// Route::view('home', 'blog/showAllBlog');
		Route::view('showAll', 'blog/showAll');
		Route::view('create', 'blog/createBlog');
		Route::view('update', 'blog/updateBlog');
	});
});



