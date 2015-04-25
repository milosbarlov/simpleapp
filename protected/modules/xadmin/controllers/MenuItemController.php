<?php

class MenuItemController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
    public function beforeRender($view) {
        $menus = Menu::model()->findAll();
        $this->menu = array(
            'admin'=>array('url'=>Yii::app()->createUrl('xadmin'), 'label'=>'Admin'),
            'menus'=>array('label'=>'Active Menus', 'class'=>'nav-header'),
        );
        if (!empty($menus))
        {
            foreach ($menus as $m) {
                array_push($this->menu, array('url'=>Yii::app()->createUrl('xadmin/menuItem/assign', array('mid'=>$m->id)), 'label'=>$m->title));
            }
        }

        return parent::beforeRender($view);
    }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update', 'assign'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new MenuItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['MenuItem']))
		{
			$model->attributes=$_POST['MenuItem'];
			if ($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['MenuItem']))
		{
			$model->attributes=$_POST['MenuItem'];
			if ($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('MenuItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new MenuItem('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['MenuItem']))
			$model->attributes = $_GET['MenuItem'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MenuItem the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = MenuItem::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MenuItem $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
    public function actionAssign($mid)
    {
        $model = Menu::model()->findByPk($mid);
        $menuItems = MenuItem::model()->findAll(array('condition'=>'menu_id='.$mid));
        $items = array();
        if (!empty($menuItems))
        {
            foreach ($menuItems as $i)
            {
                array_push($items, $i->model_id);
            }
        }

        $pages = Content::model()->findAll(array('condition'=>'parent_id IS NULL'));
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
            foreach ($page as $key=>$val)
            {
                if (!in_array($key, $items))
                {
                    $menuItem = new MenuItem;
                    $menuItem->model_name = 'Content';
                    $menuItem->model_id = $key;
                    $menuItem->menu_id = $mid;
                    $menuItem->status = 1;
                    $menuItem->list_order = 0;
                    $menuItem->save();
                }
            }
            foreach ($items as $i)
            {
                if (!array_key_exists($i, $page))
                {
                    $menuItem = MenuItem::model()->findByAttributes(array('model_name'=>'Content', 'model_id'=>$i, 'menu_id'=>$mid));
                    $menuItem->delete();
                }
            }
            $this->redirect($this->createUrl('assign', array('mid'=>$mid)));
        }

        $this->render('assing', array(
            'model'=>$model,
            'pages'=>$pages,
            'items'=>$items,
        ));
    }
}
