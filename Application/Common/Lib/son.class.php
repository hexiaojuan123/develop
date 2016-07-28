<?php
namespace Common\Lib;
class son extends pepole 
{
    public function rsc(){
        return $this->getNumber1()+$this->getNumber2();
    }
    public function buy($gid){
        return '商品的ID:'.$gid;
    }
    public function sell($pid) {
        return '所售卖的商品是:'.$pid;
    }
    public function getname(){
        return '我是继承类中的方法';
    }
}

?>