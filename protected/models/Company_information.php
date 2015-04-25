<?php

class Company_information extends Content
{
    
     public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 9'
        );
    }
    
    
     public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 9;

        return parent::beforeSave();
    }
    
  public function attributeLabels()
	{
		return array(
			'id' => Yii::t('application', 'model.content.id'),
			'parent_id' => Yii::t('application', 'model.content.parent_id'),
			'title' => Yii::t('application', 'model.content.tel'),
			'excerpt' => Yii::t('application', 'model.content.fax'),
			'content' => Yii::t('application', 'model.content.email'),
			'created_by' => Yii::t('application', 'model.content.created_by'),
			'create_time' => Yii::t('application', 'model.content.create_time'),
			'updated_by' => Yii::t('application', 'model.content.updated_by'),
			'update_time' => Yii::t('application', 'model.content.update_time'),
			'status' => Yii::t('application', 'model.content.status'),
                        'for_index' => Yii::t('application', 'model.content.index'),
		);
	}
        
       
    
}

