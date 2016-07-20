<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $password=md5(123456);
        $this->assign('paw',$password);
        $this->display();
    }
}