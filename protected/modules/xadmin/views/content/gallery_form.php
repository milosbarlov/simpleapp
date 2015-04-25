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
		<?php echo $form->textField($model,'title',array('class'=>'span10', 'size'=>60,'maxlength'=>64,'value'=>!empty($data) ? $data->title:'')); ?>
		<?php echo $form->error($model,'title'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'excerpt', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php echo $form->textArea($model,'excerpt',array('class'=>'span10','rows'=>5, 'cols'=>50,'value'=>!empty($data)? $data->excerpt:'')); ?>
		<?php echo $form->error($model,'excerpt'); ?>
              
                
            </div>
	</div>
        
        
	<div class="control-group">
		
            <div class="controls">
                <?php if(!empty($data)){?>
                   <?php foreach ($data->children as $m){?>
                
                <div style="padding-bottom: 8px">
                    <img src="<?php echo $m->content ?>" height="60" width="80">
                    <button class="btn btn-danger js-delete" data-id="<?php echo $m->id?>">delete</button>
                </div>
                
                   <?php }?>
                <?php }?>
              
                
            </div>
	</div>
        
	 <div class="control-group">
		<?php echo $form->labelEx($picture,'content', array('class'=>'control-label')); ?>
            <div class="controls">
		<?php
                 $this->widget('ext.elfinderWidgets.ElFinderInputWidget', array(
                    'connectorRoute' => Yii::app()->controller->createUrl('content/elFinder'),
                    'model' => $picture,
                    'attribute' => 'content',
                    ));
                ?>
             
                
            </div>
	</div>

          

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    
  $('.js-delete').click(function(e){
      var that = $(this);
      e.preventDefault();
      
      var r = confirm('Are uou sure you want delete this file?')
      
      if(r){
             $.ajax({
             url:'<?php echo Yii::app()->createUrl("xadmin/content/deleteItem")?>',
             type:'POST',
             data:{
                 idItem:$(e.target).data('id'),
             },
             success:function(data){
                 if(data == 'ok'){
                     that.parent('div').remove();
                     location.reload();
                 }else{
                     alert('This item not deleted!!!!')
                 }
             }
            
         });
      }
        
      
     
  })
    
    
    
</script>    