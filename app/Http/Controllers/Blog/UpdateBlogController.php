<?php


namespace App\Http\Controllers\Blog;

use Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class UpdateBlogController extends Controller
{
	public function updateBlog(Request $request, $blogId)
	{
		$name = Request::input('name');

    	//是否有值
        	echo $request->input('name');

		$users = \DB::select('select * from tblblog where id = ? and status = ?', [$blogId, 0]);
		
		if (!$users) return 'blogId not exists';


	}
	
	/*
		检查传入字段与数据库字段映射/过滤非法字段 防sql注入
	*/
	public function updateFieldCheck()
	{}

	/*
		更新字段内容
	*/
	public function updateField()
	{

	}
}
