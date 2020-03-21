<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//DB连接
use Illuminate\Support\Facades\DB;
//markdown引入
use Parsedown;
//model Comments
use App\Models\Comments;

class CommentController extends Controller
{
	public function index($blogId)
	{

		$queryWhere = [
			'article_id' => $blogId,
 			'deleted'    => 0,
			'status'     => 1,
		];
		$comments = Comments::where($queryWhere)
							->orderby('create_time', 'desc');

		return $comments;
	}

	public function create($blogId, Request $request)
	{

		$param = $request->all();

		$content = $param['commentContent'];

		$comments = new Comments;

		$comments->content = $content;
		$comments->article_id = $blogId;
		$comments->save();

		// Comments::create(array(
		// 	'content' => $content,
		// 	'article_id' => $blogId,
		// ));

		return '123123123';
	}

	public function update()
	{

	}

	public function delete()
	{

	}
}
