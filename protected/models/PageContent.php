<?php

class PageContent extends Content
{
    
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 1'
        );
    }
   
    public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 1;

        return parent::beforeSave();
    }
    
    
    
    public function behaviors(){
         return CMap::mergeArray(
                    parent::behaviors(), 
                    array(
                        'seo'=>array(
                            'class'=>'behaviors.SeoBehavior',
                            'view'=>'catalog',
                             ),
                         )
                    );
    }
    
   
    
    
}