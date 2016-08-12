<?php

	
	$money=10;//单位是分
	//发送红包
	$hongbao=new WXHongBao;
	$hongbao->__construct();
	$gznowhb=$hongbao->newhb($openid,$money);
	$fsjg=$hongbao->send();
	$content=$hongbao->error();
	
	

	
	if($fsjg!='1'){
		echo '系统繁忙!';	
	}else{
		echo '已经为您准备上红包，请笑纳！';//正式使用把最后的删除
	}

?>