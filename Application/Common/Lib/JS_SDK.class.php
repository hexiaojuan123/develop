<?php
namespace Common\Lib;

/**
 * js_sdk派生类
 * @author pengbd3
 *
 */
class JS_SDK extends WX
{
    /**
     * 获取jsapi_ticket
     * @return string jsapi_ticket码 缓存7200秒
     */
    public function jsapi_ticket(){
        $url='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->Access_Token().'&type=jsapi';
        $ticket=S('jsapi_ticket');
        if(!$ticket){
            $info=$this->http_request($url);
            $ticket=$info->ticket;
            if(!empty($ticket)){
                S('jsapi_ticket',$ticket,array('type'=>'file','expire'=>7200));
            }
        }
        return $ticket;
    }
    /**
     * 微信自定义分享 数据封装
     * @param string $url 请求URL
     * @return array $data 返回数组
     */
    public function sharedata(){
        $noncestr=$this->get_randstr();//随机字符串
        $jsapi_ticket='jsapi_ticket='.$this->jsapi_ticket();
        $timestamp=time();//时间戳
        $aurl='&url=http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $str=$jsapi_ticket.'&noncestr='.$noncestr.'&timestamp='.$timestamp.$aurl;
        $signature=sha1($str);
        $data['noncestr']=$noncestr;
        $data['signature']=$signature;
        $data['time']=$timestamp;
        $data['jsapi_ticket']=$jsapi_ticket;
        $data['url']=$aurl;
        return $data;
    }
    /**
     * 本地随机数验证
     * @return mixed $str 随机返回16为数
     */
    private function get_randstr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}

?>