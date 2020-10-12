<?php 
 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comments;
use App\Models\Category;
use App\Models\Tag;
use App\Models\BlogTag;

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
        $tagsList = Tag::orderBy('id', 'DESC')->get();

        $assign = compact('tagsList');
        
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
        $input = $request->all();
        
        $markdown = new MarkDowner; 
        
        $input['html']    = $markdown->convertMarkdownToHtml($input['markdown']);

        $input['status'] = 1;
        $tagIds = $input['tagIds'];
        $tagNames = $input['tagNames'];
        $arrTagIds = ($tagIds) ? explode('#', $tagIds) : [];
        $arrTagNames = ($tagNames) ? explode('#', $tagNames) : [];
        unset($input['tagIds']);
        unset($input['tagNames']);

        $blog = Blog::create($input);

        if ($blog) {
            $blogTag = new BlogTag();
            if ($arrTagIds) {
                $blogTag->addTagIds($blog->id, $arrTagIds);
            }

            #添加新标签
            if ($arrTagNames) {
                foreach ($arrTagNames as $item => $tagNameVal) {
                    $fields = ['name' => $tagNameVal];

                    $tagRet = Tag::create($fields);

                    $insertTagIds[] = $tagRet->id;

                }
                if ($insertTagIds) {
                    $blogTag->addTagIds($blog->id, $insertTagIds);
                }
            }
        }
        
        return json_encode('success');
        // return redirect('admin/blog');
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
        //标签
        $tags = $blog->tag;

        //评论
        $comments = new Comments;
        $param = [          
            'article_id' => $blogId,
            'status'     => 1,
        ];

        /* 评论
        $comments = Comments::where($param)
                            ->orderby('create_time','desc')
                            ->get();
        */

        $assign = compact('blog', 'comments', 'tags');
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

        $tagsObj = $blog->tag;

        $tags = [];
        #设置对应键值 
        foreach ($tagsObj as $item => $tagVal) {
            $tags[$tagVal['id']] = $tagVal;
        }
        /* 分类
        $categoryList   = Category::all();
        */

        #标签
        $tagsList = Tag::all();

        $assign = compact('blog', 'tags', 'tagsList');

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

        $html = $markdown->convertMarkdownToHtml($param['markdown']);

        //加载对应内容  和创建文章相同
        $bool = Blog::where('id',$blogId)
                    ->update(['title'   => $param['title'],
                              'html'    => $html,
                              'markdown'=> $param['markdown'],
                              'category_id'=> $param['category'],
                            ]);

        $tagIds = $param['tagIds'];
        $tagNames = $param['tagNames'];
        $arrTagIds = ($tagIds) ? explode('#', $tagIds) : [];
        $arrTagNames = ($tagNames) ? explode('#', $tagNames) : [];
        unset($param['tagIds']);
        unset($param['tagNames']);

        if ($bool) {
            $blogTag = new BlogTag();
            #删除中间表
            $blog = Blog::find($blogId);
            $deleBool = $blog->BlogTag()->delete();
            if ($arrTagIds) {
                $blogTag->addTagIds($blogId, $arrTagIds);
            }
            #添加新标签
            if ($arrTagNames) {
                foreach ($arrTagNames as $item => $tagNameVal) {
                    $fields = ['name' => $tagNameVal];

                    $tagRet = Tag::create($fields);

                    $insertTagIds[] = $tagRet->id;

                }
                if ($insertTagIds) {
                    $blogTag->addTagIds($blog->id, $insertTagIds);
                }
            }
        }

        return json_encode('success');
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
