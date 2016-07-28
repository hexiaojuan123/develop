<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.css" rel="stylesheet">
<title>我的客户</title>
<style>
body,button, input, select, textarea,h1 ,h2, h3, h4, h5, h6 { font-family: Microsoft YaHei,'宋体' , Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;}
        .text_light {
            border-radius: 15px;
            padding: 5px 10px;
            background-color: #000;
            color: #fff;
        }
        .abo{
	        margin-bottom:50px;
        	margin-left:10px;
        }
        .cover_text {
            position: relative;
            width: 100%;
            height: 100%;
        }
        body{
			background-color: #f4f3f1;
        }
        .l-btn{
		background-color:#FFAE00;border-color: #D4AA00;
        }
.panel-default:hover{
	color:#fff;
	background-color:#000;
	cursor: pointer;
}
.panel-default .panel-body{
	text-align:center;
	
}
.col-md-6 a{
	color:#000;
}
.badge{
	background-color:#000;
}
.thumbnail{
	background-color:transparent;
	border: transparent;
}
</style>
<body>
<div class="container">
<table class="table table-hover">
<thead>
<tr>
<th>姓名</th>
<th>手机号</th>
<th>状态</th>
</tr></thead>
<tbody>
<volist name="list" id="vo">
<tr class="listtable"><th hidden>{$vo['id']}</th><td>{$vo['customername']}</td><td>{$vo['customerphone']}</td><td>{$vo['status']}</td></tr>
</volist>
</tbody>
</table>
</div>
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
        <button type="button" class="btn btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> Share</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="http://libs.baidu.com/bootstrap/3.0.3/js/bootstrap.js"></script>
<script>
$(function(){
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
			$('#detailtale').find('tr').eq(0).children('td').empty().text(data[0]['customername']);
			$('#detailtale').find('tr').eq(1).children('td').empty().text(data[0]['customerphone']);
			$('#detailtale').find('tr').eq(2).children('td').empty().text(data[0]['selectobj']);
			$('#detailtale').find('tr').eq(3).children('td').empty().text(data[0]['createtime']);
			$('#detailtale').find('tr').eq(4).children('td').empty().html(data[0]['status']);
		}
		
	});
}
</script>