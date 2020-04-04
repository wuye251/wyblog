<link rel="stylesheet" href="/css/home/index.css">

@extends('layouts.public.home')

@section('title', 'wyblog-admin')

@section('view1', '博客')

@section('view2', 'GitHub')
@section('view2_url', 'https://github.com/wuye251')

@section('content')
	<div class="home_home_main_content">
<!-- 		@foreach($blogs as $k => $v)
			{{$v['title']}}
		@endforeach -->
	</div>
@endsection