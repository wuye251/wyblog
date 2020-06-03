<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/admin/create.css">

<script src="/js/app.js"></script>

@extends('layouts.admin.index')

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
    	<textarea id='myEditor' name="content" placeholder="请输入内容">{{ $blog['markdown'] }}</textarea>
		</div>

		<div class="form-group">
            <label class="checkbox-inline">
			@foreach($categoryList as $item => $info)
				@foreach($category as $i => $v)
					@if($v['category_id'] == $info['id'])
		                <input type="checkbox"  checked value="{{$info['id']}}" name="category">{{$info['name']}}
		                {{countinue}}
		            @endif
		        @endforeach
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}
            </label> 
			 @endforeach
		</div>
		
		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>修改提交</span>
			</button>
		</div>
	</div>
	</form>

@endsection


