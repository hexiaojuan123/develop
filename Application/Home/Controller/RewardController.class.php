<?php
namespace Home\Controller;
class RewardController extends CommonController {
    public function index(){
        $commission_log=M('CommissionLog');
        $condition['sendid']=self::$UID;
        $ucondition['id']=self::$UID;
        $User=M('User');
        $price=$User->where($ucondition)->find();
        //$join='INNER JOIN `think_user` ON `think_user`';
        $count=$commission_log->where($condition)->count();
        $Page=new \Think\Page($count,10);
        $Page->lastSuffix=false;
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '末页');
        $show=$Page->show();//分页显示输出
        $list=$commission_log->where($condition)->limit($Page->firstRow.','.$Page->listRows)->select();
        if($list){
            $this->assign('list',$list);
            $this->assign('page',$show);
        }
        $this->assign('price',$price);
        $this->display(); 
    }
}