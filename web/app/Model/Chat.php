<?php
App::uses('AppModel', 'Model');

class Chat extends AppModel {
	// read
	public static function readAll(){
		$chats = @file_get_contents(ROOT . DS . APP_DIR . '/Data/chats.txt');
		$chats = explode("\n", $chats);
		$chats = array_map(function($e){
			return trim($e);
		}, $chats);
		$chats = array_filter($chats, function($e){
			return strlen($e) > 0;
		});
		return $chats;
	}
}
