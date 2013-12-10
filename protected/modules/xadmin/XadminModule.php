<?php

class XadminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                

		// import the module-level models and components
		$this->setImport(array(
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            if (Yii::app()->user->isGuest){
                Yii::app()->user->returnUrl = Yii::app()->createUrl('xadmin');
                $controller->redirect(Yii::app()->createUrl('site/login'));
            }
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
