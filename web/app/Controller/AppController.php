<?php
// 日本語
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @property Basis $Basis
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		// 'DebugKit.Toolbar',

		'Session',

	);
	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
		'Nav',
	);
	public $uses = array('Parameter', 'Message');

	// 毎度実行するもの
	function beforeFilter(){

	}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- //
	// コメント
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- //
	/**
	 * 指定コメントをロードして $this->set しちゃう
	 *
	 * @param $basisId
	 * @param $page
	 */
	protected function loadAndSetComments($basisId, $page){
		$conditions = array(
			'basis_id' => $basisId,
			'page' => $page
		);
		$comments = $this->Comment->find('all', array('conditions' => $conditions, 'order' => 'Comment.id desc', 'limit' => 10));
		$this->set('comments', $comments);
		$this->set('comments_page', $page);
	}

	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- //
	// 順序変更と名前変更（同時受付）
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- //
	// 内部処理用変数
	protected $m_result = array();

	// リストセーブ処理
	protected function _saveRecords($basisId, $records, $model){
		// 保存前の全ユニットID -> $oldRecordIds
		if($basisId === null){
			$oldRecords = $model->find('all');
		}
		else{
			$oldRecords = $model->find('all',
				array('conditions' => array($model->name . '.basis_id' => $basisId))
			);
		}
		$oldRecordIds = array();
		foreach($oldRecords as $record){
			$oldRecordIds["" . $record[$model->name]['id']] = 1;
		}

		// 保存処理
		foreach($records as $record){
			if((int)$record['id'] >= 0){
				$model->id = $record['id'];
				$model->save(array($model->name => $record));
				// $oldRecordIds間引き
				unset($oldRecordIds["" . $record['id']]);
			}
			else if((int)$record['id'] < 0){ // 新規
				$model->create();
				unset($record['id']);
				if($basisId !== null){
					$record['basis_id'] = $basisId;
				}
				$model->save(array($model->name => $record));
			}
		}

		// 事後削除処理
		// $oldRecordIdsに残っているものを全て削除する
		$deleteRecordIds = array_keys($oldRecordIds);
		$this->m_result['deleteIds'] = $deleteRecordIds;
		if(count($deleteRecordIds) > 0){
			$ret = $model->deleteAll(
				array(
					$model->name . '.id' => $deleteRecordIds // 空配列を渡すと何故か一番最後のレコードが消されてしまう？？なので、配列のサイズをあらかじめチェックしておくことが必要。
				)
			);
			$this->m_result['delete'] = $ret;
		}
	}
}
