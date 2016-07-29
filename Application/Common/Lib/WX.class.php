<?php
namespace Common\Lib;

abstract class WX
{
    private  $APPID='wx04312878011613e9';
    private  $APPSECRET='758fbe2e79914626bd2f8de2071a4cbf';
    /**
     * 调用微信接口所使用的Access_Token
     * @return string Access_Token
     */
    public function Access_Token(){
      $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->APPID.'&secret='.$this->APPSECRET;
      $ac=S('accesstoken');
      if(!$ac){
           $tac=$this->http_request($url);
           $ac=$tac->access_token;
           if(!empty($ac)){
              S('accesstoken',$ac,array('type'=>'file','expire'=>7200));
            }
        }
        return $ac;
    }
    /**
     * @return the $APPID
     */
    public function getAPPID()
    {
        return $this->APPID;
    }

 /**
     * @return the $APPSECRET
     */
    public function getAPPSECRET()
    {
        return $this->APPSECRET;
    }

 /**
     * @param string $APPID
     */
    public function setAPPID($APPID)
    {
        $this->APPID = $APPID;
    }

 /**
     * @param string $APPSECRET
     */
    public function setAPPSECRET($APPSECRET)
    {
        $this->APPSECRET = $APPSECRET;
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
        return $json;
    }
}

?>