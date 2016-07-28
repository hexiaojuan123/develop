<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<title>分享页面</title>
<style>
body,button, input, select, textarea,h1 ,h2, h3, h4, h5, h6 { font-family: Microsoft YaHei,'宋体' , Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;}
        .text_light {
            border-radius: 15px;
            padding: 5px 10px;
            background-color: #000;
            color: #fff;
        }
        .abo{
	        margin-bottom:50px;
        	margin-left:10px;
        }
        .cover_text {
            position: relative;
            width: 100%;
            height: 100%;
        }
        body{
			background-color: #f4f3f1;
        }
        .l-btn{
		background-color:#FFAE00;border-color: #D4AA00;
        }
.panel-default:hover{
	color:#fff;
	background-color:#000;
	cursor: pointer;
}
.panel-default .panel-body{
	text-align:center;
	
}
.col-md-6 a{
	color:#000;
}
.badge{
	background-color:#000;
}
.thumbnail{
	background-color:transparent;
	border: transparent;
}
#footerbtn{
	    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 0;
}
</style>
<body>
<div class="container">


<!-- start详情 -->

<div class="row">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-4 col-md-12">
    <div class="thumbnail">
      <a href="#">
      <img src="/develop/Public/<?php echo ($vo['cover']); ?>" alt="detal" >
      </a>
      <div class="caption">
        <h3><?php echo ($vo['title']); ?></h3>
        <p><?php echo ($vo['connect']); ?></p>
      </div>
    </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div id="footerbtn" class="row">
<div class="col-xs-12 col-md-12" style="padding: 0;">
    <div class="btn-group btn-group-justified" role="group">
        <a type="button" class="btn btn-success btn-lg" style="width:50%" role="button" href="<?php echo U('/Home/Register');?>">成为经纪人</a>
        <a type="button" class="btn btn-warning btn-lg" style="width:50%" role="button" href="<?php echo U('haveintent',array('uid'=>I('get.uid'),'orid'=>I('get.orid')));?>">我有意向</a>
    </div>
</div>

</div>
<!-- end详情 -->
</div>
</body>
</html>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>