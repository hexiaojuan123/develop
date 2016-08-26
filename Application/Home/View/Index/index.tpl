<extend name="public/base" />
<block name="main">
<div class="panel panel-default">
<div class="panel-body">
<img class="pull-left img-circle" alt="{$userinfo['username']}" src="{$userinfo['faceimg']}" width="30px" height="30px" />
<div class="pull-left" style="line-height: 30px;">{$userinfo['username']}</div>
<div class="pull-right" style="line-height: 30px;">推荐：{$count}人  余额￥:{$balance}</div>
<div class="clearfix"></div>
</div>
</div>
<div class="row">
<div class="col-xs-6 col-md-6">
<a href="{:U('/Home/Sharelist')}">
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
    <div class="thumbnail" style="margin:0 auto;">
      <a href="{:U('/Home/Sendshare/index',array('goodsid'=>$vo['id']))}" >
      <img src="__PUBLIC__/{$vo['cover']}" alt="detal" >
      </a>
      <div class="caption">
        <h4 style="margin:0 auto;">{$vo['title']}</h4>
        <p><small>{$vo.connect|subtext=20}</small></p>
      </div>
    </div>
  </div>
  </volist>
</div>
<!-- end详情 -->
</block>