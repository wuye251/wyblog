<link rel="stylesheet" href="/css/blog/showBlog.css">

@extends('layouts.home')


<!-- 博客页面左侧用户信息 -->
@section('content_menu')
	个人博客用户信息
@endsection

<!-- 博客内容列表侧内容 -->
@section('content_body')
	<div class="showBlog_content_body">
			<div class="showBlog_content_body_allInfo">
				<div class="showBlog_content_body_title">
							{{ $blog['title'] }}
						<hr>
				</div><!-- title end -->

				<div class="showBlog_content_body_summary">
					<div class="showAllBlogs_content_body_authorInfo">
						<p>{{$blog['author']}}   </p>
					</div>

					<div class="showAllBlogs_content_body_timeInfo">
						<p>{{$blog['updated_at']}}</p>
					</div>
					
					<div class="showAllBlogs_content_body_category">
						<p>php练习生日常</p>
					</div>
				</div><!-- summary end -->
				<div style="clear: both;"></div>
				<hr>
				<div class="showBlog_content_body_content">
					11这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据这是一个假数据 
				</div>
			</div>
	</div>		
	

@endsection

<!-- 右侧评论内容 -->
@section('content_sidebar')
	右侧评论
@endsection

