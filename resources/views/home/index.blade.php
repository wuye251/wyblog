<link rel="stylesheet" href="/css/public/blogList.css">
<link rel="stylesheet" href="/css/home/index.css">
<link rel="stylesheet" href="/css/public/paginate.css">

@extends('layouts.home.index')

<!-- 博客页面左侧用户信息 -->
@section('content_menu')
	个人博客用户信息
@endsection


@section('content')
	<div class="home_home_left_content"></div>
	
	<div class="home_home_main_content">
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
					<p></p>
				</div>
			</div>
		@endforeach

		</div>
		<div style="position: relative;">
			<ul class="showAllBlogs_content_pagination">
				<li>{{$blogs->links()}}</li>
			</div>
	</div>

	<div class="home_home_right_content"></div>
@endsection
