<?php

header('content-type:text/html;charset=utf-8');

require_once 'CurlClass.php';

session_start();

if(empty($_SESSION['StudentName']) || empty($_SESSION['StudentNumber'])){
    echo 'no logon';
}


$timetable_url = 'http://218.75.197.124:83/tjkbcx.aspx?xh=';
$timetable_url = $timetable_url.$_SESSION['StudentNumber'];
$timetable_url = $timetable_url.'&xm='.urlencode(iconv('utf-8','gbk',$_SESSION['StudentName'])).'&gnmkdm=N121601';


$res = getNowTimeTable($timetable_url);
$res = iconv('gbk', 'utf-8', $res);
$time_table_res = getTable($res);

$time_table_arr_res = getTableArray($time_table_res);

$time_table_json_res = json_encode($time_table_arr_res, JSON_UNESCAPED_UNICODE);

//去除/r/t/n
$str_vowels = array('\t', '\n', '\r');
$time_table_json_res = str_replace($str_vowels, '', $time_table_json_res);

echo $time_table_json_res;

//获取当前学期的班级课表页面
function getNowTimeTable($url)
{
    $curl_score = new Curl($url);
    $curl_score->setOpt(CURLOPT_AUTOREFERER,1);
    $curl_score->setOpt(CURLOPT_RETURNTRANSFER,1);
    $curl_score->setOpt(CURLOPT_FOLLOWLOCATION,1);
    $curl_score->setOpt(CURLOPT_REFERER, $url);
    $curl_score->setOpt(CURLOPT_COOKIE,$_SESSION['SessionId']);
    $res = $curl_score->exec();
    unset($culr_score);
    return $res;
}
//截取课表table
function getTable($res)
{
    preg_match_all("/<table id=\"Table6\" class=\"blacktab\"[^>]*>([\s\S]*?)<\/table>/",$res,$result);
    return $result[0][0];
}

//将table转化为数组
function getTableArray($table) {
    $table = preg_replace("'<table[^>]*?>'si","",$table);
    $table = preg_replace("'<tr[^>]*?>'si","",$table);
    $table = preg_replace("'<td[^>]*?>'si","",$table);
    $table = str_replace("</tr>","{tr}",$table);
    $table = str_replace("</td>","{td}",$table);
    //去掉 HTML 标记
    $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);
    //去掉空白字符
    $table = preg_replace("'([rn])[s]+'","",$table);
    $table = preg_replace('/&nbsp;/',"",$table);
    $table = str_replace(" ","",$table);
    $table = str_replace(" ","",$table);
    $table = explode('{tr}', $table);
    array_pop($table);
    foreach ($table as $key=>$tr) {
        $td = explode('{td}', $tr);
        array_pop($td);
        $td_array[] = $td;
    }
    return $td_array;
}


function get_VIEWSTATE($url)
{
    $curl_score = new Curl($url);
    $curl_score->setOpt(CURLOPT_AUTOREFERER,1);
    $curl_score->setOpt(CURLOPT_RETURNTRANSFER,0);
    $curl_score->setOpt(CURLOPT_FOLLOWLOCATION,1);
    //$curl_score->setOpt(CURLOPT_POST,1);
    $curl_score->setOpt(CURLOPT_REFERER, $url);
    //$curl_score->setOpt(CURLOPT_POSTFIELDS,$data);
    $curl_score->setOpt(CURLOPT_COOKIE,$_SESSION['SessionId']);
    $res = $curl_score->exec();

    unset($culr_score);
    return $res;
}

function getTimeTable($url)
{
    $data = array(
        '__EVENTTARGET'=>'xq',
        '__EVENTARGUMENT'=>'',
        'xn'=>'2015-2016',
        //'__VIEWSTATE'=>'dDwtMTU1NDcwODA2Mjt0PHA8bDx4c3p5ZG07PjtsPDA4MTA7Pj47bDxpPDE+Oz47bDx0PDtsPGk8MT47aTwzPjtpPDU+O2k8Nz47aTw5PjtpPDExPjtpPDEzPjtpPDE1PjtpPDE5PjtpPDIxPjtpPDIzPjtpPDI1Pjs+O2w8dDx0PHA8cDxsPERhdGFUZXh0RmllbGQ7RGF0YVZhbHVlRmllbGQ7PjtsPHhuO3huOz4+Oz47dDxpPDEwPjtAPDIwMTUtMjAxNjsyMDE0LTIwMTU7MjAxMy0yMDE0OzIwMTItMjAxMzsyMDExLTIwMTI7MjAxMC0yMDExOzIwMDktMjAxMDsyMDA4LTIwMDk7MjAwNy0yMDA4OzIwMDYtMjAwNzs+O0A8MjAxNS0yMDE2OzIwMTQtMjAxNTsyMDEzLTIwMTQ7MjAxMi0yMDEzOzIwMTEtMjAxMjsyMDEwLTIwMTE7MjAwOS0yMDEwOzIwMDgtMjAwOTsyMDA3LTIwMDg7MjAwNi0yMDA3Oz4+O2w8aTwwPjs+Pjs7Pjt0PHQ8cDxwPGw8RGF0YVRleHRGaWVsZDtEYXRhVmFsdWVGaWVsZDs+O2w8eHE7eHE7Pj47Pjt0PGk8Mj47QDwxOzI7PjtAPDE7Mjs+PjtsPGk8MD47Pj47Oz47dDx0PHA8cDxsPFZpc2libGU7PjtsPG88Zj47Pj47Pjs7Pjs7Pjt0PHQ8cDxwPGw8RGF0YVRleHRGaWVsZDtEYXRhVmFsdWVGaWVsZDs+O2w8bmo7bmo7Pj47Pjt0PGk8MTE+O0A8MjAxNTsyMDE0OzIwMTM7MjAxMjsyMDExOzIwMTA7MjAwOTsyMDA4OzIwMDc7MjAwNjsyMDA1Oz47QDwyMDE1OzIwMTQ7MjAxMzsyMDEyOzIwMTE7MjAxMDsyMDA5OzIwMDg7MjAwNzsyMDA2OzIwMDU7Pj47bDxpPDI+Oz4+Ozs+O3Q8dDxwPHA8bDxEYXRhVGV4dEZpZWxkO0RhdGFWYWx1ZUZpZWxkOz47bDx4eW1jO3h5ZG07Pj47Pjt0PGk8MTc+O0A855S15rCU5LiO5L+h5oGv5bel56iL5a2m6ZmiO+Wcn+acqOW3peeoi+WtpumZojvljIXoo4XkuI7mnZDmlpnlt6XnqIvlrabpmaI75py65qKw5bel56iL5a2m6ZmiO+WkluWbveivreWtpumZojvljIXoo4Xorr7orqHoibrmnK/lrabpmaI76K6h566X5py65LiO6YCa5L+h5a2m6ZmiO+azleWtpumZojvmloflrabkuI7mlrDpl7vkvKDmkq3lrabpmaI755CG5a2m6ZmiO+WVhuWtpumZojvotKLnu4/lrabpmaI76Z+z5LmQ5a2m6ZmiO+W7uuetkeS4juWfjuS5oeinhOWIkuWtpumZojvkvZPogrLlrabpmaI75Zu96ZmF5a2m6ZmiO+WGtumHkeW3peeoi+WtpumZojs+O0A8MDE7MDM7MDQ7MDU7MDY7MDc7MDg7MDk7MTA7MTE7MTQ7MTU7MTc7MTg7MzA7OTQ7OTU7Pj47bDxpPDY+Oz4+Ozs+O3Q8dDxwPHA8bDxEYXRhVGV4dEZpZWxkO0RhdGFWYWx1ZUZpZWxkOz47bDx6eW1jO3p5ZG07Pj47Pjt0PGk8OD47QDzorqHnrpfmnLrnp5HlrabkuI7mioDmnK876YCa5L+h5bel56iLO+i9r+S7tuW3peeoizvnvZHnu5zlt6XnqIs754mp6IGU572R5bel56iLO+iuoeeul+acuue9kee7nOaKgOacrzvorqHnrpfmnLrmjqfliLbmioDmnK87XGU7PjtAPDA4MTA7MDgyMDswODMwOzA4NDA7MDg1MDswODkxOzA4OTI7XGU7Pj47bDxpPDA+Oz4+Ozs+O3Q8dDxwPHA8bDxEYXRhVGV4dEZpZWxkO0RhdGFWYWx1ZUZpZWxkOz47bDx0amtibWM7dGprYmRtOz4+Oz47dDxpPDQ+O0A8XGU76K6h566X5py6MTMwMTvorqHnrpfmnLoxMzAyO+iuoeeul+acujEzMDM7PjtAPFxlOzIwMTMwODEwMjAxNS0yMDE2MTEzNDA4MTAwMTsyMDEzMDgxMDIwMTUtMjAxNjExMzQwODEwMDI7MjAxMzA4MTAyMDE1LTIwMTYxMTM0MDgxMDAzOz4+O2w8aTwxPjs+Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPFxlOz4+Oz47Oz47dDw7bDxpPDU+Oz47bDx0PEAwPDs7Ozs7Ozs7Ozs+Ozs+Oz4+O3Q8cDxwPGw8VGV4dDs+O2w85pyA5paw6K++6KGo6K+355m76ZmGandjLmh1dC5lZHUuY27ov5vlhaXmlZnliqHnrqHnkIbns7vnu5/mn6Xor6I7Pj47Pjs7Pjt0PEAwPHA8cDxsPFBhZ2VDb3VudDtfIUl0ZW1Db3VudDtfIURhdGFTb3VyY2VJdGVtQ291bnQ7RGF0YUtleXM7PjtsPGk8MT47aTw0PjtpPDQ+O2w8Pjs+Pjs+Ozs7Ozs7Ozs7Oz47bDxpPDA+Oz47bDx0PDtsPGk8MT47aTwyPjtpPDM+O2k8ND47PjtsPHQ8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w84oCc6K6h566X5py6572R57uc4oCd6K++56iL6K6+6K6hOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlofpuL87Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDEuMDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MTktMTk7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCZuYnNwXDs7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+Oz47bDx0PHA8cDxsPFRleHQ7PjtsPOKAnOiuoeeul+acuue7hOaIkOWOn+eQhuKAneivvueoi+iuvuiuoTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85p2o5Lyf5LiwOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxLjA7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDE4LTE4Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwmbmJzcFw7Oz4+Oz47Oz47Pj47dDw7bDxpPDA+O2k8MT47aTwyPjtpPDM+O2k8ND47aTw1Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDzorqHnrpfmnLrmk43kvZzns7vnu5/or77nqIvorr7orqE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOaWh+W/l+W8ujs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MS4wOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwxNy0xNzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+O3Q8O2w8aTwwPjtpPDE+O2k8Mj47aTwzPjtpPDQ+O2k8NT47PjtsPHQ8cDxwPGw8VGV4dDs+O2w855S15bel5a2m5a6e6aqMMjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85ZC06Z+hKjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MC41Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwwMy0xNDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8Jm5ic3BcOzs+Pjs+Ozs+Oz4+Oz4+Oz4+O3Q8QDA8cDxwPGw8UGFnZUNvdW50O18hSXRlbUNvdW50O18hRGF0YVNvdXJjZUl0ZW1Db3VudDtEYXRhS2V5czs+O2w8aTwxPjtpPDI+O2k8Mj47bDw+Oz4+Oz47Ozs7Ozs7Ozs7PjtsPGk8MD47PjtsPHQ8O2w8aTwxPjtpPDI+Oz47bDx0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+O2k8Nj47aTw3Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwwMTA0NDs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MDEwNDQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOiwgzA0NzQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCgyMDE1LTIwMTYtMSktMDExMTAwMjAtMDEwNDQtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w855S15bel5a2mMjs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w85pyx5rC456WlKOeUteawlOS4juS/oeaBr+W3peeoi+WtpumZoinlkagy56ysM+iKgui/nue7rTLoioJ756ysNC0xMeWRqH0v5YWs5YWxMjE5Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmnLHmsLjnpaUo55S15rCU5LiO5L+h5oGv5bel56iL5a2m6ZmiKeWRqDTnrKw36IqC6L+e57utMuiKgnvnrKw0LTEx5ZGofS/orqHpgJrmpbw1MTE7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPDIwMTUtMDktMjItMDgtMDU7Pj47Pjs7Pjs+Pjt0PDtsPGk8MD47aTwxPjtpPDI+O2k8Mz47aTw0PjtpPDU+O2k8Nj47aTw3Pjs+O2w8dDxwPHA8bDxUZXh0Oz47bDwwODA3NTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w8MDgwNzU7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPOiwgzA5MjQ7Pj47Pjs7Pjt0PHA8cDxsPFRleHQ7PjtsPCgyMDE1LTIwMTYtMSktMDgxMjA1MDEtMDgwNzUtMTs+Pjs+Ozs+O3Q8cDxwPGw8VGV4dDs+O2w86K6h566X5py6572R57ucOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlofpuL8o6K6h566X5py65LiO6YCa5L+h5a2m6ZmiKeWRqDXnrKw36IqC6L+e57utMuiKgnvnrKwxMS0xMeWRqH0v6K6h6YCa5qW8NTExOz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDzmlofpuL8o6K6h566X5py65LiO6YCa5L+h5a2m6ZmiKeWRqDPnrKwz6IqC6L+e57utMuiKgnvnrKwxNy0xN+WRqH0v5YWs5YWxMjE5Oz4+Oz47Oz47dDxwPHA8bDxUZXh0Oz47bDwyMDE1LTExLTEzLTA4LTUzOz4+Oz47Oz47Pj47Pj47Pj47Pj47Pj47Ps/jpXlCSpj3zROSCwe/BLrz/ci0',
        'xq'=>'2',
        'nj'=>'2013',
        'xy'=>'08',
        'zy'=>'0810',
        'kb'=>'201308102015-20162134081001');

    $curl_score = new Curl($url);
    $curl_score->setOpt(CURLOPT_AUTOREFERER,1);
    $curl_score->setOpt(CURLOPT_RETURNTRANSFER,0);
    $curl_score->setOpt(CURLOPT_FOLLOWLOCATION,1);
    $curl_score->setOpt(CURLOPT_POST,1);
    $curl_score->setOpt(CURLOPT_REFERER,'http://218.75.197.124:83/tjkbcx.aspx?xh=13408100142&xm=%C0%EE%D1%EE&gnmkdm=N121601');
    $curl_score->setOpt(CURLOPT_POSTFIELDS,$data);
    $curl_score->setOpt(CURLOPT_COOKIE,$_SESSION['SessionId']);
    $res = $curl_score->exec();

    unset($culr_score);
    return $res;
}
