
@section('nav_welcome', '/')
@section('nav_index', '/')
@section('nav_blog', '/blog')

@section('loginCheck')
	@if (!Auth::guard('oauth')->check())
		<li><a class="login-btn" data-toggle="modal" data-target="#login-modal">登录</a></li>
	@else
		<li><a class="login-name"> {{ auth()->guard('oauth')->user()->name }}</a></li>
		
		<li><a style="color: #f1f2f7b3"href="{{ route('OAuthLogout') }}">退 出</a></li>
    @endif
@endsection
