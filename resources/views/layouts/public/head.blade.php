<link rel="stylesheet" href="/css/public/head.css">

<div class="head">
	<div class="head-body">
		<p class="welcome">欢迎来到wyblog</p>
		<input class="search" type="text" name="search" placeholder="Search or jump to">
		<div class="container_kindView">
			<a class="container_home"  href="/">首页</a>
			<a class="container_blog"  href="/blog">@yield('view1')</a>
			<a class="container_veiw2" href="@yield('view2_url')">@yield('view2')</a>
			<a class="container_veiw3" href="http://www.baidu.com">@yield('view3')</a>
			<a class="container_veiw4" href="http://www.baidu.com">@yield('view4')</a>
		</div>

		<!-- <a class="editBlog" href='/blog/view/createBlog'>创建博客</a> -->

		<div class="userView">
			<input id="isLogin" type="button" name="isLogin" onclick="location.href='http://www.baidu.com'" value="登录/注册">
		</div>
	</div>	
</div><!-- header end -->