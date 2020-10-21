<link rel="stylesheet" href="/css/admin/index.css">
<link rel="stylesheet" href="/css/blog/createBlog.css">

    <script src="{{mix('/js/app.js')}}"></script>
    <script src="{{asset('/js/tips.js')}}"></script>

@extends('layouts.public.index')

@extends('layouts.admin.module')

@section('content')

	@if (!isset($blog))
	<input id="blogId" type="hidden" value="">
	<form action="./store" method="post" id="blogPublish">
	@else
	<input id="blogId" type="hidden" value="{{$blog['id']}}">
	<form action="{{route('admin.update', $blog['id'])}}" method="post" id="blogPublish">
	@endif

	@csrf
	<div class="admin_create_content">
		<div class="admin_blog_create_title">
			<a class="b-title-return" href="{{route('index')}}">< 文章管理</a>
			<div class="b-title-input">
				@if (isset($blog))
				<input maxlength="100" id="title" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="{{$blog['title']}}">
				<!-- <span class="b-title-count">0/100</span> -->
				@else
				<input maxlength="100" id="title" class="admin_blog_create_title_input" placeholder="请输入标题" name="title" value="">
				<!-- <span class="b-title-count">0/100</span> -->
				@endif
			</div>
			<div class="b-edit-operate">
					<button class="btn-save" id="save">保存草稿</button>
					<button class="btn-publish" id="publish">发布文章</button>
			</div>
		</div>

		<div class="b-summary-input" style="width: 83%; margin:auto">
			<div style="display: inline-block;background: #f3e9e9;font-size: 23px;">摘要：</div>
			@if (isset($blog))
			<textarea maxlength="100" id="summary" class="admin_blog_create_title_input" placeholder="写点摘要" name="summary" value="{{$blog['summary']}}" style="width: 93%;">{{$blog['summary']}}</textarea>
			<!-- <span class="b-title-count">0/100</span> -->
			@else
			<textarea maxlength="100" id="summary" class="admin_blog_create_title_input" placeholder="写点摘要" name="summary" value="" style="width: 93%;"></textarea>
			<!-- <span class="b-title-count">0/100</span> -->
			@endif
		</div>


		@include('editor::head')
		<!-- 重定义 markdown大小 -->
		<div class="editor" style="width: 83%;height: 95%; margin:auto">
		@if (isset($blog))
    		<textarea id='myEditor' name="markdown" placeholder="请输入内容">{{ $blog['markdown'] }}</textarea>
    	@else 
    		<textarea id='myEditor' name="markdown" placeholder="请输入内容"></textarea>
    	@endif
		</div>


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
	.modal.in .modal-dialog {
	    z-index: 1040;
	}

	.tag__options-list {
	    padding: 8px 8px 0 0;
	    width: 403px;
	    max-height: 117px;
	    background: #fff;
	    margin: auto;
	}

	.tag__option-box {
	    float: left;
	    /*height: 210px;*/
	    line-height: 21px;
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
				@foreach($tagsList as $item => $tagVal)
				<label class="tag__option-label">
					@if(isset($tags) && isset($tags[$tagVal['id']]))
					<input id="tagId__{{$tagVal['id']}}"type="checkbox" class="tag__option-chk" checked="checked" value="{{$tagVal['id']}}">{{ $tagVal['name'] }}
					@else
					<input id="tagId__{{$tagVal['id']}}"type="checkbox" class="tag__option-chk" value="{{$tagVal['id']}}">{{ $tagVal['name'] }}
					@endif
				</label>
				@endforeach
			</div>
		</div>

		<div id="cbox-blog-viewable">
			<div class="cbox-fron">发布类型:</div>
			<div class="blog__option-box">
				<label role="radio" tabindex="0" class="el-radio is-checked" aria-checked="true">
					<span class="el-radio__input is-checked">
						<span class="el-radio__inner"></span>
						@if((isset($blog) && $blog['status'] == 1) || !isset($blog))
						<input id="blog-type" type="radio" aria-hidden="true" checked="true" id="kind" name="kind" tabindex="-1" class="el-radio__original" value="1">
						@else
						<input id="blog-type" type="radio" aria-hidden="true" id="kind" name="kind" tabindex="-1" class="el-radio__original" value="1">
						@endif
					</span>
					<span class="el-radio__label">公开</span>
				</label>
				
				<label role="radio" tabindex="0" class="el-radio is-checked" aria-checked="true">

					<span class="el-radio__input is-checked">
						<span class="el-radio__inner"></span>
						@if(isset($blog) && $blog['status'] == 2)
						<input id="blog-type" type="radio" aria-hidden="true" checked="true" name="kind" id="kind" tabindex="-1" class="el-radio__original" value="2">
						@else
						<input id="blog-type" type="radio" aria-hidden="true" name="kind" id="kind" tabindex="-1" class="el-radio__original" value="2">
						@endif
					</span>
					<span class="el-radio__label">私密</span>
				</label>
			</div>
		</div>

		<div class="btn-cbox">
			<button type="submit" class="btn-publish btn-cbox-publish" onclick="submitBlog()">发布文章</button>
		</div>
	</form>
	</div>
</div>


<script type="text/javascript">
	index = 1;
	function addCategory(){
		var html  = '<div class="parent-tag" id="tagName"><input type="text" class="tag__option-chk" value="">';
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

<!-- ajax提交 -->
<script type="text/javascript">
	function submitBlog() {
		var title   = $("#title").val();
		var content = $("#myEditor").val();
		var summary = $("#summary").val();

		var tagIds  = '';
		$("[id^='tagId__']").each(function(item, val){
			if (val.checked) {
				if (tagIds == '') { 
					tagIds = $(val).val();
				} else {
					tagIds += '#' + $(val).val();
				}
			}
			
		}); //已有标签列表

		var tagNames = ''  //新建标签
		$("[id^='tagName']").each(function(item, val){
			if (tagNames == '') { 
				tagNames = $(val).find("input").val();
			} else {
				tagNames += '#' + $(val).find("input").val();
			}
		}); //已有标签列表

		//公开私密
		var status = '';
		$("[id^='blog-type']").each(function(item, val){
			if (val.checked) {
				status = $(val).val();
			}
			
		});

		var url = '';
		var blogId = $("#blogId").val();
		if (blogId != "") {
			url = "{{route('admin.update', $blog['id'] ?? '')}}";
		} else {
			url = "{{route('storeBlog')}}";
		}


		if (title.length == 0) {
			alert("标题不能为空");
			// $("#title").tips({msg: "标题不能为空"});
			return -1;
		}
		if (summary.length == 0) {
			alert("摘要不能为空");
			// $("#myEditor").tips({msg: "好歹写点什么塞~"});
			return -1;
		}

		if (content.length == 0) {
			alert("内容不能为空");
			// $("#myEditor").tips({msg: "好歹写点什么塞~"});
			return -1;
		}

		var data = {
			"title":   title,
			"markdown": content,
			"tagIds":   tagIds,
			"tagNames": tagNames,
			"author":  "吴烨",
			"summary": summary,
			'status': status,
		};

		console.log(data);


		$.ajax({
			type: 'POST',
			url:  url,
			data: data,
			dataType: 'json',
			success: function (response) {
				if (response == 'success') {
					window.location.href="{{route('index')}}";
				} else {
					alert('unexception');
				}
			},
			error: function (response) {
				console.log('response----'+response)
				alert('error>>'+response);
			}
		})



	}
</script>

@endsection
