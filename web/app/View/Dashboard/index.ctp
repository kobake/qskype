<style>
	.section{
		margin-bottom: 16px;
	}
	.date{
		border-bottom: 1px solid #aaa;
		width: 300px;
		margin-bottom: 4px;
	}
	.date-chats{
		margin-left: 12px;
	}
	.chat{
	}
	.chat-name{
		display: inline-block;
	}
	.chat-count{
		display: inline-block;
	}
</style>
<div class="dashboard index" style="padding: 0px 40px;">
	<!-- 設定に関する注意 -->
	<!-- Config test -->
	<?php $errorCount = 0; ?>
	<div>
		<?php
		$setupGuide = false;
		$databaseTextPath = ROOT . DS . APP_DIR . '/Data/database.txt';
		if(!is_readable($databaseTextPath)){
			if(!$setupGuide){
				$setupGuide = true;
				print "<h2>Setup guide</h2>\n";
			}
			print <<<EOS
<ul>
	<li>
		データベース設定が見つかりません。
		<ul>
			<li>
				<a href="{$this->webroot}admin/db">データベース設定</a> を行ってください。
			</li>
		</ul>
	</li>
</ul>
EOS;
			$errorCount++;
		}
		?>
	</div>
	<div>
		<?php
		$databaseTextPath = ROOT . DS . APP_DIR . '/Data/chats.txt';
		if(!is_readable($databaseTextPath)){
			if(!$setupGuide){
				$setupGuide = true;
				print "<h2>Setup guide</h2>\n";
			}
			print <<<EOS
<ul>
	<li>
		表示する会話の設定が見つかりません。
		<ul>
			<li>
				<a href="{$this->webroot}admin/chats">表示する会話の設定</a> を行ってください。
			</li>
		</ul>
	</li>
</ul>
EOS;
			$errorCount++;
		}
		?>
	</div>

	<!-- 最近のチャット一覧 -->
	<?php if($errorCount === 0): ?>
		<h2>Recent Chats</h2>
		<div>
			<?php foreach($infos as $info): ?>
				<?php if($info['total'] <= 0)continue; ?>
				<div class="section">
					<div class="date"><?php echo h($info['yyyymmdd_human']);?></div>
					<div class="date-chats">
						<?php foreach($info['chats'] as $chat): ?>
							<?php if($chat['count'] <= 0)continue; ?>
							<div class="chat">
								<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($chat['name']);?>/<?php echo h($info['yyyymmdd']);?>">
									<div class="chat-name">
										<?php echo h($chat['name']); ?>
									</div>
									<div class="chat-count">
										(<?php echo h($chat['count']); ?>件)
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</div>

<?php echo $this->element('foot'); ?>
