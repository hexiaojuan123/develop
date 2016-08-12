<?php
namespace Home\Controller;
class VerifyController extends CommonController {
    public function index(){
        $config =    array(
            'fontSize'    =>    60,    // 验证码字体大小
            'length'      =>    4,     // 验证码位数
            'codeSet'    =>    '0123456789', // 设置验证码字符为纯数字
            'expire'=>'120'
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
        echo $Verify;
    }
}