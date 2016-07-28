<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<title>O(∩_∩)O~</title>
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
<form action="<?php echo U('Register');?>" method="post">
<div class="col-md-12" style="text-align:center;margin-top:1em;">
<img class="img-circle" alt="<?php echo ($userinfo['username']); ?>" src="/develop/Public/common/images/face.jpg" width="50px" height="50px" />
</div>
<div class="col-md-12">
<input type="text" value="/develop/Public/common/images/face.jpg" name="faceimg" hidden/>
<div class="form-group">
<label for="likename">昵称：</label>
<input type="text" id="likename" name="likename" value="pengbd3" class="form-control" value="" placeholder="Likename" />
</div>
<div class="form-group">
<label for="realname">真实姓名：</label>
<input type="text" id="realname" name="realname" class="form-control" value="" placeholder="Realname"/>
</div>
<div class="form-group">
<div class="col-sm-8 col-md-8" style="padding:0;">
<label for="Phone">手机号：</label>
<input type="text" id="Phone" name="Phone" class="form-control" value="" placeholder="Phone"/>
</div>
<div class="col-sm-4 col-md-4" style="padding:0;">
<label for="vecode">验证码：</label>
<input type="text" id="vecode" name="vecode" class="form-control" value="" placeholder="Vecode"/>
</div>
<div class="clearfix"></div>
</div>
<div class="form-group">
<input name="uid" value="<?php echo I('get.uid');?>" hidden />
<input name="orid" value="<?php echo I('get.orid');?>" hidden />
<input name="redirect" value="<?php echo I('get.redirect');?>" hidden />
<button type="submit" class="btn btn-default btn-block">注册</button>
</div>
</div>
</form>
</body>
</html>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
<script>
$(function(){
	$('#realname').focus();
});
</script>