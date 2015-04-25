<section id="content" style='min-height:720px;'><div class="ic"></div>
  <div class="border-horiz"></div>

    <div class="main">
    <h3>Dokumenta</h3>
    
    <div class="overflow padd-2" id="dokumenta">
        <ul>
            <?php foreach($model as $key){?>
            <li><a href="<?php echo $key->content?>" target="_blank">- <?php echo $key->excerpt?></a></li>
            <?php }?>
        </ul>    
        
    </div>    
    <div class="clear"></div>
        
    </div>
    
   
</section>