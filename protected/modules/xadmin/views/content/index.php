<?php
/* @var $this ContentController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Contents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
