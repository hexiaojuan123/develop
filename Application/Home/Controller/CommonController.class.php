<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 公共控制器 
 * @author pengbd3
 * 
 */
class CommonController extends Controller {
    public static $OPENID;//用户openid
    public static $UID;//用户UID
    public function _initialize(){
        $this->checkSign();
    }
    /**
     * 静态类 从数据库获取用户的基本信息 如果获取不到将将从微信中拉取
     * @return url | array 数据库中无数据将跳转或者返回用户数据
     */
    protected static function userinfo() {
        $User=M('User');
        $param['openid']=self::$OPENID;
        $param['id']=self::$UID;
        $userinfo=$User->where($param)->cache(120)->find();
        if($userinfo)
            return $userinfo;
        else
            redirect(__APP__.'/Home/Jump');
    }
    /**
     * 检查是否登录
     */
    protected function checkSign(){
        if(!session('?openid')||!session('?uid')){
            $sendid=I('sendid');//获取发送者的ID
            $goodsid=I('goodsid');//获取商品表的ID
            $customerid=I('customerid');//获取客户表的ID
            if(empty($sendid)||empty($goodsid)||empty($customerid))
                redirect(__APP__.'/Home/Jump');
            else 
                redirect(__APP__.'/Home/Jump/goodsid='.$goodsid.'/sendid=/'.$sendid.'/customerid=/'.$customerid);
        }else {
            self::$OPENID=session('openid');
            self::$UID=session('uid');
            $User=M('User');
            $param['id']=self::$UID;
            $res=$User->where($param)->find();
            if($res['realname']==null){
                if(CONTROLLER_NAME!='Register'){
                    $this->success('请先补全信息',__APP__.'/Home/Register');
                    exit();
                }
            }
        }
    }
}