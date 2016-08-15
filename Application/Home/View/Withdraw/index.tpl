<extend name="public/base" />
<block name="main">
<form action="{:U('/Home/Withdraw/getHongbao')}" method="post">
<div class="row">
<h1 style="text-align: center;">提现</h1>
<if condition="$wdc['code']=='000'">
<h4 style="text-align: center;">可提现金额:{$wdc['price']}元</h4>
</if>
<div class="col-md-12">
<div class="form-group">
<label for="realname">提现金额：</label>
<input autofocus type="number" id="price" name="price"  class="form-control" value="" placeholder="提现金额" maxlength="3"/>
</div>
<div class="form-group">
<button type="submit" class="btn btn-default btn-block" id="btn-save">提交</button>
<p><small>提现金额将会以红包的形式发送到您的账户，单笔最高不超过200元。注:获取佣金后7日后方可提现，如在7日内申请退货，所得佣金将会被扣除。</small></p>
</div>
<div class="weui_dialog_alert" id="dialog1" style="display: none;">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示</strong></div>
        <div class="weui_dialog_bd dialog-info"></div>
        <div class="weui_dialog_ft">
            <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>
</div>
</div>
</form>
</block>
<block name="js">
<script>
	$(function(){
		<if condition="$wdc['code']=='001'">
		adddialog('尚未到达提现时间，{$wdc['date']} 天后方可提现',"{:U('/Home/Index')}");
		<elseif condition="$wdc['code']=='002'" />
		adddialog('您的提现余额还未达到提现最低标准，赶紧分享获取更多佣金在来领取吧！',"{:U('/Home/Index')}");
		</if>
		var pr=document.getElementById('price');
		pr.oninput=function(){
			if(pr.value.length<=3){
				if(parseInt(pr.value)>0&&parseInt(pr.value)<=200){
				    if(parseInt(pr.value)><if condition="$wdc['price'] neq null">{$wdc['price']}<else />0</if>){
				    	adddialog('不能超出您的可提现金额 {$wdc['price']} 元');
				    	pr.value="";
					}else{
					    console.log(pr.value.length);
					    console.log("价格："+pr.value);
					}
				}else{
					adddialog('请输入1-200之间的金额');
					pr.value="";
				}
			}else{
				pr.value=pr.value.slice(0,3);
			}
		}
		$('#btn-save').click(function(){
			
		});
	});
	function adddialog(coninfo,url){
		$('#btn-save').button('loading');
		$('.dialog-info').text(coninfo);
		$('#dialog1').show('fast').on('click', '.weui_btn_dialog', function () {
			if(url!='' && url!=null){
				window.location.href=url;
			}
            $('#dialog1').off('click').hide('fast',function(){
            	$('#btn-save').button('reset');
            });
        });
	}
</script>
</block>
