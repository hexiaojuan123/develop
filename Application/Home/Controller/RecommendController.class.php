<?php
namespace Home\Controller;
class RecommendController extends CommonController {

    public function index(){
        $order=M('Order');
        $param['display']=2;//加载所需显示的商品
        $res=$order->where($param)->select();
        if($res)
        $this->assign('list',$res);
        $this->display();
    }
    public function Addcustomer() {
        $Customer=D('Customer');
        $data['customername']=I('CustomerName');
        $data['customerphone']=I('CustomerPhone');
        $data['selectobj']=I('SelectObj');
        $data['userid']=session('uid');
        $data['source']=1;//直接来源
        $where['customerphone']=$data['customerphone'];
        $where['userid']=$data['userid'];
        if($data['selectobj']==0||empty($data['customername'])||empty($data['customerphone'])){
            $this->error('请将数据添加完整');
        }
        $res=$Customer->where($where)->find();
        if($res){
            $this->error('当前用户已在推荐列表中无需重复添加');
        }else{
            if(!$Customer->create($data)){
                $this->error($Customer->getError());
            }else{
                $res=$Customer->add();
                if($res){
                    $this->success('操作成功,请将该条信息分享给好友',U('/Home/Sendshare/index',array('goodsid'=>$data['selectobj'],'sendid'=>$data['userid'],'customerid'=>$res)));
                }
            }
        }
    }
}