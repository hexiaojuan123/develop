<?php
namespace Common\Lib\Soap;

class soapHandle
{
    public function strtolink($url=''){
        return sprintf('<a href="%s">%s</a>', $url, $url);
    }
}

?>