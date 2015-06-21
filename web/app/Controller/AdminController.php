<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Admin Controller
 *
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Search.PrgComponent $Search.Prg
 * @property RequestHandlerComponent $RequestHandler
 */
class AdminController extends AppController {
	public $uses = array('Message', 'Conversation', 'Chat');
	public $helpers = array('App');
	public $components = array('Paginator', 'Session', 'Search.Prg', 'RequestHandler');

	// DB設定
	public function db() {
		// ヒント -> $hints
		$hints = array();
		$files = scandir('/home');
		foreach($files as $file){
			$path = '/home/' . $file;
			if(preg_match('/^[^\.]/', $file) && is_dir($path)){
				$hints[] = $file;
			}
		}
		$this->set('hints', $hints);

		// 初期値
		if(!isset($this->request->data['Admin']['dbfile'])){
			$dbfile = file_get_contents(ROOT . DS . APP_DIR . '/Data/database.txt');
			$this->request->data['Admin']['dbfile'] = $dbfile;
		}

		// 保存
		if($this->request->is('post')){
			$dbfile = $this->request->data['Admin']['dbfile'];
			$ret = @file_put_contents(ROOT . DS . APP_DIR . '/Data/database.txt', $dbfile);
			if($ret){
				$this->Session->setFlash('データベース設定を行いました');
				$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
			}
			else{
				$this->Session->setFlash('データベース設定に失敗しました');
			}
		}
	}

	// DB設定
	public function chats() {
		if(!isset($this->request->data['Admin']['chats'])){
			$dbfile = file_get_contents(ROOT . DS . APP_DIR . '/Data/chats.txt');
			$this->request->data['Admin']['chats'] = $dbfile;
		}
		if($this->request->is('post')){
			$chats = $this->request->data['Admin']['chats'];
			$ret = @file_put_contents(ROOT . DS . APP_DIR . '/Data/chats.txt', $chats);
			if($ret){
				$this->Session->setFlash('表示する会話の設定を行いました');
				$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));

			}
			else{
				$this->Session->setFlash('表示する会話の設定に失敗しました');
			}
		}
	}
}
