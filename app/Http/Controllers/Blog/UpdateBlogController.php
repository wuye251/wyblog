<?php


namespace App\Http\Controllers\Blog;


//入参获取
use Illuminate\Http\Request;
//入参字段验证
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class UpdateBlogController extends Controller
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
			// 'id'            =>  'required',
			'title' 		=>	'nullable',
			'content'		=>	'nullable',
			'status'		=>	'required',
			'create_time'	=>  'nullable',
			'update_time'	=>  'nullable',
			'author'		=>	'nullable',
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

	/*
	 *更新字段过滤  防注入
	 */
	public function columnFilter($arrInput)
	{
		$updateId = $arrInput['blogId'];

		$updateFields = [];
		if (isset($arrInput['titile'])) {
			$updateFields['titile'] = $arrInput['titile'];
		}
		if (isset($arrInput['content'])) {
			$updateFields['content'] = $arrInput['$content'];
		}
		if (isset($arrInput['status'])) {
			$updateFields['status'] = $arrInput['status'];
		}
		$updateFields['update_time'] = date('Y-m-d H:i:s', time());
		$boolUpdate = \DB::table('tblblog')
					->where('id', $updateId)
					->update($updateFields);
		return $boolUpdate;
	}

	public function updateBlog(Request $request)
	{
		$param = $request->all();
		
		if (!isset($param['blogId'])) return 'id missed';

		$blogId = $param['blogId'];
		//数据是否存在
		$users = \DB::select('select * from tblblog where id = ? and status = ?', [$blogId, 0]);
		
		if (!$users) return 'blogId not exists';

		//参数验证
    	$validator = $this->rule($param);

		if ($validator->fails()) {
			$errors = $validator->errors();
			return $errors;
		}

		$boolRetUpdate = $this->columnFilter($param);
		if (!$boolRetUpdate) {
			return 'update failed [update fields：' . "$param" . ']'; 
		}
		return 'update success';
	}
}
