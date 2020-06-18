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

Route::get('/12345', function(){
	return view('layouts.public.index');
});

Route::get('/1234', function(){
	return view('test.bootstrap');
});
Route::get('/123', function(){
	return view('test.tanchuang');
});




//web index
Route::get('/', 'Home\IndexController@index')->name('home');

//forbidden create user 
Auth::routes(['register' => false]);


Route::namespace('Home')->group(function(){
		Route::get('/', 'IndexController@index');
		//blog
		Route::prefix('blog')->group(function(){
			Route::get('/', 'BlogController@index')->name('blog');
			Route::get('{blogId}','BlogController@show')->name('blog_content');/*paginate生成的link为 blog/article/{blogId} 后期需要优化 为 blog/{blogId}*/

			// Route::get('comment/{blogId}', 'CommentController@index');/*暂不支持单独评论展示路由*/
			Route::post('comment/{blogId}', 'CommentController@create');
		});
});


//前台登录
Route::namespace('Home')->prefix('home')->group(function (){
	//登录选择
	Route::get('login',  'OAuthController@index')->name('OAuthLogin');
	//登出
	Route::get('logout', 'OAuthController@logout')->name('OAuthLogout');
	//第三方登录
	Route::get('login/{action}', 'OAuthController@login')->name('OAuthGetInfo');
	//回调
	Route::get('callBack', 'OAuthController@handleProviderCallback')->name('callBack');
});


//第三方 信息设置
Route::namespace('Admin')->prefix('admin')->group(function (){

	Route::prefix('oauth/client')->group(function () {
		Route::get('/', 		'OAuthClientController@index');
		Route::get('create', 	'OAuthClientController@add');
		Route::get('store',  	'OAuthClientController@store');
		Route::get('edit/{id}', 'OAuthClientController@edit');
		Route::get('update', 	'OAuthClientController@update');
		Route::get('del', 		'OAuthClientController@destroy');
	});

});

Route::post('auth/oauth/login', 'Auth\OAuthController@login')->name('OAuthLoginIndex');


// 后台登录页面
Route::namespace('Admin')->prefix('admin')->group(function () {

    Route::get('login', 'LoginController@index');
    // 退出
    Route::get('logout', 'LoginController@logout')->name('adminLogout');

});

Route::post('auth/admin/login', 'Auth\AdminController@login')->name('adminLogin');

Route::namespace('Admin')->prefix('admin')->middleware('admin')->group(function(){
// Route::namespace('Admin')->prefix('admin')->group(function(){

		Route::get('/','IndexController@index');
		Route::get('index','IndexController@index');
		
		//博客
		Route::prefix('blog')->group(function(){
			Route::get('/', 'BlogController@index')->name('index');
			/*create 必须在{blogId}上*/
			Route::get('create',        	  'BlogController@create')->name('createBlog');
			Route::post('store',        	  'BlogController@store');
			Route::get('edit/{blogId}',       'BlogController@edit')->name('editBlog');
			Route::post('upload',             'BlogController@upload');
			Route::post('update/{blogId}',    'BlogController@update');
			Route::get('softDelete/{blogId}', 'BlogController@softDelete')->name('softDelete');
			Route::get('destroy/{blogId}',    'BlogController@destroy')->name('destory');
			Route::get('{blogId}',            'BlogController@show')->name('showBlog');
		});

		//分类管理
		Route::prefix('category')->group(function(){
			Route::get('index', 		'CategoryController@index');
			Route::get('create', 		'CategoryController@create');
			Route::get('store', 		'CategoryController@store');
			Route::get('show/{id}', 	'CategoryController@show');
			Route::get('edit/{id}', 	'CategoryController@edit');
			Route::get('update/{id}', 	'CategoryController@update');
			Route::get('destroy/{id}',  'CategoryController@destroy');
			
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




