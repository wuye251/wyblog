<!-- <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/public/head.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<link rel="stylesheet" href="/css/admin/head.css">

<!-- @section('home_url', '/admin')

@section('title', 'wyblog-admin')

@section('view1', '首页')
@section('view1_url', '/admin')


@section('view2', '博客管理')
@section('view2_url', '/admin/blog')


@section('view3', 'GitHub')
@section('view3_url', 'https://github.com/wuye251')
 -->

@section('createBlog', '创建文章')
@section('createBlog_url', '/admin/blog/create')

@section('createBlog')
	<a class="btn container_createBlog" href="@yield('createBlog_url')">@yield('createBlog')</a>
@endsection


@section('loginCheck')
	@if (!Auth::guard('admin')->check())
		<input id="isLogin" type="button" name="isLogin" onclick="location.href='http://www.baidu.com'" value="登 录">
	@else
		<span style="color: #807474;"> {{ auth()->guard('admin')->user()->name }}</span> 
		
		<a style="color: #337ab7;"href="{{ route('adminLogout') }}">退 出</a>
    @endif
@endsection