<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
<!-- Navbar -->
<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
<?php
if(!isset($chats)){
	App::uses('Chat', 'Model');
	$chats = Chat::readAll();
	/*
	if(isset($error) && get_class($error) === 'ConversationNotFound'){
		$currentChat = $error->chat;
		var_dump($currentChat);
	}
	*/
	$currentChat = $this->request->params['pass'][0];
}
?>
<div class="collapse navbar-collapse" id="nav1">
	<ul class="nav navbar-nav">
		<?php foreach($chats as $chat): ?>
			<li class="<?php if($chat === $currentChat)echo 'active';?>">
				<a href="<?php echo $this->webroot; ?>messages/index2/<?php echo h($chat); ?>/current">
					<?php echo h($chat); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>

	<ul class="nav navbar-nav pull-right">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">管理 <span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-right" role="menu">
				<li><a href="<?php echo $this->webroot; ?>admin/db">データベース設定</a></li>
				<li><a href="<?php echo $this->webroot; ?>admin/chats">表示する会話の設定</a></li>
			</ul>
		</li>
	</ul>
</div>
