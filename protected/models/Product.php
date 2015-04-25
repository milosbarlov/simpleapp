<?php

class Product extends Content
{
    
      public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function defaultScope() {
        return array(
            'condition'=>'type = 3'
        );
    }
    
  public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, excerpt, content', 'required'),
                        array('for_index','topProduct'),
			array('created_by, create_time, updated_by,for_index update_time, status', 'numerical', 'integerOnly'=>true),
			array('parent_id', 'length', 'max'=>10),
                        array('created_by,for_index,create_time, updated_by, update_time, status' ,'safe'),
			array('title', 'length', 'max'=>64),
			array('excerpt', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, excerpt,for_index, content, created_by, create_time, updated_by, update_time, status', 'safe', 'on'=>'search'),
                    //    array('for_index','topProduct'), 
		);
	}
    
     public function beforeSave() {
        if ($this->isNewRecord)
            $this->type = 3;
            
        return parent::beforeSave();
    }
    
    public function topProduct(){
            if($this->for_index == 1){
              $number_product = count(Content::model()->findAll(array('condition'=>'for_index = 1'))); 
            
              if($number_product >= 3){
                  $this->addError('for_index', 'The Index page you can only three top product,plase delete one top product');
                  return false;
              }
             
            }
            return true;
        }
    
    
    
    
}
