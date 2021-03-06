<?php


namespace App\Http\Controllers\Blogs;

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

		$blog = new Blog;
		
		// $users = DB::table('tblblog')->get();
		
		$blog->title   = $param['title'];
		$blog->content = $param['content'];
		$blog->status  = isset($param['status']) ? $param['status'] : 1;
		$blog->author  = $param['author'];
		
		$boolInsert = $blog->save();
		

		if ($boolInsert) return redirect('blog/index');

		return 'insert failed';
	}
}