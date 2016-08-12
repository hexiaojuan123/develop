<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class SharelistController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $order=M('Order');
        $condition['display']=2;
        $count=$order->where($condition)->count();
        $Page=new \Think\Page($count,6);
        $Page->lastSuffix=false;
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '末页');
        $show=$Page->show();//分页显示输出
        $list=$order->where($condition)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        if($list){
            $this->assign('list',$list);
            $this->assign('page',$show);
        }
        $this->display();
    }
}