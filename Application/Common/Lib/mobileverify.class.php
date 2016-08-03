<?php
// +----------------------------------------------------------------------
// | Author: pengbd3 <pengbd3@163.com> <http://www.pengbobo.com>
// +----------------------------------------------------------------------
namespace Common\Lib;
class mobileverify
{
    private  static  $URL;
    private  static  $ACCOUNT;
    private static  $PASSWD;
    /**
     * @return the $URL
     */
    public static function getURL()
    {
        return mobileverify::$URL;
    }

 /**
     * @return the $ACCOUNT
     */
    public static function getACCOUNT()
    {
        return mobileverify::$ACCOUNT;
    }

 /**
     * @return the $PASSWD
     */
    public static function getPASSWD()
    {
        return mobileverify::$PASSWD;
    }

 /**
     * @param field_type $URL
     */
    public static function setURL($URL)
    {
        mobileverify::$URL = $URL;
    }

 /**
     * @param field_type $ACCOUNT
     */
    public static function setACCOUNT($ACCOUNT)
    {
        mobileverify::$ACCOUNT = $ACCOUNT;
    }

 /**
     * @param field_type $PASSWD
     */
    public static function setPASSWD($PASSWD)
    {
        mobileverify::$PASSWD = $PASSWD;
    }

    public function __construct($_url,$_account,$_passwd){
        self::$URL=$_url;
        self::$ACCOUNT=$_account;
        self::$PASSWD=$_passwd;
    }
    public static function sendVerifyCode($mobile, $code)
    {
        $URL     = self::getURL();
        $pwd     = strtoupper(md5(self::getPASSWD()));
        $account = self::getACCOUNT();
        $referrer="";
        $inheader=null;
        //分析下URL
        $urlinfo=parse_url($URL);
        if($referrer=="") //设置referrer
            $referrer=$_SERVER["SCRIPT_URI"];
        
        $ctime   = date("Y-m-d h:i:s", time());
        $urlinfo = parse_url($URL);
        $content =iconv('UTF-8','GBK','尊敬的客户，您的验证码是: '.$code.'。');
        $data_string ="<Group Login_Name='".$account."' Login_Pwd='".$pwd."' OpKind='0' InterFaceID='0'>
	        <E_Time>".$ctime."</E_Time>
	            <Item><Task><Recive_Phone_Number>".$mobile."</Recive_Phone_Number>
	                <Content><![CDATA[".$content."]]></Content><Search_ID>abdsdd</Search_ID></Task></Item></Group>";
        if(!isset($urlinfo["port"]))
	    $urlinfo["port"]=80;
        //发送的POST数据
        $request.="POST ".$urlinfo["path"]." HTTP/1.1\n";
        $request.="Host: ".$urlinfo["host"]."\n";
        $request.="Referer: $referrer\n";
        $request.="Content-Type: text/xml; charset=utf-8\n";
        $request.="Content-length: ".strlen($data_string)."\n";
        $request.="Connection: close\n";
        $request.="\n";
        $request.=$data_string."\n";
        $fp = fsockopen($urlinfo["host"],$urlinfo["port"]);
        fputs($fp, $request);
        while(!feof($fp)) {
        	$line = fgets($fp,1024); 
        	if ($inheader && ($line == "\n" || $line == "\r\n")) {
        		$inheader = 0;
        	}
        	if ($inheader == 0) {
        		$result.= $line;
        	}
        }
        //去除请求包的头只显示页面的返回数据
        preg_match("/Content-Length:.?(\d+)/", $result, $matches);
        $length = $matches[1];
        $result = substr($result, - $length);
        
        fclose($fp);
        return $result;
    }
}

?>