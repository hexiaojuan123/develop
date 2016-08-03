<?php

function formtphone($text, $length=7,$temp="****")
{
    $fristtext=substr($text,0,3);
    $endtext=substr($text,7,11);
    return $fristtext.$temp.$endtext;
}
function subtext($text, $length)
{
    if (mb_strlen($text, 'utf8') > $length){
        $text=mb_substr($text, 0, $length, 'utf8');
        return $text . '...';
    }else{
        return $text;
    }
}

function reciprocaltext($text,$count=5)
{
    $num=$count-(int)$text;
    return $num;
}
//判断状态
function checkgift($key)
{
    switch ($key){
        case 0:
            return '未获奖';
            break;
        case 1:
            return '已获奖';
            break;  
    }
}
//格式化城市
function format_city($city){
    switch ($city){
        case '102':return '成都';break;
        case '103':return '重庆';break;
        case '105':return '昆明';break;
        case '111':return '广州';break;
        case '107':return '长沙';break;
        case '104':return '武汉';break;
        case '114':return '贵阳';break;
        case '113':return '南宁';break;
        case '115':return '东莞';break;
        case '117':return '上海';break;
        case '116':return '北京';break;
        case '119':return '天津';break;
    }
}
//判断当前是否在移动端运行
function is_mobile_request()
{
    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = '0';
    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
        $mobile_browser++;
    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
        $mobile_browser++;
    if(isset($_SERVER['HTTP_PROFILE']))
        $mobile_browser++;
    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents))
        $mobile_browser++;
    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
        $mobile_browser++;
    // Pre-final check to reset everything if the user is on Windows
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
        $mobile_browser=0;
    // But WP7 is also Windows, with a slightly different characteristic
    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
        $mobile_browser++;
    if($mobile_browser>0)
        return true;
    else
        return false;
}