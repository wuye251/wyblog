<link rel="stylesheet" href="/css/admin/home.css">
<link rel="stylesheet" href="/css/admin/create.css">

<script src="/js/app.js"></script>

@extends('layouts.public.home')

@section('title', 'wyblog-admin')

@section('view1', '博客管理')


@section('view2', 'GitHub')
@section('view2_url', 'https://github.com/wuye251')

@section('createBlog', '创建文章')
@section('createBlog_url', 'https://wyblog/admin/blog/create')

@section('content')

	<form action="./store" method="post" id="blogPublish">
		@csrf
	<div class="admin_create_content">
		<div class="admin_blog_create_title">
			<input class="admin_blog_create_title_input" placeholder="请输入标题" name="title">
		</div>
		@include('editor::head')
		<!-- 重定义 markdown大小 -->
		<div class="editor" style="width: 100%;height: 1000px;">
    	<textarea id='myEditor' name="content" placeholder="请输入内容"></textarea>
		</div>

		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>发布博文</span>
			</button>
		</div>
	</div>
	</form>

@endsection
