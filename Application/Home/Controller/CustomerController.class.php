<?php
namespace Home\Controller;
class CustomerController extends CommonController {

    public function index(){
        $Customer=M('Customer');
        $condition['userid']=session('uid');
        $res=$Customer->where($condition)->select();
        $newdate=new \Org\Util\Date();
        if($res){
            foreach ($res as  $key=>$val){
                 switch ($val['status']){
                     case 1:
                         $res[$key]['status']='等待反馈';
                         break;
                     case 2:
                         $res[$key]['status']='<span class="label label-info">有意向</span>';
                         break;
                     case 3:
                         $res[$key]['status']='成交';
                         break;
                     default:
                         $res[$key]['status']='等待反馈';
                         break;
                 }
            }
            $this->assign('list',$res);
        }
        $this->display();
    }
    public function getinfo() {
        $newdate=new \Org\Util\Date();
        $id=I('id');
        $Customer=M('Customer');
        $condition['userid']=session('uid');
        $condition['think_customer.id']=$id;
        $join='INNER JOIN `think_order` ON `think_order`.`id`=`think_customer`.`selectobj` ';
        $field='`think_customer`.id as id,`selectobj`,`userid`,`customername`,`customerphone`,`display`,`status`,`think_order`.`title`,`think_customer`.`createtime` ';
        $res=$Customer->join($join)->field($field)->where($condition)->find();
        if($res){
                switch ($res['status']){
                    case 1:
                        $res['status']='等待反馈';
                        break;
                    case 2:
                        $res['status']='<span class="label label-info">有意向</span>';
                        break;
                    case 3:
                        $res['status']='成交';
                        break;
                    default:
                        $res['status']='等待反馈';
                        break;
                }
            //$res[$key]['createtime']=$newdate->timeDiff($val['createtime']);
        }
        return $this->ajaxReturn($res);
    }
}