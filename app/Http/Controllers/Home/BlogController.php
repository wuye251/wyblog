<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comments;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                     ->paginate(10);

        $assign = [
            'blogs' => $articles,
        ];

        return view('home.index', $assign);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blogId)
    {
        //博文
        $blog = Blog::findOrFail($blogId);
        //评论
        $comments = new Comments;
        $param = [          
            'article_id' => $blogId,
            'status'     => 1,
        ];
        $comments = Comments::where($param)
                            ->orderby('create_time','desc')
                            ->get();

        $assign = compact('blog', 'comments');

        return view('home.blog', $assign);
    }
}
