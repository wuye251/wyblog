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
		<a id="isLogin" style="color: white" type="name="isLogin" href="{{ route('OAuthGetInfo', 'github') }}" >登 陆</a>

    @endif
@endsection