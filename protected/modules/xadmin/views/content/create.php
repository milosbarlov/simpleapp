<?php
/* @var $this ContentController */
/* @var $model Content */
?>
<div class="well">
<h1>Create Content</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<div class="well">
<?php echo $this->actionAdmin();?>
</div>