<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Scope;
use Common\Lib\Jsapi_Ticket;
use Common\Lib\JS_SDK;
class RegisterController extends Controller {
    public function index(){
        $User=M('User');
        $condition['openid']=session('openid');
        $selsect_openid=$User->where($condition)->find();
           if(!$selsect_openid){
               redirect(__APP__.'/Home/Jump');
               exit();
             }else {
                $this->assign('userinfo',$selsect_openid);
             }
        $jssdk=new JS_SDK();
        $sh=$jssdk->sharedata($_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
        $this->assign('sh',$sh);
        var_dump($sh);
        $this->assign('appid',$jssdk->getAPPID());
        $this->display();
    }
    public function http_request($url) {
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST ,1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output=curl_exec($curl);
        curl_close($curl);
        $json=json_decode($output);
        return $output;
    }
    public function Register() {
        $likename=I('nickname');
        $realname=I('realname',null,false);
        $phone=I('Phone',null,false);
        $vecode=I('vecode',null,false);
        $faceimg=I('faceimg',null,false);
        $openid=I('openid');
        $redirect=I('redirect');
        $sendid=I('uid');
        $orid=I('orid');
        if(empty($faceimg)){
          $this->error('请将数据填写完整');  
        }else{
            $data['username']=$likename;
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
                    var_dump($data);
//                     $user->commit();
                    if(empty($redirect))
                        $this->success('添加成功',__APP__.'/Home/Index');
                    else 
                        $this->success('跳转中...',__APP__.'/Home/'.$redirect.'?uid='.$sendid.'&orid='.$orid);
                    session('uid',$res);
                }else{
                    $user->rollback();
                    $this->error($user->getDbError());
                }
            }
            
        }
    }
}