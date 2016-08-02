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
</div>
</div>
</form>
</block>
<block name="js">
<script>
    $(function(){
    	$('#realname').focus();
    });
</script>
</block>
