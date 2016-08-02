<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Shop;
class TestController extends Controller {
    private  $datalist=array();
    public function index(){
        $Sale=array(1,0.85,0.8,0.75);
        $shop=new Shop(1000);
        $shop::$Sale=$Sale;
        $sh=$shop->SaleValue();
        $uid=session('uid');
        $this->getiu($uid);
        echo '<pre>';
        var_dump($this->datalist);
        echo '<pre/>';
        
    }
    public function getiu($sendid=NULL){
        $customer=M('customer');
        $join='INNER JOIN `think_order` ON `think_order`.`id`=`think_customer`.`selectobj` ';
        $field='`think_customer`.`id` as `id`,`userid`,`receiveid`,`title`';
        if(!empty($sendid))
            $condition['receiveid']=$sendid;
        $res=$customer->where($condition)->field($field)->join($join)->find();
        if($res){
            $sendid=$res['userid'];
            array_push($this->datalist, $res);
            $this->getiu($sendid);
        }else{
            return false;
        }
    }
}