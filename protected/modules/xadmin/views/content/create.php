<?php
/* @var $this ContentController */
/* @var $model Content */
?>
<div class="well">
    <h1><?php echo'Create '. get_class($model)?></h1>
    
    <?php
        if(isset($model_img)){
        echo $this->renderPartial('_form', array('model'=>$model,'model_img'=>$model_img));}
        
        else{
            
           echo $this->renderPartial('_form', array('model'=>$model)); 
        } ?>
    
   
</div>
