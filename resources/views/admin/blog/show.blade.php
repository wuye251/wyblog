<link rel="stylesheet" href="/css/admin/blog.css">
<link rel="stylesheet" href="/css/blog/showBlog.css">

<script src="{{ asset('js/highlight.pack.js') }}"></script>
<link href="{{ asset('css/highlight/monokai-sublime.css') }}" rel="stylesheet">

<script >hljs.initHighlightingOnLoad();</script> 

@extends('layouts.public.index')

@extends('layouts.admin.module')


@section('content')
	<div class="showBlog_content_body">
			<div class="showBlog_content_body_allInfo">
				<div class="showBlog_content_body_title">
							{{ $blog['title'] }}
						<hr>
				</div><!-- title end -->

				<div class="showBlogs_content_body_summary">
					<div class="showAllBlogs_content_body_authorInfo">
						<p class="fa fa-user">{{$blog['author']}}   </p>
					</div>

					<div class="showAllBlogs_content_body_timeInfo">
						<p class="fa fa-calendar">{{$blog['updated_at']}}</p>
					</div>
					
					<div class="showAllBlogs_content_body_category">
						<p class="fa fa-tags"> 
						@if (!$category['name']) 
						   暂无分类
						@else
						{{$category['name']}} 
						@endif
						</p>
					</div>
					<div class="container">
						<dt class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<a class="blog-operate-link" href="{{route('editBlog', $blog['id'])}}" target="_self">编辑</a>
							<a class="blog-operate-link" href="{{route('softDelete', $blog['id'])}}" target="_self">刪除</a>
							<a class="blog-operate-link" href="{{route('destory', $blog['id'])}}" target="_self">徹底刪除</a>
						</dt>
					</div>
				</div><!-- summary end -->

				<div style="clear: both;"></div>
				<hr>
				<div class="showBlog_content_body_content">
					{!! htmlspecialchars_decode($blog['html'],ENT_QUOTES) !!}
				</div> <!-- content end -->
				<!-- <div class="showBlog_content_body_comment">
					<hr>
					<span class="comment_title">咖啡厅</span>
					<br />
					<div class="comment_contentAndSumit">
						<form action="/blog/comment/create/{{$blog['id']}}" method="get" class="comment_commit">	
							<textarea class="comment_content" name="commentContent" placeholder="火钳刘明(●'◡'●)"></textarea>
							<br />
							<input class="conmment_submit" type="submit" value="提交">
						</form>
					</div>
					<br />
 -->					<hr>

					<div class="comment_list">
						@foreach($comments as $commentKey => $commentValue)
							{{$commentValue['create_time']}}
							{{$commentValue['content']}}
							<hr>
						@endforeach
					</div> <!-- 评论列表展示结束 -->
				</div>
			</div>
	</div>		
	

@endsection

