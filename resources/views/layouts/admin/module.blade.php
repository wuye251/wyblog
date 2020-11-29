<!-- 导航栏 -->
@section('nav')
    <li class="nav-item b-nav-col">
    	<a class="nav-link" href="{{route('admin.noteList')}}" target="_blank" style="color: rgba(234, 229, 229, 0.9);">时间藤条</a></li>
    </li>
    <li class="nav-item b-nav-col">
    	<a class="nav-link" href="{{route('createBlog')}}" target="_blank" style="color: rgba(234, 229, 229, 0.9);">新建</a></li>
    </li>

	<!-- <li class="b-nav-col"><a href="{{route('createBlog')}}" target="_blank">新建</a></li> -->
@endsection

@section('nav_welcome', '/admin')
@section('nav_index', '/admin')
@section('nav_blog', '/admin/blog')
<!-- 登陆验证 -->
@section('loginCheck')
	@if (!Auth::guard('admin')->check())
		<li><a class="login-btn btn" data-toggle="modal" data-target="#login-modal">登录</a></li>
	@else
		<li><a class="login-name"> {{ auth()->guard('admin')->user()->name }}</a></li>
		
		<li><a style="color: #f1f2f7b3"href="{{ route('adminLogout') }}">退 出</a></li>
    @endif
@endsection


