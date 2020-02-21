<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>wyblogs查看</title>
<!-- <meta name="viewpoint" content="width=device-width, initial-sacle=1"> -->
<!-- <base href="wyblog/blog/"> -->

<style>
	body {
		margin: 0 0 0 0;
	}

	.header {
		background-color: #000000;
		padding: 1;
		height: 65px;
		text-align: center;
	}
	.search {
		width: 100px;
		height: 30px;
		margin-top: 5px;
		margin: 6px 0 50px 0; 
	}

	.title {
		background-color: #f1f1f1;
  		padding: 1;
  		text-align: center;
  		/*display: block;*/
	}
	.titleText {
		font-size: 100%;
		text-align: center;
	}
	/*初始颜色*/
	a:visited {color:white;}
	/*鼠标悬浮*/
	a:hover {color:green;}

	.sideBar {
		width: 180px;
		height: 200px;
		padding-top: 200px;
		padding-left:200px;
		/*边框*/
		border-style: solid;
		/*和内容框并排*/
		float: left;
	}
	.Maincontent {
		width:500px;
		height: 500px;
		border-style: solid;
		padding-top: 200px;
		padding-left: 200px;
		float: left;
	}
	.rightSideBar {
		width: 240px;
		height: 500px;
		/*padding-top: 30px;*/
		/*padding-left:30px;*/
		/*边框*/
		border-style: solid;
		/*内容右侧悬浮*/
		float: left;
	}

</style>
</head>

<body>

	<div class="header">
		<!-- 搜索栏 -->
		<input class="search" type="text" name="searchContent">

		<a class="titleText" href="showAll">博客</a>s
	</div>

	<div class="title">
		<span><a href="">横栏内容</a></span>
	</div>

	<div class="content">
		<div class="sideBar">
			侧边栏
		</div>
		
		<div class="Maincontent">
			内容栏
		</div>
		
		<div class="rightSideBar">
			右侧边栏
		</div>
	</div>
</body>


</head>
</html>
