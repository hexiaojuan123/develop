<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
header("Content-Type: text/html; charset=utf8");
class CustomerController extends CommonController {
    public $datalist=array();
    public static $num;
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $Customer=M('Customer');
        $User=M('User');
        $condition['userid']=self::$UID;
        $field='`username`,`faceimg`';
        $join='INNER JOIN `think_user` ON `think_user`.`id`=`think_customer`.`userid`';
        $count=$Customer->where($condition)->join($join)->count();
        $Page=new \Think\Page($count,9);
        $Page->lastSuffix=false;
        $Page->setConfig('first', '首页');
        $Page->setConfig('last', '末页');
        $show=$Page->show();//分页显示输出
        $newdate=new \Org\Util\Date();
        $res=$Customer->field('`think_customer`.`id` as id,`receiveid`,`selectobj`,`status`,`think_customer`.`createtime`')->join($join)->limit($Page->firstRow.','.$Page->listRows)->where($condition)->select();
        foreach ($res as $key=>$val){
            $data['id']=$val['receiveid'];
            $res[$key]['info']=$User->field($field)->where($data)->find();
            switch ($val['status']){
                case 1:
                    $res[$key]['status']='等待反馈';
                    break;
                case 2:
                    $res[$key]['status']='<span class="label label-info">有意向</span>';
                    break;
                case 3:
                    $res[$key]['status']='<span class="label label-success">成交</span>';
                    break;
                default:
                    $res[$key]['status']='等待反馈';
                    break;
            }
            $res[$key]['createtime']=$newdate->timeDiff($val['createtime']);
        }
        $this->assign('list',$res);
        $this->assign('page',$show);
        $this->display();
    }
    public function getinfo() {
        $newdate=new \Org\Util\Date();
        $id=I('id');
        $Customer=M('Customer');
        $condition['userid']=self::$UID;
        $condition['think_customer.id']=$id;
        $joinu='INNER JOIN `think_user` ON `think_user`.`id`=`think_customer`.`receiveid`';
        $join='INNER JOIN `think_order` ON `think_order`.`id`=`think_customer`.`selectobj` ';
        $field='`think_customer`.`id` as id,`selectobj`,`userid`,`customername`,`customerphone`,`display`,`status`,`think_order`.`title`,`think_customer`.`createtime`,`faceimg`,`username` ';
        $res=$Customer->join($join)->join($joinu)->field($field)->where($condition)->find();
        if($res){
                
                switch ($res['status']){
                    case 1:
                        $res['status']='<span class="label label-warning">等待反馈</span>';
                        break;
                    case 2:
                        $res['status']='<span class="label label-info">有意向</span>';
                        break;
                    case 3:
                        $res['status']='<span class="label label-success">成交</span>';
                        break;
                    default:
                        $res['status']='等待反馈';
                        break;
                }
            //$res[$key]['createtime']=$newdate->timeDiff($val['createtime']);
        }
        return $this->ajaxReturn($res);
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
        $field='`username`,`think_customer`.`id` as `id`,`userid`,`receiveid`,`faceimg`';
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
}