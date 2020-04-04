<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>	@yield('title')</title>

<link rel="stylesheet" href="/css/public/home.css">


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