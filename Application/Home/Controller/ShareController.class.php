<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
use Think\Controller;
header("Content-Type: text/html; charset=utf8");
class ShareController extends Controller {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $order=M('Order');
        $condition['id']=I('goodsid');
        $condition['display']=2;
        $res=$order->where($condition)->select();
        $this->assign('list',$res);
        $this->display();
    }
    public function haveintent() {
        $sendid=I('sendid');//获取发送者的ID
        $goodsid=I('goodsid');//获取商品表的ID
        $uid=session('uid');//获取用户uid
        $openid=session('openid');//获取用户的openid
        if(empty($sendid)||empty($goodsid)){
            $this->error('缺少必要数据',__APP__.'/Home/Index');
            return false;
        }
        if(!empty($openid)||!empty($uid)){
        $User=M('User');
        $where['openid']=$openid;
        $field='`id`,`phone`,`openid`,`username`,`realname`';
        $isuser=$User->where($where)->field($field)->find();//获取用户的基本信息
        $Customer=D('Customer');
        $Order=M('order');
        $Customer->startTrans();//开始事务
        $data['status']=2;//有意向
        $data['receiveid']=$uid;//接收者的ID
        $condition['think_customer.userid']=$sendid;//用户ID
        $condition['think_customer.']=$isuser['phone'];//用户的手机号
        $wheregeturl['id']=$goodsid;
        $join='INNER JOIN `think_order` ON `think_order`.`id`=`think_customer`.`selectobj` ';
        $resurl=FALSE;
        $geturl=$Order->field('`url`')->where($wheregeturl)->find();//获取需要跳转的url
        $url='&send='.$sendid.'&receive='.$uid.'&goodsid='.$goodsid;
        if($resurl){
            //当客户表中有该用户对应手机号且接收者的ID与自己匹配
            if(!$Customer->token(false)->create($data)){
                $this->error($Customer->getError());
            }else{
                //将状态改变为有意向
                $res=$Customer->where($condition)->save();
                if(false!==$res){
                    $this->success('正在跳转... ',$geturl['url'].$url);
                    $Customer->commit();
                }else{
                    $this->error('存储数据更新失败');
                    $Customer->rollback();
                }
            }        
        }else{
            //当客户表中无对应手机号 则需要单独添加该用户信息到客户表
            //并对应到发送者客户表下 表明该用户是通过发送者的信息中表明自己有意向
            unset($data);//清除data
            unset($condition);//清除condition
            $data['status']=2;//有意向
            $data['receiveid']=$uid;
            $data['userid']=$sendid;
            $data['selectobj']=$goodsid;
            $data['source']=2;
            $condition['receiveid']=$uid;
            $condition['userid']=$sendid;
            $condition['selectobj']=$goodsid;
            $condition['status']=2;
            $iscustomer=$Customer->where($condition)->find();
            if($iscustomer){
                //判断如果存在该用户的推荐意向将无需重复添加客户信息
                $this->success('正在跳转... ',$geturl['url'].$url);
            }else{
                if(!$Customer->token(false)->create($data)){
                    $this->error($Customer->getError());
                }else{
                    $resadd=$Customer->add();
                    if($resadd){
                        $this->success('正在跳转... ',$geturl['url'].$url);
                        $Customer->commit();
                    }else{
                        $this->error('数据添加失败');
                        $Customer->rollback();
                    }
                }
            }
       }
      }else{
        //前往注册页面
        redirect(U('/Home/Register/index',array('goodsid'=>$goodsid,'sendid'=>$sendid)));
     }
    }
}