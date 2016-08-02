<extend name="public/base" />
<block name="main">
<form action="{:U('Addcustomer')}" method="post">
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
<if condition="I('get.selectid') neq null"><option value="{:I('get.selectid')}">{:I('get.title')}</option><else /><option value="0">请选择推荐项目</option></if>
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
</block>

<block name="js">
<script>
    $(function(){
    	$('#realname').focus();
    });
</script>
</block>