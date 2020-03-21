<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //指定表名
	protected $table = 'comments';

	//指定主键
	protected $primaryKey = 'id';

	// const CREATE_AT = 'create_time';
	//删除自动维护的时间
	//因为没有设置update_at 自动维护会报错
	public $timestamps = false;


	/*
		id 主键id
		return 符合行信息
	*/
	public function getById($id)
	{
		$param = [			
		    'article_id' => $id,
			'status'     => 1,
 			'deleted'    => 0,
		];
		DB::connection()->enableQueryLog();
		$comments = Comments::where($param)
							->orderby('create_time', 'desc');
		// return response()->json(DB::getQueryLog());

		print_r(DB::getQueryLog());exit;
		return $comments;
	}
}
