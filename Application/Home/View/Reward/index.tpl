<extend name="public/base" />
<block name="css">
<style>
.wdth{
	width:47%;
}
.list{
	padding:1px;
}
.panel-default:hover{
	color:#000;
	background-color:#fff;
	cursor: none;
}
.nav-pills > li.active > a,.nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
	color: #000000;
    background-color: #EAEAEA;
}
a {
    color: #000000;
    text-decoration: none;
	text-align: center;
}
</style>
</block>
<block name="main">
<div class="row">
<div style="position: absolute;right: 0.8em;top: 1em;"><a href="{:U('/Home/Register/index')}">提现</a></div>
<div class="clearfix"></div>
<h1 style="text-align: center;">我的佣金</h1>
<ul class="nav nav-pills" role="tablist">
    <li role="presentation" class="active wdth pull-left"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">可提现{$price['balance']|withdrawcash}元</a></li>
    <li role="presentation" class="wdth pull-right"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">已提现 0元</a></li>
    <li class="clearfix"></li>
</ul>
 <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="home">
    <h4 style="text-align:center">佣金明细</h4>
    <div class="panel panel-default">
  <div class="panel-body">
  <volist name="list" id="vo" empty="没有数据">
   <div class="list">
    <div class="pull-left">
    <h4 style="margin: 0 auto;">{$vo['title']}-佣金</h4>
    <div class="pull-left"><small>{$vo['createtime']}</small></div>
    </div>
    <div class="pull-right"><h4>{$vo['commission']}元</h4></div>
    <div class="clearfix"></div>
   </div>
   <hr />
   </volist>
   {$page}
  </div>
</div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="profile">
    <h4 style="text-align:center">提现明细</h4>
        <div class="panel panel-default">
  <div class="panel-body">
   <div class="list">
    <div class="pull-left">
    <h4 style="margin: 0 auto;">提现佣金</h4>
    <div class="pull-left"><small>2016-07-06 13:01</small></div>
    </div>
    <div class="pull-right"><h4>0元</h4></div>
    <div class="clearfix"></div>
   </div>
  </div>
</div>
    </div>
    </div>
    </div>
</block>