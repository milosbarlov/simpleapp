<section id="content"><div class="ic"></div>
  <div class="border-horiz"></div>
  <div class="container_12">
    <article class="grid_12">
      <h3><?php echo 'Proizvodi' ?></h3>
      <?php echo Yii::t('app',' Ovo je stranica proizvodi')?>
      <ul class="list-recipes">
        <?php foreach($model as $item){?>
            <li>
                <figure class="box-img">
                    <a  href="images/reso4.jpg" data-lightbox="roadtrip"><img src='<?php echo $item->one_children->content?>'  alt="" width="280" height="133"/></a>
                </figure>
                <div class="overflow">
                  <h4><?php echo $item->title . $item->excerpt?></h4>
                  <?php echo $item->content?>
                </div>
                <div class="clear"></div>
            </li>
        <?php }?>
        </ul>
      </article>
    <div class="clear"></div>
  </div>
</section>
