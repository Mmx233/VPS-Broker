<?php
$key='Mmx_demo';//探针密钥
$dtime=150;//触发报警超时时长
$point=$_GET['point'];
$ip=$_SERVER['REMOTE_ADDR'];
$s1='health_checker/'.$ip;
$s2='health_locker/'.$ip;
function alerter($message){//通知函数
file_get_contents('https://alert.mmxblog.com/alert?'.urlencode($message));
}
?>
