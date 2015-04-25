<?php echo CHtml::hiddenField($name, $value, array('id' => $id)); ?>

<?php echo CHtml::htmlButton(
        '<i class="icon-picture"></i> '.$buttonLabel, 
        array('id'=>$id.'_btn', 'class'=>$buttonClass)
);?>

<div id="<?php echo $id;?>_preview" style="margin-top:7px;display: none;">
    <div id="<?php echo $id;?>_img">
        <?php echo CHtml::link('<i class="icon-remove-sign"></i>', '#', 
                        array(
                            'title' => $imgOptions['removeTitle'],
                            'id' => $id.'_remove',
                        )
                );?>
        <img src="<?php echo $value;?>" class="<?php echo $imgOptions['class'];?>" style="width:<?php echo $imgOptions['width'];?>;height:<?php echo $imgOptions['height'];?>" />
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript(__CLASS__.'#'.$id,
    "\r\n
    $('#".$id."_btn').on('click', function() {
        var fm = $('<div/>').dialogelfinder({
            url : '".$connectorRoute."',
            lang : '".(isset($clientOptions['lang']) && !empty($clientOptions['lang']) ? $clientOptions['lang'] : 'en')."',
            width : 840,
            destroyOnClose : true,
            getFileCallback : function(files, fm) {
                    $('#".$id."').val(files);
                    $('#".$id."_img img:first').attr('src', files);
                    $('#".$id."_preview').show();
            },
            commandsOptions : {
                    getfile : {
                            oncomplete : 'close'
                    }
            }
        }).dialogelfinder('instance');
    }); \r\n
    $('#".$id."_remove').on('click', function(e) {
        e.preventDefault();
        $('#".$id."_preview').hide();
        $('#".$id."').val('');
        $('#".$id."_img img:first').attr('src','');
        return false;
    });
");

if (!empty($value)) {
    Yii::app()->clientScript->registerScript(__CLASS__.'_update#'.$id,
    "\r\n
    $('#".$id."_preview').show();
");
}
