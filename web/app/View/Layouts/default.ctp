<?php
/**
 *
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta charset="utf-8">
	<title>
		<?php
		$title = "qskype";
		echo h($title);
		?>
	</title>
	<!-- キャンバスで変なスケールを発生させないため -->
	<!--
	<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-width" />
	-->
	<!-- -->
	<link href="<?php echo $this->webroot; ?>bootstrap/dist/css/bootstrap.css" rel="stylesheet" /> <!-- -->
	<!-- <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" /> <!-- -->
	<!-- <link href="/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" /> <!-- --> <!-- ←これを入れるとフラットじゃなくなってしまうので、入れない -->
	<link href="<?php echo $this->webroot; ?>jquery-ui-1.11.0/jquery-ui.css" rel="stylesheet" />
	<link href="<?php echo $this->webroot; ?>jquery-ui-1.11.0/jquery-ui.theme.css" rel="stylesheet" />
	<link href="<?php echo $this->webroot; ?>css/simple-sidebar.css" rel="stylesheet" />
	<link href="<?php echo $this->webroot; ?>css/app.css" rel="stylesheet" />
	<link href="<?php echo $this->webroot; ?>css/app-sidetab.css" rel="stylesheet" />

	<?php
	//echo $this->Html->meta('icon');
	if(preg_match('/virtualbox/', $_SERVER['SERVER_NAME']) || preg_match('/local/', $_SERVER['SERVER_NAME'])){
		// 開発アイコン
		echo $this->Html->meta('icon', $this->Html->url('/favicon_dev.png'));
	}
	else{
		// 本番favicon
		echo $this->Html->meta('icon', $this->Html->url('/favicon.png'));
	}
	// echo $this->Html->css('cake.generic');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>

	<!-- lib -->
	<script src="<?php echo $this->webroot; ?>js/sprintf.min.js"></script>
	<script src="<?php echo $this->webroot; ?>jquery/jquery-2.1.3.js"></script> <!-- escapeHTML -->
	<script>
		jQuery(function(){
			// jQuery.noConflict();
		});
	</script>
	<script src="<?php echo $this->webroot; ?>jquery-ui-1.11.0/jquery-ui.js"></script>
	<script src="<?php echo $this->webroot; ?>bootstrap/dist/js/bootstrap.js"></script>

	<!-- app control -->
	<script src="<?php echo $this->webroot; ?>js/app.js"></script>
</head>
<body class="role-<?php echo h($currentUser['role']);?>">
<div id="all">
	<!-- Global variables -->
	<div style="display: none;">
		<?php
		$currentController = $this->params["controller"];
		$currentAction = $this->params["action"];
		?>
		<div id="currentController"  ><?php echo h($this->params["controller"]); ?></div>
		<div id="currentAction"      ><?php echo h($this->params["action"]);     ?></div>

	</div>

	<!-- Fixed navbar -->
	<nav id="top-navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				        data-target="#nav1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand <?php if($this->params["controller"] == 'dashboard'){ echo 'active'; } ?>" href="<?php echo $this->webroot; ?>">
					<i class="glyphicon glyphicon-dashboard"></i>
					<?php //echo h($title); ?>
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<?php echo $this->element('navbar1', array()); ?>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>

	<div id="container" class="container theme-showcase frame-<?php echo h($this->params["controller"]); ?>" role="main">
		<div id="content" class="clearfix">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

	<div id="flash-wrapper">
		<!-- <div id="flashMessage" class="message">The comment has been deleted.</div> -->
		<?php echo $this->Session->flash(); ?>

		<script>
			jQuery(function(){
				jQuery('#flashMessage.message').delay(1000).fadeOut();
			});
		</script>
	</div>
</div>

</body>
</html>
