<?php

// 2014-06-17 05:31:21.803935 (26文字)
function YYYYMMDD_HHMMSS_UUUUUU()
{
	$micro = microtime();
	// print "micro = $micro\n";
	list($micro, $Unixtime) = explode(" ", $micro);
	# print "micro = $micro\n";
	# $sec = $micro + date("s", $Unixtime); // 秒"s"とマイクロ秒を足す
	$micro = sprintf("%.6f", $micro);
	return date("Y-m-d H:i:s", $Unixtime) . substr($micro, 1);
}

function YYYYMMDD_HHMMSS_UUUUUU_UNDER(){
	$micro = microtime();
	// print "micro = $micro\n";
	list($micro, $Unixtime) = explode(" ", $micro);
	# print "micro = $micro\n";
	# $sec = $micro + date("s", $Unixtime); // 秒"s"とマイクロ秒を足す
	$micro = sprintf("%.6f", $micro);
	return date("Ymd_His", $Unixtime) . '_' . substr($micro, 2);
}
