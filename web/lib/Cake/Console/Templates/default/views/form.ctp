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
2014.08.10 kobake bootstrap3 support
*/
?>
<!-- Title -->
<h2>
	<a href="<?php echo "<?php echo \$this->Html->url(array('action' => 'index')); ?>"; ?>">
		<?php echo $pluralHumanName;?>
	</a>
	-&gt;
</h2>

<!-- Form -->
<div class="<?php echo $pluralVar; ?> form">
<?php echo <<<EOS
	<?php
	echo \$this->Form->create('{$modelClass}',
		array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'label' => array(
					'class' => 'col col-md-3 col-xs-3 control-label'
				),
				'wrapInput' => 'col col-md-5 col-xs-5',
				'class' => 'form-control'
			),
			'class' => 'well form-horizontal'
		)
	);
	?>
EOS;
?>

	<!-- Fields -->
	<fieldset>
		<legend>
			<?php printf("%s %s", Inflector::humanize($action), $singularHumanName); ?>
			<?php
				if($action == 'edit'){
					echo ":<?php echo h(\$this->request->data['{$modelClass}']['id']); ?>";
				}
			?>

		</legend>
<?php
		echo "\t\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field === $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}', array('label' => '{$field}'));\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}', array('label' => '{$assocName}'));\n";
			}
		}
		echo "\t\t?>\n";
?>
	</fieldset>

<?php
	echo <<<EOS
	<!-- Submit -->
	<div class="form-group">
		<?php
		echo \$this->Form->submit(
			'Submit',
			array('div' => 'col col-md-5 col-xs-5 col-md-offset-3 col-xs-offset-3', 'class' => 'btn btn-default')
		);
		?>
	</div>
	<?php echo \$this->Form->end(); ?>
EOS;
?>

</div>
