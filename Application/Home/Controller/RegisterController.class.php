<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Scope;
class RegisterController extends Controller {
    public function index(){
//         $pepole=new son(1,2);
//         $a=$pepole->rsc();
//         $b=$pepole->buy('123456');
//         $c=$pepole->sell('哈哈哈');
//         var_dump($a);
//         var_dump($b);
//         var_dump($c);

        $appid='wx04312878011613e9';
        $appsecret='758fbe2e79914626bd2f8de2071a4cbf';
//         $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
//         $ac=S('accesstoken');
//           if(!$ac){
//              $ac=$this->http_request($url);
//              if(!empty($ac)){
//                 S('accesstoken',$ac,array('type'=>'file','expire'=>7200));
//              }
//           }

        
          $redirect_url=urlencode('http://jhl.aipu.com/develop/index.php?s=/Home/Index');
          $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_url.'&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect';
          $this->success('跳转中...',$url);
          exit();
          $code=I('code');
          if(!empty($code)){
              $curl='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code ';
              $cc=$this->http_request($curl);
          }


//          $scope=new Scope($redirect_url,'snsapi_userinfo','123');
//          $a=$scope->getcode();
//         var_dump($a);
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
        $likename=I('likename');
        $realname=I('realname',null,false);
        $phone=I('Phone',null,false);
        $vecode=I('vecode',null,false);
        $faceimg=I('faceimg',null,false);
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
                    $user->commit();
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