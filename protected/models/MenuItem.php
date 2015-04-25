<?php

/**
 * This is the model class for table "menu_item".
 *
 * The followings are the available columns in table 'menu_item':
 * @property string $id
 * @property string $menu_id
 * @property string $model_name
 * @property string $model_id
 * @property integer $list_order
 * @property integer $created_by
 * @property integer $create_time
 * @property integer $updated_by
 * @property integer $update_time
 * @property integer $status
 */
class MenuItem extends CActiveRecord
{
    
    const HEADER_MANU = 1;
    const FOOTER_MANU = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuItem the static model class
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
		return 'menu_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id, model_name, model_id, list_order', 'required'),
			array('list_order, created_by, create_time, updated_by, update_time, status', 'numerical', 'integerOnly'=>true),
			array('menu_id, model_id', 'length', 'max'=>10),
			array('model_name', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_id, model_name, model_id, list_order, created_by, create_time, updated_by, update_time, status', 'safe', 'on'=>'search'),
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
                    'content'=>array(self::BELONGS_TO, 'Content', 'model_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('application', 'model.menuitem.id'),
			'menu_id' => Yii::t('application', 'model.menuitem.menu_id'),
			'model_name' => Yii::t('application', 'model.menuitem.model_name'),
			'model_id' => Yii::t('application', 'model.menuitem.model_id'),
			'list_order' => Yii::t('application', 'model.menuitem.list_order'),
			'created_by' => Yii::t('application', 'model.menuitem.created_by'),
			'create_time' => Yii::t('application', 'model.menuitem.create_time'),
			'updated_by' => Yii::t('application', 'model.menuitem.updated_by'),
			'update_time' => Yii::t('application', 'model.menuitem.update_time'),
			'status' => Yii::t('application', 'model.menuitem.status'),
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
		$criteria->compare('menu_id',$this->menu_id,true);
		$criteria->compare('model_name',$this->model_name,true);
		$criteria->compare('model_id',$this->model_id,true);
		$criteria->compare('list_order',$this->list_order);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public function behaviors() {
        return array(
            'ContentUserBehavior' => array(
                'class' => 'behaviors.ContentUserBehavior',
                'setUpdateOnCreate' => true,
                'timestampExpression' => 'time()',
            ),
        );
    }
}