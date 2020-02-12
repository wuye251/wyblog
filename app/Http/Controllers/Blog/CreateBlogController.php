<?php


namespace App\Http\Controllers\Blog;

//入参获取
use Illuminate\Http\Request;
//入参字段验证
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class CreateBlogController extends Controller
{

	/*
	 * 入口函数
	 */
	public function index(Request $request)
	{}

	/*
	 * 字段验证
	 */
	public function rule($arrInput)
	{
		//入参
		$data = $arrInput;

		//参数验证字段
		$rules = [
			'title' 		=>	'required',
			'content'		=>	'required',
			'status'		=>	'nullable',
			'create_time'	=>  'nullable',
			'update_time'	=>  'nullable',
			'author'		=>	'required',
			'deleted'		=>	'nullable',
		];

		//错误信息
		$messages = [
			'require' => ':attribute不能为空',
			// 'numerbic'=> ':attribute必须为数字',
			// 'max'	  => ':attribute最大长度不能超过:max',
		];

		$attributes = [
        	'title' 		=>	'标题',
			'content'		=>	'内容',
			'status'		=>	'状态',
			'create_time'	=>	'创建时间',
			'update_time'	=>  '修改时间',
			'author'		=>	'文章作者',
			'deleted'		=>	'删除标志',
    	];

		return Validator::make($data, $rules, $messages);

	}

	public function createBlog(Request $request)
	{
		//获取入参
		$param = $request->all();
		
		//入参验证
		$validator = $this->rule($param);
		if ($validator->fails()) {
			$errors = $validator->errors();
			return $errors;
		}

		// $users = DB::table('users')->get();

		$users = \DB::table('tblblog')->get();
		
		$time = date("Y-m-d H:i:s",time());
		$showtime=date("Y-m-d H:i:s");
		print($showtime);exit;
		$addDate[] = [
			'title' => $param['title'],
			'content'=> $param['content'],
			'status' => isset($param['status']) ? $param['status'] : 1,
			'author' => isset($param['author']) ? $param['author'] : '吴烨',
			'create_time' => date('Y-m-d H:i:s', time()),
			'update_time' => date('Y-m-d H:i:s', time()),
		];
		
		$boolInsert = \DB::table('tblblog')->insert($addDate);
		if ($boolInsert) return 'insert success';

		return 'insert failed';
	}
}