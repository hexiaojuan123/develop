<?php
namespace Home\Controller;
class IndexController extends CommonController {
    public function index(){
        $_W['openid']='oGYnqt5R74jztGcIGSJ6XXMXYxKs';
        $openid=$_W['openid'];
        if(!empty($openid)){
            $user=M('user');
            $where['openid']=$openid;
            $res=$user->where($where)->find();
            if($res){
                $this->assign('userinfo',$res);
            }
            
        }else{
            //信息注册
        }
        $this->display();
    }
}