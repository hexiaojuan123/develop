<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
class SendshareController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $goods=I('goodsid');
        $sendid=I('sendid');
        $customerid=I('customerid');
        $order=M('Order');
        $condition['id']=I('goodsid');
        $condition['display']=2;
        $res=$order->where($condition)->select();
        $this->assign('list',$res);
        $this->assign('sharelink',$_SERVER['SERVER_NAME'].U('/Home/Share/index',array('goodsid'=>$goods,'sendid'=>$sendid,'customerid'=>$customerid)));//自定义分享链接
        $this->display();
    }
}