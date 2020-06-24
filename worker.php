<?php
if(is_null($point)){header("HTTP/1.1 403 Forbidden");exit;}
if(file_exists($s1)){
	if(file_get_contents($s1)==$dtime)goto a;
	else{
	file_put_contents($s1,$dtime);
	echo 1;
	exit;
	}
}
else{
if(file_exists($s2)){
	$detime=(int)file_get_contents($s2);
	$otime=(int)date('U');
	$btime=$otime-$detime;
	if($btime>=(24*60*60)){
		$day=intval($btime/(24*60*60));
		$temp=$btime%(24*60*60);
		$hour=intval($temp/(60*60));
		$temp=$temp%(60*60);
		$min=intval($temp/60);
		$sec=$temp%60;
		$tmessage=$day.'天'.$hour.'时'.$min.'分'.$sec.'秒';
		unset($day);unset($hour);unset($min);unset($sec);unset($temp);
	}
	else if($btime>=(60*60)){
		$hour=intval($btime/(60*60));
		$temp=$btime%(60*60);
		$min=intval($temp/60);
		$sec=$temp%60;
		$tmessage=$hour.'时'.$min.'分'.$sec.'秒';
		unset($hour);unset($min);unset($sec);unset($temp);
	}
	else if($btime>=60){
		$min=intval($btime/60);
		$sec=$btime%60;
		$tmessage=$min.'分'.$sec.'秒';
		unset($min);unset($sec);
	}
	else{
		$tmessage=$btime.'秒';
	}
	$message="服务器 ".$ip."(".$point.")"." 心跳恢复\n异常历时".$tmessage;
	alerter($message);
	unlink($s2);
	unset($message);unset($tmessage);unset($otime);unset($detime);
}
a:echo 0;
 //关闭连接
 header("Content-Length: ".ob_get_length());
 header('Connection: close');
 ob_end_flush();
 flush();
 if (function_exists("fastcgi_finish_request")) { 
    fastcgi_finish_request();
 }
ignore_user_abort(true);
set_time_limit(0);
function jump(){
	    global $point,$ip,$s1,$s2;
		unlink($s1);
		//锁checker
		file_put_contents($s2,(int)date('U'));
		//通知
		$message="服务器 ".$ip."(".$point.")"." 心跳异常\n请主淫立刻处理";
		alerter($message);
}
for(file_put_contents($s1,$dtime);1==1;file_put_contents($s1,file_get_contents($s1)*1-1)){
	if(file_get_contents($s1)*1<=0){
		if(file_get_contents($s1)*1==-1){unlink($s1);exit;}
        jump();
        exit;
	}
	sleep(1);
}
}
?>
