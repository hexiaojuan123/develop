<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<title>哈哈</title>
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
</style>
<body>
<div class="container">
<?php if($userinfo == null ): ?><form action="" method="get">
<div class="panel panel-default">
<div class="panel-body">
<lable class="col-md-1">Likename:</lable>
<div class="col-md-4">
<input type="text" class="form-control" name="likename" placeholder="Likename" />
</div>
<lable class="col-md-1">Phone:</lable>
<div class="col-md-4">
<input type="text" class="form-control" name="phone" placeholder="Phone"/>
</div>
<div class="col-md-2">
<button type="submit" class="btn btn-default btn-balck">注册</button>
</div>
</div>
</div>
</form>
<?php else: ?>
<div class="panel panel-default">
<div class="panel-body">
<div class="pull-left"><?php echo ($userinfo['username']); ?></div>
<img class="pull-left img-circle" alt="<?php echo ($userinfo['username']); ?>" src="/develop/Public/common/images/face.jpg" width="30px" height="30px" />
<div class="pull-right">推荐：<?php echo ($count); ?>人，余额￥:<?php echo ($userinfo['balance']); ?></div>
<div class="clearfix"></div>
</div>
</div><?php endif; ?>

<div class="col-md-6">
<a href="<?php echo U('/Home/Recommend');?>">
<div class="panel panel-default">
<div class="panel-body">
我要推荐
</div>
</div>
</a>
</div>


<div class="col-md-6">
<a href="<?php echo U('/Home/Customer');?>">
<div class="panel panel-default">
<div class="panel-body">
我的客户<span class="badge"><?php echo ($count); ?></span>
</div>
</div>
</a>
</div>


<div class="col-md-6">
<a href="#">
<div class="panel panel-default">
<div class="panel-body">
我的酬劳
</div>
</div>
</a>
</div>


<div class="col-md-6">
<a href="#">
<div class="panel panel-default">
<div class="panel-body">
活动规则
</div>
</div>
</a>
</div>

<!-- start详情 -->

<div class="row">
  <div class="col-sm-6 col-md-6">
    <div class="thumbnail">
      <a href="#">
      <img src="/develop/Public/common/images/1.png" alt="detal" >
      </a>
      <div class="caption">
        <h3>999套餐</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <p><a href="#" class="btn btn-default" role="button">推荐</a> </p>
      </div>
    </div>
  </div>
    <div class="col-sm-6 col-md-6">
    <div class="thumbnail">
    <a href="#">
      <img src="/develop/Public/common/images/2.png" alt="detal">
      </a>
      <div class="caption">
        <h3>599活动套餐</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <p><a href="#" class="btn btn-default" role="button">推荐</a> </p>
      </div>
    </div>
  </div>
</div>
<!-- end详情 -->
</div>
</body>
</html>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>