<?php
namespace Common\Lib;

class Scope extends WX
{
   private $redirect_uri;
   private $scopetype;
   private $state;
   private $response_type;
   public function __construct($_redirect,$_scoptype='snsapi_base',$_state=null,$_response_type='code') {
       $this->redirect_uri=$_redirect;
       $this->scopetype=$_scoptype;
       $this->state=$_state?$_state:null;
       $this->response_type=$_response_type;
   }
   public function getcode() {
       $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->getAPPID().'&redirect_uri='.$this->redirect_uri.'&response_type='.$this->response_type.'&scope='.$this->scopetype.'&state='.$this->state.'#wechat_redirect';
       $code=$this->http_request($url);
       return $code;
   }
}

?>