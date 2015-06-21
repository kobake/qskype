<style>
	.success{
		color: #0a0;
	}
	.failure{
		color: #f44;
	}
	.command{
		border: 1px solid #444;
		padding: 4px 8px;
		font-family: 'ＭＳ ゴシック';
		min-width: 400px;
		display: inline-block;
		color: #444;
		margin: 4px 0px;
		margin-bottom: 8px;
	}
	ul.base > li{
		margin-bottom: 16px;
	}
</style>
<div style="padding: 0px 20px;">
	<?php if(get_class($error) === 'ConversationNotFoundException'): ?>
		<h2>該当する会話 (<?php echo h($error->chat);?>) が見つかりません</h2>
		<ul>
			<li>
				会話名が間違っている可能性があります。<br/>
				<a href="<?php echo $this->webroot;?>admin/chats">表示する会話の設定</a> を見直してみてください。
			</li>
		</ul>
	<?php elseif(get_class($error) === 'MissingConnectionException'): ?>
		<h2>データベースファイルにアクセスできません</h2>

		<?php
		$dbfile = @file_get_contents(ROOT . DS . APP_DIR . '/Data/database.txt');
		$jfile = $dbfile . '-journal';
		?>

		<ul class="base">
			<?php while(true): ?>
				<li>
					データベース設定
					<ul>
						<?php if($dbfile !== false && $dbfile !== ''): ?>
							<li class="success">(SUCCESS) 設定が確認できました。</li>
						<?php else:?>
							<li class="failure">
								(FAILURE) データベース設定が確認できませんでした。<br/>
								<a href="/admin/db">データベース設定</a>を行ってください。
							</li>
							<?php break; ?>
						<?php endif;?>
					</ul>
				</li>
				<li>
					ディレクトリパーミッション
					<ul>
						<?php
						// チェックすべきディレクトリの列挙
						$dirs = [];
						$dir = $dbfile;
						while(true){
							$dir = dirname($dir);
							if($dir !== '')$dirs[] = $dir;
							if($dir === '' || $dir === '/')break;
						}
						$dirs = array_reverse($dirs);
						?>

						<?php foreach($dirs as $dir): ?>
							<li><?php echo h($dir);?> のパーミッションをチェックします。</li>
							<?php if(!file_exists($dir)): ?>
								<li class="failure">
									(FAILURE) ディレクトリが見つかりません。<br/>
									<a href="/admin/db">データベース設定</a>を見直してください。
								</li>
								<?php break 2; ?>
							<?php elseif(!is_readable($dir) || !is_executable($dir)): ?>
								<li class="failure">
									(FAILURE) 読み取り可能なパーミッションになっていません。<br/>
									以下コマンドを試してみてください。<br/>
									<div class="command">
										chmod a+rx "<?php echo h($dir); ?>"
									</div>
								</li>
								<?php break 2; ?>
							<?php else:?>
								<li class="success">(SUCCESS) 読み取り可能なパーミッションです。</li>
							<?php endif;?>
						<?php endforeach; ?>
					</ul>
				</li>
				<li>
					データベースファイル存在有無
					<ul>
						<li><?php echo h($dbfile);?> の存在をチェックします。</li>
						<?php if(file_exists($dbfile)): ?>
							<li class="success">(SUCCESS) ファイルの存在が確認できました。</li>
						<?php else:?>
							<li class="failure">
								(FAILURE) ファイルの存在が確認できませんでした。<br/>
								<a href="<?php echo $this->webroot;?>admin/db">データベース設定</a>を見直してみてください。
							</li>
							<?php break; ?>
						<?php endif;?>
					</ul>
				</li>
				<li>
					データベースファイルパーミッション
					<ul>
						<li><?php echo h($dbfile);?> のパーミッションをチェックします。</li>
						<?php if(is_readable($dbfile)):?>
							<li class="success">(SUCCESS) 読み取り可能なパーミッションです。</li>
						<?php else:?>
							<li class="failure">
								(FAILURE) 読み取り可能なパーミッションになっていません。<br/>
								以下コマンドを試してみてください。<br/>
								<div class="command">
									chmod a+r <?php echo h($dbfile); ?>*
								</div>
							</li>
							<?php break; ?>
						<?php endif;?>
					</ul>
				</li>
				<li>
					データベースファイル journal パーミッション
					<ul>
						<li><?php echo h($jfile);?> のパーミッションをチェックします。</li>
						<?php if(!file_exists($jfile)): ?>
							<li>journal ファイルは存在しません。チェックを省略します。</li>
						<?php elseif(!is_readable($jfile)): ?>
							<li class="failure">
								(FAILURE) 読み取り可能なパーミッションになっていません。<br/>
								以下コマンドを試してみてください。<br/>
								<div class="command">
									chmod a+r "<?php echo h($jfile);?>"
								</div>
							</li>
							<?php break; ?>
						<?php else:?>
							<li class="success">(SUCCESS) 読み取り可能なパーミッションです。</li>
						<?php endif;?>
					</ul>
				</li>
				<li>
					すべての設定は確認できました。
				</li>
				<?php break; ?>
			<?php endwhile; ?>
		</ul>
	<?php else: ?>
		<h2>内部エラーが発生しました<?php //echo $name; ?></h2>
		<p class="error error500">
			<strong>Error: </strong>
			An Internal Error Has Occurred.
		</p>
		<?php
		if (Configure::read('debug') > 0):
			echo $this->element('exception_stack_trace');
		endif;
		?>
	<?php endif; ?>
</div>
