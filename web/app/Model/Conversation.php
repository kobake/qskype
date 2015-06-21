<?php
App::uses('AppModel', 'Model');
/**
 * Conversation Model
 *
 * @property InboxMessage $InboxMessage
 * @property LastMessage $LastMessage
 * @property ActiveVm $ActiveVm
 * @property SpawnedFromConvo $SpawnedFromConvo
 */
class Conversation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'Conversations';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'displayname';

	// public $virtualFields = array('id' => 'id', 'identity' => 'identity', 'displayname' => 'displayname');


	// Default order
	public $order = array('Conversation.id desc');

	// Search plugin
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'id'    => array('type' => 'value'),
		'displayname'  => array('type' => 'like'),
	);


	public function getConversationIdentity($chatname){
		// Conversation の identity 参照 -> $conversationIdentity
		$conversation = $this->find(
			'first',
			array(
				'conditions' => array('displayname' => $chatname),
				'fields' => array('id', 'identity', 'displayname')
			)
		);
		if(!$conversation){
			return '';
		}
		$conversationIdentity = $conversation['Conversation']['identity'];
		return $conversationIdentity;
	}


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/*
	public $belongsTo = array(
		'InboxMessage' => array(
			'className' => 'InboxMessage',
			'foreignKey' => 'inbox_message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'LastMessage' => array(
			'className' => 'LastMessage',
			'foreignKey' => 'last_message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ActiveVm' => array(
			'className' => 'ActiveVm',
			'foreignKey' => 'active_vm_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SpawnedFromConvo' => array(
			'className' => 'SpawnedFromConvo',
			'foreignKey' => 'spawned_from_convo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	*/
}
