<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">


@extends('layouts.public.index')

@extends('layouts.admin.module')

@section('content')
	<!-- <div class="home_home_left_content"></div> -->
	
	<!-- <div class="home_home_main_content"> -->

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-left: 204px;"style="margin-left: 175px;">
			@foreach($blogs as $k => $v)
				<div class="row b-blog-summay">
					<h3 class="col-xs-12 col-md-12 col-lg-12 b-titile">
						<a class="blog-titile" href="{{route('admin.show',$v['id'])}}">@if($v['status'] == 2)(私密)@endif{{ $v['title'] }} </a>
					</h3>
					<div class="col-xs-12 col-md-12 col-lg-12  b-summary-date">
	                    <div class="row">
	                        <dl class="col-xs-4 col-md-4 col-lg-4">
	                            <dt class="fa fa-user"></dt> {{ $v->author }}
	                        </dl>
	                        <dl class="col-xs-4 col-md-4 col-lg-4">
	                            <dt class="fa fa-calendar"></dt> {{ $v->updated_at }}
	                        </dl>
	                        <dl class="col-xs-4 col-md-4 col-lg-4">
	                        	<dt class="fa fa-tags" style="margin-top: 7px;">  
	                        		@if(!$v->tag->isEmpty())
		                        		@foreach($v->tag as $item => $tagInfo)
		                        			{{$tagInfo->name}}
		                        		@endforeach
		                        	@else
		                        		暂无分类
		                        	@endif
								</dt>
	                        </dl>
	                    </div>
	                </div>

					<div class="col-xs-12 col-md-12 col-lg-12 operate">
						<a class="col-xs-4 col-md-4 col-lg-4" href="{{route('admin.show',$v['id'])}}">查 看</a>
						<a  class="col-xs-4 col-md-4 col-lg-4" href="{{route('editBlog', $v['id'])}}">编 辑</a>
						<a  class="col-xs-4 col-md-4 col-lg-4" href="{{route('softDelete', $v['id'])}}">刪 除</a>
					</div>
					
	                
	                <!-- 文章摘要 -->
	                <div class="b-des" style="padding: 0 100px 10px 100px;">
	                	    {{ $v['summary'] }}
	                </div>
	                <!-- 文章摘要结束 -->

<!-- 	            	<a href="{{route('blog_content', $v['id']) }}" class="btn-read">查看文章</a> -->
	            </div>
			@endforeach
			</div>
		</div>

<!-- 		<div style="position: relative;">
			<ul class="showAllBlogs_content_pagination">
				<li>{{$blogs->render()}}</li>
		</div> -->
		<div id="pull_right">
	       <div class="pull-right">
	          {!! $blogs->render() !!}
	       </div>
 		</div>
	</div>

@endsection