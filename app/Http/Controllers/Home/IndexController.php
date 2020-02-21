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

	public function index()
	{
		
		return view('blog.index');
	}


}