<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Shop;
use Common\Lib\Rebbag\WXHongBao;
class TestController extends Controller {
    private $datalist=array();
    private static $num=0;
    public function index(){
        $Sale=array(0.05,0.04,0.01);//设置每一级的佣金
        //$goodsid=I('goodsid');//获取商品ID
        $goodsid=2;//获取商品ID
        $customerid=I('customerid');
        $sendid=I('sendid');
        $uid='6267';
        $price=$this->FindGoodsPrice($goodsid);
        if(!$price){
            $this->error('获取商品总价失败');
        }
        $shop=new Shop($price);//传入商品的总价
        $shop::$Sale=$Sale;//将佣金折扣传入shop类
        $this->getiu($uid);
        if(empty($this->datalist)){
            $this->error('获取关键数据失败,请联系管理人员进行处理');
        }
        $sh=$shop->SaleValue($this->datalist);
        $User=D('User');
        $commission_log=M('CommissionLog');
        $User->startTrans();
        foreach ($sh as $key=>$val){
            $data['sendid']=$val['userid'];
            $data['receiveid']=$val['receiveid'];
            $data['title']=$val['title'];
            $data['commission']=$val['commission'];
            $data['goodsid']=$val['goodsid'];
            $data['realname']=$val['realname'];
            $data['username']=$val['username'];
            $data['customerid']=$val['id'];
            $condition['id']=$val['userid'];
            $res=$User->where($condition)->setInc('balance',$val['commission']);
            if(false!==$res){
              if($data['commission']!=0){
                $commission_log->add($data);
              }
              $User->commit();
            }else{
              $User->rollback();
          }
        }
        echo '<pre>';
        var_dump($sh);
        echo '</pre>';
    }
    /**
     * 递归 获取对应发送者的上级
     * @param string $sendid 发送者ID
     * @return array|bool $data 上级
     */
    public function getiu($sendid=NULL){
        if(self::$num>1){
            return false;
        }
        $customer=M('customer');
        $Orderjoin='INNER JOIN `think_order` ON `think_order`.`id`=`think_customer`.`selectobj` ';
        $Userjoin='INNER JOIN `think_user` ON `think_user`.`id`=`think_customer`.`userid` ';
        $field='`username`,`think_customer`.`id` as `id`,`userid`,`receiveid`,`title`,`realname`,`think_order`.`id` as goodsid ';
            if(!empty($sendid)){
                $condition['receiveid']=$sendid;
            }
            $res=$customer->where($condition)->field($field)->join($Userjoin)->join($Orderjoin)->find();
            if($res){
                if($sendid==$res['userid']){
                    return false;//如果发送者和接收者相等 直接跳出循环
                }
                $sendid=$res['userid'];
                array_push($this->datalist, $res);
                self::$num=self::$num+1;
                $this->getiu($sendid);
            }else{
                return false;
            }
    }
    /**
     * 查找商品的价格
     * @param int $goodsid 商品的ID
     * @return float $price 商品的价格
     */
    public function FindGoodsPrice($goodsid){
        $order=M('order');
        $condtion['id']=$goodsid;
        $field='`price`';
        $price=$order->where($condtion)->field($field)->find();
        if($price){
            return $price['price'];
        }else {
            return false;
        }
    }
    public function hh() {
        $money=100;//单位是分
        //发送红包
        $hongbao=new WXHongBao();
        $gznowhb=$hongbao->newhb('oGYnqt8d8--axLoPtfBaOVX8cUxk',$money);
        $fsjg=$hongbao->send();
        $content=$hongbao->error();
        if($fsjg!='1'){
            echo '系统繁忙!';
        }else{
            echo '已经为您准备上红包，请笑纳！';//正式使用把最后的删除
        }
    }
}