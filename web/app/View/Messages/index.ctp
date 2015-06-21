<?php
function timeformat($timestamp){
	return date('Y-m-d H:i:s', $timestamp);
}
?>
<div class="messages index">
	<!-- Title -->
	<h2>
		Messages
		<div class="pull-right">
			<a href="<?php echo $this->Html->url(array('action' => 'add'));?>" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> 新規作成</a>
		</div>
	</h2>

	<!-- Search form -->
	<div class="panel panel-default">
		<div class="panel-heading">検索</div>
		<div class="panel-body">
			<div class="search-form">
				<?php echo $this->Form->create();?>
				<?php
				echo $this->Form->input('id', array('label' => 'ID', 'class' => 'span12', 'empty' => true, 'type' => 'text'));
				?>
				<?php echo $this->Form->end('検索');?>
			</div>
		</div>
	</div>

	<!-- Table -->
	<?php echo $this->element('paging'); ?>
	<table cellpadding="0" cellspacing="0" class="table index-table table-bordered">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('chat'); ?></th>
			<th><?php echo $this->Paginator->sort('user'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('timestamp'); ?></th>
		</tr>
		<?php foreach ($messages as $message): ?>
			<?php $row = $message['Message']; ?>
			<tr id="row-<?php echo h($row['id']); ?>" data-id="<?php echo h($row['id']); ?>">
				<!-- ID -->
				<td class="col-id">
					<?php echo h($row['id']); ?>
				</td>
				<td><?php echo h($message['Message']['chat']); ?>&nbsp;</td>
				<td><?php echo h($message['Message']['user']); ?>&nbsp;</td>
				<td><?php echo h($message['Message']['body']); ?>&nbsp;</td>
				<td><?php echo timeformat($message['Message']['timestamp']); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>


	<div class="edit-buttons" style="margin-bottom: 16px;">
		<?php
		$del = '<i class="glyphicon glyphicon-trash"></i>';
		echo $this->Form->postLink("{$del}{$del} 全削除 {$del}{$del}",
			array('action' => 'deleteAll'),
			array('escape' => false),
			'全削除してよろしいですか?'
		);
		?>
	</div>
</div>
