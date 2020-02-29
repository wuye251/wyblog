<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
	<p id="demo">hiahiahia</p>

<script>	
	function myFunction()
	{
		x=document.getElementById("demo"); //找到元素
		x.innerHTML="我的第一个js"    //改变内容
	}

	//点灯泡
	function changeImage()
	{
		element=document.getElementById('myimage')
		if (element.src.match("bulbon"))
		{
			element.src="/images/pic_bulboff.gif";
		}
		else
		{
			element.src="/images/pic_bulbon.gif";
		}
	}
	//修改字体颜色
	function myFunction1()
	{
		x=document.getElementById("demo1") // 找到元素
		x.style.color="#ff0000";          // 改变样式
	}
	//判断输入内容
	function myFunction2()
	{
		var x=document.getElementById("demo2").value;
		if(x==""||isNaN(x))
		{
			alert("不是数字");
		}
	}
</script>

<button type="button" onclick="myFunction()">点击这里</button>

<img id="myimage" onclick="changeImage()" src="/images/pic_bulboff.gif" width="100" height="180"></button>

<p id="demo1">变变变</p>
<button type="button" onclick="myFunction1()">点</button>

<input id="demo2" type="text">
<button type="button" onclick="myFunction2()">点点</button>

可以把脚本保存到外部文件中。外部文件通常包含被多个网页使用的代码。

外部 JavaScript 文件的文件扩展名是 .js。

如需使用外部文件，请在 <'script'> 标签的 "src" 属性中设置该 .js 文件：

</body>
</html>