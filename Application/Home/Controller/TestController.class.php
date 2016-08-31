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
    public function  jjsss() {
        $Receive=M('Receive');
        $commission_log=D('CommissionLog');
        $uid=self::$UID;
        $condition['sendid']=6266;//需要提现的用户ID
        $condition['status']=1;
        $money=I('price',0.00,'floatval');//提现的金额
        $parme=6;//最小提现金额
        $price=0;//初始化余额总数
        if($money<$parme){
            $this->error('提现金额不能小于最小提现额度');
        }
        $field='`id`,`sendid`,`goodsid`,`commission`,`createtime`,`status`';
        $wdc=$commission_log->field($field)->where($condition)->where('UNIX_TIMESTAMP(createtime) < UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 7 DAY))')->select();
        foreach ($wdc as $item){
            $p+=floatval($item['commission']);
        }
        if($p<=$parme){
            exit($this->error('提现金额不能大于可提现余额'));
        }
        /**--获取所有能提现的款项--**/
        if($wdc){
            foreach ($wdc as $val){
                $price+=floatval($val['commission']);
                $data['status']=2;
                $where['id']=$val['id'];
                $commission_log->startTrans();
                $mosrs=$commission_log->lock(true)->where($where)->save($data);
                if($mosrs){
                    $isfindmoney=$this->findredbag($money*100);
                    if($isfindmoney){
                        
                        $isrecev=$Receive->save();
                        $commission_log->commit();
                    }
                    else{ 
                        $commission_log->rollback();
                        $this->error('系统繁忙');
                    }
                }else{
                    $commission_log->rollback();
                    //$this->error('默认提交数据出错');
                }
                if($price>=$parme){
                    $limitprice=$price-$parme;
                    if($limitprice>0){
                        /**---当余额大于提现金额---**/
                        $data['commission']=$limitprice;
                        $data['status']=1;
                        if(!$commission_log->token(false)->create($data)){
                            $commission_log->rollback();
                            $this->error($commission_log->getError());
                        }else{
                            $result=$commission_log->lock(true)->where($where)->save();
                            if($result){
                                $isfindmoney=$this->findredbag($money*100);
                                if($isfindmoney){
                                    $commission_log->commit();
                                }
                                else{
                                    $commission_log->rollback();
                                    $this->error('系统繁忙');
                                }
                            }
                        }
                    }
                    break;
                }
            }
        }
    }
    protected function findredbag($money=0){
        $hongbao=new WXHongBao();
        $gznowhb=$hongbao->newhb(self::$OPENID,$money);
        $fsjg=$hongbao->send();
        $content=$hongbao->error();
        if($fsjg!='1'){
            return false;
        }else{
            return true;
        }
    }
    public function fakk() {
        $Receive=D('Receive');//receive 模型
        $commission_log=D('CommissionLog');//CommissionLog 模型
        $money=I('price',0.00,'floatval');//用户提现的金额
        $sendid=6266;//发送者ID
        $status=1;//提现状态 1:已提现，2:未提现
        $price=0;//初始化余额总数

        /***查询 达到7天后可提现的金额所有数据**begin*/
        $condition['sendid']=$sendid;
        $condition['status']=$status;
        $field='`id`,`sendid`,`goodsid`,`commission`,`createtime`,`status`';
        $all_price_order=$commission_log->field($field)->where($condition)->where('UNIX_TIMESTAMP(createtime) < UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 7 DAY))')->select();
        /***查询 达到7天后可提现的金额所有数据**end*/
        
    }
}