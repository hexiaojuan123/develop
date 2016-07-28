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
        $condition['id']=$id;
        $res=$Customer->where($condition)->select();
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
            //$res[$key]['createtime']=$newdate->timeDiff($val['createtime']);
        }
        return $this->ajaxReturn($res);
    }
}