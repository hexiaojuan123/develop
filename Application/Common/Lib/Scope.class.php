<?php
namespace Common\Lib;
class Scope extends WX
{
   private $redirect_uri;
   private $scopetype;
   private $state;
   private $response_type;
/**
    * Scope 构造函数
    * @param string $_redirect 回调地址哎
    * @param string $_scoptype scopt的类型 snsapi_base snsapi_userinfo
    * @param string $_state 默认可为空
    * @param string $_response_type 默认code
    */
   public function __construct($_redirect=NULL,$_scoptype='snsapi_base',$_state=null,$_response_type='code') {
       $this->redirect_uri=urlencode($_redirect);
       $this->scopetype=$_scoptype;
       $this->state=$_state?$_state:null;
       $this->response_type=$_response_type;
   }
   /**
    * snsapi_userinfo授权 强制拉取用户数据
    * @param string $url 调整地址
    * @return string $url 返回跳转url
    */
   public function triggerurl($url=NULL) {
       $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->getAPPID().'&redirect_uri='.$this->redirect_uri.'&response_type='.$this->response_type.'&scope='.$this->scopetype.'&state='.$this->state.'#wechat_redirect';
       return $url;
   }
   /**
    * 通过code换取的是一个特殊的网页授权access_token
    * @param string $code
    * @return array $res 数组
    */
   public function GetAccess_token($code){
       $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->getAPPID().'&secret='.$this->getAPPSECRET().'&code='.$code.'&grant_type=authorization_code ';
       $res=$this->http_request($url);
       $data=array();
       if(empty($res->errcode)){
           $data['access_token']=$res->access_token;
           $data['$user_refresh_token']=$res->refresh_token;
           $data['openid']=$res->openid;
           $data['scope']=$res->scope;
       }else{
           $data=$res;
       }
       return $data;
   }
   public function Get_user_info($access_token,$openid) {
       $url='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN ';
       $userinfo=$this->http_request($url);
       return $userinfo;
   }
}

?>