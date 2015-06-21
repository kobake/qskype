<style>
	.process-item-op{
		cursor: pointer;
		margin-left: 3px;
	}
	.process-item-op:hover{
		color: #0a0;
	}
	.process-item-buttons{
		padding-left: 1px;
		padding-right: 4px;
		background-color: rgba(255, 255, 255, 0.3);
	}
</style>

<?php
$currentController = $this->params['controller'];
$currentAction = $this->params['action'];
$currentProcessId = (int)$this->params['named']['process'];
$currentBasisId = (int)$this->params['named']['basis'];
?>


<div class="sidebar" style="position: relative;">
	<ul class="nav nav-sidebar">
		<li <?php if($currentAction === 'admin' && $currentController === 'bases')echo 'class="active"';?>><a href="/bases/admin/basis:<?php echo $currentBasisId;?>">管理</a></li>
		<li <?php if($currentAction === 'cover')echo 'class="active"';?>><a href="/bases/cover/basis:<?php echo $currentBasisId;?>">表紙</a></li>
		<li <?php if($currentAction === 'toc')echo 'class="active"';?>><a href="/bases/toc/basis:<?php echo $currentBasisId;?>">目次</a></li>
		<li <?php if($currentAction === 'basis1')echo 'class="active"';?>><a href="/bases/basis1/basis:<?php echo $currentBasisId;?>">基本情報</a></li>
		<li <?php if($currentAction === 'basis2')echo 'class="active"';?>><a href="/bases/basis2/basis:<?php echo $currentBasisId;?>">本業務の内容</a></li>
		<li <?php if($currentAction === 'basis3')echo 'class="active"';?>><a href="/bases/basis3/basis:<?php echo $currentBasisId;?>">システム・体制</a></li>
		<li <?php if($currentAction === 'positions' && $currentController === 'processes')echo 'class="active"';?>><a href="/processes/positions/basis:<?php echo $currentBasisId; ?>">手続きページ</a></li>
		<?php $number = 0; ?>
		<?php foreach($currentProcesses as $process): ?>
			<?php
			$active = '';
			if($currentAction === 'edit2' && $currentProcessId === (int)$process['id']){
				$active = 'active';
			}
			?>
			<li class="process-item <?php echo $active; ?>" style="position: relative;">
				<a class="process-item-link" data-id="<?php echo $process['id']; ?>" href="/processes/edit2/basis:<?php echo $currentBasisId; ?>/process:<?php echo $process['id']; ?>" style="padding-left: 16px;">
					　(<?php echo ++$number; ?>) <?php echo $process['name']; ?>
				</a>
			</li>
		<?php endforeach; ?>

		<?php
		$active = '';
		if($currentProcessId === -1){
			$active = 'active';
		}
		?>
		<li class="<?php echo $active; ?>">
			<a href="/processes/edit2/basis:<?php echo $currentBasisId; ?>/process:-1">
				　<i class="glyphicon glyphicon-plus"></i> 新規
			</a>
		</li>
	</ul>

	<!-- 最小化操作部 (右端に表示) -->
	<style>
		.sidebar-right-box{
			position: absolute;
			display: block;
			top: 0px;
			right: -1px;
			height: 100%;
			width: 32px;
			/* border: 1px solid #f00; /* */
			background-color: rgba(255, 255, 255, 0.5);
			color: #777;
			cursor: pointer;
		}
		.sidebar-right-box:hover{
			opacity: 0.9;
			background-color: #88a;
			border: 1px solid #668;
			color: #eee;
		}
		.sidebar-right-box .glyphicon-menu-left{
			display: inline;
		}
		.sidebar-right-box .glyphicon-menu-right{
			display: none;
		}
		.sidebar-small .sidebar-right-box .glyphicon-menu-left{
			display: none;
		}
		.sidebar-small .sidebar-right-box .glyphicon-menu-right{
			display: inline;
		}
		.sidebar-right-arrow{
			position: absolute;
			display: block;
			/* border: 1px solid #00f; /* */
			width: 100%;
			text-align: center;
			top: 50%;
			margin-top: -1em;
		}
	</style>
	<div class="sidebar-right-box">
		<!-- 縦中央 -->
		<div class="sidebar-right-arrow">
			<i class="glyphicon glyphicon-menu-left"></i>
			<i class="glyphicon glyphicon-menu-right"></i>
		</div>
	</div>
</div>

<script>
	jQuery(function(){
		// サイドバー伸縮
		jQuery('.sidebar-right-box').disableSelection(); // ダブルクリックによる選択を発生させない
		jQuery('.sidebar-right-box').click(function(){
			jQuery('body').toggleClass('sidebar-small');
		});
	});

	// 手続きホバー時のホバーアイテム動的生成
	window.g_hover = null;
	jQuery('.process-item a').hover(
		function(){
			console.log("in");
			var $e = jQuery('<div class="nav" style="position: absolute; pointer-events: none;"></div>');
			$e.appendTo('.navi.view');
			$e.css('top', jQuery(this).offset().top);
			$e.css('left', jQuery(this).offset().left);
			$e.css('z-index', '2000');
			// $e.css('border', '1px solid #f00');
			$e.css('width', 'auto');
			$e.css('background-color', '#eee');
			jQuery(this).parents('.process-item').clone().appendTo($e);
			// global
			window.g_hover = $e;
		},
		function(){
			console.log("out");
			if(window.g_hover){
				window.g_hover.remove();
				window.g_hover = null;
			}
		}
	);
</script>
