<!DOCTYPE html>
<html>
<head>
	<title>吴烨个人站</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- 	<link rel="stylesheet" type="text/css" href="{{asset('/js/app.js')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/public/index.css')}}">
    

</head>
<body>
	<!-- 导航栏开始 -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">

			<div class="navbar-header col-md-1">
					<a href="@yield('nav_welcome')" class="navbar-brand">hello world</a>
			</div>

			<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav" id="mytab">
						<li class="b-nav-col active"><a class="btn" href="@yield('nav_index')" >首页</a></li>
						<li class="b-nav-col"><a class="btn" href="@yield('nav_blog')" >博客</a></li>
						<li class="b-nav-col"><a class="btn" href="{{config('const.github')}}" target="_blank" >Github</a></li>
						@yield('nav')
					</ul>
<!-- 
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="搜索" name="">
							<button type="submit" class="btn btn-default">提交</button>
						</div>
					</form> -->

					<ul class="nav navbar-nav navbar-right b-login">
						@yield('loginCheck')
					</ul>
				
			</div>
		</div>
	</nav>
	<!-- 导航栏结束 -->
	<div class="b-margin">
		@yield('content')
	</div>
	<!-- 底部信息开始 -->
	<div id="b-foot">
		<div class="container">
			<div class="row content">
				<dl class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-lg-offset-3">
					<dt><h3>权益</h3></dt>

						<dd>版权所有：© 2014-2020</dd>

						<dd>联系邮箱：<a href="mailto:{{config('const.mailto')}}">{{config('const.mailto')}}</a></dd>

						<dd>ICP 备案：<a href="http://www.beian.miit.gov.cn/">{{config('const.icp')}}</a></dd>
				</dl>

				<dl class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<dt><h3>架构</h3></dt>

						<dd>项目名称：<a rel="nofollow" href="{{config('const.version_url')}}" target="_blank">{{config('const.project_name')}}</a></dd>

						<dd>博客版本：<a rel="nofollow" href="{{config('const.version_url')}}" target="_blank">{{config('const.version')}}</a></dd>

	                	<dd>项目作者：{{config('const.author')}}</dd>

	                	<dd>框架版本：<a rel="nofollow"  href="https://github.com/laravel/framework" target="_blank">{{config('const.framework_ver')}}</a></dd>
	                
				</dl>

	<!-- 			<dl class="col-xs-12 col-sm-12 col-md-3 col-lg-3 b-social">
	                <dt>Social</dt>
	                <dd class="b-small-logo">
	                	 <a rel="nofollow" href="https://github.com/baijunyao" target="_blank"><img src="https://baijunyao.com/images/home/social-github.png" alt="github"></a>rel="nofollow" href="https://gitee.com/wuye251
	            </dl> -->
			</div>
		</div>
	</div>
	<!-- 底部信息结束 -->
</body>
<script>
$(function () {
　　$("#mytab").find("li").each(function () {

　　　　var a = $(this).find("a:first")[0];

　　　　 if ($(a).attr("href") === location.pathname) {

　　　　　　$(this).addClass("active");

　　　　} else {

　　　　　　 $(this).removeClass("active");

　　　　}

　　});

})
</script>
</html> 


<!-- 登陆弹窗 -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                <h4 class="modal-title login-title" id="myModalLabel">无需注册，用以下帐号即可直接登录。</h4>
            </div>
              <div class="row">
                  <div class="col-xs-12 col-md-12 col-lg-12 login-icon" > 
                    <a class="fa fa-github" href="{{ url('home/login/github') }}" alt="GitHub" title="给他哈勃"></a>
                    <!-- <div class="fa fa-qq" title="QQ"></div> -->
                  </div>
              </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>