<?php
header('Content-Type:image/Gif');
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

session_start();

require 'CurlClass.php';

$login_curl = 'http://218.75.197.124:83/default2.aspx';
$log_in_host = '218.75.197.124:83';
$check_code_url = $log_in_host.'/CheckCode.aspx';

saveCookie($login_curl);

getCheckCode($check_code_url);

function saveCookie($login_url)
{
    $curl_login_1 = new Curl($login_url);
    $curl_login_1->setOpt(CURLOPT_RETURNTRANSFER,1);
    $curl_login_1->setOpt(CURLOPT_HEADER,1);    //将头文件的信息作为数据流输出
    $content = $curl_login_1->exec();
    unset($curl_login_1);
    preg_match('/Set-Cookie:(.*);/iU',$content,$str); //正则匹配cookie
    $cookie = $str[1];
    if(!empty($cookie)){
        $_SESSION['SessionId'] = $cookie;
        return true;
    }else{
        return false;
    }
}

function getCheckCode($check_code_url)
{
    $curl_check_code = new Curl($check_code_url);
    $curl_check_code->setOpt(CURLOPT_RETURNTRANSFER,0);
    $curl_check_code->setOpt(CURLOPT_AUTOREFERER,1);
    $curl_check_code->setOpt(CURLOPT_COOKIE,$_SESSION['SessionId']);
    $res = $curl_check_code->exec();
    unset($curl_check_code);
    return $res;
}





