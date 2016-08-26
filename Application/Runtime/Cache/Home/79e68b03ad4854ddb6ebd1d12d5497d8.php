<?php if (!defined('THINK_PATH')) exit();?><html>
<head></head>
<body>
<form action="<?php echo U('/Home/Hh/cc');?>" method="post">
<div>
    <img class="lazy" data-original="/develop/Public/common/images/1.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/2.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/900.jpg" width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/1.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/2.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/900.jpg"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/1.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/2.png"  width="600px" height="400px"/>
    <img class="lazy" data-original="/develop/Public/common/images/900.jpg"  width="600px" height="400px"/>
</div>
</form>
</body>
</html>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="/develop/Public/common/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("img.lazy").lazyload({
            //threshold : 200,//提前多少像素加载
            effect : "fadeIn",//显示方式淡入淡出
            skip_invisible : true//跳过未查看的
        });
    })
</script>