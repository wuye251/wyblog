<link rel="stylesheet" href="/css/admin/head.css">

@section('home_url', 'http://wyblog/admin')

@section('title', 'wyblog-admin')

@section('view1', '首页')
@section('view1_url', 'http://wyblog/admin')


@section('view2', '博客管理')
@section('view2_url', 'http://wyblog/admin/blog')


@section('view3', 'GitHub')
@section('view3_url', 'https://github.com/wuye251')


@section('createBlog', '创建文章')
@section('createBlog_url', 'http://wyblog/admin/blog/create')


@section('createBlog')
	<a class="container_createBlog" href="@yield('createBlog_url')">@yield('createBlog')</a>
@endsection
