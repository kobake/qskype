<div style="padding: 0px 20px;">
	<h2><?php echo $name; ?></h2>
	<p class="error error400">
		<strong>Error: </strong>
		The requested address <strong>'<?php echo h($url); ?>'</strong> was not found on this server.
	</p>
	<?php
	if (Configure::read('debug') > 0):
		echo $this->element('exception_stack_trace');
	endif;
	?>
</div>
