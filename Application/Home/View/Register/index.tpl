<extend name="public/base" />
<block name="main">
<form action="{:U('Register')}" method="post">
<div class="col-md-12" style="text-align:center;margin-top:1em;">
<img class="img-circle" alt="{$userinfo['username']}" src="{$userinfo['faceimg']}" width="50px" height="50px" />
</div>
<div class="col-md-12">
<input type="text" value="{$userinfo['faceimg']}" name="faceimg" hidden/>
<div class="form-group">
<label for="nickname">昵称：</label>
<input type="text" id="nickname" name="nickname" value="{$userinfo['username']}" class="form-control" value="" placeholder="nickname" disabled/>
</div>
<div class="form-group">
<label for="realname">真实姓名：</label>
<input autofocus type="text" id="realname" name="realname" class="form-control" value="" placeholder="Realname" />
</div>
<div class="form-group">
<div class="col-sm-8 col-md-8" style="padding:0;">
<label for="Phone">手机号：</label>
<input type="text" id="Phone" name="Phone" class="form-control" value="" placeholder="Phone"/>
</div>
<div class="col-sm-4 col-md-4" style="padding:0;">
<label for="vecode">验证码：</label><button type="button" class="btn btn-default btn-xs sendmobile">发送验证码</button>
<input type="text" id="vecode" name="vecode" class="form-control" value="" placeholder="Vecode"/>
</div>
<div class="clearfix"></div>
</div>
<div class="form-group">
<input name="sendid" value="{:I('get.sendid')}" hidden />
<input name="goodsid" value="{:I('get.goodsid')}" hidden />
<input name="customerid" value="{:I('get.customerid')}" hidden />
<input name="redirect" value="{:I('get.redirect')}" hidden />
<button type="submit" class="btn btn-default btn-block">注册</button>
</div>
</div>
</form>
</block>
<block name="js">
<script>
    $(function(){
    	$('#realname').focus();
        $('.sendmobile').click(function(){
        	event.stopPropagation();
        	$('.sendmobile').button('loading');
        	$phone=$('input[name=Phone]').val();
        	if($phone==''){
        		alert('请输入您的手机号');
        		$('.sendmobile').button('reset');
        	}else{
        		mobileVerify($phone);
        	}
        });
    });
    var c=60;
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
    				alert('短信发送失败，请稍后在试');
    			}
    		}
    	});
    }
</script>
</block>
