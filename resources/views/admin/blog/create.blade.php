<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/blog/createBlog.css">

    <script src="{{mix('/js/app.js')}}"></script>
@extends('layouts.public.index')

@extends('layouts.admin.module')

@section('content')
		
	@if (!isset($blog))
	<form action="./store" method="post" id="blogPublish"></form>
	@else
	<form action="{{route('admin.update', $blog['id'])}}" method="post" id="blogPublish"></form>
	@endif
	
	@csrf
	<div class="admin_create_content">
		<div class="admin_blog_create_title">
			<a class="b-title-return" href="{{route('index')}}">< 文章管理</a>
			<div class="b-title-input">
				@if (isset($blog))
				<input maxlength="100" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="{{$blog['title']}}">
				<!-- <span class="b-title-count">0/100</span> -->
				@else
				<input maxlength="100" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="">
				<!-- <span class="b-title-count">0/100</span> -->
				@endif
			</div>
			<div class="b-edit-operate">
					<button class="btn-save" id="save">保存草稿</button>
					<button class="btn-publish" id="publish">发布文章</button>
			</div>
		</div>
		@include('editor::head')
		<!-- 重定义 markdown大小 -->
		<div class="editor" style="width: 100%;height: 95%;">
		@if (isset($blog))
    		<textarea id='myEditor' name="content" placeholder="请输入内容">{{ $blog['markdown'] }}</textarea>
    	@else 
    		<textarea id='myEditor' name="content" placeholder="请输入内容"></textarea>
    	@endif
		</div>
	</div>

<!-- 		<div class="form-group">
            <label class="checkbox-inline">
            @if (isset($blog))
			@foreach($categoryList as $item => $info)
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}

            </label> 
			 @endforeach
			@else
			@foreach($category as $item => $info)
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}
            </label> 
			@endforeach
			@endif
		</div>
		</div> -->
		
<!-- 		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>提 交</span>
			</button>
		</div>
	</div>
	</form>
	 -->

@endsection

<script type="text/javascript">
	$(document).ready(function(){
        $("#publish").colorbox({transition: "fade"});
    	});
</script>

