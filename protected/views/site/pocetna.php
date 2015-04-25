<div class="box-slider">
    <div class="flexslider">
      <ul class="slides">
         
          
        <?php //print_r($model->attributes);exit();?>
        <?php foreach($model as $item){?>
          <?php foreach($item->children as $children){?>
        <li><img alt="" src="<?php echo $children->content ?>" width="940" height="448"></li>
          <?php }?>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="box-slogan">
      <h3><?php echo'Dobrodosli u '. Yii::app()->name?></h3>
      <?php echo Yii::t('app','Ovo je pocetna stranica')?>
      
  </div>
</header>
<!--==============================content=================================-->
<section id="content"><div class="ic"></div>
  <div class="border-horiz"></div>
  <div class="container_12 row-1">
    <?php foreach($product as $item){?>
       <article class="grid_4 thumbnail-1">
      <h3><span><?php echo $item->title ?></span><?php echo $item->excerpt?> </h3>
      <figure class="box-img" style='width:auto;height:auto'><img src="<?php echo $item->one_children->content?> " height="146" width="280"  alt="" /></figure>
      <p><?php echo $item->content?></p>
      <a href="<?php echo Yii::app()->createUrl('site/proizvodi')?>" class="btn">Detaljnije</a> 
    </article>
    <?php }?>
   
    <div class="clear"></div>
  </div>
</section>
