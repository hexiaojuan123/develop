<extend name="public/base" />
<block name="main">
<!-- start详情 -->
<div class="row">
<h1 style="text-align: center;">推荐列表</h1>
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
<div style="margin:0 auto;text-align:center;">{$page}</div>
<!-- end详情 -->
</block>