<style>
	.control-label{
		width: 80px;
		/* border: 1px solid #f00; */
		float: left;
		padding-top: 7px;
		padding-right: 4px;
		text-align: right;
	}
	.control-input{
		width: auto;
		display: block;
		/* border: 1px solid #00f; */
		margin-left: 80px;
		margin-right: 16px;
	}
	.col-submit{
		margin-left: 80px;
	}
</style>
<div class="admin db" style="padding: 0px 20px;">
	<!-- Title -->
	<h2>
		管理 - 表示する会話の設定
	</h2>

	<?php
	echo $this->Form->create('Admin',
		array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'label' => array(
					'class' => 'control-label'
				),
				'wrapInput' => 'control-input',
				'class' => 'form-control'
			),
			'class' => 'well form-horizontal'
		)
	);
	?>
	<!-- Fields -->
	<fieldset>
		<legend>
			会話一覧設定<br/>
			(改行区切りで複数設定)
		</legend>
		<?php
		echo $this->Form->input(
			'chats',
			array(
				'label' => 'chats',
				'type' => 'textarea',
				// 'default' => file_get_contents(ROOT . DS . APP_DIR . '/Data/database.txt')
			)
		);
		?>
	</fieldset>

	<!-- Submit -->
	<div class="form-group">
		<?php
		echo $this->Form->submit(
			'Submit',
			array('div' => 'col col-submit', 'class' => 'btn btn-primary')
		);
		?>
	</div>
	<?php echo $this->Form->end(); ?>

</div>
