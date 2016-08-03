<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 标题 start-->
    	<title>极互联</title>
    	<!-- 标题 end-->
		<!--    <link rel="shortcut icon"href="/develop/Public/img/Common/admin.ico">-->     
		<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
		<link href="/develop/Public/common/css/site.css" rel="stylesheet">
		<!-- 样式表文件 start-->
		
		<!-- 样式表文件 end-->
	</head>
	<body>
     	<!-- 头文件 start-->
    	<a href="/develop/index.php?s=/Home/Index/index">首页</a>	
   		<!-- 头文件 end-->
		<!-- 内容页 start -->
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
<img class="pull-left img-circle" alt="<?php echo ($userinfo['username']); ?>" src="<?php echo ($userinfo['faceimg']); ?>" width="30px" height="30px" />
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
<a href="<?php echo U('/Home/Reward');?>">
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
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-6">
    <div class="thumbnail">
      <a href="#">
      <img src="/develop/Public/<?php echo ($vo['cover']); ?>" alt="detal" >
      </a>
      <div class="caption">
        <h3><?php echo ($vo['title']); ?></h3>
        <p><?php echo ($vo['connect']); ?></p>
        <p><a href="<?php echo U('/Home/Recommend/index',array('selectid'=>$vo['id'],'title'=>$vo['title']));?>" class="btn btn-default" role="button">推荐</a> </p>
      </div>
    </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!-- end详情 -->

        </div>
        <!-- 内容页 end -->
        <!-- 脚文件 start-->
                 <div class="footer" style="margin-top:100px;">
         	<div class="container">
         		<p style="text-align: center;" hidden>Copyright &copy; 2016 JHL</p>
         		<div class="clearfix"> </div>
         	</div>
         </div>	
		<!-- 脚文件 end-->
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php if($appid != null): ?><!-- 微信分享js start-->
    <script>
    wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo ($appid); ?>', // 必填，公众号的唯一标识
    timestamp: <?php echo ($sh['time']); ?>, // 必填，生成签名的时间戳
    nonceStr: '<?php echo ($sh["noncestr"]); ?>', // 必填，生成签名的随机串
    signature: '<?php echo ($sh["signature"]); ?>',// 必填，签名，见附录1
    jsApiList: ['checkJsApi',
  	                'onMenuShareTimeline',
  	                'onMenuShareAppMessage',
  	                'onMenuShareQQ',
  	                'onMenuShareWeibo',
  	                'hideMenuItems',
  	                'showMenuItems',
  	                'hideAllNonBaseMenuItem',
  	                'showAllNonBaseMenuItem',
  	                'translateVoice',
  	                'startRecord',
  	                'stopRecord',
  	                'onRecordEnd',
  	                'playVoice',
  	                'pauseVoice',
  	                'stopVoice',
  	                'uploadVoice',
  	                'downloadVoice',
  	                'chooseImage',
  	                'previewImage',
  	                'uploadImage',
  	                'downloadImage',
  	                'getNetworkType',
  	                'openLocation',
  	                'getLocation',
  	                'hideOptionMenu',
  	                'showOptionMenu',
  	                'closeWindow',
  	                'scanQRCode',
  	                'chooseWXPay',
  	                'openProductSpecificView',
  	                'addCard',
  	                'chooseCard',
  	                'openCard'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
$shareurl=location.href.split('#')[0];
wx.ready(function () {
	//wx.hideOptionMenu();
    var shareData = {
    title: '全名经纪人',//分享的标题
    desc: '极互联-人人都能当经纪人',//分享的描述
    link: <?php if($sharelink == null): ?>$shareurl<?php else: ?>'<?php echo ($sharelink); ?>'<?php endif; ?>,//分享的链接
    imgUrl: '',//分享的图标
  };
    //var adurl="http://www.baidu.com/";//回调地址
    wx.onMenuShareAppMessage({
        title: shareData.title,
        desc: shareData.desc,
        link: shareData.link,
        imgUrl:shareData.imgUrl,
        trigger: function (res) {
        },
        success: function (res) {
          //window.location.href =adurl;
            alert('操作成功');
        },
        cancel: function (res) {
        },
        fail: function (res) {
          //alert(JSON.stringify(res));
        	alert('操作失败');
        }
    });
    //朋友圈
    wx.onMenuShareTimeline({
        title: shareData.title+"---"+shareData.desc,
        link: shareData.link,
        imgUrl:shareData.imgUrl,
        trigger: function (res) {
        },
        success: function (res) {
            //window.location.href =adurl;
        },
        cancel: function (res) {
        },
        fail: function (res) {
          //alert(JSON.stringify(res));
        }
      });
});
    </script>
    <!-- 微信分享js end--><?php endif; ?>
	<!-- javascript文件 start-->
	
	<!-- javascript文件 end-->
</body>
</html>