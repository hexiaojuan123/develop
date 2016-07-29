<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
<form action="{:U('Register')}" method="post">
<div class="col-md-12" style="text-align:center;margin-top:1em;">
<img class="img-circle" alt="{$userinfo['username']}" src="{$userinfo['faceimg']}" width="50px" height="50px" />
</div>
<div class="col-md-12">
<input type="text" value="{$userinfo['faceimg']}" name="faceimg" hidden/>
<div class="form-group">
<label for="nickname">昵称：</label>
<input type="text" id="nickname" name="nickname" value="{$userinfo['username']}" class="form-control" value="" placeholder="nickname" />
</div>
<div class="form-group">
<label for="realname">真实姓名：</label>
<input autofocus type="text" id="realname" name="realname" class="form-control" value="" placeholder="Realname"/>
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
<input name="uid" value="{:I('get.uid')}" hidden />
<input name="orid" value="{:I('get.orid')}" hidden />
<input name="redirect" value="{:I('get.redirect')}" hidden />
<button type="submit" class="btn btn-default btn-block">注册</button>
<img src="" id="ylt" width="40px" height="50px" />
<button type="button" class="btn btn-default" id="open">相册</button>
<button type="button" class="btn btn-default" id="update">上传</button>
<button type="button" class="btn btn-default" id="download">下载</button>
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
	//wx.hideOptionMenu();
	var images = {
		      localId: [],
		      serverId: []
		  };
	$('#open').click(function(){
		wx.chooseImage({
		    count: 1, // 默认9
		    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
		    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
		    success: function (res) {
		    	images.localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
				$('#ylt').attr({'src':images.localId});
				alert(localIds);
			  }
		});
	});
	$('#update').click(function(){
		 var i = 0, len = images.localId.length;
		 function wxUpload(){
    		wx.uploadImage({
    		    localId: images.localId[i], // 需要上传的图片的本地ID，由chooseImage接口获得
    		    isShowProgressTips: 1, // 默认为1，显示进度提示
    		    success: function (res) {
    			    i++;
    			    images.serverId.push(res.serverId);
                    if(i < len){
                        wxUpload();
                    }
    		    }
    		});
    		
		 }
		 wxUpload();
	});
	$('#download').click(function(){
		wx.downloadImage({
		    serverId: images.serverId[0], // 需要下载的图片的服务器端ID，由uploadImage接口获得
		    isShowProgressTips: 1, // 默认为1，显示进度提示
		    success: function (res) {
		        var localId = res.localId; // 返回图片下载后的本地ID
		        $('#realname').val(localId);
		    }
		});
		});
    var shareData = {
    title: '我是标题',//分享的标题
    desc: '我是描述哈哈哈',//分享的描述
    link: $shareurl,//分享的链接
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