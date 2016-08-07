<extend name="public/base" />
<block name="main">
<table class="table table-hover">
<thead>
<tr>
<th>姓名</th>
<th>手机号</th>
<th>状态</th>
</tr></thead>
<tbody>
<volist name="list" id="vo" empty="当前无数据">
<tr class="listtable"><th hidden>{$vo['id']}</th><td>{$vo['customername']}</td><td>{$vo['customerphone']}</td><td>{$vo['status']}</td></tr>
</volist>
</tbody>
</table>
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
        <th>姓名</th>
        <td></td>
        </tr>
        <tr>
        <th>电话</th>
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
			console.log(id);
		},
		success:function(data){
			console.log(data);
			datalist=data;
			$('#uid').val(data['id']);
			$('#sendid').val(data['userid']);
			$('#detailtale').find('tr').eq(0).children('td').empty().text(data['customername']);
			$('#detailtale').find('tr').eq(1).children('td').empty().text(data['customerphone']);
			$('#detailtale').find('tr').eq(2).children('td').empty().text(data['title']);
			$('#detailtale').find('tr').eq(3).children('td').empty().text(data['createtime']);
			$('#detailtale').find('tr').eq(4).children('td').empty().html(data['status']);
		}
		
	});
}
</script>
</block>