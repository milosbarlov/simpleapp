<section id="content"><div class="ic"></div>
  <div class="border-horiz"></div>
  <div class="main">
    <h3>Kontakt Informacije</h3>
    <div class="box-address">
        <h4><?php echo Yii::app()->name?></h4>
      <?php foreach($model as $value){?> 
      <dl class="address">
        <dt><?php echo $value->title?><br>
          <?php echo $value->excerpt?></dt>
        <dd> <span>TEL:</span> <?php echo $value->content?></dd>
        <dd> <span>FAX:</span> <?php echo $value->one_children->title?></dd>
         <dd> <span>PIB:</span> <?php echo $value->one_children->excerpt?></dd>
        <dd style='text-transform: none'> E-mail: <a class="mail-1" href='<?php echo $value->one_children->content?>'><?php echo $value->one_children->content?></a> </dd>
      </dl>
      <?php }?>  
    </div>
    <div class="map box-img" style='background:white;width:auto;height: auto;'>
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2879.4184545346175!2d20.6156803656067!3d43.805678947562434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47570596b3053bdb%3A0xc328143ff275f2e1!2zRTc2MSwgQ3ZldGtlLCDQodGA0LHQuNGY0LA!5e0!3m2!1ssr!2s!4v1406316479756" width="600" height="450" frameborder="0" style="border:0"></iframe>
    </div>
    <div class="clear"></div>
  </div>
  <div class="box-contact">
    <h3>Kontakt Forma</h3>
    <form id="contact-form">
      <div class="success"> Kontakt forma je poslata! <strong></strong></div>
      <fieldset>
        <div class="coll-1">
          <div>
            <div class="form-txt">Ime:</div>
            <label class="name">
              <input type="text" style='text-transform: none'>
              <span class="error">*Morate upisati ispravno ime.</span> <span class="empty">*Polje mora biti popunjeno.</span> </label>
            <div class="clear"></div>
          </div>
          <div>
            <div class="form-txt">Telefon:</div>
            <label class="phone">
              <input type="tel" style='text-transform: none'>
              <span class="error">*Morate upisati ispravan broj telefona.</span> <span class="empty">*Polje mora biti popunjeno.</span> </label>
            <div class="clear"></div>
          </div>
          <div>
            <div class="form-txt">Email:</div>
            <label class="email">
              <input type="email" style='text-transform: none'>
              <span class="error">*Morate upisati ispravan e-mail.</span> <span class="empty">*Polje mora biti popunjeno</span> </label>
            <div class="clear"></div>
          </div>
        </div>
        <div class="coll-2">
          <div>
            <div class="form-txt">Poruka:</div>
            <label class="message">
              <textarea style='text-transform: none'></textarea>
              <span class="error">*Poruka je prekratka.</span> <span class="empty">*Polje mora biti popunjeno .</span> </label>
            <div class="clear"></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="btns"> <a class="btn" data-type="reset">Briši</a> <a class="btn" data-type="submit">Pošalji</a> </div>
      </fieldset>
    </form>
  </div>
</section>
