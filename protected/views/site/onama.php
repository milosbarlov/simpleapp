<section id="content"><div class="ic"></div>
  <div class="border-horiz"></div>

    <div class="main">
        <h3><?php echo Yii::app()->name?></h3>
    
    <div class="overflow padd-2" style="text-align: justify">
      <?php foreach($model as $key){?>
        <p><?php echo $key->content?></p>
      <?php } ?>
    </div>    
    <div class="clear"></div>
        
    </div>
    
   
</section>