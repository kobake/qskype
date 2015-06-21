<?php
class ConversationNotFoundException extends CakeException {
	public $chat = '';
	public function __construct($chat, $message = null, $code = 500) {
		$this->chat = $chat;
		if (empty($message)) {
			$message = 'Application Error';
		}
		parent::__construct($message, $code);
	}
}
