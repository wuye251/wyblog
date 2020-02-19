<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class ShowBlogController extends Controller
{

	public function showBlog($blogId)
	{
		$users = \DB::select('select * from tblblog where id = ? and status = ? and deleted = ?', [$blogId, 0, 0]);
		return $users;
	}
}