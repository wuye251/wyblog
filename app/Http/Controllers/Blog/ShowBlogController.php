<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//DB连接
use Illuminate\Support\Facades\DB;
//Blog Model
use App\Models\Blog;


class ShowBlogController extends Controller
{

	const PAGE_COUNT = 10;
	
	public function showBlog($blogId)
	{
		// $users = DB::select('select * from tblblog where id = ? and status = ? and deleted = ?', [$blogId, 0, 0]);
		// return $users;

		// $blog = Blog::where('id', $blogId)
					// ->get()
		$blog = Blog::findOrFail($blogId);
		return $blog;
	}

	public function showAll(Request $request)
	{
		
		$param = $request->all();
		$arrRet = [];
		//传参验证
		if (!isset($param['pageIndex'])) $arrRet['pageIndex'] = 0;
		else $arrRet['pageIndex'] = $param['pageIndex'];

		//查找条件处理
		$defaultParam = [
							'author' => $param['author'] ?? '吴烨',
							'status' => isset($param['status'])  ? $param['status'] : 1,
							'deleted'=> isset($param['deleted']) ? $param['deleted'] : 0,
						];

		//符合条件总数获取
		$count = Blog::where($defaultParam)
						->count();
		
		$arrRet['count']     = $count;

		if (($arrRet['pageIndex']+1) * self::PAGE_COUNT >= $count) {
			$arrRet['nextPage'] = -1;
		} else { 
			$arrRet['nextPage'] = $arrRet['pageIndex'] + 1;
		}
		
		$index = $arrRet['pageIndex'] * self::PAGE_COUNT;

		$arrRet['fields'] = Blog::where($defaultParam)
					 ->orderby('updated_at', 'desc')
					 ->offset($index)
					 ->limit(self::PAGE_COUNT)
					 ->get();

		return $arrRet;
	}
}