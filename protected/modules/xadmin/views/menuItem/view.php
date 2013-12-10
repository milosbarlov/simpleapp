<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */


?>

<h1>View MenuItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menu_id',
		'model_name',
		'model_id',
		'list_order',
		'created_by',
		'create_time',
		'updated_by',
		'update_time',
		'status',
	),
)); ?>
