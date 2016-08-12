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
		<!-- drawer.css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.0/css/drawer.min.css">
        <!-- jquery & iScroll -->
        <!-- weui start -->
        <link rel="stylesheet" href="__PUBLIC__/common/weui/css/weui.min.css">
        <!-- weui end-->
		<!-- 样式表文件 start-->
		<block name="css"></block>
		<!-- 样式表文件 end-->
	</head>
	<body class="drawer drawer--left">
	   <main role="main">
     	<!-- 头文件 start-->
    	<include file="public/header" />	
   		<!-- 头文件 end-->
		<!-- 内容页 start -->
		<block name="heder-body"></block>
		<div class="container">
        <block name="main"></block>
        </div>
        <!-- 内容页 end -->
        <!-- 脚文件 start-->
        <include file="public/footer" />	
		<!-- 脚文件 end-->
		</main>
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
    <!-- drawer.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.0/js/drawer.min.js"></script>
    <!-- weui js start -->
     <script src="__PUBLIC__/common/weui/js/zepto.min.js"></script>
     <script src="__PUBLIC__/common/weui/js/router.min.js"></script>
     
    <!-- weui js end -->
    <if condition="$appid neq null">
    <!-- 微信分享js start-->
    <script>
    $(function(){
    	//菜单栏
   	 $('.drawer').drawer({
   		 class: {
    		    nav: 'drawer-nav',
    		    toggle: 'drawer-toggle',
    		    overlay: 'drawer-overlay',
    		    open: 'drawer-open',
    		    close: 'drawer-close',
    		    dropdown: 'drawer-dropdown'
    		  },
    		  iscroll: {
  			    // Configuring the iScroll
  			    // https://github.com/cubiq/iscroll#configuring-the-iscroll
  			    mouseWheel: true,
  			    preventDefault: false
  			  },
  			  showOverlay: true
   	   	 });
   	 //菜单栏
        });
    
    wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '{$appid}', // 必填，公众号的唯一标识
    timestamp: {$sh['time']}, // 必填，生成签名的时间戳
    nonceStr: '{$sh["noncestr"]}', // 必填，生成签名的随机串
    signature: '{$sh["signature"]}',// 必填，签名，见附录1
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
	<neq name="showshare" value="2">wx.hideOptionMenu();<else />wx.showOptionMenu();</neq>
    var shareData = {
    title: '全名经纪人',//分享的标题
    desc: '极互联-人人都能当经纪人',//分享的描述
    link: <if condition="$sharelink eq null">$shareurl<else />'{$sharelink}'</if>,//分享的链接
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
        	$('#toast').show();
         	 setTimeout(function () {
               $('#toast').hide();
           }, 2000); 
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
        	$('#toast').show();
           	 setTimeout(function () {
                 $('#toast').hide();
             }, 2000);
        },
        cancel: function (res) {
        },
        fail: function (res) {
          //alert(JSON.stringify(res));
        }
      });
});
    
    </script>
    <!-- 微信分享js end-->
    </if>
	<!-- javascript文件 start-->
	<block name="js"></block>
	<!-- javascript文件 end-->
</body>
</html>
