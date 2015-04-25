<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon"/>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap.min.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap-responsive.min.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/flexslider.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/grid.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/ie.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/lightbox.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/reset.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/style.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/css/main.css'); ?>    
        
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap.min.js'); ?>
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery-1.7.1.min.js'); ?> 
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/superfish.js'); ?> 
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.flexslider-min.js'); ?>
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/forms.js'); ?>
        
    <title><?php echo CHtml::encode($this->pageTitle);?></title>
    <base href="<?php echo Yii::app()->request->baseUrl; ?>/" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    
    <script>	
			jQuery(window).load(function() {								
			jQuery('.flexslider').flexslider({
				animation: "fade",			
				slideshow: true,			
				slideshowSpeed: 3000,
				animationDuration: 600,
				prevText: "",
				nextText: "",
				controlNav: false		
			})
			  
			
					
      });
	</script>
   
</head>

<body id="first_page">

<!--==============================header=================================-->
<header>
  
  <div class="main">
    <div class="row-top">
        <h1><a href="<?php echo Yii::app()->createUrl('site/index')?>"><img src="<?php echo Yii::app()->createAbsoluteUrl('/images/index_logo.png') ?>"></a></h1>
      <nav>
        <ul class="sf-menu">
           <?php foreach (PageContent::model()->findAll() as $model){ ?>
              <li><a href="<?php echo Yii::app()->createUrl('site/'.$model->title) ?>"><?php echo $model->title ?></a></li>
           <?php }; ?>
        </ul>
      </nav>
      <div class="clear"></div>
    </div>
  </div>
   <?php 
        echo $content;
   ;?>   
  
      
  

<!--==============================footer=================================-->
<footer>
  <div class="main">
    &#169;2014 Copyright Megatehna kv
  </div>
</footer>



</body>
</html>
