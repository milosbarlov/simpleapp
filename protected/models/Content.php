<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property string $id
 * @property string $parent_id
 * @property string $title
 * @property string $excerpt
 * @property string $content
 * @property integer $created_by
 * @property integer $create_time
 * @property integer $updated_by
 * @property integer $update_time
 * @property integer $status
 */
class Content extends CActiveRecord
{
    
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, excerpt, content', 'required'),
			array('created_by, create_time, updated_by, update_time, status', 'numerical', 'integerOnly'=>true),
			array('parent_id', 'length', 'max'=>10),
            array('created_by, create_time, updated_by, update_time, status' ,'safe'),
			array('title', 'length', 'max'=>64),
			array('excerpt', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, title, excerpt, content, created_by, create_time, updated_by, update_time, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'parent'=>array(self::BELONGS_TO, 'Content', 'parent_id'),
            'children'=>array(self::HAS_MANY, 'Content', array('parent_id'=>'id')),
            'seo'=>array(self::HAS_ONE, 'Seo', array('model_id'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('application', 'model.content.id'),
			'parent_id' => Yii::t('application', 'model.content.parent_id'),
			'title' => Yii::t('application', 'model.content.title'),
			'excerpt' => Yii::t('application', 'model.content.excerpt'),
			'content' => Yii::t('application', 'model.content.content'),
			'created_by' => Yii::t('application', 'model.content.created_by'),
			'create_time' => Yii::t('application', 'model.content.create_time'),
			'updated_by' => Yii::t('application', 'model.content.updated_by'),
			'update_time' => Yii::t('application', 'model.content.update_time'),
			'status' => Yii::t('application', 'model.content.status'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('excerpt',$this->excerpt,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function beforeSave() {
        if($this->isNewRecord)
            $this->status = self::STATUS_ACTIVE;
        return parent::beforeSave();
    }

    public function behaviors() {
        return array(
            'ContentUserBehavior' => array(
                'class' => 'behaviors.ContentUserBehavior',
                'setUpdateOnCreate' => true,
                'timestampExpression' => 'time()',
            ),
            'seo'=>array(
                'class'=>'behaviors.SeoBehavior',
                'view'=>'catalog',
            ),
        );
    }
}