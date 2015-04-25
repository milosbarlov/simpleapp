<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/adminMain'); ?>
<div class="span3 well">
    
    <?php
        if(!empty($this->menu)){ 
            foreach ($this->menu as $key){ ?>
                
    <ul style="list-style-type: none">
        <li><a style="text-decoration:none" href="<?php echo $key['url']?>"><?php echo $key['label'] ;?></a></li>
    </ul>
            
            
     <?php } }?>
    
   
</div>
<div class="span9">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>