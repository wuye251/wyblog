<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/public/paginate.css">
<link rel="stylesheet" href="/css/public/blogList.css">
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

@extends('layouts.admin.index')


@section('content')
	<div class="admin_home_content">
		<div class="admin_home_conten_bloglist">
			<div class="home_home_main_content">
			<div class="showAllBlogs_content_body">
			@foreach($blogs as $k => $v)
				<div class="showAllBlogs_content_body_allInfo">
					<div class="showAllBlogs_content_body_title">
						<a class="showAllBlogs_content_body_link" href="{{route('showBlog', $v['id'])}}" target="view_window">
							<h2 class="blog-titile">{{ $v['title'] }} </h2>
						</a> <!-- 打印标题 并且赋值超链接 -->
					</div>
					<div class="showAllBlogs_content_body_timeInfo">
					<p class="fa fa-user">  {{$v['author']}} </p> 
					<p class="fa fa-calendar"> {{$v['updated_at']}} </p>
					<p class="fa fa-tags">  
						@if (!$v->category['name']) 
						   暂无分类
						@else
						{{($v->category)['name']}} 
						@endif
					</p>
					
					</div>
					<div class="showAllBlogs_content_body_summary">
						<p></p>
					</div>

					<div class="blog-operate">
						<a class="showAllBlogs_content_body_operate_view" href="http://wyblog/admin/blog/{{$v['id']}}">查 看</a>
						<a class="showAllBlogs_content_body_operate_edit" href="{{route('editBlog', $v['id'])}}">编 辑</a>
					</div>

				</div>
			@endforeach
			</div>
			</div>
		</div>
		<div style="position: relative;">
			<ul class="showAllBlogs_content_pagination">
				<li>{{$blogs->links()}}</li>
			</ul>
		</div>
	</div>
@endsection