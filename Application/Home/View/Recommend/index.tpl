<!DOCTYPE html>
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
<form action="{:U('Addcustomer')}" method="get">
<div class="col-md-12" style="text-align:center;margin-top:1em;">
<h1>推荐给谁</h1>
</div>
<div class="col-md-12">
<div class="form-group">
<label for="customername">客户名称：</label>
<input type="text" id="CustomerName" name="CustomerName" class="form-control" value="" placeholder="CustomerName"/>
</div>
<div class="form-group">
<label for="CustomerPhone">手机号：</label>
<input type="text" id="CustomerPhone" name="CustomerPhone" class="form-control" value="" placeholder="CustomerPhone"/>
</div>
<div class="form-group">
<label for="SelectObj">推荐项目：</label>
<select class="form-control" name="SelectObj">
<option value="0">请选择推荐项目</option>
<volist name="list" id="vo">
  <option value="{$vo['id']}">{$vo['title']}</option>
  </volist>
</select>
</div>
<div class="form-group">
<button type="submit" class="btn btn-default btn-block">推荐给他/她</button>
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