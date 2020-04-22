<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/blog/showBlog.css">

@extends('layouts.admin.index')

@section('content')
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
					<div class="showBlog_content_body_operate">
						<a class="showAllBlogs_content_body_link" href="http://wyblog/admin/blog/edit/{{$blog['id']}}" target="_self">编辑</a>
					</div>
				</div><!-- summary end -->

				<div style="clear: both;"></div>
				<hr>
				<div class="showBlog_content_body_content">
					{!! htmlspecialchars_decode($blog['content'],ENT_QUOTES) !!}
				</div> <!-- content end -->
				<div class="showBlog_content_body_comment">
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
					<hr>

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

