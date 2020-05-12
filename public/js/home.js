function loginWindow(){
	var popUp = document.getElementById("tanchuang");
	//  设置获取对象的上距离
	    popUp.style.top = "140px";
	//  设置获取对象的左距离
	    popUp.style.left = "415px";
	//  设置获取对象的宽度(像素)
	    popUp.style.width = w + "px";
	//  设置获取对象的高度(像素)
	    popUp.style.height = h + "px";
	//  设置获是否显示对象  
	    popUp.style.visibility = "visible";
	}
	//创建一个删除方法
	function hidePopup(){
	//  获取操作对象的id
	var popUp = document.getElementById("tanchuang");
	//  设置对象隐藏
	popUp.style.visibility = "hidden";
}