<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Scope;
class JumpController extends Controller {
    public function index(){
              $redirect_url='http://jhl.aipu.com/develop/index.php?s=/Home/Jump';
              $scope=new Scope($redirect_url,'snsapi_userinfo');
              $code=I('code');
              if(empty($code)){
                  redirect($scope->triggerurl());
                  exit();
              }else{
                $data=$scope->GetAccess_token($code);
                if($data->errcode==40029){
                    redirect($scope->triggerurl());
                    exit();
                }else{
                    $res=$scope->Get_user_info($data['access_token'], $data['openid']);
                    if(!empty($res->openid)){
                        $User=M('User');
                        $condition['openid']=$res->openid;
                        session('openid',$res->openid);
                        $selsect_openid=$User->where($condition)->find();
                        if(!$selsect_openid){
                            $datainfo['username']=$res->nickname;
                            $datainfo['openid']=$res->openid;
                            $datainfo['faceimg']=$res->headimgurl;
                            $datainfo['city']=$res->country.','.$res->province.','.$res->city;
                            $datainfo['sex']=$res->sex;
                            $sqlres=$User->add($datainfo);
                        }
                    }else {
                        $this->error('获取用户信息失败,openid为空');
                    }
                }
              }
              redirect(__APP__.'/Home/Register');
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