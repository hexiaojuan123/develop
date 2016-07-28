<?php
namespace Common\Lib;

abstract class User
{
    private $Price;//价格
    private $Commission;//佣金
    public function __construct($_proce,$_commisson){
        $this->Price=$_proce;
        $this->Commission=$_commisson;
    }
 /**
     * @return the $Price
     */
    public function getPrice()
    {
        return $this->Price;
    }

 /**
     * @return the $Commission
     */
    public function getCommission()
    {
        return $this->Commission;
    }

 /**
     * @param field_type $Price
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

 /**
     * @param field_type $Commission
     */
    public function setCommission($Commission)
    {
        $this->Commission = $Commission;
    }

    
}

?>