<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>	@yield('title')</title>
</head>

<link rel="stylesheet" href="/css/public/home.css">
<link rel="stylesheet" href="/css/public/head.css">
<link rel="stylesheet" href="/css/public/content.css">
<link rel="stylesheet" href="/css/public/foot.css">


<body class="public_home_body">
	<div class="public_home_head">
		@include('layouts.public.head')
	</div>
	<div class="public_home_content">
		@include('layouts.public.content')
	</div>
	<div class="public_home_foot">
		@include('layouts.public.foot')
	</div>
</body>
@yield('js')
</html>