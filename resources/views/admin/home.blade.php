<link rel="stylesheet" href="/css/admin/home.css">

@extends('layouts.public.home')

@section('title', 'wyblog-admin')

@section('view1', '博客管理')


@section('view2', 'GitHub')
@section('view2_url', 'https://github.com/wuye251')


@section('content')
	@foreach($blogs as $k => $v)
		{{$v['title']}}
	@endforeach


@endsection