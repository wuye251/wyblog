<link rel="stylesheet" href="/css/showAllBlogs.css">

@extends('layouts.home')


<!-- 博客页面左侧用户信息 -->
@section('content_menu')
	个人博客用户信息
@endsection

<!-- 博客内容列表侧内容 -->
@section('content_body')
	<div class="showAllBlogs_content_body">
		@foreach($blogsInfo['fields'] as $k => $v)
			<div class="showAllBlogs_content_body_title">{{ $v['title'] }}</div>
			<div class="showAllBlogs_content_body_timeInfo">{{$v['updated_at']}}  {{$v['author']}}</p><br></div>
			<div class="showAllBlogs_content_body_summary">写死的摘要内容</p></div>
			<hr>
		@endforeach
	</div>
		<ul class="showAllBlogs_content_pagination">
			<li>{{$blogsInfo['fields']->links()}}</li>

<!-- 			<li><a href="{{$blogsInfo['fields']['first_page_url']}}">首页</button>
		    <li><a href="{}">«</a></li>
		    <li><a href="#">1</a></li>
		    <li><a class="active" href="#">2</a></li>
		    <li><a href="#">3</a></li>
			<li><a href="{{$blogsInfo['fields']['last_page_url']}}">尾页</button>
 -->
@endsection

<!-- 右侧评论内容 -->
@section('content_sidebar')
	右侧评论
@endsection

