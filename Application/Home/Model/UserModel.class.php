<?php
namespace  Home\Model;
use Think\Model;
class  UserModel extends Model{
    protected $_validate=array(
        array('realname','require','真实姓名不能为空'),
        array('phone','require','手机号不能为空'),
        array('vecode','require','验证码不能为空')
    );
    /**
     * 字段映射
     * 
     */
//     protected $_map = array(
//         'name' =>'username', // 把表单中name映射到数据表的username字段
//         'mail'  =>'email', // 把表单中的mail映射到数据表的email字段
//     );
    
}