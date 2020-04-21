<?php 
 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comments;
use EndaEditor;
use App\Common\MarkDowner;

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
                     ->paginate(20);

        $assign = [
            'blogs' => $articles,
        ];
        
        return view('admin.home', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取入参
        $param = $request->all();
        
        $blog = new Blog;
        $markdown = new MarkDowner; 

        $blog->title   = $param['title'];
        $blog->content = $markdown->convertMarkdownToHtml($param['content']);
        $blog->status  = isset($param['status']) ? $param['status'] : 1;
        $blog->author  = '吴烨';

        $boolInsert = $blog->save();

        if ($boolInsert) return redirect('admin/blog');

        return 'insert failed';
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

        return view('admin.blog.show', $assign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blogId)
    {
        //
        $blog = Blog::findOrFail($blogId);

        $markdown = new MarkDowner; 
        $blog['content'] = $markdown->convertHtmlToMarkdown($blog['content']); 

        $assign = compact('blog');

        return view('admin.blog.edit', $assign);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blogId)
    {
        $param = $request->all();

        $markdown = new MarkDowner;
        
        $content = $markdown->convertMarkdownToHtml($param['content']);

        //加载对应内容  和创建文章相同
        $bool = Blog::where('id',$blogId)
                    ->update(['title'  => $param['title'],
                              'content'=> $content,
                            ]);

        return redirect('admin/blog');
    }

    //图片上传
    public function uploadImage()
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
