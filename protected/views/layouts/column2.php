<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php
if(!empty($this->menu))
{?>
<div class="span3">
	<div id="sidebar" class="well">
	<?php 
    if (!empty($this->menu))
    {?>
        <ul class="nav nav-list">
        <?php
        foreach ($this->menu as $key=>$val)
        {?>
            <li <?php echo isset($val['class']) ? 'class="'.$val['class'].'"' : '';?>>
            <?php
            if (isset($val['url']))
            {?>
                <a href="<?php echo isset($val['url']) ? $val['url']:'';?>"><?php echo $val['label'];?></a>
            <?php
            }
            else
            {
                echo $val['label'];
            }?>
            </li>
        <?php
        }?>
        </ul>
    <?php
    }?>
	</div><!-- sidebar -->
</div>
<?php
}?>
<div class="span9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>