<!-- 导航栏 -->
@section('nav')
	<li class="b-nav-col"><a href="{{route('createBlog')}}" target="_blank">新建</a></li>
@endsection

<!-- 登陆验证 -->
@section('loginCheck')
	@if (!Auth::guard('admin')->check())
		<li><a class="login-btn" data-toggle="modal" data-target="#login-modal">登陆</a></li>
	@else
		<li><a style="color: #fff;"> {{ auth()->guard('admin')->user()->name }}</a></li>
		
		<li><a style="color: #337ab7;"href="{{ route('adminLogout') }}">退 出</a></li>
    @endif
@endsection


