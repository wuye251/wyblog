<!DOCTYPE html>
<html>

<head>
<!-- <head> 元素包含了所有的头部标签元素。在 <head>元素中你可以插入脚本（scripts）, 样式文件（CSS），及各种meta信息。
可以添加在头部区域的元素标签为: <title>, <style>, <meta>, <link>, <script>, <noscript>, and <base>. -->
<!-- <link> 标签定义了文档与外部资源之间的关系。
<link> 标签通常用于链接到样式表: -->
<link rel="stylesheet" type="text/css" href="mystyle.css">


<!-- <style> 标签定义了HTML文档的样式文件引用地址.
在<style> 元素中你也可以直接添加样式来渲染 HTML 文档: -->
<style type="text/css">
body {background-color:white}
p {color:red}
</style>

<meta name="author" content="Runoob">

<!-- 语言 -->
<meta charset="utf-8"> 
<!-- 标题 -->
<title>hahahah(runoob.com)</title>
<!-- 定义了浏览器工具栏的标题
当网页添加到收藏夹时，显示在收藏夹中的标题
显示在搜索引擎结果页面的标题 -->

<!-- 设置一个链接相对地址  并且默认需要打开新窗口 -->
<!-- <base href="//www.runoob.com/images/" target="_blank"> -->
</head> 

<h1> 这是一个标题 </h1>
<!-- 下划线 -->
<hr>
<h2> 这也是<br>一个标题</h2>
<hr>
<p>  这是一个段落</p>



<body>
<a href="www.baidu.com/">这是一个链接</a>
<a href="www.baidu.com/" target="_blank">这是一个链接 target blank 将新建窗口打开</a>

<!-- 这是一个图片 -->
<img src="/images/logo.png" width="250" height="380" />

<!-- 开始标签 *  元素内容             结束标签 *
<p>        这是一个段落            </p>
<a        href="default.htm">  这是一个链接  </a>
<br>    换行    -->
<br><br>
<b>加粗</b>    <strong>加粗strong代替b</strong><br> 
<i>斜体</i>    <em>斜体em代替i</em><br>
<code>电脑自动输出</code><br>
这是<sub>下标</sub>和<sup>上标</sup>
<ins>插入字</ins>

<a id="tips">有用的提示部分</a>
<a href="#tips">访问有用的提示部分</a>
</body> 




<!-- 2020/2/15 -->
<meta charset="utf-8">
<title>2020/2/15前端学习</title>
<style type="text/css">
h1 {color:red;}
p {color:black;}
</style>
<body>
    <h1>这是一个标题</h1>
    <p>这是一个段落</p>
    <!-- CSS的内联样式 -->
    <p style="color:blue;margin-left:200px;background-color: yellow">这是内联样式</p>
    <p style="color:blue;margin-left:200px;margin-right: 900px; background-color: yellow">
    这是内联样式</p>
    <h2 style="color:white; background-color: black">这是一个白色字体 黑色背景的标题</h2>

    <!-- font-family学习定义字体样式 -->
    <h3 style="font-family: verdana">自定义字体的标题</h3>
    <p style="font-family: arial; color:red; font-size:20px">让我康康这个段落是傻样纸滴</p>

</body>

<!-- body某个单元样式设置 -->


<!-- 下一知识点 html中的图片显示 -->
<body>
    <h2>lalalalala</h2>
    <!-- alt表示图片无法显示时输出错误信息 -->
    <img border="0" src="/images/pulpit.jpg" alt="Pulpit rock"  style="float:right" width="330" height="320">;
    <!-- <img src="url" alt="some_text">     -->

    <!-- 创建图片链接 -->
    <p> 这个有边框的有链接嘛后面？
    <a href="//wyblog">
    <img border="10" src="smiley.gif" alt="试一试" width="32" height="32"></p>
    <img border="0" src="smiley.gif" alt="无边框的？" width="32" height="32"></a></p>

</body>


<!-- html 表格学习   -->
<body>
    <p>
每个表格从一个 table 标签开始。 
每个表格行从 tr 标签开始。
每个表格的数据从 td 标签开始。
</p>
    <table border="1">
        <tr>
            <td>100</td>
        </tr>
    </table>

    <p>一行两列 </p>
    <table border="1">
        <tr>
            <td>100</td>
            <td>200</td>
        </tr>
    </table>
    <p>两行一列</p>
    <!-- border是边框属性 -->
    <table border="2">
        <th>这是表格的表头</th>
        <tr>
            <td>300</td>
        </tr>
        <tr>
            <td>400</td>
        </tr>
    </table>


    <h4>单元格间距="10":</h4>
    <!-- cellspacing表示表格间距 -->
    <table border="1" cellspacing="10">
        <tr>
            <td>First</td>
            <td>Row</td>
        </tr>
        <tr>
        <td>Second</td>
        <td>Row</td>
        </tr>
    </table>

    <h5>单元格边距="10":</h5>
    <!-- cellpadding表示表格间距 -->
    <table border="1" cellpadding="10">
        <tr>
            <td>First</td>
            <td>Row</td>
        </tr>
        <tr>
        <td>Second</td>
        <td>Row</td>
        </tr>
    </table>

</body>


<!-- HTML <div> 标签 -->
<p>以后就可以使用div来替代body分割知识点的块元素啦</p>
<div style="color:#0000FF">    
    <h>这是div里的标题</h>
    <p>这是div里的段落</p>
</div>
<p1>这是div外的段落</p1>

<!-- 使用 <span> 元素对文本中的一部分进行着色： -->
<p>我的母亲有 <span style="color:blue">蓝色</span> 的眼睛。</p>

<!-- HTML布局 -->
<body>

<div id="container" style="width:100%">
    <div id="header" style="background-color:#FFA500">
        <h1 style="margin-bottom: 0">主要的网页标题</h1>
        <div id="menu" style="background-color: #FFD700; height: 200px; width: 100px; float:left;">
            <b>菜单</b><br>
            HTML<br>
            CSS<br>
            Javescript
        </div>

        <div id="content" style="background-color: #EEEEEE; height: 100%; width:400px; float: left;">
            内容在这里
        </div>

        <div id="footer" style="background-color: #FFA500; clear:both; text-align: center;">
            版权  @版权是我滴
        </div>
    </div>
</div>


<!-- HTML表单和输入 -->
<div>
    <form action="">
        账号：<input type="text" name="account"><br>
        <!-- type=password 用户输入密码不显示 -->
        密码：<input type="password" name="password"><br>
        <!-- submit 提交按钮-->
        <input type="submit" value="login"><br>
        <!-- type=radio 为单选按钮 -->
        <input type="radio" name="sex" value="male">Male<br>
        <input type="radio" name="sex" value="female">Female<br>
        <!-- checkbox 为复选框 -->
        <input type="checkbox" name="vehicle" value="Bike">I have a bike<br>
        <input type="checkbox" name="vehicle" value="Car">I have a car<br>
    </form>

</div>

</body>


<!-- iframe  html框架 -->
<!-- <iframe src="URL"></iframe>  -->
<div>
    <iframe src="demo_iframe.htm" width="200" height="200"></iframe>
    <!-- frameborder iframe的边框 -->
    <iframe src="demo_iframe.htm" frameborder="0"></iframe>
    <!-- 使用iframe来显示目标链接页面,iframe可以显示一个目标链接的页面,目标链接的属性必须使用iframe的属性，如下实例: -->
    <iframe src="demo_iframe" name="iframe_a"></iframe>
    <p><a href="https://www.baidu.com" target="iframe_a">iframe学习</a></p>
    <!-- 上面通过点击iframe_a文字 在上面的iframe框中可以显示href的url地址 -->
</div>
</html>
