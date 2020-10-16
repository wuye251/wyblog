
@section('nav_welcome', '/')
@section('nav_index', '/')
@section('nav_blog', '/blog')

@section('loginCheck')
	@if (!Auth::guard('oauth')->check())
		<li><a class="login-btn" data-toggle="modal" data-target="#login-modal">登陆</a></li>
	@else
		<li><a class="login-name"> {{ auth()->guard('oauth')->user()->name }}</a></li>
		
		<li><a style="color: #337ab7;"href="{{ route('adminLogout') }}">退 出</a></li>
    @endif
@endsection
