<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'username', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'username'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'first_name', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'first_name'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'last_name', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'last_name'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'email'); ?>
            </div>
	</div>
        
        <div class="control-group">
		<?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'password',array('value'=>'', 'size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'password'); ?>
            </div>
	</div>
        
        <div class="control-group">
		<?php echo $form->labelEx($model,'re_password', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'re_password',array('value'=>'','size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'re_password'); ?>
            </div>
	</div>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->