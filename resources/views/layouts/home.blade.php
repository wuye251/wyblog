<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>	wyblog
</title>
	<!-- <img src="/image/home/title.png"/> -->
	<!-- title中加入照片 -->
	<link rel="shortcut icon" href="/images/home/favicon.ico">


<link rel="stylesheet" href="/css/index.css">

<body>

	<div id="container">
		<div id="heading">
			<div id="heading-body">
				<p id="welcome">欢迎来到wyblog</p>
				<input id="search" type="text" name="search" placeholder="Search or jump to">
				<div id="container_kindView">
					<a id="container_blog"  href="http://wyblog/blog/showAll">博客</a>
					<a id="container_veiw2" href="http://www.baidu.com">view2</a>
					<a id="container_veiw3" href="http://www.baidu.com">view3</a>
					<a id="container_veiw4" href="http://www.baidu.com">view4</a>
					<a id="container_veiw5" href="http://www.baidu.com">view5</a>
				</div>

				<div id="userView">
					<input id="isLogin" type="button" name="isLogin" onclick="location.href='http://www.baidu.com'" value="登录/注册">
				</div>
			</div>	
		</div><!-- header end -->

		<div class="content">	
			<div id="content_menu">@yield('content_menu')</div>
			<div id="content_body">@yield('content_body')</div>
			<div id="content_sidebar">@yield('content_sidebar')右侧栏</div>
		</div><!-- content end -->

		<div id="footing">@yield('footing')底部栏</div>	

	</div>
</body>
</html>