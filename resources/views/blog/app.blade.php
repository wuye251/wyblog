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
<base href="//www.runoob.com/images/" target="_blank">
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




</html>