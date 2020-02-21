<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>wyblog</title>
	<style type="text/css">
		body {
			margin: 0;
		}
		#container {
			width: 100%;
			height: 950px;
			background-color: darkgray;
		}
		#heading {
			width: 100%;
			height: 5%;
			background-color: black;
			color : white;
		}
		#content_menu {
			width: 25%;
			height: 40%;
			background-color: green;
			float: left;
		}		
		#content_body {
			width: 60%;
			height: 90%;
			background-color: yellow;
			float: left;
		}
		#content_sidebar {
			width: 15%;
			height: 70%;
			background-color: pink;
			float: left;
		}
		#footing {
			width:100%;
			height: 5%;
			background-color: blue;
			clear: both;
		}
		/*头部 欢迎词*/
		#welcome {
			margin-top:	5px;
			font-size: 120%;
			margin-left: 20px;
			display: inline-block;
		}
		/*搜索框*/
		#search {
			width: 20%;
			height: 70%;
			margin-left: 40px;
			margin-top: 4px;
			/*并行*/
			display: inline-block;
			/*框的形状设置 设置边框圆角效果 */
			border-radius: 5px;
			/*字体设置*/
			font-size: 18px;
			font-family: "verdana";

		}
		/*头部各个栏目*/
		#container_kindView {
			margin-left: 40px;
			color: white;
			display: inline-block;
			width: 50%;
		}
		/*以下几个是各个栏目字体及间距设置*/
		/*#container_kindView:visited {color:white;}*/
		#container_blog {
			margin-left: 10px;
			color: white;
		}
		#container_veiw2 {
			margin-left: 10px;
			color: blue;
		}
		#container_veiw3 {
			margin-left: 10px;
			color: green;
		}
		#container_veiw4 {
			margin-left: 10px;
			color: pink;
		}
		#container_veiw5 {
			margin-left: 10px;
			color: red;
		}

		/*title右侧用户信息*/
		#userView {
			display: inline-block;
		}
		#isLogin {
			width: 100px;
			height: 5%;
		}
	</style>
</head>

<body>
	<div id="container">
		<div id="heading">
			<p id="welcome">欢迎来到wyblog</p>
			<input id="search" type="text" name="search" placeholder="Search or jump to">
			<div id="container_kindView">
				<a id="container_blog"  href="http://www.baidu.com">博客</a>
				<a id="container_veiw2" href="http://www.baidu.com">view2</a>
				<a id="container_veiw3" href="http://www.baidu.com">view3</a>
				<a id="container_veiw4" href="http://www.baidu.com">view4</a>
				<a id="container_veiw5" href="http://www.baidu.com">view5</a>
			</div>

			<div id="userView">
				<input id="isLogin" type="button" name="isLogin" value="登录/注册">
			</div>
		</div>
		<div id="content_menu">左侧用户信息</div>
		<div id="content_body">内容主体</div>
		<div id="content_sidebar">右侧栏</div>
		<div id="footing">底部</div>	
	</div>
</body>
</html>