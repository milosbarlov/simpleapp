<?php

class ProductImg extends Content
{
    
      public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 4'
        );
    }
    
    
     public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 4;

        return parent::beforeSave();
    }
    
    public function beforeValidate() {
        
           $this->title = 0;
           $this->excerpt = 0;
         
        return parent::beforeValidate();
    }


    public function attributeLabels()
	{
		return array(
			
			'content' => Yii::t('application', 'model.content.img'),
			
		);
    
        }
    
    
    
    
    
    
}