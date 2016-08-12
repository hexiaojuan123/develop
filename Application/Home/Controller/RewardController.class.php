<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class RewardController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $commission_log=M('CommissionLog');
        $condition['sendid']=self::$UID;
        $ucondition['id']=self::$UID;
        $User=M('User');
        $price=$User->where($ucondition)->find();
        $count=$commission_log->where($condition)->count();
        $Page=new \Think\Page($count,10);
        $Page->lastSuffix=false;
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '末页');
        $show=$Page->show();//分页显示输出
        $list=$commission_log->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        //$wdar=withdrawcash(99.21);
        //$this->assign('balance',$wdar);
        if($list){
            $this->assign('list',$list);
            $this->assign('page',$show);
        }
        $this->assign('price',$price);
        $this->display(); 
    }
}