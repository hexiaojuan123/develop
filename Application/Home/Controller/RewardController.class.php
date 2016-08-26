<?php
namespace Home\Controller;
use Common\Lib\JS_SDK;
header("Content-Type: text/html; charset=utf8");
class RewardController extends CommonController {
    public function index(){
        $jssdk=new JS_SDK();
        $this->assign('sh',$jssdk->sharedata());
        $this->assign('appid',$jssdk->getAPPID());
        $commission_log=M('CommissionLog');
        $condition['sendid']=self::$UID;
        $condition['state']=1;
        $price=$commission_log->where($condition)->where('UNIX_TIMESTAMP(createtime) < UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 7 DAY))')->sum('commission');
        $price=withdrawcash($price);
        $this->assign('price',$price);
        $this->display(); 
    }

    /**
     * 可提现
     */
    public function withdrewing(){
        $pagelimit=5;
        $commission_log=M('CommissionLog');
        $pageindex=intval(I('key'));
        $condition['sendid']=self::$UID;
        $count=$commission_log->where($condition)->count();//获取用户的收入列表总数
        $pagecount=ceil($count/$pagelimit);//计算总页数
        $pageindex=empty($pageindex)?1:$pageindex;
        $list=$commission_log->where($condition)->page($pageindex,$pagelimit)->select();
        if($list) {
            $page=$this->pageination($pageindex,$pagecount);
            $pagedata=array('pagecount' => $pagecount, 'count' => $count, 'index' => $pageindex);
            $this->assign('list',$list);
            $this->assign('pagedata',$pagedata);
            if($count>$pagelimit)
                $this->assign('apage',$page);
            $this->display('showwithdrewing');
        }
    }
    /**
     * 已提现
     */
    public function withdrewed(){
        $pagelimit=5;
        $receive=M('Receive');
        $pageindex=intval(I('key'));
        $condition['userid']=self::$UID;
        $count=$receive->where($condition)->count();//获取用户的收入列表总数
        $pagecount=ceil($count/$pagelimit);//计算总页数
        $pageindex=empty($pageindex)?1:$pageindex;
        $list=$receive->where($condition)->page($pageindex,$pagelimit)->select();
        if($list) {
            $page=$this->pageinationed($pageindex,$pagecount);
            $pagedata=array('pagecount' => $pagecount, 'count' => $count, 'index' => $pageindex);
            $this->assign('list',$list);
            $this->assign('pagedata',$pagedata);
            if($count>$pagelimit)
                $this->assign('bpage',$page);
            $this->display('showwithdred');
        }
    }
    public function pageination($index,$count,$url=null,$showlimit=4){
        $tempmin=null;
        $firsttag='<nav><ul class="pagination">';
        if($index!=1)
            $pretag='<li><a href="#" onclick="getwithdrewing('.($index-1).')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        else
            $pretag='<li><a href="#" onclick="getwithdrewing('.$count.')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        if($index!=$count)
            $nexttag='<li><a href="#" onclick="getwithdrewing('.($index+1).')" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        else
            $nexttag='<li><a href="#" onclick="getwithdrewing(1)" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        $finishtag='</ul></nav>';
        if($count>=$showlimit){
            if($index>=$showlimit){
                //$tempmin='<li><a href="#" onclick="getwithdrewing(1)">1</a></li>';
                //$tempmin.='<li><a>···</a></li>';
                $tsi=$showlimit+$index;
                $tsi=$tsi>=$count?$count:$tsi;
                for ($i=$index-1;$i<=$tsi;$i++){
                    if($index==$i)
                        $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                    else
                        $tempmin.='<li><a href="#" onclick="getwithdrewing('.($i).')">'.$i.'</a></li>';
                }
                //$tempmin.='<li><a>···</a></li>';
                //$tempmin.='<li><a href="#" onclick="getwithdrewing('.$count.')">'.$count.'</a></li>';
            }else{
                for ($i=1;$i<=$showlimit;$i++){
                    if($index==$i)
                        $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                    else
                        $tempmin.='<li><a href="#" onclick="getwithdrewing('.($i).')">'.$i.'</a></li>';
                }
            }
            
        }else{
            for ($i=1;$i<=$count;$i++){
                if($index==$i)
                    $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                else
                    $tempmin.='<li><a href="#" onclick="getwithdrewing('.($i).')">'.$i.'</a></li>';
            }
        }
        return $firsttag.$pretag.$tempmin.$nexttag.$finishtag;
    }
    public function pageinationed($index,$count,$url=null,$showlimit=4){
        $tempmin=null;
        $firsttag='<nav><ul class="pagination">';
        if($index!=1)
            $pretag='<li><a href="#" onclick="getwithdrewed('.($index-1).')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        else
            $pretag='<li><a href="#" onclick="getwithdrewed('.$count.')" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        if($index!=$count)
            $nexttag='<li><a href="#" onclick="getwithdrewed('.($index+1).')" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        else
            $nexttag='<li><a href="#" onclick="getwithdrewed(1)" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
        $finishtag='</ul></nav>';
        if($count>=$showlimit){
            if($index>=$showlimit){
                //$tempmin='<li><a href="#" onclick="getwithdrewing(1)">1</a></li>';
                //$tempmin.='<li><a>···</a></li>';
                $tsi=$showlimit+$index;
                $tsi=$tsi>=$count?$count:$tsi;
                for ($i=$index-1;$i<=$tsi;$i++){
                    if($index==$i)
                        $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                    else
                        $tempmin.='<li><a href="#" onclick="getwithdrewed('.($i).')">'.$i.'</a></li>';
                }
                //$tempmin.='<li><a>···</a></li>';
                //$tempmin.='<li><a href="#" onclick="getwithdrewing('.$count.')">'.$count.'</a></li>';
            }else{
                for ($i=1;$i<=$showlimit;$i++){
                    if($index==$i)
                        $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                    else
                        $tempmin.='<li><a href="#" onclick="getwithdrewed('.($i).')">'.$i.'</a></li>';
                }
            }
    
        }else{
            for ($i=1;$i<=$count;$i++){
                if($index==$i)
                    $tempmin.='<li class="active"><a href="#" >'.$i.'<span class="sr-only">(current)</span></a></li>';
                else
                    $tempmin.='<li><a href="#" onclick="getwithdrewed('.($i).')">'.$i.'</a></li>';
            }
        }
        return $firsttag.$pretag.$tempmin.$nexttag.$finishtag;
    }
}