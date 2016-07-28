<?php
namespace Common\Lib;
use Common\Lib\Shop;
abstract class  pepole implements Shop
{
    private $number1;
    private $number2;
    public function __construct($_number1,$_number2) {
        $this->number1=$_number1;
        $this->number2=$_number2;
    }
    public function __toString(){
        return get_class($this);
    }
 /**
     * @return the $number1
     */
    public function getNumber1()
    {
        return $this->number1;
    }

 /**
     * @return the $number2
     */
    public function getNumber2()
    {
        return $this->number2;
    }

 /**
     * @param field_type $number1
     */
    public function setNumber1($number1)
    {
        $this->number1 = $number1;
    }

 /**
     * @param field_type $number2
     */
    public function setNumber2($number2)
    {
        $this->number2 = $number2;
    }

    
}

?>