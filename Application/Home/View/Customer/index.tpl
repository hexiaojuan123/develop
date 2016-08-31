<extend name="public/base" />
<block name="main">
<h1 style="text-align: center;">我的客户</h1>
<table class="table table-hover">
<thead>
<tr>
<th>头像</th>
<th>昵称</th>
<th>时间</th>
<th>状态</th>
</tr></thead>
<tbody>
<volist name="list" id="vo" empty="当前无数据">
<tr class="listtable"><th hidden>{$vo['id']}</th><td><img src="{$vo['info']['faceimg']}" alt="{$vo['info']['username']}" width="20px" height="20px" /></td><td>{$vo['info']['username']|subtext=7}</td><td>{$vo['createtime']}</td><td>{$vo['status']}</td></tr>
</volist>
</tbody>
</table>
<div style="text-align:center;">{$page}</div>
<input id="uid" type="text" value=""  hidden />
<input id="sendid" type="text" value="" hidden />
<!-- Large modal -->
<div class="modal fade mymodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">详细信息</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="detailtale">
        <thead>
        </thead>
        <tbody>
        <tr>
        <th>头像</th>
       
        <td></td>
        </tr>
        <tr>
        <th>姓名</th>
        <td></td>
        </tr>
        <tr>
        <th>商品</th>
        <td></td>
        </tr>
        <tr>
        <th>时间</th>
        <td></td>
        </tr>
        <tr>
        <th>状态</th>
        <td></td>
        </tr>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn_share" class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</button>
      </div>
    </div>
  </div>
</div>
<div id="loadingToast" class="weui_loading_toast" style="display:none;">
   <div class="weui_mask_transparent" style="z-index:1041;"></div>
   <div class="weui_toast" style="z-index:1043;">
       <div class="weui_loading">
           <!-- :) -->
           <div class="weui_loading_leaf weui_loading_leaf_0"></div>
           <div class="weui_loading_leaf weui_loading_leaf_1"></div>
           <div class="weui_loading_leaf weui_loading_leaf_2"></div>
           <div class="weui_loading_leaf weui_loading_leaf_3"></div>
           <div class="weui_loading_leaf weui_loading_leaf_4"></div>
           <div class="weui_loading_leaf weui_loading_leaf_5"></div>
           <div class="weui_loading_leaf weui_loading_leaf_6"></div>
           <div class="weui_loading_leaf weui_loading_leaf_7"></div>
           <div class="weui_loading_leaf weui_loading_leaf_8"></div>
           <div class="weui_loading_leaf weui_loading_leaf_9"></div>
           <div class="weui_loading_leaf weui_loading_leaf_10"></div>
           <div class="weui_loading_leaf weui_loading_leaf_11"></div>
       </div>
       <p class="weui_toast_content">数据加载中</p>
   </div>
</div>
</block>
<block name="js">
<script>
var datalist={};
$(function(){
	$("#btn_share").click(function(){
		console.log(datalist);
		window.location.href="__APP__/Home/Sendshare/index/goodsid/"+datalist['selectobj']+"/customerid/"+datalist['id']+"/sendid/"+datalist['userid']+".shtml";
	});
	$(".listtable").find("td").click(function(){
    	$('.mymodal').modal('toggle');
    	var num=$(this).parents(".listtable").find('th').text();
    	getdetail(num);
   }); 
});
function getdetail(id){
	$.ajax({
		type:'post',
		data:{'id':id},
		url:'{:U("getinfo")}',
		beforeSend:function(){
			$('#loadingToast').show();
		},
		success:function(data){
			console.log(data);
			datalist=data;
			$('#uid').val(data['id']);
			$('#sendid').val(data['userid']);
			$('#detailtale').find('tr').eq(0).children('td').empty().html('<img width="30px" height="30px" src="'+data['faceimg']+'" />');
			$('#detailtale').find('tr').eq(1).children('td').empty().text(data['username']);
			$('#detailtale').find('tr').eq(2).children('td').empty().text(data['title']);
			$('#detailtale').find('tr').eq(3).children('td').empty().text(data['createtime']);
			$('#detailtale').find('tr').eq(4).children('td').empty().html(data['status']);
		},
		complete:function() {
			$('#loadingToast').hide();
		}
	});
}
</script>
</block>