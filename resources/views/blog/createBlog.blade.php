<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>新建blog</title>

<style>
    body {
        background-color: #F5F5F5;
    }
    .title {
/*      background-color: blue;
        height: 200px;*/
        text-align: center;
    }
    table, td, th
    {
        /*border:10px solid #FFFFFF;*/
        margin: auto;
    }
    /*定义标题输入框大小*/
    #titleInput {
        height: 25px;
    }
    /*id形式的用#来表示
      class用.表示
     */
    #contentInput {
        font-size: 20px;
        color : #000000;/*纯黑*/
    }
</style>
    <div>
        <h1 class="title">Laravel 6.x 个人博客</h1>
    </div>

    <div>
        <form action="{{url('/blog/create')}}" method="GET">   
            <table width="50%" algin="right" cellpadding="10" border="30">
                <tr>
                    <td>
                        <!-- 下面注释的内容 是想把title的默认文字显示  value直接赋值比较麻烦 
                              后面提交输入的value还需要修改 -->
                        <!-- <input class="titleInput" type="text" size="100%" name="title" value="请输入内容"> -->
                        <!-- baidu的placeholder="这里输入文字" 替代 -->
                        <input id="titleInput" name="title" type="text" size="100%"  placeholder="请输入标题">
                    </td>
                <tr>
                    <td>
                    <!-- 文章表格准备用input展示  baidu使用了下面的文本域 -->
                    <!-- <td>文章内容<input class="contentInput" type="text" size="100%" name="content"> -->
                        <textarea id="contentInput" name="content" rows="50" cols="71%"></textarea>
                    </td>
                </tr>
            </table>
                <!-- submit必须要和上面表单放在一起 -->
                <!-- 下面添加div是让其居中 -->
            <div style="text-align:center">
                <!-- 临时作者框 -->
                作者<input name="author" type="text">

                <input id="submitDisplay" type="submit" value="createBlog" style=" border:10px solid #DC143C">
            </div>
        </form>
    </div>

</html>