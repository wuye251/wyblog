<link rel="stylesheet" href="/css/public/head.css">

<div class="head">
	<div class="head-body">
		<p class="welcome">欢迎来到wyblog</p>
		<input class="search" type="text" name="search" placeholder="Search or jump to">
		<div class="container_kindView">
			<a class="container_home"  href="@yield('view1_url')">@yield('view1')</a>
			<a class="container_blog"  href="@yield('view2_url')">@yield('view2')</a>
			<a class="container_veiw2" href="@yield('view3_url')">@yield('view3')</a>
			<a class="container_veiw3" href="@yield('view4_url')">@yield('view4')</a>
			<a class="container_veiw4" href="@yield('view5_url')">@yield('view5')</a>

			<a class="createBlog" href="@yield('createBlog_url')" target="_blank">@yield('createBlog')</a>
		</div>

		<!-- <a class="editBlog" href='/blog/view/createBlog'>创建博客</a> -->

		<div class="userView">
            @if (!Auth::guard('admin')->check())
				<input id="isLogin" type="button" name="isLogin" onclick="location.href='http://www.baidu.com'" value="登录/注册">
			@else
				<span style="color: #fff;"> {{ auth()->guard('admin')->user()->name }}</span> 
				
				<a style="color: #337ab7;"href="{{ route('adminLogout') }}">退 出</a>
            @endif

		</div>
	</div>	
</div><!-- header end -->