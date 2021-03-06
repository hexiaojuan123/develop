<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class IndexController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $this->assign('showshare',2);
        $user=M('user');
        $order=M('Order');
        $CommissionLog=M('commission_log');
        $condition['sendid']=self::$UID;
        $condition['state']=1;//可提现的金额
        $balance=$CommissionLog->where($condition)->sum('commission');
        $balance=!empty($balance)?$balance:0.00;
        $where['openid']=self::$OPENID;
        $where['think_user.id']=self::$UID;
        $res=$user->where($where)->find();
         if($res){
              $this->assign('userinfo',$res);
          }
        $join=' RIGHT JOIN `think_customer` ON `think_customer`.`userid`=`think_user`.`id` ';
        $count=$user->where($where)->join($join)->count();
        $condition['display']=2;
        $list=$order->where($condition)->order('id desc')->limit(4)->select();
        if($list){
            $this->assign('list',$list);
        }
        $this->assign('count',$count);
        $this->assign('balance',$balance);
        $this->display();
    }
}