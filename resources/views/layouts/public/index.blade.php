<!DOCTYPE html>
<html>
<head>
	<title>吴烨个人站</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/public/index.css')}}">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="col-md-3">
					<a href="#" class="navbar-brand">极客</a>
				</div>
			</div>

			<div class="collapse navbar-collapse">
				<div class="row">
					<ul class="nav navbar-nav col-md-3 col-md-offset-12" id="mytab">
						<li class="active"><a href="#">Link</a></li>
						<li ><a href="#">Link</a></li>
						<li ><a href="#">Link</a></li>
					</ul>

					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="搜索" name="">
							<button type="submit" class="btn btn-default">提交</button>
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="">登陆</a>
						</li>
					</ul>
				</div>
				
			</div>
		</div>
		
	</nav>
</body>
</html> 