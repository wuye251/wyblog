<?php


namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class DeleteBlogController extends Controller
{

	const DELETEFLAG_ISDELETE = 1;

	public function deleteBlog($blogId)
	{
		$users = \DB::select('select * from tblblog where id = ? and status = ?', [$blogId, 1]);
		//符合数据为空 直接返回

		if (!$users) return 'delete success but content is null';

		//删除数据 
		$updateTime = date('Y-m-d H:i:s', time());
		$delete = self::DELETEFLAG_ISDELETE;
		$boolDelete = \DB::update('update tblblog 
								   set update_time = ? ,deleted = ?
			                       where id = ?',
			                       [$updateTime, $delete, $blogId]);
		if ($boolDelete) return 'delete success';
		return 'delete failed';
	}
}