<?php
App::uses('AppController', 'Controller');
/**
 * Dashboard Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Search.PrgComponent $Search.Prg
 * @property RequestHandlerComponent $RequestHandler
 */
class DashboardController extends AppController {
	public $uses = array('Message', 'Conversation', 'Chat');
	public $helpers = array('App');
	public $components = array('Paginator', 'Session', 'Search.Prg', 'RequestHandler');

	public function index() {
		// チャット一覧
		$chats = $this->Chat->readAll();
		$this->set('chats', $chats);

		// ここ1週間の発言数
		$infos = array();
		$current = time();
		for($i = 0; $i < 7; $i++){
			// 日付
			$t = strtotime("-{$i} day", $current);
			$info = array();
			$info['yyyymmdd'] = date('Ymd', $t);
			$table = array('日', '月', '火', '水', '木', '金', '土');
			$w = $table[date('w', $t)];
			$info['yyyymmdd_human'] = date("Y年n月j日({$w})", $t);

			// 日時範囲
			$from = strtotime(date('Y-m-d 00:00:00', $t));
			$to = strtotime("+1 day", $from);

			// 各チャット
			$info['chats'] = array();
			$info['total'] = 0;
			foreach($chats as $chat){
				// Conversation の identity 参照 -> $conversationIdentity
				$conversationIdentity = $this->Conversation->getConversationIdentity($chat);
				if($conversationIdentity === ''){
					continue; //throw new ConversationNotFoundException($chat, 'conversation identity is not found');
				}
				$count = $this->Message->find(
					'count',
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
				$ch = array();
				$ch['name'] = $chat;
				$ch['count'] = $count;
				$info['chats'][] = $ch;
				$info['total'] += $count;
			}

			// 追加
			$infos[] = $info;
		}
		$this->set('infos', $infos);
	}
}
