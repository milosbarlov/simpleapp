<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
                
	{
            
                
                
		$model = Gallery::model()->findall();
                $product = Product::model()->findAllByAttributes(array('for_index'=>1));
        
        
                    $this->render('pocetna',array(
                        'model'=>$model,
                        'product'=>$product,
                        
                    ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error = Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
               
		$model = new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
    public function actionSeo($seo)
    {
        
        /*
        $seo = Seo::model()->findByAttributes(array('url'=>$seo));
        if ($seo)
        {
            $model = Content::model()->findByPk($seo->model_id);
        }

        $this->pageTitle = $model->title;
        $this->render('page', array(
            'model'=>$model,
        ));
         * 
         */
    }
    
    public function actionPocetna(){
        
        $model = Gallery::model()->findall();
        $product = Product::model()->findAllByAttributes(array('for_index'=>1));
        
        
       $this->render('pocetna',array(
           'model'=>$model,
           'product'=>$product
       ));
    }
    
    public function actionProizvodi(){
        
        $model = Product::model()->findAll();
        
        $this->render('proizvodi',array(
            'model'=>$model,
        ));
    }
    
    public function actionOnama(){
        
        $model = PageContent::model()->findAllByAttributes(array('title'=>'onama'));
        
        
        $this->render('onama',array(
            'model'=>$model,
        ));
    }
    
    public function actionDokumenta(){
        $model = File::model()->findAll();
        
        $this->render('dokumenta',array(
            'model'=>$model,
        ));
    }
    
    public function actionKontakt(){
        
        $model = Company::model()->findAll();
        $data = Company_information::model()->findAll();
        
        
        $this->render('kontakt',array(
            'model'=>$model,
            'data'=>$data,
        ));
        
    }
    
    
    
}