<link rel="stylesheet" type="text/css" href="{{ asset('css/home/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">

@extends('layouts.public.index')

@extends('layouts.home.module')

@section('content')
	<!-- <div class="home_home_left_content"></div> -->
	
	<!-- <div class="home_home_main_content"> -->

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-left: 204px;">
			@foreach($blogs as $k => $v)
				<div class="row b-blog-summay">
					<h3 class="col-xs-12 col-md-12 col-lg-12 b-titile">
						<a class="blog-titile" href="{{ route('blog_content', $v['id']) }}">{{ $v['title'] }} </a>
					</h3>
					<div class="col-xs-12 col-md-12 col-lg-12  b-summary-date">
	                    <div class="row">
	                        <dl class="col-xs-4 col-md-4 col-lg-3 col-lg-offset-2">
	                            <dt class="fa fa-user"></dt> {{ $v->author }}
	                        </dl>
	                        <dl class="col-xs-4 col-md-4 col-lg-4">
	                            <dt class="fa fa-calendar"></dt> {{ $v->updated_at }}
	                        </dl>
	                        <dl class="col-xs-4 col-md-4 col-lg-3">
	                        	<dt class="fa fa-tags">  
		                        	@if (!$v->category['name']) 
								   		暂无分类
									@else
										{{($v->category)['name']}} 
									@endif
								</dt>
	                        </dl>
	                    </div>
	                </div>

	                <!-- 文章摘要 -->
	                <div class="b-des">
	                	    这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试这是一个摘要我来测试
	                </div>
	                <!-- 文章摘要结束 -->

	            	<a href="{{route('blog_content', $v['id']) }}" class="btn-read">查看文章</a>
	            </div>
			@endforeach
			</div>
		</div>

		</div>
		<div style="position: relative;">
			<ul class="showAllBlogs_content_pagination">
				<li>{{$blogs->links()}}</li>
		</div>
	</div>

@endsection
