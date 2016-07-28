<?php
namespace Home\Controller;
class ShareController extends CommonController {
    public function index(){
        $order=M('Order');
        $condition['id']=I('orid');
        $condition['display']=2;
        $res=$order->where($condition)->select();
        $this->assign('list',$res);
        $this->display();
    }
    public function haveintent() {
        $sendid=I('uid');
        $orid=I('orid');
        if(empty($sendid)||empty($orid)){
            $this->error('缺少必要数据',__APP__.'/Home/Index');
            return false;
        }
        $openid="oGYnqt5R74jztGcIGSJ6XXMXYxKa";
        $User=M('User');
        $where['openid']=$openid;
        $isuser=$User->where($where)->find();
        if(!$isuser){
           $this->success('请先注册',__APP__.'/Home/Register/index/?redirect=share&uid='.$sendid.'&orid='.$orid);
           return false;
        }else{
        $Customer=D('Customer');
        $Customer->startTrans();
        $data['status']=2;//有意向
        $condition['id']=$orid;
        if(!$Customer->create($data)){
            $this->error($Customer->getError());
        }else{
            $res=$Customer->lock(true)->where($condition)->save();
            if(!false==$res){
                $url='&send='.$sendid.'&receive='.$isuser['id'].'&orid='.$orid;
                $this->success('正在跳转... ','http://jhl.aipu.com/app/index.php?i=3&c=entry&id=10&do=detail&m=wdl_june_shopping#wechat_redirect'.$url);
                $Customer->commit();
            }else{ 
                $this->error($Customer->getDbError());
                $Customer->rollback();
            }
        }
       }
    }
}