<?php


namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class CreateBlogController extends Controller
{

	public function createBlog()
	{
		// $users = DB::table('users')->get();

		$users = \DB::table('tblblog')->get();
		 
		$addDate[] = [
			'title' => "吴烨第一个博客标题",
			'content'=> "博客内容",
			'status' => 0,
			'author' => "吴烨",
			'create_time' => date('Y-m-d H:i:s', time()),
			'update_time' => date('Y-m-d H:i:s', time()),
		];
		
		$boolInsert = \DB::table('tblblog')->insert($addDate);
		if ($boolInsert) return 'ok';
		return 'insert failed';
	}
}