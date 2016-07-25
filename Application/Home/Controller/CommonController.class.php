<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
        if(!session('?uid')){
            $this->error('请先注册',__APP__.'/Home/Register');
        }
    }
}