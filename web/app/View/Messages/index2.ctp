<?php
function timeformat($timestamp){
	// return date('Y-m-d H:i:s', $timestamp);
	return date('H:i', $timestamp);
}
function timeformat_ymd($timestamp){
	// return date('Y-m-d H:i:s', $timestamp);
	$table = ['日','月','火','水','木','金','土'];
	$w = date('w', $timestamp);
	$w = $table[$w];
	return date("Y年m月d日({$w})", $timestamp);
}
?>
<style>
	.message{
		border: 1px solid #aaa;
		border-collapse: collapse;
		width: 100%;
		display: table;
		margin-bottom: 4px;
	}
	.message-time{
		display: table-cell;
		width: 50px;
		border: 1px solid #aaa;
		padding: 2px 4px;
		/* width: 200px; */
	}
	.message-user{
		display: table-cell;
		width: 140px;
		border: 1px solid #aaa;
		padding: 2px 4px;
	}
	.message-body{
		display: table-cell;
		width: auto;
		max-width: 400px;
		border: 1px solid #aaa;
		padding: 2px 4px;

		word-wrap: break-word;      /* IE 5.5+ */
		word-break: break-all;
		overflow: auto;
	}
	.chat-header{
		position: fixed;
		display: block;
		left: 180px;
		right: 0px;
		height: 40px;
		line-height: 40px;
		background-color: #ccc;
		opacity: 1.0;
		padding-left: 8px;
		font-size: 14pt;
		border-bottom: 1px solid #888;
		z-index: 1000;
	}
	.chat-body{

	}
	.chat-body .quote-frame{
		display: block;
		/* border: 1px solid #ccc; */
		margin-top: 4px;
		margin-bottom: 4px;
		border-left: 6px solid #ccc;
		padding-left: 10px;
	}
	.chat-body .quote-body{
		display: block;
		color: #444;
	}
	.chat-body .quote-details{
		display: block;
		padding: 2px 0px;
		font-size: 8pt;
		color: #888;
	}
	.chat-body legacyquote{
		display: none;
	}

	/* 日付区切り */
	.date-sep:first-child{
		margin-top: 0px;
	}
	.date-sep{
		margin-top: 16px;
		font-size: 14pt;
	}

	/* アンカー */
	/* http://pixelflips.com/blog/anchor-links-with-a-fixed-header */
	.anchor{
		display: block;
		height: 100px; /*same height as header*/
		margin-top: -100px; /*same height as header*/
		visibility: hidden;
	}

</style>

<div id="wrapper">

	<!-- Sidebar -->
	<div id="sidebar-wrapper">
		<div>
			<ul class="sidebar-nav">
				<?php
				$yyyymmdd = date("Ymd");
				?>
				<?php
				$class = '';
				if($currentYyyymmdd === $yyyymmdd){
					$class = 'active';
				}
				?>
				<li class="<?php echo $class;?>">
					<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo $yyyymmdd;?>">
						今日
					</a>
				</li>
			</ul>
		</div>

		<div style="height: 2px;">
			<div style="height: 2px; border: 1px solid #000;">
			</div>
		</div>

		<?php if(!isset($currentKeyword)): ?>
			<div>
				<ul class="sidebar-nav">
					<?php
					$current = strtotime(sprintf("%04d-%02d-%02d 00:00:00", $currentYear, $currentMonth, $currentDay));
					$currentWeekIndex = date("w", $current); // 0～6
					$weekStart = strtotime("-{$currentWeekIndex} day", $current); // 週初め

					// /messages/index2/OSHOGATSU/20150524 (日)
					// /messages/index2/OSHOGATSU/20150529
					$from = $weekStart; // strtotime("2015-05-24 00:00:00");
					$to = $from + 7 * 24 * 60 * 60;
					$nextWeekStart = $weekStart + 7 * 24 * 60 * 60;
					$prevWeekStart = $weekStart - 7 * 24 * 60 * 60;
					$nextWeekDay = $current + 7 * 24 * 60 * 60;
					$prevWeekDay = $current - 7 * 24 * 60 * 60;
					?>
					<?php for($t = $from; $t < $to; $t += 1 * 24 * 60 * 60): ?>
						<?php
						$a = localtime($t, true);
						$table = ['日','月','火','水','木','金','土'];
						$w = $table[$a['tm_wday']];
						$yyyymmdd = sprintf("%04d%02d%02d", $a['tm_year'] + 1900, $a['tm_mon'] + 1, $a['tm_mday']);
						$class = '';
						if($currentYyyymmdd === $yyyymmdd){
							$class = 'active';
						}
						?>
						<li class="<?php echo $class;?>">
							<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo $yyyymmdd;?>">
								<?php echo $a['tm_mon'] + 1; ?>月<?php echo $a['tm_mday']; ?>日(<?php echo $w;?>)
							</a>
						</li>
					<?php endfor; ?>
				</ul>
			</div>

			<!-- 週切替ボタン -->
			<div class="week-buttons">
				<div class="week-button week-button-prev">
					<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo date('Ymd', $prevWeekDay); ?>">
						<i class="glyphicon glyphicon-triangle-left"></i> 前の週
					</a>
				</div>
				<div class="week-button week-button-next">
					<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo date('Ymd', $nextWeekDay); ?>">
						次の週 <i class="glyphicon glyphicon-triangle-right"></i>
					</a>
				</div>
			</div>
		<?php endif; ?>


		<div id="search-box" style="margin-top: 24px;">
			<!-- 検索ボックス：本当はStack Overflowのボックスをマネしたい -->
			<form class="navbar-form" role="search" method="GET" action="<?php echo $this->webroot;?>messages/search/<?php echo h($currentChat); ?>">
				<div class="input-group">
					<input type="text"
					       class="form-control"
					       placeholder="Search"
					       name="q"
					       id="srch-term"
					       value="<?php if(isset($currentKeyword))echo h($currentKeyword); ?>">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /#sidebar-wrapper -->

	<!-- chat header -->
	<div class="chat-header">
		<?php echo h($currentChat); ?>
		-
		<?php if(isset($currentYear)): ?>
			<?php echo h($currentYear); ?>年<?php echo h($currentMonth); ?>月<?php echo h($currentDay); ?>日(<?php echo h($currentWeek);?>)
		<?php else: ?>
			検索: <?php echo h($currentKeyword); ?>
		<?php endif; ?>
	</div>

	<!-- Page Content -->
	<div id="page-content-wrapper" style="padding-top: 60px;">
		<div class="container-fluid">
			<div class="messages index">
				<!-- paging -->
				<?php if(isset($currentKeyword)): ?>
					<?php echo $this->element('paging'); ?>
				<?php endif; ?>

				<!-- Table -->
				<div class="chat-body">
					<div class="messages">
						<?php $lastYmd = ''; ?>
						<?php $lastHhmm = ''; ?>
						<?php foreach ($messages as $message): ?>
							<?php $row = $message['Message']; ?>

							<!-- 日付区切り -->
							<?php if(isset($currentKeyword)): ?>
								<?php $ymd = timeformat_ymd($message['Message']['timestamp']); ?>
								<?php if($ymd !== $lastYmd): ?>
									<div class="date-sep">
										<?php $yyyymmdd = date('Ymd', $message['Message']['timestamp']); ?>
										<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo h($yyyymmdd); ?>">
											<?php echo h($ymd); ?>
										</a>
									</div>
									<?php $lastYmd = $ymd; ?>
								<?php endif; ?>
							<?php endif; ?>

							<!-- メッセージ -->
							<?php $yyyymmdd = date('Ymd', $row['timestamp']); ?>
							<?php $hhmm = date('Hi', $row['timestamp']); ?>
							<?php
							$timeId = '';
							if($hhmm !== $lastHhmm){
								$timeId = "t{$hhmm}";
							}
							if($timeId !== ''){
								echo "<span class='anchor' id='{$timeId}'></span>";
							}
							?>
							<div class="message" id="row-<?php echo h($row['id']); ?>" data-id="<?php echo h($row['id']); ?>">
								<div class="message-time">
									<a href="<?php echo $this->webroot;?>messages/index2/<?php echo h($currentChat); ?>/<?php echo h($yyyymmdd); ?>#t<?php echo h($hhmm);?>">
										<?php echo timeformat($row['timestamp']); ?>
									</a>
								</div>
								<div class="message-user"><?php echo h($row['from_dispname']); ?></div>
								<div class="message-body"><?php echo h2_with_tag($row['body_xml']); ?></div>
							</div>
							<?php $lastHhmm = $hhmm; ?>

						<?php endforeach; ?>
					</div>
				</div>

				<!-- paging -->
				<?php if(isset($currentKeyword)): ?>
					<br/>
					<?php echo $this->element('paging'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php echo $this->element('foot'); ?>

</div>


<script>
	// 引用の展開 //
	$(function(){
		$('quote').each(function(){
			var author = $(this).attr('author');
			var authorname = $(this).attr('authorname');
			var timestamp = $(this).attr('timestamp');
			var t = new Date(timestamp * 1000);
			var tp = sprintf("%s, %04d年%d月%d日 %02d:%02d", authorname, t.getFullYear(), t.getMonth() + 1, t.getDate(), t.getHours(), t.getMinutes());

			var $frame = $('<div class="quote-frame"></div>');
			$(this).after($frame);
			$frame.append($(this));
			$(this).addClass('quote-body');
			$frame.append($('<div class="quote-details">' + tp + '</div>'));
			// console.log(tp);
			// console.log($(this).html());
		});
	});
</script>