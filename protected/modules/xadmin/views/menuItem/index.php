<?php
/* @var $this MenuItemController */
/* @var $dataProvider CActiveDataProvider */

?>

<h1>Menu Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
