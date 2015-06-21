<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property Chat $Chat
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Search.PrgComponent $Search.Prg
 * @property RequestHandlerComponent $RequestHandler
 */
class MessagesController extends AppController {
	public $uses = array('Message', 'Conversation', 'Chat');

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('App');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Search.Prg', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;

		$this->Prg->commonProcess(); // Search
		$this->paginate = array(
			'conditions' => $this->Message->parseCriteria($this->passedArgs),
			'order' => array('Message.id' => 'desc'),
			'limit' => 20
		);

		$this->set('messages', $this->Paginator->paginate());
	}

	// 絞込み
	//   チャット名
	//   年月
	// /messages/index2/OSHOGATSU/201504
	public function index2($chat, $yyyymmdd) {
		$this->Message->recursive = -1;

		// chat permission
		$chats = $this->Chat->readAll();
		if(!in_array($chat, $chats)){
			die("invalid chat");
		}

		// current
		if($yyyymmdd === 'current'){
			$yyyymmdd = date('Ymd');
		}


		$this->set('currentChat', $chat);
		$this->set('currentYyyymmdd', $yyyymmdd);

		// Conversation の identity 参照 -> $conversationIdentity
		$conversationIdentity = $this->Conversation->getConversationIdentity($chat);
		if($conversationIdentity === ''){
			throw new ConversationNotFoundException($chat, 'conversation identity is not found');
		}

		// $yyyymmdd から $y, $m, $d を作る
		if(!preg_match('/^([0-9][0-9][0-9][0-9])([0-9][0-9])([0-9][0-9])$/', $yyyymmdd, $matched)){
			die("invalid yyyymmdd ({$yyyymmdd})");
		}
		$y = $matched[1];
		$m = $matched[2];
		$d = $matched[3];
		$this->set('currentYear', $y);
		$this->set('currentMonth', $m);
		$this->set('currentDay', $d);

		// 曜日
		$t = mktime(0, 0, 0, $m, $d, $y);
		$a = localtime($t, true);
		$table = ['日','月','火','水','木','金','土'];
		$w = $table[$a['tm_wday']];
		$this->set('currentWeek', $w);

		// 日時範囲
		// $from = mktime(0, 0, 0, $m, 1, $y);
		// $to = mktime(0, 0, 0, $m + 1, 1, $y);
		$from = mktime(0, 0, 0, $m, $d, $y);
		$to = mktime(0, 0, 0, $m, $d + 1, $y);
		/*
		var_dump(date("Y-m-d", $from));
		var_dump(date("Y-m-d", $to));
		var_dump($from);
		var_dump($to);
		exit;*/
		$messages = $this->Message->find(
			'all',
			array(
				'conditions' => array(
					// 'chat LIKE' => "%{$chat}%",
					// 'chat' => "{$chat}",
					'chatname' => $conversationIdentity,
					'timestamp >=' => $from,
					'timestamp <' => $to,
				),
				'order' => array('timestamp asc'),
				// 'fields' => array(),
				// 'limit' => 10
			)
		);

		// モデル名キー削除
		if($this->request->params['ext'] === 'json'){
			foreach ($messages as $k => &$v) {
				$v = $v['Message'];
			}
		}

		$this->set('messages', $messages);

		// チャット一覧
		$chats = $this->Chat->readAll();
		$this->set('chats', $chats);
	}

	// 絞込み
	//   チャット名
	//   年月
	// /messages/search/OSHOGATSU?q=hoge
	public function search($chat) {
		$this->Message->recursive = -1;

		$this->set('currentChat', $chat);

		// chat permission
		$chats = $this->Chat->readAll();
		if(!in_array($chat, $chats)){
			die("invalid chat");
		}

		$q = $this->request->query['q'];
		$this->set('currentKeyword', $q);

		// Conversation の identity 参照 -> $conversationIdentity
		$conversationIdentity = $this->Conversation->getConversationIdentity($chat);
		if($conversationIdentity === ''){
			throw new ConversationNotFoundException('conversation identity is not found');
		}

		// 検索
		$this->Prg->commonProcess(); // Search
		$this->paginate = array(
			'conditions' => array(
				$this->Message->parseCriteria($this->passedArgs),
				array(
					'chatname' => $conversationIdentity,
					'body_xml LIKE' => "%{$q}%",
				)
			),
			'order' => array('timestamp asc'),
			'limit' => 100,
		);
		$messages = $this->Paginator->paginate();
		/*
		$messages = $this->Message->find(
			'all',
			array(
				'conditions' => array(
					'chatname' => $conversationIdentity,
					'body_xml LIKE' => "%{$q}%",
				),
				'order' => array('timestamp asc'),
				// 'fields' => array(),
				'limit' => 100,
			)
		);
		*/

		// モデル名キー削除
		if($this->request->params['ext'] === 'json'){
			foreach ($messages as $k => &$v) {
				$v = $v['Message'];
			}
		}

		$this->set('messages', $messages);

		// チャット一覧
		$chats = $this->Chat->readAll();
		$this->set('chats', $chats);
	}

}
