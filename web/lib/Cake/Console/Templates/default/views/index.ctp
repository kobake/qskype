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
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/*
2014.08.10 kobake bootstrap3 support, search plugin
*/
?>
<div class="<?php echo $pluralVar; ?> index">
	<!-- Title -->
	<h2>
		<?php echo $pluralHumanName; ?>

		<div class="pull-right">
			<?php echo '<a href="<?php echo $this->Html->url(array(\'action\' => \'add\'));?>" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> 新規作成</a>'; ?>

		</div>
	</h2>

	<!-- Search form -->
	<div class="panel panel-default">
		<div class="panel-heading">検索</div>
		<div class="panel-body">
			<div class="search-form">
<?php echo <<<EOS
				<?php echo \$this->Form->create();?>
				<?php
				echo \$this->Form->input('id', array('label' => 'ID', 'class' => 'span12', 'empty' => true, 'type' => 'text'));
				?>
				<?php echo \$this->Form->end('検索');?>
EOS;
?>

			</div>
		</div>
	</div>

	<!-- Table -->
	<?php echo '<?php echo $this->element(\'paging\'); ?>'; ?>

	<table cellpadding="0" cellspacing="0" class="table index-table table-bordered">
		<tr>
<?php foreach ($fields as $field): ?>
			<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php endforeach; ?>
		</tr>
		<?php
		echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
		echo "\t\t\t<?php \$row = \${$singularVar}['{$modelClass}']; ?>\n";
		echo "\t\t\t<tr id=\"row-<?php echo h(\$row['id']); ?>\" data-id=\"<?php echo h(\$row['id']); ?>\">\n";
		echo <<<EOS
				<!-- ID -->
				<td class="col-id">
					<?php echo h(\$row['id']); ?>
					<div class="row-op-list">
						<div class="row-op">
							<?php
							echo \$this->Html->link('<i class="glyphicon glyphicon-edit"></i> 編集',
								array('action' => 'edit', \$row['id']),
								array('escape' => false)
							);
							?>
						</div>
						<div class="row-op">
							<?php
							echo \$this->Form->postLink('<i class="glyphicon glyphicon-trash"></i> 削除',
								array('action' => 'delete', \$row['id']),
								array('escape' => false),
								__('%sを削除してよろしいですか?', \$row['id'])
							);
							?>
						</div>
					</div>
				</td>

EOS;
			foreach ($fields as $field) {
				if($field == 'id')continue;
				$isKey = false;
				if (!empty($associations['belongsTo'])) {
					foreach ($associations['belongsTo'] as $alias => $details) {
						if ($field === $details['foreignKey']) {
							$isKey = true;
							echo "\t\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
							break;
						}
					}
				}
				if ($isKey !== true) {
					echo "\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
				}
			}
		echo "\t\t\t</tr>\n";

		echo "\t\t<?php endforeach; ?>\n";
		?>
	</table>
	<?php echo '<?php echo $this->element(\'paging\'); ?>'; ?>

</div>
