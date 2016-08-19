<?php
namespace Home\Controller;
use Think\Controller;
class HhController extends Controller {
    public function index(){
       $this->display();
    }
    public function cc() {
        $receive=D('Receive');
        $data['userid']=123;
        $data['money']=I('price');
        
        if(!$receive->autoCheckToken($_POST)){
            exit($this->error('不能重复提交表单'));
        }else{
            if(!$receive->token(false)->create($data)){
                exit($this->error($receive->getError()));
            }
        }
    }
}