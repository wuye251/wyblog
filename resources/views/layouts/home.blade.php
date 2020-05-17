<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>	wyblog
</title>
	<!-- <img src="/image/home/title.png"/> -->
	<!-- title中加入照片 -->
	<link rel="shortcut icon" href="/images/home/title.ico">
	

<link rel="stylesheet" href="/css/index.css">

<body>

	<div id="container">
		<div class="content">	
			<div id="content_menu">@yield('content_menu')</div>
			<div id="content_body">@yield('content_body')</div>
			<div id="content_sidebar">@yield('content_sidebar')右侧栏</div>
		</div><!-- content end -->

		<div id="footing">@yield('footing')底部栏</div>	

	</div>
</body>
</html>