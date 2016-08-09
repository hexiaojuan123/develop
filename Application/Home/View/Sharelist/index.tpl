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
        <a type="button" class="btn btn-warning btn-lg btn-block" id="share" role="button">分享</a>
    </div>
</div>
<block name="header-body">
<img class="shareBg" src="__PUBLIC__/common/images/shareBg.png" style="position: fixed;display:none;z-index:999;left:0;top:0;width:100%;height:100%;"/>
</block>
</div>
</block>
<block name="js">
<script>
	$(function(){
		$('#share').click(function(){
			//alert('请点击微信右上角分享按钮进行分享');
			$(".shareBg").show();
			$(".shareBg").click(function(){
				$(this).hide();
			});
		});
	});
</script>
</block>