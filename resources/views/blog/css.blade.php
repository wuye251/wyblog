<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
<style>
body
{
	background-color:#d0e4fe;
}
h1
{
	color:orange;
	text-align:center;
}
p
{
	font-family:"Times New Roman";
	font-size:20px;
}
</style>
</head>

	<body>
		<h1>CSS 实例!</h1>
		<p>这是一个段落。</p>
	</body>

</html>
 -->



<!-- <!DOCTYPE html>
<html>
<head>
<meta cherset="utf-8">
<title>wyblogCss</title>

<style>
	body {background-color: yellow}
	h1 {font-size:36pt;}
	h2 {color:blue;}
	p {margin-left: 50px;}
</style>
</head>

	<body>
		<h1>这是36pt大小的标题字体</h1>
		<h2>这是蓝色的标题</h2>

		<p>这是距离左边50px的段落</p>
	</body>

</html> -->


<!-- 实例2 -->
<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CSS实例2</title>
<style>
	body {background-color: tan;}
	h1 {color:maroon;font-size: 20pt;}
	hr {color:navy;}
	p {font-size:11pt;margin-left: 15px;}
	/*a:hover  必须跟在 a:link 和 a:visited后面
	  a:active 必须跟在 a:hover后面*/
	a:link	{color:green;}
	a:visited {color:red;}
	a:hover {color:black;}	
	a:active{color:blue;}
</style>
</head>
	<body>
		<h1>这是一个标题</h1>
		<hr>
		<p>这是一个段落
		<p><a href="https://www.baidu.com" target="_blank">这是一个链接</a></p>
	</body>

</html>
 -->

<!-- css中选择html特有元素进行样式展示 -->
<!-- <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CSS id样式展示</title>
<style>
	#para {
		color:red;
		text-align: center;
	}
	/*使用class 来将一组的元素属性进行展示*/
	.group {
		color :green;
		text-align: center;
	}
	/*指定某个特定的段落或者标题的样式设置*/
	p.group {
		color : pink;
		text-align: right;
	}
</style>

	<body>
		<p id="para">啦啦啦</p>
	</body>
	<br>
	<body>
		<h1 class="group">这是一组中的某个标题</h1>
		<p class="group">这是一组中的某个段落</p>
	</body>
</head>
</html>
 -->


<!-- CSS背景 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CSS背景</title>

<style>
	body 
	{
		background-image:url('gradient2.png');
		background-repeat:repeat-x; /*水平平铺*/
		background-repeat:no-repeat; /*不平铺*/
		background-position:right top; /*设置定位*/
		/*background-color:#cccccc;*/

		/*  background	简写属性，作用是将背景属性设置在一个声明中。
			background-attachment	背景图像是否固定或者随着页面的其余部分滚动。
			background-color	设置元素的背景颜色。
			background-image	把图像设置为背景。
			background-position	设置背景图像的起始位置。
			background-repeat	设置背景图像是否及如何重复。*/
	}
	h1 {background-color: #6495ed;}
	p {background-color: #e0ffff;}
	div {background-color: #b0c4de;}
</style>
	woshishizhege<br>
	<body>
		<h1>这是我的标题</h1>
		<div>
			插入div的文字
			<p>这是我的div里定义的段落颜色背景</p><br>
			<h1>lalala</h1>
		</div>
	</body>

</head>
</html>