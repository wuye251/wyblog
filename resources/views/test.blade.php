<div>
    <button class="layer" onclick="a()">Copy Text</button>
</div>

<script src="{{ asset('layui/layui.js') }}"></script>
<script>

    function a() {
        layui.use('layer', function(){
          var layer = layui.layer;
          
         layer.open({
  type: 2, 
  content: 'http://sentsin.com'
            });
        });
    }
          
</script>