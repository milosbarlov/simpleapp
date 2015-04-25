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

    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/js/bootstrap.min.js'); ?>
	<title><?php echo CHtml::encode($this->pageTitle);?></title>
    <base href="<?php echo Yii::app()->request->baseUrl; ?>/" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding-top: 50px;
        }
    </style>
</head>

<body>

<div class="container-fluid" >
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-inner">
            <a class="brand" href="<?php echo Yii::app()->createUrl('xadmin');?>"><?php echo Yii::app()->name ;?></a>
            <ul class="nav">
                <li><a href="<?php echo Yii::app()->createUrl('xadmin/content/admin'); ?>"><?php echo 'Main Content' ?></a></li>
                 <li><a href="<?php echo Yii::app()->createUrl('xadmin/user/admin'); ?>"><?php echo 'Users' ?></a></li>
                <li class="pull-right"><a href="<?php echo Yii::app()->createUrl('xadmin/user/logOut'); ?>"><?php echo Yii::app()->user->name ?>(logout)</a></li>
               
            </ul>
        </div>
    </div>
    <?php
    if (!empty($this->breadcrumbs))
    {?>
    <ul class="breadcrumb">
        <?php
        foreach ($this->breadcrumbs as $b)
        {
            if(is_array($b))
            {?>
                <li><a href="<?php echo isset($b['url'])? $b['url']:'';?>" ><?php echo $b['label'].'/';?></a></li>
            <?php
            }
            else
            {?>
                <li><?php echo $b;?></li>
            <?php
            }
        }?>
        <!-- breadcrumbs -->
    </ul>
    <?php
    }?>

    <div class="row-fluid">

        <?php echo $content; ?>

    </div>
    <div id="footer" class="container-fluid" >
        <hr />
        <?php
        if (!empty($this->footerMenu))
        {?>
        <div class="navbar">
            <div class="navbar-inner">
                <ul class="nav">
                <?php
                foreach ($this->footerMenu as $m)
                {
                    if(isset($m['url']))
                    {?>
                        <li><a href="<?php echo $m['url'];?>"><?php echo $m['label'];?></a></li>
                    <?php
                    }
                    else if (isset($m['items']))
                    {?>
                        <li class="dropdown">
                            <a class="dropdown-toggle"
                               data-toggle="dropdown"
                               href="#">
                                <?php echo $m['label'];?>
                                <b class="caret"></b>
                              </a>
                            <ul class="dropdown-menu">
                            <?php
                            foreach($m['items'] as $mi)
                            {?>
                                <li><a href="<?php echo $mi['url'];?>"><?php echo $mi['label'];?></a></li>
                            <?php
                            }?>
                            </ul>
                    <?php
                    }
                }?>
                </ul>
            </div>
        </div>
        <?php
        }?>
        <div style="margin: 0 auto; text-align: center">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div>
    </div>
    <!-- footer -->
</div><!-- page -->

</body>
</html>
