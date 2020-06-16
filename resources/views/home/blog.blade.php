<link rel="stylesheet" href="/css/blog/showBlog.css">
<link rel="shortcut icon" href="/images/home/title.ico">
<script src="{{ asset('js/highlight.pack.js') }}"></script>
<link href="{{ asset('css/highlight/monokai-sublime.css') }}" rel="stylesheet">
<script >hljs.initHighlightingOnLoad();</script> 
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">


@extends('layouts.public.index')


<!-- 博客页面左侧用户信息 -->
@section('content_menu')
	个人博客用户信息
@endsection

<!-- 博客内容列表侧内容 -->
@section('content')
	<div class="showBlog_content_body">
			<div class="showBlog_content_body_allInfo">
				<div class="showBlog_content_body_title">
							{{ $blog['title'] }}
						<hr>
				</div><!-- title end -->

				<div class="showBlog_content_body_summary">
					<div class="showAllBlogs_content_body_authorInfo">
						<p class="fa fa-user">{{$blog['author']}}   </p>
					</div>

					<div class="showAllBlogs_content_body_timeInfo">
						<p class="fa fa-calendar">{{$blog['updated_at']}}</p>
					</div>
					
					<div class="showAllBlogs_content_body_category">
						<p class="fa fa-tags">{{$category['name']}}</p>
					</div>
				</div><!-- summary end -->
				<div style="clear: both;"></div>
				<hr>
				<div class="showBlog_content_body_content">
					{!! htmlspecialchars_decode($blog['html'],ENT_QUOTES) !!}
				</div> <!-- content end -->
				<div class="showBlog_content_body_comment">
					<hr>
					<!-- <span class="comment_title">咖啡厅</span> -->
					<!-- <br /> -->
<!-- 					<div class="comment_contentAndSumit">
						<form action="/blog/comment/{{$blog['id']}}" method="POST" class="comment_commit">	
							@csrf
							<textarea class="comment_content" name="commentContent" placeholder="火钳刘明(●'◡'●)"></textarea>
							<input class="conmment_submit" type="submit" value="提交">
						</form>
					</div> -->
					<!-- <br /> -->
					<!-- <hr> -->

					<div class="comment_list">
<!-- 						@foreach($comments as $commentKey => $commentValue)
							{{$commentValue['create_time']}}
							{{$commentValue['content']}}
							<hr>
						@endforeach
 -->					</div> <!-- 评论列表展示结束 -->
				</div>
			</div>
	</div>		
	

@endsection

<!-- 右侧评论内容 -->
@section('content_sidebar')
	右侧评论
@endsection

