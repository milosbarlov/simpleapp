<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'title',array('class'=>'span10', 'size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'title'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'excerpt', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'excerpt',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($model,'excerpt'); ?>
            </div>
	</div>
        
        <div class="control-group">
		<?php echo $form->labelEx($model,'content', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($model,'content',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
            </div>
	</div>
        
         <div class="control-group">
		<?php echo $form->labelEx($data,'title', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($data,'title',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($data,'title'); ?>
            </div>
	</div>
         <div class="control-group">
		<?php echo $form->labelEx($data,'excerpt', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($data,'excerpt',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($data,'excerpt'); ?>
            </div>
	</div>
         <div class="control-group">
		<?php echo $form->labelEx($data,'content', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textField($data,'content',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($data,'content'); ?>
            </div>
	</div>
        
   
        
       
     
        
        
      

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->