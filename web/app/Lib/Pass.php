<?php

// パスワード暗号化
function PassEncrypt($plain_text)
{
	// 暗号化済みなら無加工で返す
	if(preg_match('/^CRYPTED:(.*)$/', $plain_text, $m)){
		return $plain_text;
	}
	
	// キー
	$key = md5(PASS_KEY);

	// 暗号化モジュール使用開始
	$td  = mcrypt_module_open('des', '', 'ecb', '');
	$key = substr($key, 0, mcrypt_enc_get_key_size($td));
	$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	
	// 暗号化モジュール初期化
	if (mcrypt_generic_init($td, $key, $iv) < 0) {
		exit('error.');
	}
	
	//データを暗号化
	$crypt_text = base64_encode(mcrypt_generic($td, $plain_text));

	//暗号化モジュール使用終了
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	
	// 結果
	return "CRYPTED:" . $crypt_text;
}

// パスワード複合化
function PassDecrypt($crypt_text)
{
	// 暗号化済みなら複合化のための部分を取得
	if(preg_match('/^CRYPTED:(.*)$/', $crypt_text, $m)){
		$crypt_text = $m[1];
	}
	// 暗号化されていなければ無加工で返す
	else{
		return $crypt_text;
	}
	
	// キー
	$key = md5(PASS_KEY);
	
	//暗号化モジュール使用開始
	$td  = mcrypt_module_open('des', '', 'ecb', '');
	$key = substr($key, 0, mcrypt_enc_get_key_size($td));
	$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

	//暗号化モジュール初期化
	if (mcrypt_generic_init($td, $key, $iv) < 0) {
		exit('error.');
	}

	//データを復号化
	$plain_text = mdecrypt_generic($td, base64_decode($crypt_text));
	
	//暗号化モジュール使用終了
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	
	// 結果
	return $plain_text;
}
