<?php
namespace  Home\Model;
use Think\Model;
class  CustomerModel extends Model{
    protected $_validate=array(
        array('customername','require','客户姓名不能为空'),
        array('customerphone','require','客户手机号不能为空'),
        array('selectobj','require','项目选择不能为空'),
        array('userid','require','必须先登录再进行操作'),
    );
}