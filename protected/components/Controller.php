<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
    public $headerMenu = array();

    public $footerMenu = array();

    public function beforeRender($view)
    {
        $header = MenuItem::model()->findAll(array('condition'=>'menu_id = '.MenuItem::HEADER_MANU));
        $footer = MenuItem::model()->findAll(array('condition'=>'menu_id = '.MenuItem::FOOTER_MANU));
        if (!empty($header))
        {
            foreach ($header as $h)
            {
                array_push($this->headerMenu, array('url'=>Yii::app()->createUrl($h->content->seo->url), 'label'=>$h->content->title, 'visible'=>true));
            }
        }
        array_push($this->headerMenu, array('url'=>Yii::app()->createUrl('xadmin'), 'label'=>'Backend', 'visible'=>!Yii::app()->user->isGuest));
        array_push($this->headerMenu, array('url'=>Yii::app()->createUrl('site/logout'), 'label'=>'LogOut', 'visible'=>!Yii::app()->user->isGuest));

        array_push($this->headerMenu, array('url'=>Yii::app()->createUrl('site/login'), 'label'=>'Login', 'visible'=>Yii::app()->user->isGuest));

        if (!empty($footer))
        {
            foreach ($footer as $f)
            {
                array_push($this->footerMenu, array('url'=>Yii::app()->createUrl($f->content->seo->url), 'label'=>$f->content->title));
            }
        }

        return parent::beforeRender($view);
    }
}