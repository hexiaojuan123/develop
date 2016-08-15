<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class WithdrawController extends CommonController {
    public function index(){
        $User=M('User');
        $param['openid']=self::$OPENID;
        $param['id']=self::$UID;
        $userinfo=$User->where($param)->cache(10)->find();
        $jssdk=new JS_SDK();
        $wdc=withdrawcash($userinfo['balance'],$userinfo['paytime'],0);
        $this->assign('userinfo',$userinfo);
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $this->assign('wdc',$wdc);
        $this->display();
    }
    public function getHongbao() {
        $Receive=D('Receive');
        $data['money']=I('price');
        if(!$Receive->create($data)){
            $this->error($Receive->getError());
        }
    }
}