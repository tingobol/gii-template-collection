<p class="note"><?php echo "<?php echo Yii::t('app','Fields with');?> <span class=\"required\">*</span> <?php echo Yii::t('app','are required');?>";?>.</p>


<?php echo "<?php if(isset(\$_POST['returnUrl']))
\n\t\techo CHtml::hiddenField('returnUrl', \$_POST['returnUrl']); ?>\n"; ?>
<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
?>
		<?php 
		if(!$column->isForeignKey) 
		{
			echo "<div class=\"row\">\n";
			echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; 
			echo "<?php ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; 
			echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; 
			echo "</div>\n\n";
		}
}

foreach($this->getRelations() as $key => $relation)
{
	if($relation[0] == 'CBelongsToRelation' 
			or $relation[0] == 'CHasOneRelation' 
			or $relation[0] == 'CManyManyRelation')
	{
		printf('<label for="%s">Belonging %s</label>', $relation[1], $relation[1]);
		echo "<?php ". $this->generateRelation($this->modelClass, $key, $relation)."; ?>\n"; ?>
			<?php
	}
}
?>
