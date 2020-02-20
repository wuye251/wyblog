<?php

namespace App\Http\Controllers\Blog;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//DB连接
use Illuminate\Support\Facades\DB;
//Blog Model
use App\Models\Blog;


class ShowBlogController extends Controller
{

	public function showBlog($blogId)
	{
		// $users = DB::select('select * from tblblog where id = ? and status = ? and deleted = ?', [$blogId, 0, 0]);
		// return $users;

		// $blog = Blog::where('id', $blogId)
					// ->get()
		$blog = Blog::findOrFail($blogId);
		return $blog;
	}

	public function ormShowBlog($blogId)
	{
		//all
		// $blogs = Blog::all();
		// dd($blogs);
		$blogs = Blog::where('id', $blogId)
					 ->get();
		dd($blogs);
	}
}