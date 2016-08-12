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
 * @param number $limit 限制提现最低额度 默认100
 * @return number 返回可提现金额
 */
function withdrawcash($price,$limit=100){
    $price=intval($price);
    $temp=intval($price/$limit);
    return $temp*$limit;
}
//验证码的检查
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}