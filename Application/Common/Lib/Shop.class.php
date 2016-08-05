<?php
namespace Common\Lib;
/**
 * 佣金计算类
 * @author pengbd3
 *
 */
class Shop
{
    private $Total;//原价|总价
    private $Grade;//当前等级
    public static $Sale;//分销
    /**
     * 构造函数 佣金类
     * @param float $_total 总价
     * @param int $_grade 用户等级
     */
    public function __construct($_total,$_grade=NULL){
        $this->Total=$_total;
        $this->Grade=$_grade;
    }
    /**
     * 
     * @param array $data
     * @return array $data 增加对应佣金的键值对
     */
    public function SaleValue($data=NULL) {
        //国家规定发展下级最多三级
        for ($i=0;$i<2;$i++)
        {
           $data[$i]['commission']=($this->Total*(self::$Sale[$i]-self::$Sale[$i+1]));
        }
        return $data;
    }
}

?>