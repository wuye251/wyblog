<?php 
 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comments;
use App\Models\Category;

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
        $articles = Blog::where('status', 1)
                     ->orderby('updated_at', 'desc')
                     ->paginate(10);

        $assign = [
            'blogs' => $articles,
        ];
        
        return view('admin.index', $assign);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //分类列表
        $category = Category::orderBy('sort', 'ASC')->get();

        $assign = compact('category');
        
        return view('admin.blog.create', $assign);
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
        $blog->html    = $markdown->convertMarkdownToHtml($param['content']);
        $blog->markdown= $param['content'];
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

        //分类标签
        $category = $blog->category;

        //评论
        $comments = new Comments;
        $param = [          
            'article_id' => $blogId,
            'status'     => 1,
        ];


        $comments = Comments::where($param)
                            ->orderby('create_time','desc')
                            ->get();
        $assign = compact('blog', 'comments', 'category');

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

        $category = $blog->category;

        $categoryList   = Category::all();
        $assign = compact('blog', 'category', 'categoryList');

        return view('admin.blog.create', $assign);
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
        
        //未勾选 给空值
        $param['category'] = $param['category'] ?? 0;

        $html = $markdown->convertMarkdownToHtml($param['content']);

        //加载对应内容  和创建文章相同
        $bool = Blog::where('id',$blogId)
                    ->update(['title'   => $param['title'],
                              'html'    => $html,
                              'markdown'=> $param['content'],
                              'category_id'=> $param['category'],
                            ]);

        return redirect('admin/blog');
    }

    //图片上传
    public function upload()
    {
        //
        // path 为 public 下面目录，比如我的图片上传到 public/uploads 那么这个参数你传uploads 就行了

        $data = EndaEditor::uploadImgFile('statistics/blog');
        return json_encode($data);
    }

    /**
     * 软删除博文
     * @param int $id
     * @return bool 
     */
    public function softDelete($blogId)
    {

        Blog::find($blogId)->delete();

        return route('index');
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blogId)
    {
        //
        Blog::forceDelete()->where('id',$blogId);


        return route('index');
    }

}
