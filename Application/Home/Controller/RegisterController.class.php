<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
use Common\Lib\mobileverify;
class RegisterController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $User=M('User');
        $param['openid']=self::$OPENID;
        $param['id']=self::$UID;
        $userinfo=$User->field('`realname`,`faceimg`')->where($param)->find();
        if($userinfo['realname']){
            var_dump($userinfo);
        }  
        $this->assign('userinfo',$userinfo);
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $this->display();
    }
    public function Register() {
        $realname=I('realname',null,false);
        $phone=I('Phone',null,false);
        $vecode=I('vecode',null,false);
        $imgcode=I('imgcode',null,false);
        $code=session('verify');
        if(!check_verify($imgcode)){
            $this->error('图形验证码错误');
        }
        if($vecode!=$code){
            $this->error('验证码错误请确认手机号');
        }
        if(empty($phone)||empty($vecode)||empty($realname)){
          $this->error('请将数据填写完整');  
        }else{
            $data['realname']=$realname;
            $data['phone']=$phone;
            $where['id']=self::$UID;
            $user=D('User');
            $user->startTrans();
            if(!$user->create($data)){
                $this->error($user->getError());
            }else{
                $res=$user->where($where)->save();
                if(!false==$res){
                    $user->commit();
                    if(empty($redirect)){
                        $this->success('添加成功',__APP__.'/Home/Index');
                    }
                }else{
                    $user->rollback();
                    $this->error('数据添加失败,请稍后在试');
                }
            }
            
        }
    }
    public function Verify() {
        $phone=I('phone');
        if(!empty($phone)){
            $r=rand(1000, 9999);
            $verify=new mobileverify('http://userinterface.vcomcn.com/Opration.aspx','cdjhl','lzc20160301');
            $issend=$verify::sendVerifyCode($phone,$r);
            $_SESSION['verify']=$r;
            $msg=array('code'=>1,'msg'=>'发送成功','data'=>$issend);
        }else{
            $msg=array('code'=>0,'msg'=>'发送失败');
        }
        return $this->ajaxReturn($msg);
      }
}