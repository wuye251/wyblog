<!DOCTYPE html>
<html>
<head>
	<title>吴烨个人站</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/public/index.css')}}">
    <script src="{{mix('/js/app.js')}}"></script>
</head>


<body>
	<!-- 导航栏开始 -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> -->
  		<a class="navbar-brand" href="@yield('nav_welcome')">hello world</a></a>
		<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button> -->


		 <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto" id="mytab">
		        <li class="nav-item active b-nav-col">
		        	<a class="nav-link" href="@yield('nav_index')">首页 <span class="sr-only">(current)asdasd</span></a>
		        </li>
		        <li class="nav-item b-nav-col">
		        	<a class="nav-link" href="@yield('nav_blog')" >博客</a></li>
		        </li>
		        <li class="nav-item b-nav-col">
		        	<a class="nav-link" href="{{config('const.github')}}" target="_blank" >Github</a></li>
		        </li>
				@yield('nav')
   			</ul>
   			<ul class="nav navbar-nav navbar-right b-login">
				@yield('loginCheck')
			</ul>
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
				<dl class="col-xs-12 col-sm-6 col-md-3 col-lg-5">
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