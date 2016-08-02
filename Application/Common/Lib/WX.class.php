<?php
namespace Common\Lib;
/**
 * 微信抽象类
 * @author pengbd3
 * @link http://www.baidu.com
 *
 */
abstract class WX
{
    private  $APPID='wx04312878011613e9';//APPID
    private  $APPSECRET='758fbe2e79914626bd2f8de2071a4cbf';//APPSECRET
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
    /**
     * URL语法规定来传输文件和数据 无数据
     * @param string $url 请求URL
     * @param array $data 请求数据
     * @return array $data 返回请求对象
     */
    public function http_request($url,$data=null) {
        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST ,1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output=curl_exec($curl);
        curl_close($curl);
        $data=json_decode($output);
        return $data;
    }
}

?>