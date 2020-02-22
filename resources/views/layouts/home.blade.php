<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>wyblog</title>
<link rel="stylesheet" href="/css/index.css">
	
</head>

<body>
	<div id="container">		
		<div id="heading">
			@section('heading')
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
				<input id="isLogin" type="button" name="isLogin" onclick="location.href='http://www.baidu.com'" value="登录/注册">

			</div>
		@show
		</div>

		<div id="content_menu">左侧用户信息</div>
		<div id="content_body">内容主体

		</div>
		<div id="content_sidebar">右侧栏</div>
		<div id="footing">
		</div>	
	</div>
</body>
</html>