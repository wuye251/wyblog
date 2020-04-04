<?php


namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//DB连接
use Illuminate\Support\Facades\DB;
//Models
use App\Models\Blog;

class DeleteBlogController extends Controller
{

	const DELETEFLAG_ISDELETE = 1;

	public function deleteBlog($blogId)
	{
		$boolDelete = Blog::find($blogId)
						  ->delete();
		if ($boolDelete) return 'deleted success';
		return 'delete failed';
	}
}