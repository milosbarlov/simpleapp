<?php

class DefaultController extends Controller
{
    public $layout='//layouts/column2';
        
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	public function actionIndex()
	{
        $this->menu = array(
            'pages'=>array('url'=>Yii::app()->createUrl('xadmin/content/create'), 'label'=>'Main Content'),
          //  'menus'=>array('url'=>Yii::app()->createUrl('xadmin/menuItem/assign', array('mid'=>  MenuItem::HEADER_MANU)), 'label'=>'Menus'),
            'users'=>array('url'=>Yii::app()->createUrl('xadmin/user/create'), 'label'=>'Users'),
           
            
        );
		$this->render('index');
	}
}