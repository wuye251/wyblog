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


Route::namespace('Home')->group(function(){
		Route::get('/', 'IndexController@index');
		//blog
		Route::prefix('blog')->group(function(){
			Route::get('/', 'BlogController@index');
			Route::get('{blogId}','BlogController@show');/*paginate生成的link为 blog/article/{blogId} 后期需要优化 为 blog/{blogId}*/

			// Route::get('comment/{blogId}', 'CommentController@index');/*暂不支持单独评论展示路由*/
			Route::post('comment/{blogId}', 'CommentController@create');
		});
});


Route::namespace('Admin')->prefix('admin')->group(function(){
		Route::get('/','IndexController@index');

		Route::prefix('blog')->group(function(){
			Route::get('/', 'BlogController@index');
			Route::get('create', 'BlogController@create');
			Route::post('store', 'BlogController@store');
			Route::get('update', 'BlogController@update');
			Route::get('delete', 'BlogController@destroy');
		});
});


// //blog路由
// Route::prefix('blog')->group(function(){
// 	/*php逻辑处理*/
// 	Route::get('index', 'Home\IndexController@index');
// 	//当前分类下所有的博文展示
// 	Route::get('tag', 'Blog\ShowBlogController@showAll');
// 	//当前博文的内容
// 	Route::get('article/{article}', 'Blog\ShowBlogController@showBlog');

// 	//引入评论
// 	Route::get('comment', 'Blog\CommentController@index');
// 	//提交评论
// 	Route::get('comment/create/{blogId}', 'Blog\CommentController@create');
// 	//删除评论
// 	Route::get('comment/delete', 'Blog\CommentController@delete');
// 	//修改评论
// 	Route::get('comment/update', 'Blog\CommentController@update');

// 	Route::post('create', 'Blog\CreateBlogController@createBlog');

// 	Route::get('delete/{blogId}', 'Blog\DeleteBlogController@deleteBlog');

// 	Route::get('show/{blogId}', 'Blog\ShowBlogController@showBlog');

// 	Route::get('update', 'Blog\UpdateBlogController@updateBlog');
	
// 	Route::get('view/createBlog', function(){
// 		return view('blog.createBlog');
// 	});
// });



