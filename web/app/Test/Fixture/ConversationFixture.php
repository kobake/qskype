<?php
/**
 * ConversationFixture
 *
 */
class ConversationFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'Conversations';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'is_permanent' => array('type' => 'integer', 'null' => true),
		'identity' => array('type' => 'text', 'null' => true),
		'type' => array('type' => 'integer', 'null' => true),
		'live_host' => array('type' => 'text', 'null' => true),
		'live_start_timestamp' => array('type' => 'integer', 'null' => true),
		'live_is_muted' => array('type' => 'integer', 'null' => true),
		'alert_string' => array('type' => 'text', 'null' => true),
		'is_bookmarked' => array('type' => 'integer', 'null' => true),
		'is_blocked' => array('type' => 'integer', 'null' => true),
		'given_displayname' => array('type' => 'text', 'null' => true),
		'displayname' => array('type' => 'text', 'null' => true),
		'local_livestatus' => array('type' => 'integer', 'null' => true),
		'inbox_timestamp' => array('type' => 'integer', 'null' => true),
		'inbox_message_id' => array('type' => 'integer', 'null' => true),
		'last_message_id' => array('type' => 'integer', 'null' => true),
		'unconsumed_suppressed_messages' => array('type' => 'integer', 'null' => true),
		'unconsumed_normal_messages' => array('type' => 'integer', 'null' => true),
		'unconsumed_elevated_messages' => array('type' => 'integer', 'null' => true),
		'unconsumed_messages_voice' => array('type' => 'integer', 'null' => true),
		'active_vm_id' => array('type' => 'integer', 'null' => true),
		'context_horizon' => array('type' => 'integer', 'null' => true),
		'consumption_horizon' => array('type' => 'integer', 'null' => true),
		'last_activity_timestamp' => array('type' => 'integer', 'null' => true),
		'active_invoice_message' => array('type' => 'integer', 'null' => true),
		'spawned_from_convo_id' => array('type' => 'integer', 'null' => true),
		'pinned_order' => array('type' => 'integer', 'null' => true),
		'creator' => array('type' => 'text', 'null' => true),
		'creation_timestamp' => array('type' => 'integer', 'null' => true),
		'my_status' => array('type' => 'integer', 'null' => true),
		'opt_joining_enabled' => array('type' => 'integer', 'null' => true),
		'opt_access_token' => array('type' => 'text', 'null' => true),
		'opt_entry_level_rank' => array('type' => 'integer', 'null' => true),
		'opt_disclose_history' => array('type' => 'integer', 'null' => true),
		'opt_history_limit_in_days' => array('type' => 'integer', 'null' => true),
		'opt_admin_only_activities' => array('type' => 'integer', 'null' => true),
		'passwordhint' => array('type' => 'text', 'null' => true),
		'meta_name' => array('type' => 'text', 'null' => true),
		'meta_topic' => array('type' => 'text', 'null' => true),
		'meta_guidelines' => array('type' => 'text', 'null' => true),
		'meta_picture' => array('type' => 'binary', 'null' => true),
		'picture' => array('type' => 'text', 'null' => true),
		'is_p2p_migrated' => array('type' => 'integer', 'null' => true),
		'premium_video_status' => array('type' => 'integer', 'null' => true),
		'premium_video_is_grace_period' => array('type' => 'integer', 'null' => true),
		'guid' => array('type' => 'text', 'null' => true),
		'dialog_partner' => array('type' => 'text', 'null' => true),
		'meta_description' => array('type' => 'text', 'null' => true),
		'premium_video_sponsor_list' => array('type' => 'text', 'null' => true),
		'mcr_caller' => array('type' => 'text', 'null' => true),
		'chat_dbid' => array('type' => 'integer', 'null' => true),
		'history_horizon' => array('type' => 'integer', 'null' => true),
		'history_sync_state' => array('type' => 'text', 'null' => true),
		'thread_version' => array('type' => 'text', 'null' => true),
		'consumption_horizon_set_at' => array('type' => 'integer', 'null' => true),
		'alt_identity' => array('type' => 'text', 'null' => true),
		'in_migrated_thread_since' => array('type' => 'integer', 'null' => true),
		'extprop_windowpos_x' => array('type' => 'integer', 'null' => true),
		'extprop_windowpos_y' => array('type' => 'integer', 'null' => true),
		'extprop_windowpos_w' => array('type' => 'integer', 'null' => true),
		'extprop_windowpos_h' => array('type' => 'integer', 'null' => true),
		'extprop_window_roster_visible' => array('type' => 'integer', 'null' => true),
		'extprop_window_splitter_layout' => array('type' => 'text', 'null' => true),
		'extprop_hide_from_history' => array('type' => 'integer', 'null' => true),
		'extprop_window_detached' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'IX_Conversations_inbox_timestamp' => array('column' => 'inbox_timestamp', 'unique' => 0),
			'IX_Conversations_alt_identity' => array('column' => 'alt_identity', 'unique' => 0),
			'IX_Conversations_identity' => array('column' => 'identity', 'unique' => 0),
			'IX_Conversations_type' => array('column' => 'type', 'unique' => 0)
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'is_permanent' => 1,
			'identity' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'type' => 1,
			'live_host' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'live_start_timestamp' => 1,
			'live_is_muted' => 1,
			'alert_string' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'is_bookmarked' => 1,
			'is_blocked' => 1,
			'given_displayname' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'displayname' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'local_livestatus' => 1,
			'inbox_timestamp' => 1,
			'inbox_message_id' => 1,
			'last_message_id' => 1,
			'unconsumed_suppressed_messages' => 1,
			'unconsumed_normal_messages' => 1,
			'unconsumed_elevated_messages' => 1,
			'unconsumed_messages_voice' => 1,
			'active_vm_id' => 1,
			'context_horizon' => 1,
			'consumption_horizon' => 1,
			'last_activity_timestamp' => 1,
			'active_invoice_message' => 1,
			'spawned_from_convo_id' => 1,
			'pinned_order' => 1,
			'creator' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'creation_timestamp' => 1,
			'my_status' => 1,
			'opt_joining_enabled' => 1,
			'opt_access_token' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'opt_entry_level_rank' => 1,
			'opt_disclose_history' => 1,
			'opt_history_limit_in_days' => 1,
			'opt_admin_only_activities' => 1,
			'passwordhint' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'meta_name' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'meta_topic' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'meta_guidelines' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'meta_picture' => 'Lorem ipsum dolor sit amet',
			'picture' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'is_p2p_migrated' => 1,
			'premium_video_status' => 1,
			'premium_video_is_grace_period' => 1,
			'guid' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'dialog_partner' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'meta_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'premium_video_sponsor_list' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'mcr_caller' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'chat_dbid' => 1,
			'history_horizon' => 1,
			'history_sync_state' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'thread_version' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'consumption_horizon_set_at' => 1,
			'alt_identity' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'in_migrated_thread_since' => 1,
			'extprop_windowpos_x' => 1,
			'extprop_windowpos_y' => 1,
			'extprop_windowpos_w' => 1,
			'extprop_windowpos_h' => 1,
			'extprop_window_roster_visible' => 1,
			'extprop_window_splitter_layout' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'extprop_hide_from_history' => 1,
			'extprop_window_detached' => 1
		),
	);

}
