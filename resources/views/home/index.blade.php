<link rel="stylesheet" href="/css/blog/showAllBlogs.css">
@extends('layouts.home')

<!-- 博客页面左侧用户信息 -->
@section('content_menu')
	个人博客用户信息
@endsection

<!-- 博客内容列表侧内容 -->
@section('content_body')
	<div class="showAllBlogs_content_body">
		@foreach($blogs as $k => $v)
			<div class="showAllBlogs_content_body_allInfo">
				<div class="showAllBlogs_content_body_title">
					<a class="showAllBlogs_content_body_link" href="http://wyblog/blog/{{$v['id']}}" target="view_window">
						{{ $v['title'] }}
					</a> <!-- 打印标题 并且赋值超链接 -->
				</div>
				<div class="showAllBlogs_content_body_timeInfo">
					<p>{{$v['updated_at']}}  {{$v['author']}}</p>
				</div>
				<div class="showAllBlogs_content_body_summary">
					<p>写死的摘要内容</p>
				</div>
				<hr>
			</div>
		@endforeach
	</div>
		<ul class="showAllBlogs_content_pagination">
			<li>{{$blogs->links()}}</li>


@endsection

<!-- 右侧评论内容 -->
@section('content_sidebar')
	右侧评论
@endsection

@section('footing')
	底部栏
@endsection

