<extend name="public/base" />
<block name="main">
<form action="{:U('Register')}" method="post">
<div class="col-md-12" style="text-align:center;margin-top:1em;">
<img class="img-circle" alt="{$userinfo['username']}" src="{$userinfo['faceimg']}" width="50px" height="50px" />
</div>
<div class="col-md-12">
<div class="form-group">
<label for="realname">真实姓名：</label>
<input autofocus type="text" id="realname" name="realname" class="form-control" value="" placeholder="真实名称" />
</div>
<div class="form-group">
<div class="row">
<label class="col-xs-12" for="realname">验证码：</label>
<div class="col-xs-8"> 
<input type="text" id="imgcode" maxlength="4" name="imgcode" class="form-control" value="" placeholder="图片验证码" />
</div>
<div class="col-xs-4" style="margin: 0 auto;">
<img src="{:U('/Home/Verify/index')}" alt="verifycode" style="height: 2.3em;width: 6.5em;" id="img-code" />
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<div class="col-xs-12">
<label for="Phone">手机号：</label>
<button type="button" class="btn btn-default btn-xs sendmobile">发送验证码</button>
</div>
<div class="col-xs-8">
<input type="text" id="Phone" name="Phone" class="form-control" value="" placeholder="手机号"/>
</div>
<div class="col-xs-4 col-sm-4 col-md-4" style="margin: 0 auto;">
<input type="text" id="vecode" maxlength="4" name="vecode" class="form-control" value="" placeholder="验证码"/>
</div>
</div>
</div>
<div class="form-group">
<button type="submit" id="rebtn" class="btn btn-default btn-block">注册</button>
<p><small>请认真填写您的真实姓名和电话号码，这将影响到您的提现操作！</small></p>
</div>
<div class="error-text">
<p style="text-align: center;"><small></small></p>
</div>
</div>
</form>
<div class="weui_dialog_alert" id="dialog1" style="display: none;">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
        <div class="weui_dialog_bd dialog-info"></div>
        <div class="weui_dialog_ft">
            <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>
</block>
<block name="js">
<script>
    $(function(){
    	$('#realname').focus();
    	$('input[name=Phone]').keyup(function(){
    		if(validate($(this).val())==false){
				$('.error-text p small').text('手机号格式不正确');
				$('#rebtn').button('loading');
            }else{
            	$('.error-text p small').text('');
            	$('#rebtn').button('reset');
            }
        });
        $('.sendmobile').click(function(){
        	event.stopPropagation();
        	$('.sendmobile').button('loading');
        	$phone=$('input[name=Phone]').val();
        	if($phone==''){
        		adddialog('请输入您的手机号');
        		$('.sendmobile').button('reset');
        	}else{
        		mobileVerify($phone);
        	}
        });
        $('#img-code').click(function(){
        	ref();
        });
    });
    var c=120;
    var t;
    function timedCount()
    {
    	$('.sendmobile').button('loading');
    	c=c-1;
    	if(c<=0){
    		clearTimeout(t);
        	$('.sendmobile').button('reset');
        	c=60;
        	return false;
    	}
    	else{
    		$('.sendmobile').text(c+'秒后重新发送');
    	}
    	t=setTimeout("timedCount()",1000);
    }
    function validate($key){
        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if(!myreg.test($key))
        {
            return false;
        }else{
            return true;
        }
    }
    function mobileVerify(phone){
    	$.ajax({
    		type:'post',
    		url:'{:U("Verify")}',
    		data:{'phone':phone},
    		beforeSend:function(){
    			console.log(phone);
    		},
    		success:function(data){
    			console.log(data);
    			if(data.data==00){
    				console.log(data);
    				timedCount();
    			}else{
    				adddialog('短信发送失败，请稍后在试');
    			}
    		}
    	});
    }
	function adddialog(coninfo,url){
		$('#btn-save').button('loading');
		$('.dialog-info').text(coninfo);
		$('#dialog1').show('fast').on('click', '.weui_btn_dialog', function () {
			if(url!='' && url!=null){
				window.location.href=url;
			}
            $('#dialog1').off('click').hide('fast',function(){
            	$('#btn-save').button('reset');
            });
        });
	}
    function ref(){
    	 $('#img-code').attr("src",'{:U('/Home/Verify/Index/index')}?'+Math.random());
    } 
</script>
</block>
