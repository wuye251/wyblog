@extends('layouts.public.home')

@include('layouts.home.public.head')

@section('loginCheck')
	@if (!Auth::guard('oauth')->check())
		<a id="isLogin" style="color: white" name="isLogin" href="{{ route('OAuthLogin') }}" >登 陆</a>
	@else
		<span style="color: #fff;"> {{ auth()->guard('oauth')->user()->name }}</span> 
		
		<a style="color: #337ab7;" href="{{ route('OAuthLogout') }}">退 出</a>
    @endif
@endsection

