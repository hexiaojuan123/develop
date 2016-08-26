<?php
/**
 * 手机号加星
 * @param string $text 手机号
 * @param number $length 从第几位开始替换 默认 7
 * @param string $temp 替换的字符 默认 ****
 * @return string $phone 加星后的手机号
 */
function formtphone($text, $length=7,$temp="****")
{
    $fristtext=substr($text,0,3);
    $endtext=substr($text,7,11);
    return $fristtext.$temp.$endtext;
}
/**
 * 截取字符串
 * @param string $text 需要截取的文本
 * @param number $length 
 * @return string
 */
function subtext($text, $length)
{
    $text=htmlspecialchars($text);
    if (mb_strlen($text, 'utf8') > $length){
        $text=mb_substr($text, 0, $length, 'utf8');
        return $text . '...';
    }else{
        return $text;
    }
}
/**
 * 
 * @param float $price 金额
 * @param int $date 最后一次交易成功的时间戳
 * @param int $limit 限制提现最低额度 默认20
 * @param int $limitdate 提现时间间隔 ，默认7天
 * @return number 返回可提现金额
 */
function withdrawcash($price,$date=NULL,$limitdate=7,$limit=20.00){
    if(empty($date)){
        return $price;        
    }
    $date=strtotime("+".$limitdate." day",$date);
    if($price>=$limit){
        if($date<=time()){
            $data=array('code'=>'000','msg'=>'可提现','price'=>$price);
        }else{
            $Date=new \Org\Util\Date();
            $data=array('code'=>'001','msg'=>'还未到提现时间','date'=>ceil($Date->dateDiff($date)));
        }
    }else{
        $data=array('code'=>'002','msg'=>'未达到最低提现金额 '.$limit.'元');
    }
    return $data;
}
//验证码的检查
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}