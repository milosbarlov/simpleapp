<?php

class Gallery extends Content
{
    
     public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 6'
        );
    }
    
    
     public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 6;

        return parent::beforeSave();
    }
    
    public function beforeValidate() {
        $this->content = 0;
        
        return parent::beforeValidate();
    }
    

  
       
    
}

