<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

Yii::app()->clientScript->registerCss('login-form',
    "\r\n
    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 70px auto 100px;
        -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
                 border-radius: 5px;
         -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                 box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    "
);
?>

<div class="container-fluid">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions' => array ('class'=>'well form-signin')
)); ?>
    <?php echo $form->label($model,'username');?>
	<?php echo $form->textField($model,'username', array('class'=>'span12')); ?>
    
    <?php echo $form->label($model,'password');?>
	<?php echo $form->passwordField($model,'password', array('class'=>'span12')); ?>
        
	<?php echo $form->checkBox($model,'rememberMe').' '.Yii::t('app','Remember Me'); ?>
    <br/><br/>
	<?php /*$this->widget('bootstrap.widgets.TbButtonColumn', array(
                   // 'buttonType'=>'submit',
                    //'type'=>'primary',
                //    'label'=>nYii::t('backend','Login'),
                  //  'htmlOptions' => array('class'=>'btn'),
            )); */
    echo CHtml::submitButton(Yii::t('app','LogIn'), array('class'=>'btn btn-primary')) ?>

<?php $this->endWidget(); ?>
</div><!-- form -->