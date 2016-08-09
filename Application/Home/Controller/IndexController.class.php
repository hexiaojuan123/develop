<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class IndexController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $user=M('user');
        $order=M('Order');
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
        $this->display();
    }
}