<?php
namespace Common\Lib;
/**
 * 模板消息类
 * @author pengbd3
 *
 */
class WXsend extends WX
{
    private static $URL='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=';//模板发送地址
    public function send_template($data) {
        $url=self::$URL.$this->Access_Token();
        $res=$this->http_request($url,$data);
        return json_decode($res,true);
    }
    /**
     * 发送模板消息设置
     * @param string $openid 用户的唯一识别码
     * @param string $templateid 模板消息的ID
     * @param string $first 标题文字
     * @param int $phone 内容文字 手机号
     * @param string $connect 内容文字 充值内容
     * @param string $remark 内容文字 备注
     * @return array $msg 消息反馈提示
     * @example 尊敬的用户，恭喜您成功获赠100M免费流量，流量已自动为您充值至绑定号码中。手机号码：15312341234 赠送内容：100M免费流量 温馨提醒：流量当月有效，次月失效，请及时使用。
     */
    public function sended_option($openid,$phone,$connect=NULL) {
        $first="您好，极互联4K问卷调查的礼品已送达，请查收";
        $remark="如有疑问请致电:952155，传真:028-61813600";
        $template=array(
	        'touser'=>$openid,
	        'template_id'=>"uTS4HuZh_Y0VXlpIhUL4GoCCwH8QLntkK9seHJQRGbs",
	        'topcolor'=>"#FF0000",
	        'data'=>array(
	            'first'=>array('value'=>urlencode($first),'color'=>'#743a3a'),
	            'keyword1'=>array('value'=>urlencode($phone),'color'=>'#49baff'),
	            'keyword2'=>array('value'=>urlencode($connect),"color"=>'#ff0000'),
	            'remark'=>array('value'=>urlencode($remark),'color'=>'#000000'),
	        )
	    );
	    $res=$this->send_template(urldecode(json_encode($template)));
	    if($res['errcode']==0){
	        $msg=array('code'=>1,'phone'=>$phone,'msg'=>'发送成功');
	    }else{
	        $msg=array('code'=>$res['errcode'],'phone'=>$phone,'msg'=>$res['errmsg']);
	    }
	   return $msg;
    }
    /**
     * 数据封装 入口
     * @param array $data 需要发送的数据
     * @example $data=array('openid'=>$openid,'phone'=>$phone,'type'=>$type)
     */
    public function arrayformat($data) {
        foreach ($data as $key=>$val){
           $msg[]=$this->sended_option($val['openid'],$val['phone'],$val['type']);
        }
        return $msg;
    }
}

?>