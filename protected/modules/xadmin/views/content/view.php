<?php
/* @var $this ContentController */
/* @var $model Content */
?>
<div class="well">
<h1>View Content #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'title',
		'excerpt',
		'content',
		'created_by',
		'create_time',
		'updated_by',
		'update_time',
		'status',
	),
)); ?>
</div>
<div class="well">
    <h3>Add Sub Page</h3>
    <form action="<?php echo Yii::app()->createUrl('xadmin/content/subPage');?>" method="post">
        <select>
            
        </select>
    </form>
</div>

<div class="well">
<?php echo $this->actionAdmin();?>
</div>
