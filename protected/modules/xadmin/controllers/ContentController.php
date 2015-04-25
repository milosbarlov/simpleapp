<?php

class ContentController extends Controller
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
    
        
    public function beforeRender($view)
    {
        
        $this->menu = array(
            'admin'=>array('url'=>Yii::app()->createUrl('xadmin/content/admin'), 'label'=>'Admin Content'),
            'Create/Manage Pages'=>array('url'=>Yii::app()->createUrl('xadmin/content/create'), 'label'=>'Create Pages'),
            'Create/Manage Product'=>array('url'=>Yii::app()->createUrl('xadmin/content/createProduct'), 'label'=>'Create Product'),
            'Create/Manage File'=>array('url'=>Yii::app()->createUrl('xadmin/content/createFile'), 'label'=>'Create Pdf File'),
            'Create/Manage Gallery'=>array('url'=>Yii::app()->createUrl('xadmin/content/createGallery'), 'label'=>'Create Gallery'),
            'Create/Manage Data'=>array('url'=>Yii::app()->createUrl('xadmin/content/companyData'), 'label'=>'Company Information'),
        );
        
        

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
				'actions'=>array('index','view','deleteItem','admin','elFinder','createProduct','createFile','createGallery','companyData'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        
         public function actions()
	{
		return array(
                        'elFinder'=>array(
                            'class' => 'ext.elfinderWidgets.ElFinderConnectorAction',
                            'roots'=> array(
                                array(
                                    'driver' => 'LocalFileSystem',
                                    'path' => "images",
                                    'startPath' => 'images',
                                    'URL' => "/images",
                                    // 'treeDeep'   => 3,
                                    'alias'      => 'Categories',
                                    'mimeDetect' => 'internal',
                                    'tmbPath' => '.tmb',
                                    'utf8fix' => true,
                                    'tmbCrop' => false,
                                    'tmbBgColor' => 'transparent',
                                    'accessControl' => 'access',
                                    'acceptedName' => '/^[^\.].*$/',
                                    // 'tmbSize' => 128,
                                    'attributes' => array(
                                        array(
                                            'pattern' => '/\.tmb/',
                                            'hidden' => true,
                                        ),
                                        array(
                                            'pattern' => '/\.quarantine/',
                                            'hidden' => true,
                                        ),
                                    ),
                                // 'uploadDeny' => array('application', 'text/xml')
                                ),
                            )
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
		$model = new PageContent;
                $model_img = new ContentImg;
                
               

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['PageContent']) && isset($_POST['ContentImg']))
		{
                      $model->attributes = $_POST['PageContent'];
                    
                      $model->save();
                       $model_img->parent_id = $model->id;
                       $model_img->attributes = $_POST['ContentImg']; 
			if ($model_img->save())
				$this->redirect(array('content/create'));
		}

		$this->render('create',array(
			'model'=>$model,
                        'model_img'=>$model_img
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

		if (isset($_POST['Content']))
		{
			$model->attributes = $_POST['Content'];
			if($model->save())
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
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Content');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Content('search');
               
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Content']))
			$model->attributes = $_GET['Content'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Content the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Content::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Content $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCreateProduct(){
            
            $model = new Product;
            $model_img = new ProductImg;
            
            
            
            if(isset($_POST['Product'])&& isset($_POST['ProductImg'])){
                
               
                $model->attributes = $_POST['Product'];
               //print_r($model->attributes);exit();
                if($model->save()){
                     $model_img->parent_id = $model->id;
                     $model_img->attributes = $_POST['ProductImg'];
                
            
                       
                if($model_img->save()){
                    $this->redirect(array('content/createProduct'));
                }       
                    
                }
               // print_r($model->attributes);exit();
               
                       
            }
          
            
            $this->render('create',array(
               'model'=>$model,
               'model_img'=> $model_img
            ));
            
            
        }
        
        public function actionCreateFile(){
            
            $model = new File;
            
            if(isset($_POST['File'])){
                $model->attributes = $_POST['File'];
                if($model->save()){
                    $this->redirect(array('createFile'));  
                };
            }
            $this->render('create',array(
                'model'=>$model 
            ));
            
        }
        
        
        public function actionDeleteItem(){
            $item = Yii::app()->request->getParam('idItem');
            
            $model = $this->loadModel($item);
            
            if($model->delete()){
                echo 'ok';
            }else{
                echo 'no';
            }
            
            
        }


        
        
        public function actionCreateGallery(){
          
            $model = new Gallery;
            $picture = new GalleryItem;
            $title='';
            $excerpt='';
            $data=array();
            
            if(!empty(Yii::app()->request->getParam('data'))){
                 $id = Yii::app()->request->getParam('data');
                 $data = $this->loadModel($id);
               
            }
            
            
        
           
            
            if(isset($_POST['Gallery']) && isset($_POST['GalleryItem'])){
                $x=$_POST['Gallery']['title'];
               
                $check =  Gallery::model()->findByAttributes(array('title'=>$x));
              
               
                if($check){
                    $picture->attributes = $_POST['GalleryItem'];
                    $picture->parent_id = $check->id;
                    if($picture->save()){   
                       $this->redirect(array('createGallery','data'=>$check->id));
                    }  
                }else{
                
                $model->attributes = $_POST['Gallery'];
                if($model->save()){
                    $picture->attributes = $_POST['GalleryItem'];
                    $picture->parent_id = $model->id;
                    if($picture->save()){   
                       $this->redirect(array('createGallery','data'=>$model->id));
                    }  
                }
            }
           
            }
            
            $this->render('gallery_form',array(
                'model'=>$model,
                'picture'=>$picture,
                'data'=>$data,
            ));
        
        
        }
        
        
       public function actionCompanyData(){
        
           $model = new Company;
           $data = new Company_information;
           
           
           if(isset($_POST['Company'])&& isset($_POST['Company_information'])){
               
               $model->attributes = $_POST['Company'];
               if($model->save()){
                   $data->parent_id = $model->id;
                   $data->attributes = $_POST['Company_information'];
                   $data->save();
                   $this->redirect(array('admin'));
               }
               
           }
           
           
           $this->render('company_info',array(
               'model'=>$model,
               'data'=>$data,
           ));
           
           
       }
        
        
      
        
}
