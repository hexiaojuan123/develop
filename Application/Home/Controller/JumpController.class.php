<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Scope;
header("Content-Type: text/html; charset=utf8");
class JumpController extends Controller {
    private static $parma=NULL;
    public function index(){
      $type=I('type')?'snsapi_userinfo':'snsapi_base';
      $sendid=I('sendid');//获取发送者的ID
      $goodsid=I('goodsid');//获取商品表的ID
      $customerid=I('customerid');//获取客户表的ID
      if(!empty($goodsid)&&!empty($sendid)){
         self::$parma='/goodsid='.$goodsid.'/sendid=/'.$sendid;
      }
      $redirect_url='http://jhl.aipu.com/develop/index.php?s=/Home/Jump/'.$type;
      $scope=new Scope($redirect_url,$type);
      redirect($scope->triggerurl());
      exit();
    }
    public function snsapi_base(){
        $code=I('code');
        $scope=new Scope();
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
                if($selsect_openid){
                    session('uid',$selsect_openid['id']);
                    if($selsect_openid['realname']!==null){
                         if(!empty(self::$parma))
                            redirect(__APP__.'/Home/Sendshare/index'.self::$parma);
                        else 
                            redirect(__APP__.'/Home/Index');
                    }else{
                        if(!empty(self::$parma))
                            redirect(__APP__.'/Home/Sendshare/index'.self::$parma);
                        else 
                            redirect(__APP__.'/Home/Index');
                    }
                    exit();
                }else{
                    redirect(__APP__.'/Home/Jump/Index/type/snsapi_userinfo');
                    exit();
                }
            }else {
                redirect(__APP__.'/Home/Jump/Index/type/snsapi_userinfo');
                exit();
            }
        }
    }
    public function snsapi_userinfo() {
        $code=I('code');
        $scope=new Scope();
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
                $ip = get_client_ip();
                $Rip = new \Org\Util\IP(); // 实例化类 参数表示IP地址库文件
                $postion=$Rip::find($ip);
                if(!$selsect_openid){
                    $datainfo['username']=$res->nickname;
                    $datainfo['openid']=$res->openid;
                    $datainfo['faceimg']=$res->headimgurl;
                    $datainfo['city']=$res->country.','.$res->province.','.$res->city;
                    $datainfo['sex']=$res->sex;
                    $datainfo['ip']=$ip;
                    $datainfo['address']=$postion;
                    $sqlres=$User->add($datainfo);
                    if($sqlres){
                        session('uid',$sqlres);
                        if(!empty(self::$parma))
                            redirect(__APP__.'/Home/Sendshare/index'.self::$parma);
                        else 
                            redirect(__APP__.'/Home/Index');
                        exit();
                    }else{
                        $this->error('数据存储失败请稍后在试');
                    }
                }else{
                    session('uid',$selsect_openid['id']);
                    redirect(__APP__.'/Home/Index/index');
                }
            }
        }
    }
}