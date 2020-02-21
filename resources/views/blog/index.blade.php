<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>div布局</title>
	<style type="text/css">
		body {
			margin: 0;
		}
		#container {
			width: 100%;
			height: 950px;
			background-color: darkgray;
		}
		#heading {
			width: 100%;
			height: 5%;
			background-color: black;
			color : white;
		}
		#content_menu {
			width: 25%;
			height: 40%;
			background-color: green;
			float: left;
		}		
		#content_body {
			width: 60%;
			height: 90%;
			background-color: yellow;
			float: left;
		}
		#content_sidebar {
			width: 15%;
			height: 70%;
			background-color: pink;
			float: left;
		}
		#footing {
			width:100%;
			height: 5%;
			background-color: blue;
			clear: both;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="heading">头部</div>
		<div id="content_menu">左侧用户信息</div>
		<div id="content_body">内容主体</div>
		<div id="content_sidebar">右侧栏</div>
		<div id="footing">底部</div>	
	</div>
</body>
</html>
