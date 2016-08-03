<extend name="public/base" />
<block name="main">
<if condition="$userinfo eq null ">
<form action="" method="get">
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
<else />
<div class="panel panel-default">
<div class="panel-body">
<div class="pull-left">{$userinfo['username']}</div>
<img class="pull-left img-circle" alt="{$userinfo['username']}" src="{$userinfo['faceimg']}" width="30px" height="30px" />
<div class="pull-right">推荐：{$count}人，余额￥:{$userinfo['balance']}</div>
<div class="clearfix"></div>
</div>
</div>
</if>
<div class="row">
<div class="col-xs-6 col-md-6">
<a href="{:U('/Home/Recommend')}">
<div class="panel panel-default">
<div class="panel-body">
我要推荐
</div>
</div>
</a>
</div>


<div class="col-xs-6 col-md-6">
<a href="{:U('/Home/Customer')}">
<div class="panel panel-default">
<div class="panel-body">
我的客户<span class="badge">{$count}</span>
</div>
</div>
</a>
</div>


<div class="col-xs-6 col-md-6">
<a href="{:U('/Home/Reward')}">
<div class="panel panel-default">
<div class="panel-body">
我的酬劳
</div>
</div>
</a>
</div>


<div class="col-xs-6 col-md-6">
<a href="#">
<div class="panel panel-default">
<div class="panel-body">
活动规则
</div>
</div>
</a>
</div>
</div>
<!-- start详情 -->
<div class="row">
<volist name="list" id="vo">
  <div class="col-xs-6 col-md-6">
    <div class="thumbnail">
      <a href="#">
      <img src="__PUBLIC__/{$vo['cover']}" alt="detal" >
      </a>
      <div class="caption">
        <h4>{$vo['title']}</h4>
        <p><small>{$vo.connect|subtext=20}</small></p>
        <p><a href="{:U('/Home/Recommend/index',array('selectid'=>$vo['id'],'title'=>$vo['title']))}" class="btn btn-default" role="button">推荐</a> </p>
      </div>
    </div>
  </div>
  </volist>
</div>
<!-- end详情 -->
</block>