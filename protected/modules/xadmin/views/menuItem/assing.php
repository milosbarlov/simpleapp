<?php

/**
 * @author Dragan Zivkovic <dragan.zivkovic.ts@gmail.com>
 * Created on 10.12.2013.,09.00.54
 * 
 */
?>
<h4>Select pages to conect with <?php echo $model->title;?> menu:</h4>
<form action="<?php echo Yii::app()->createUrl('xadmin/menuItem/assign', array('mid'=>$model->id));?>" method="post">
<?php 
    if(!empty($pages))
    {
        foreach($pages as $p)
        {?>
            <input type="checkbox" name="page[<?php echo $p->id;?>]" 
                <?php
                if(in_array($p->id, $items))
                {
                    echo 'checked';
                };?>
            /> 
                <?php echo $p->title;?><br/><br/>
        <?php
        }
    };?>
            <button type="submit" class="btn btn-primary">Save</button>
</form>