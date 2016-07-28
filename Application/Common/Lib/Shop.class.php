<?php
namespace Common\Lib;

interface Shop
{
    /**
     * 购买操作
     * @param mixed $gid
     * @return string 返回购买信息;
     */
    public function buy($gid); 
    /**
     * 销售操作
     * @param mixed $param
     */
    public function sell($param);
}

?>