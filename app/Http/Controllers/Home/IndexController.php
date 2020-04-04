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
use App\Models\Comments;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

// use App\Http\Controllers\Blog;

class IndexController extends Controller
{
	const PAGE_COUNT = 10;

	public function index()
	{

		//查找条件处理
		$defaultParam = [
							'author' => '吴烨',
							'status' =>  1,
							'deleted'=>  0,
						];

		$articles = Blog::where($defaultParam)
					 ->orderby('updated_at', 'desc')
					 ->paginate(self::PAGE_COUNT);

		$assign = [
			'blogs' => $articles,
		];
		
		// return view('home.index', $assign);
		return view('home.home', $assign);

	}
}