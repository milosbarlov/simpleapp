<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $created_by
 * @property integer $create_time
 * @property integer $updated_by
 * @property integer $update_time
 * @property integer $status
 */
class Menu extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
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
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, created_by, create_time, updated_by, update_time, status', 'required'),
			array('created_by, create_time, updated_by, update_time, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>64),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, created_by, create_time, updated_by, update_time, status', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('application', 'model.menu.id'),
			'title' => Yii::t('application', 'model.menu.title'),
			'description' => Yii::t('application', 'model.menu.description'),
			'created_by' => Yii::t('application', 'model.menu.created_by'),
			'create_time' => Yii::t('application', 'model.menu.create_time'),
			'updated_by' => Yii::t('application', 'model.menu.updated_by'),
			'update_time' => Yii::t('application', 'model.menu.update_time'),
			'status' => Yii::t('application', 'model.menu.status'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}