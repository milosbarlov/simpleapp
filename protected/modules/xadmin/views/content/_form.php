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
		<?php echo $form->textArea($model,'excerpt',array('class'=>'span10','rows'=>5, 'cols'=>50)); ?>
		<?php echo $form->error($model,'excerpt'); ?>
            </div>
	</div>
        <?php if(get_class($model) == 'File'){?>
            
             <div class="control-group">
		<?php echo $form->labelEx($model,'content', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php
                     $this->widget('ext.elfinderWidgets.ElFinderInputWidget', array(
                        'connectorRoute' => Yii::app()->controller->createUrl('content/elFinder'),
                        'model' => $model,
                        'attribute' => 'content',
                        ));
                    ?>
                </div>
            </div> 
        
        <?php } ?>
        
       <?php if(get_class($model) != 'File'){?>
                 
	<div class="control-group">
		<?php echo $form->labelEx($model,'content', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textArea($model,'content',array('class'=>'span10','rows'=>10, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
            </div>
	</div>
       <?php }?>
        
      <?php if(isset($model_img)){?>
        <div class="control-group">
		<?php echo $form->labelEx($model_img,'content', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php
                 $this->widget('ext.elfinderWidgets.ElFinderInputWidget', array(
                    'connectorRoute' => Yii::app()->controller->createUrl('content/elFinder'),
                    'model' => $model_img,
                    'attribute' => 'content',
                    ));
                ?>
            </div>
	</div>
      <?php } ?>
        
       
       <?php if(get_class($model)=='Product'){?>
            
        <div class="control-group">
		<?php echo $form->labelEx($model,'for_index', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->dropDownList($model,'for_index',array(1=>'yes',0=>'no')); ?>
		<?php echo $form->error($model,'for_index'); ?>
            </div>
	</div>
            
       <?php }?>
      
        
        
      

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->