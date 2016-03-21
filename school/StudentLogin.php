<?php
session_start();

require 'CurlClass.php';

$student_number = $_POST['number'];
if(empty($student_number)){
    echo '<h1>说好的学号那</h1>';

    die();
}
$student_passwd = $_POST['passwd'];
if(empty($student_passwd)){
    echo '<h1>说好的密码那</h1>';
    die();
}
$ckeck_code = $_POST['checkcode'];
if(empty($ckeck_code)){
    echo '<h1>说好的验证码那</h1>';
    die();
}
$what = $_POST['what'];
$login_url = 'http://218.75.197.124:83/default2.aspx';
$log_in_data = array(
    '__VIEWSTATE'=>'dDwyODE2NTM0OTg7Oz5IQ/UNIWFQ97/vhvmrIysrDk7Sog==',
    'txtUserName'=>$student_number,
    'TextBox2'=>$student_passwd,
    'txtSecretCode'=>$ckeck_code,
    'RadioButtonList1'=>'(unable to decode value)',
    'Button1'=>'',
    'lbLanguage'=>'',
    'hidPdrs'=>'',
    'hidsc'=>''
);

$login_res = login($login_url, $log_in_data);
if ($login_res) {
    $_SESSION['StudentName'] = iconv('gbk','utf-8',$login_res);
    $_SESSION['StudentNumber'] = $student_number;
    if($what == 'grade'){
        header('Location:/school/GetGreade.php');
    }else{
        header('Location:/school/GetTimeTable.php');
    }
}else{
    echo 'login false';
}
function login($url,$data)
{
    $check_code_error = iconv('utf-8', 'gbk', '验证码不正确！！');
    $student_number_error = iconv('utf-8', 'gbk', '用户名不存在或未按照要求参加教学活动！！');
    $student_passwd_error = iconv('utf-8', 'gbk', '密码错误！！');
    $student_success_info_1 = iconv('utf-8', 'gbk', 'id="xhxm">');
    $student_success_info_2 = iconv('utf-8', 'gbk', '同学</span></em>');

    $curl_login = new Curl($url);
    $curl_login->setOpt(CURLOPT_AUTOREFERER,1);
    $curl_login->setOpt(CURLOPT_RETURNTRANSFER,1);
    $curl_login->setOpt(CURLOPT_POST,1);
    $curl_login->setOpt(CURLOPT_FOLLOWLOCATION,1);
    $curl_login->setOpt(CURLOPT_POSTFIELDS,$data);
    $curl_login->setOpt(CURLOPT_COOKIE,$_SESSION['SessionId']);

    $res = $curl_login->exec();
    file_put_contents('login_data',$res);

    if(strpos($res, $check_code_error)){
        echo 'ckeckcode error';
    }else if (strpos($res, $student_number_error)) {
        echo 'number error';
    }else if (strpos($res, $student_passwd_error)) {
        echo 'password error';
    }else if(strpos($res, $student_success_info_1)) {
        //提取姓名
        $offset_s = strpos($res, $student_success_info_1) + strlen($student_success_info_1);
        $offset_e = iconv_strpos($res, $student_success_info_2);
        $student_name = substr($res, $offset_s, $offset_e - $offset_s);
        if(empty($student_name)){
            $curl_login->close();
            unset($culr_login);
            echo 'deal error';
        }else{
            $curl_login->close();
            unset($culr_login);
            return $student_name;
        }
    }else{
        echo 'Illegal login';
    }

    $curl_login->close();
    unset($culr_login);
    return false;
}
