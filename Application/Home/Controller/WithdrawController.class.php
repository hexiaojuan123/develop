<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
use Common\Lib\Rebbag\WXHongBao;
class WithdrawController extends CommonController {
    public function index(){
        $User=M('User');
        $commission_log=M('CommissionLog');
        $param['openid']=self::$OPENID;
        $param['id']=self::$UID;
        $userinfo=$User->where($param)->cache(10)->find();
        $condition['sendid']=self::$UID;
        $condition['state']=1;
        $wdc=$commission_log->where($condition)->where('UNIX_TIMESTAMP(createtime) < UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 7 DAY))')->sum('commission');
        $jssdk=new JS_SDK();
        $this->assign('userinfo',$userinfo);
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $this->assign('wdc',$wdc);
        $this->display();
    }
//     public function getHongbao() {
        
//         $Receive=M('Receive');
//         $userinfo=self::userinfo();
//         $data['money']=floatval(I('price',0,'intval'));
//         $data['userid']=self::$UID;
//         $data['balancebefore']=floatval($userinfo['balance']);
//         $money=100*$data['money'];//单位是分
//         if(!$Receive->autoCheckToken($_POST)){
//             exit($this->error('不能重复提交表单'));
//         }else{
//             if(!$Receive->token(false)->create($data)){
//                 exit($this->error($Receive->getError()));
//             }else{
//                 $User=M('User');
//                 $condition['id']=self::$UID;
//                 $Receive->startTrans();
//                 $User->startTrans();
//                 $res=$User->where($condition)->setDec('balance',$data['money']);
//                 if(false!==$res){
//                     $data['balanceafter']=$data['balancebefore']-$data['money'];
//                     $resave=$Receive->save($data);
//                     if($resave){
//                         $hongbao=new WXHongBao();
//                         $gznowhb=$hongbao->newhb($userinfo['openid'],$money);
//                         $fsjg=$hongbao->send();
//                         $content=$hongbao->error();
//                         if($fsjg!='1'){
//                             $this->error('系统繁忙,请稍后在试');
//                             $User->rollback();
//                             $Receive->rollback();
//                         }else{
//                             $Receive->commit();
//                             $this->success('发送成功',U('/Home/Index'));
//                         }
//                     }else{
//                         $User->rollback();
//                         $this->error('日志无法写入');
//                     }
//                 }else{
//                     $this->error('无法更新');
//                 }
//             }
//         }
//     }
}