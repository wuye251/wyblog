<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/admin/create.css">

<script src="/js/app.js"></script>

@extends('layouts.admin.index')


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

		<div class="form-group">
			@foreach($category as $item => $info)
            <label class="checkbox-inline">
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}
            </label> 
			 @endforeach
		</div>
		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>发布博文</span>
			</button>
		</div>
	</div>
	</form>

@endsection
