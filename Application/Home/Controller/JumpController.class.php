<?php
namespace Home\Controller;
use Think\Controller;
use Common\Lib\Scope;
header("Content-Type: text/html; charset=utf8");
class JumpController extends Controller {
    public function index(){
      $type=I('type')?'snsapi_userinfo':'snsapi_base';
      $sendid=I('sendid');//获取发送者的ID
      $goodsid=I('goodsid');//获取商品表的ID
      $customerid=I('customerid');//获取客户表的ID
       if(!empty($sendid)||!empty($goodsid)||!empty($customerid))
           $redirect_url='http://jhl.aipu.com/develop/index.php?s=/Home/Jump/goodsid='.$goodsid.'/sendid=/'.$sendid.'/customerid=/'.$customerid.'/'.$type;
       else 
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
                        redirect(__APP__.'/Home/Index');
                    }else{
                        redirect(__APP__.'/Home/Register');
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
                if(!$selsect_openid){
                    $datainfo['username']=$res->nickname;
                    $datainfo['openid']=$res->openid;
                    $datainfo['faceimg']=$res->headimgurl;
                    $datainfo['city']=$res->country.','.$res->province.','.$res->city;
                    $datainfo['sex']=$res->sex;
                    $sqlres=$User->add($datainfo);
                    if($sqlres){
                        session('uid',$sqlres);
                        redirect(__APP__.'/Home/Register');
                        exit();
                    }else{
                        $this->error('数据存储失败请稍后在试');
                    }
                }else{
                    session('uid',$selsect_openid['id']);
                    redirect(__APP__.'/Home/Register');
                }
            }
        }
    }
}