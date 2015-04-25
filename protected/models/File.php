<?php

class File extends Content
{
    
     public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 5'
        );
    }
    
    
     public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 5;

        return parent::beforeSave();
    }
    
    public function attributeLabels()
	{
		return array(
			
			'content' => Yii::t('application', 'model.content.file'),
                        'excerpt' => Yii::t('application', 'model.content.text'),
			
		);
    
        }
        
       
    
}

