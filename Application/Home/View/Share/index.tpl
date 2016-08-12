<extend name="public/base" />
<block name="main">
<div class="row">
<h1 style="text-align: center;">分享</h1>
<volist name="list" id="vo">
  <div class="col-sm-4 col-md-12">
    <div class="thumbnail">
      <a href="#">
      <img src="__PUBLIC__/{$vo['cover']}" alt="detal" >
      </a>
      <div class="caption">
        <h3>{$vo['title']}</h3>
        <p>{$vo['connect']}</p>
      </div>
    </div>
  </div>
    </volist>
</div>

<div id="footerbtn" class="row">
<div class="col-xs-12 col-md-12" style="padding: 0;">
    <div class="btn-group btn-group-justified" role="group">
        <a type="button" class="btn btn-success btn-lg" style="width:50%" role="button" href="{:U('/Home/Index')}">成为经纪人</a>
        <a type="button" class="btn btn-warning btn-lg" style="width:50%" role="button" href="{:U('haveintent',array('sendid'=>I('get.sendid'),'goodsid'=>I('get.goodsid'),'customerid'=>I('get.customerid')))}">我有意向</a>
    </div>
</div>

</div>
</block>