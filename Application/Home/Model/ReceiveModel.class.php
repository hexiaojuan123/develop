<?php
namespace  Home\Model;
use Think\Model;
class  ReceiveModel extends Model{
    protected $_validate=array(
        array('userid','require','用户ID不能为空'),
        array('money','require','领取红包金额不能为空'),
        array('balancebefore','require','领取前的余额不能为空'),
        array('balanceafter','require','领取后的余额不能为空'),
    );
    
}