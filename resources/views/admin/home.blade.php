<link rel="stylesheet" href="/css/admin/home.css">
<link rel="stylesheet" href="/css/public/paginate.css">
<link rel="stylesheet" href="/css/public/blogList.css">

@extends('layouts.public.home')

@section('title', 'wyblog-admin')



@section('home_url', 'http://wyblog/admin')

@section('view1', '博客管理')
@section('blog_url', 'http://wyblog/admin/blog')

@section('view2', 'GitHub')
@section('view2_url', 'https://github.com/wuye251')

@section('createBlog', '创建文章')
@section('createBlog_url', 'http://wyblog/admin/blog/create')

@section('content')
	<div class="admin_home_content">
		<div class="admin_home_conten_bloglist">
			<div class="home_home_main_content">
			<div class="showAllBlogs_content_body">
			@foreach($blogs as $k => $v)
				<div class="showAllBlogs_content_body_allInfo">
					<div class="showAllBlogs_content_body_title">
						<a class="showAllBlogs_content_body_link" href="http://wyblog/admin/blog/{{$v['id']}}" target="view_window">
							{{ $v['title'] }}
						</a> <!-- 打印标题 并且赋值超链接 -->
					</div>
					<div class="showAllBlogs_content_body_timeInfo">
						<p>{{$v['updated_at']}}  {{$v['author']}}</p>
					</div>
					<div class="showAllBlogs_content_body_summary">
						<p>写死的摘要内容</p>
					</div>
						<div class="showAllBlogs_content_body_operate_view" href="http://wyblog/admin/blog/{{$v['id']}}">查看</div>
						<div class="showAllBlogs_content_body_operate_edit">编辑</div>
				</div>
			@endforeach
			</div>
			</div>
		</div>
		<div>
			<ul class="showAllBlogs_content_pagination">
				<li>{{$blogs->links()}}</li>
			</ul>
		</div>
	</div>
@endsection