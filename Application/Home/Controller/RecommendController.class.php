<?php
namespace Home\Controller;
class RecommendController extends CommonController {

    public function index(){
        $order=M('Order');
        $res=$order->select();
        if($res)
        $this->assign('list',$res);
        $this->display();
    }
    public function Addcustomer() {
        $Customer=D('Customer');
        $data['customername']=I('CustomerName');
        $data['customerphone']=I('CustomerPhone');
        $data['selectobj']=I('SelectObj');
        $data['userid']=!empty(session('uid'))?session('uid'):NULL;
        if(!$Customer->create($data)){
            $this->error($Customer->getError());
        }else{
            $res=$Customer->add();
            if($res){
                $this->success('操作成功,请将该条信息分享给好友',__APP__.'/Home/Share?uid='.session('uid').'&orid='.$data['selectobj']);
            }
        }
    }
}