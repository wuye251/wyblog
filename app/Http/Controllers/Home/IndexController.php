<?php

namespace App\Http\Controllers\Home;

//入参获取
use Illuminate\Http\Request;
//入参字段验证
use Illuminate\Support\Facades\Validator;
//DB连接
use Illuminate\Support\Facades\DB;
//Models
use App\Models\Blog;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class IndexController extends Controller
{
	const PAGE_COUNT = 10;

	public function index(Request $request)
	{
		$param = $request->all();
		$arrRet = [];
		//传参验证
		// if (!isset($param['page'])) $arrRet['page'] = 0;
		// else $arrRet['page'] = $param['page'];

		//查找条件处理
		$defaultParam = [
							'author' => $param['author'] ?? '吴烨',
							'status' => isset($param['status'])  ? $param['status'] : 1,
							'deleted'=> isset($param['deleted']) ? $param['deleted'] : 0,
						];

		//符合条件总数获取
		// $count = Blog::where($defaultParam)
		// 				->count();
		
		// $arrRet['count']     = $count;

		//每页固定博客数量
		$pageCount = isset($param['pageCount']) 
						 ? $param['pageCount'] 
						 : self::PAGE_COUNT;

		//如果刚好够成整页   否则%不为0 总页+1
		// $arrRet['pageCount']   = ($count%$pageCount) 
		// 					 ? (intval($count / $pageCount) + 1)
		// 					 :($count / $pageCount);
						 
		// if (($arrRet['pageIndex']+1) * $pageCount >= $count) {
		// 	$arrRet['nextPage'] = -1;
		// } else { 
		// 	$arrRet['nextPage'] = $arrRet['pageIndex'] + 1;
		// }
		
		$curPage = isset($param['page']) ? $param['page'] : 0;
		$index = $curPage * $pageCount;

		$arrRet['fields'] = Blog::where($defaultParam)
					 ->orderby('updated_at', 'desc')
					 ->offset($index)
					 // ->limit($pageCount)
					 ->paginate($pageCount);
					 // ->get();

		// $jsRet = json_encode($arrRet);
		//直接访问目录
		// return $arrRet;
		return view('home.index')->with('blogsInfo', $arrRet);
	}
}