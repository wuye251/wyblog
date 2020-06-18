@section('loginCheck')
	@if (!Auth::guard('oauth')->check())
		<li><a class="login-btn" data-toggle="modal" data-target="#login-modal">登陆</a></li>
	@else
		<li><a style="color: #fff;"> {{ auth()->guard('oauth')->user()->name }}</a></li>
		
		<li><a style="color: #337ab7;"href="{{ route('adminLogout') }}">退 出</a></li>
    @endif
@endsection
