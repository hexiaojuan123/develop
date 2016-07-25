<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
    public function index(){
        $this->display();
    }
    public function Register() {
        $likename=I('likename');
        $realname=I('realname',null,false);
        $phone=I('Phone',null,false);
        $vecode=I('vecode',null,false);
        $faceimg=I('faceimg',null,false);
        if(empty($faceimg)){
          $this->error('请将数据填写完整');  
        }else{
            $data['likename']=$likename;
            $data['realname']=$realname;
            $data['phone']=$phone;
            $data['vecode']=$vecode;
            $data['faceimg']=$faceimg;
            $data['openid']='oGYnqt5R74jztGcIGSJ6XXMXYxKs';
            $user=D('User');
            $user->startTrans();
            if(!$user->create($data)){
                $this->error($user->getError());
            }else{
                $res=$user->add();
                if($res){
                    $user->commit();
                    $this->success('添加成功',__APP__.'/Home/Index');
                    session('uid',$res);
                }else{
                    $user->rollback();
                    $this->error($user->getDbError());
                }
            }
            
        }
    }
}