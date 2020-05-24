<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/public/head.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

@section('title', 'wyblog')

@section('view1', '首页')
@section('view1_url', 'http://wyblog')

@section('view2', '博客')
@section('view2_url', 'http://wyblog/blog')

@section('view3', 'GitHub')
@section('view3_url', 'https://github.com/wuye251')


@section('loginCheck')
	@if (auth()->guard('oauth')->check())
		<span style="color: #fff;"> {{ auth()->guard('oauth')->user()->name }}</span> 
		
		<a style="color: #337ab7;" href="{{ route('OAuthLogout') }}">退 出</a>
	@else

		<!-- <a id="isLogin" style="color: white" name="isLogin" href="{{ route('OAuthGetInfo', 'github') }}" >登 陆</a> -->
		<button class="btn btn-primary login-btn" data-toggle="modal" data-target="#login-modal">
			登陆
		</button>

		<!-- <a id="isLogin" style="color: white" type="name="isLogin" href="{{ route('OAuthGetInfo', 'github') }}" >登 陆</a> -->
    @endif
@endsection