<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0,user-scalable=no">
    <meta name="x5-orientation" content="portrait">
    <meta name="screen-orientation" content="portrait">
		<!-- 标题 start-->
    	<title><block name="title">极互联</block></title>
    	<!-- 标题 end-->
		<!--    <link rel="shortcut icon"href="__PUBLIC__/img/Common/admin.ico">-->     
		<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
		<link href="__PUBLIC__/common/css/site.css" rel="stylesheet">
	</head>
	<body>
	<div class="container">
	<div class="row">
	<div class="col-xs-4"></div>
	<div class="col-xs-4">
		<h2><?php echo($message); ?></h2>
    	<p class="jump">
                         页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </p>
	</div>
	<div class="col-xs-4"></div>
	</div>

    </div>
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
    <script>
    (function(){
    	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    	var interval = setInterval(function(){
    		var time = --wait.innerHTML;
    		if(time <= 0) {
    			location.href = href;
    			clearInterval(interval);
    		};
    	}, 1000);
    	})();
	</script>
</body>
</html>
