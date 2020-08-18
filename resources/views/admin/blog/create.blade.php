<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/blog/createBlog.css">

    <script src="{{mix('/js/app.js')}}"></script>
@extends('layouts.public.index')

@extends('layouts.admin.module')

@section('content')
		
	@if (!isset($blog))
	<form action="./store" method="post" id="blogPublish"></form>
	@else
	<form action="{{route('admin.update', $blog['id'])}}" method="post" id="blogPublish"></form>
	@endif
	
	@csrf
	<div class="admin_create_content">
		<div class="admin_blog_create_title">
			<a class="b-title-return" href="{{route('index')}}">< 文章管理</a>
			<div class="b-title-input">
				@if (isset($blog))
				<input maxlength="100" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="{{$blog['title']}}">
				<!-- <span class="b-title-count">0/100</span> -->
				@else
				<input maxlength="100" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="">
				<!-- <span class="b-title-count">0/100</span> -->
				@endif
			</div>
			<div class="b-edit-operate">
					<button class="btn-save" id="save">保存草稿</button>
					<button class="btn-publish" id="publish">发布文章</button>
			</div>
		</div>
		@include('editor::head')
		<!-- 重定义 markdown大小 -->
		<div class="editor" style="width: 100%;height: 95%;">
		@if (isset($blog))
    		<textarea id='myEditor' name="content" placeholder="请输入内容">{{ $blog['markdown'] }}</textarea>
    	@else 
    		<textarea id='myEditor' name="content" placeholder="请输入内容"></textarea>
    	@endif
		</div>
	</div>

<!-- 		<div class="form-group">
            <label class="checkbox-inline">
            @if (isset($blog))
			@foreach($categoryList as $item => $info)
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}

            </label> 
			 @endforeach
			@else
			@foreach($category as $item => $info)
                <input type="checkbox"  value="{{$info['id']}}" name="category">{{$info['name']}}
            </label> 
			@endforeach
			@endif
		</div>
		</div> -->
		
<!-- 		<div class="publish_setting">
			<button class="publish_publishbtn">
				<span>提 交</span>
			</button>
		</div>
	</div>
	</form>
	 -->

@endsection


<script type="text/javascript">
	$(document).ready(function(){
        $("#publish").colorbox({
        	width: "500px",
        	height: "50%",
        	inline: true,
        	href: "#cbox-category"
    	});
    });
</script>

<style type="text/css">
	.tag__options-list {
	    padding: 8px 8px 0 0;
	    width: 403px;
	    max-height: 117px;
	    background: #fff;
	    overflow-x: hidden;
	    overflow-y: auto;
	    border: 1px solid #e8e8ee;
	    margin: auto;
	}

	.tag__option-box {
	    float: left;
	    height: 210px;
	    line-height: 21px;
	    white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    margin: 0 16px 8px 0;
	    font-size: 14px;
	    font-family: PingFangSC-Regular,PingFang SC;
	    font-weight: 400;
	    color: #606266;
	}
	.tag__option-box label.tag__option-label {
	    padding-left: 10px;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    user-select: none;
	    cursor: pointer;
    }
    .cbox-fron {
	    margin-top: 20px;
	    margin-left: 11px;
	    padding: 8px;
	    font-size: 19px;
	    display: inline-block;
    }

    .btn-cbox {
    	margin-top: 61px;
    	margin-left: 180px;
    }
    .blog__option-box {
    	margin-left: 32px;
    }
    .blog__option-label{
    	width: 100px;
    }
    .btn-cbox-publish {

    }

    .el-radio {
	    color: #606266;
	    font-weight: 500;
	    line-height: 1;
	    position: relative;
	    cursor: pointer;
	    display: inline-block;
	    white-space: nowrap;
	    outline: none;
	    font-size: 14px;
	    margin-right: 30px;
	    -moz-user-select: none;
	    -webkit-user-select: none;
	    -ms-user-select: none;
	}

	.el-radio__input {
	    white-space: nowrap;
	    cursor: pointer;
	    outline: none;
	    display: inline-block;
	    line-height: 1;
	    position: relative;
	    vertical-align: middle;
	}
	.cbox-category-title {
		display: inline-block;
	}
	.tag__option-box button.tag__btn-tag {
		margin-top: 4px;
	    color: #79a5e5;
	    height: 28px;
	    padding: 0 8px;
	    border-radius: 4px;
	    border: 1px solid rgba(38,125,204,.1);
	    color: #555666;
	    font-size: 14px;
	    background-color: rgba(148, 131, 131, 0.15);;
	}
	.parent-tag input{
		width: 100px;
	}

	.parent-tag {
		display: inline-block;
	}
	.append-tag {
		display: inline-block;
	}
	.cbox-add-tag {
		display: inline-block;
	}

</style>


<div id="cbox-parent" style="display: none;">
	<div id="cbox-category">
		<div class="cbox-fron">分类专栏：</div>
		<div class="append-tag"></div>
		<div class="cbox-add-tag">
			<button type="button" class="tag__btn-tag" onclick="addCategory()">
		    	+ 新建分类
			</button>
		</div>
		<div class="tag__options-list">
			<div class="tag__option-box">
				<label class="tag__option-label">
					<input type="checkbox" class="tag__option-chk" value="blog">测试标签1
				</label>
				<label class="tag__option-label">
					<input type="checkbox" class="tag__option-chk" value="blog">测试标签1
				</label>
				<label class="tag__option-label">
					<input type="checkbox" class="tag__option-chk" value="blog">测试标签1
				</label>
			</div>
		</div>

		<div id="cbox-blog-viewable">
			<div class="cbox-fron">发布类型:</div>
			<div class="blog__option-box">
				<label role="radio" tabindex="0" class="el-radio is-checked" aria-checked="true">
					<span class="el-radio__input is-checked">
						<span class="el-radio__inner"></span>
						<input type="radio" aria-hidden="true" name="kind" tabindex="-1" class="el-radio__original" value="private">
					</span>
					<span class="el-radio__label">公开</span>
				</label>
				
				<label role="radio" tabindex="0" class="el-radio is-checked" aria-checked="true">

					<span class="el-radio__input is-checked">
						<span class="el-radio__inner"></span>
						<input type="radio" aria-hidden="true" name="kind" tabindex="-1" class="el-radio__original" value="private">
					</span>
					<span class="el-radio__label">私密</span>
				</label>
			</div>
		</div>

		<div class="btn-cbox">
			<button class="btn-publish btn-cbox-publish" type="submit">发布文章</button>
		</div>
	</form>
	</div>
</div>


<script type="text/javascript">
	index = 1;
	function addCategory(){
		var html  = '<div class="parent-tag"><input type="text" class="tag__option-chk" value="">';
			html += '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="rmCategory(this)">';
  			html += '<path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>';
 	 		html += '<path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>';
			html += '</svg></div>';
		$(".append-tag").append(html);
	}
	function rmCategory(obj){
		$(obj).parent().remove();
	}
</script>