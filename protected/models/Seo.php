<?php

/**
 * This is the model class for table "seo".
 *
 * The followings are the available columns in table 'seo':
 * @property string $id
 * @property string $model_name
 * @property string $model_id
 * @property string $url
 * @property string $view
 * @property integer $status
 */
class Seo extends CActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seo the static model class
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
		return 'seo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model_name, model_id, url', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('model_name, view', 'length', 'max'=>64),
			array('model_id', 'length', 'max'=>10),
			array('url', 'length', 'max'=>255),
            array('status', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_name, model_id, url, view, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('application', 'model.seo.id'),
			'model_name' => Yii::t('application', 'model.seo.model_name'),
			'model_id' => Yii::t('application', 'model.seo.model_id'),
			'url' => Yii::t('application', 'model.seo.url'),
			'view' => Yii::t('application', 'model.seo.view'),
			'status' => Yii::t('application', 'model.seo.status'),
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
		$criteria->compare('model_name',$this->model_name,true);
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('view',$this->view,true);
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
}