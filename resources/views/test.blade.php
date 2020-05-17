<link rel="stylesheet" href="{{asset('layui/css/layui.css')}}" media="all">

<div>
    <button class="layer" id="id" onclick="a()">Copy Text</button>
    <div id="test1"></div>
</div>
<style type="text/css">
  
  body .demo-class .layui-layer-title{background:#c00; color:#fff; border: none;}
  body .demo-class .layui-layer-btn{border-top:1px solid #E9E7E7}
  body .demo-class .layui-layer-btn a{background:black;}
  body .demo-class .layui-layer-btn .layui-layer-btn1{background:#999;}
</style>
<script src="{{ asset('layui/layui.js') }}"></script>
<script>

    function a() {
        layui.use('layer', function(){
          var layer = layui.layer;
          
         layer.open({
          title: ['文本', 'font-size:30px;'],
          type: 2, 
          content: '',
          skin: 'demo-class',
          area: ['60%', '800px'],
          offset: '100px',
          anim: 1,
          scrollbar: false, //底层滚动条消失
          move: false,      //禁止拖动
            });
        });
    }

layui.use('laypage', function(){
  var laypage = layui.laypage;

  //执行一个laypage实例
  laypage.render({
  elem: 'test1' //注意，这里的 test1 是 ID，不用加 # 号
  ,count: 50 //数据总数，从服务端得到
  });
});
</script>

 

