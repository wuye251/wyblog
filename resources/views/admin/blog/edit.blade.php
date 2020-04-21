<link rel="stylesheet" href="/css/admin/home.css">
<link rel="stylesheet" href="/css/admin/create.css">

<script src="/js/app.js"></script>

@extends('layouts.admin.home')

@section('content')

	<form action="http://wyblog/admin/blog/update/{{$blog['id']}}" method="post" id="blogPublish">
		@csrf
	<div class="admin_create_content">
		<div class="admin_blog_create_title">
			<input class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="{{$blog['title']}}">
		</div>
		@include('editor::head')
		<!-- 重定义 markdown大小 -->
		<div class="editor" style="width: 100%;height: 1000px;">
    	<textarea id='myEditor' name="content" placeholder="请输入内容">
    			{{ $blog['content'] }}
    	</textarea>
		</div>

		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>修改提交</span>
			</button>
		</div>
	</div>
	</form>

@endsection


