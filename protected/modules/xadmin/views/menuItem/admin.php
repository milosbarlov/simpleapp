<?php
/* @var $this MenuItemController */
/* @var $model MenuItem */

?>

<h1>Manage Menu Items</h1>
<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'menu-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'menu_id',
		'model_name',
		'model_id',
		'list_order',
		'created_by',
		/*
		'create_time',
		'updated_by',
		'update_time',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
