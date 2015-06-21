<?php

//App::import('Model', 'Activity');

/*
 * @global Activity $g_activity
 */
global $g_activity;

function DbLog($message, $details = "")
{
	// ユーザ
	$ip = '';
	if(isset($_SERVER) && isset($_SERVER['REMOTE_ADDR'])){
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	// 日時
	$t = YYYYMMDD_HHMMSS_UUUUUU();
	
	global $g_activity;
	if(!isset($g_activity)){
		$g_activity = ClassRegistry::init('Activity');
	}
	$g_activity->create();
	$ret = $g_activity->save(
		array(
			'Activity' => array(
				'message' => mb_strimwidth($message, 0, 255, "..."),
				'details' => $details,
				'label' => $t,
				'ip' => $ip
				//'created' => $g_activity->getDataSource()->expression('NOW()')
			)
		)
	);

	print("DbLog:[{$t}] {$message}\n");

	return $ret;
}
