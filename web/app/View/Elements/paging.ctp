<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
</p>
<div class="paging">
	<?php
	echo $this->Paginator->pagination(array(
		'ul' => 'pagination',
		'modulus' => 10
	));
	?>
</div>
