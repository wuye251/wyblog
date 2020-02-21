<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>wyblogs查看</title>
<meta name="viewpoint" content="width=device-width, initial-sacle=1">
<!-- <base href="wyblog/blog/"> -->
<style>
	body {
		margin: 0 0 0 0;
	}
	.header {
		background-color: #000000;
		padding: 1;
		text-align: center;
		
	}
	.title {
		background-color: #f1f1f1;
  		padding: 1;
  		text-align: center;
  		display: block;
	}
	/*初始颜色*/
	a:visited {color:white;}
	/*鼠标悬浮*/
	a:hover {color:green;}
</style>
</head>

<body>

	<div class="header">
		<a href="showAll">博客</a></span>
	</div>

	<div class="title">
		<span><a href="">横栏内容</a></span>
	</div>
		hello , {{ $blogsInfo }}
</body>
</head>
</html>
