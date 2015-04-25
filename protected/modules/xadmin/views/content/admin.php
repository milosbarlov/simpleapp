<?php
/* @var $this ContentController */
/* @var $model Content */



?>

<h1>Manage Contents</h1>
<!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'parent_id',
		'title',
		'excerpt',
		//'content',
		'created_by',
                'for_index',
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
