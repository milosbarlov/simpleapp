<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 */
class User extends CActiveRecord
{
    
    public $re_password;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, first_name, last_name, email, password', 'required'),
			array('username, first_name, last_name, email', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
            array ( 're_password', 'compare', 'compareAttribute' => 'password', 'on' => 'insert' ),
            array ( 're_password', 'compare', 'compareAttribute' => 'password', 'on' => 'update' ),
			array('id, username, first_name, last_name, email, password', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('application', 'model.user.id'),
			'username' => Yii::t('application', 'model.user.username'),
			'first_name' => Yii::t('application', 'model.user.first_name'),
			'last_name' => Yii::t('application', 'model.user.last_name'),
			'email' => Yii::t('application', 'model.user.email'),
            'password' => Yii::t('application', 'model.user.password'),
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('password', $this->password, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}