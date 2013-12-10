<?php
Yii::import('zii.behaviors.CTimestampBehavior');
/**
 * ContentUserBehavior class file.
 *
 * @author Dragan Zivkovic <dragan.zivkovic.ts@gmail.com>
 * 
 */

 /**
 * ContentUserBehavior extends CTimestampBehavior and will automatically fill also createdBy and updatedBy related atributes.
 *
 * ContentUserBehavior will automatically fill createdBy and updatedBy related atributes when the active record
 * is created and/or upadated.
 * You may specify an active record model to use this behavior like so:
 * <pre>
 * public function behaviors(){
 * 	return array(
 * 		'ContentUserBehavior' => array(
 * 			'class' => 'path.to.ContentUserBehavior',
 * 			'createdBy' => 'created_by_attribute',
 * 			'updatedBy' => 'updated_by_attribute',
 *                      'createAttribute' => 'create_time_attribute',
 * 			'updateAttribute' => 'update_time_attribute',
 * 		)
 * 	);
 * }
 * </pre>
 * The {@link createdBy} and {@link updatedBy} options actually default to 'created_by' and 'updated_by'
 * respectively, so it is not required that you configure them. If you do not wish ContentUserBehavior
 * to set a user id for record update or creation, set the corresponding attribute option to null.
 *
 * By default, the update attribute is only set on record update. If you also wish it to be set on record creation,
 * set the {@link setUpdateOnCreate} option to true.
 *
 * Although ContentUserBehavior attempts to figure out on it's own what value to inject into attributes,
 * you may specify a custom value to use instead via {@link userInfoExpression}
 *
 * @author Dragan Zivkovic <dragan.zivkovic.ts@gmail.com>
 * @version $Id$
 */
class ContentUserBehavior extends CTimestampBehavior
{
	/**
	* @var mixed The name of the attribute to store the creation user information.  Set to null to not
	* use a user info for the creation attribute.  Defaults to 'created_by'
	*/
	public $createdBy = 'created_by';
	/**
	* @var mixed The name of the attribute to store the modification user info.  Set to null to not
	* use a user info for the update attribute.  Defaults to 'updated_by'
	*/
	public $updatedBy = 'updated_by';

	/**
	* @var bool Whether to set the update attribute to the creation user info upon creation.
	* Otherwise it will be left alone.  Defaults to false.
	*/
	public $setUpdateOnCreate = false;
        
        /**
	* @var bool Whether to skip change update user info upon update process.
	* Otherwise it will be updated.  Defaults to false.
        * (e.g. if u update some field that is not related to this attribute, like some count field)
	*/
	public $skipUpdate = false;

	/**
	* @var mixed The expression that will be used for generating the user info.
	* This can be either a string representing a PHP expression (e.g. 'Yii::app()->user->id').
	* Defaults to null, meaning that we will use Yii::app()->user->id. 
	*/
	public $userInfoExpression;

	/**
	* Responds to {@link CModel::onBeforeSave} event.
	* Sets the values of the creation or modified attributes as configured
	*
	* @param CModelEvent $event event parameter
	*/
	public function beforeSave($event)
    {
        if ($this->getOwner()->getIsNewRecord() && ($this->createAttribute !== null))
        {
			$this->getOwner()->{$this->createAttribute} = $this->getTimestampByAttribute($this->createAttribute);
		}
        if ($this->getOwner()->getIsNewRecord() && ($this->createdBy !== null))
        {
			$this->getOwner()->{$this->createdBy} = $this->getUserInfoByAttribute($this->createdBy);
		}
                
		if ((!$this->getOwner()->getIsNewRecord() || $this->setUpdateOnCreate) && (!$this->skipUpdate) && ($this->updateAttribute !== null))
        {
			$this->getOwner()->{$this->updateAttribute} = $this->getTimestampByAttribute($this->updateAttribute);
		}
		if ((!$this->getOwner()->getIsNewRecord() || $this->setUpdateOnCreate) && (!$this->skipUpdate) && ($this->updatedBy !== null))
        {
			$this->getOwner()->{$this->updatedBy} = $this->getUserInfoByAttribute($this->updatedBy);
		}
        return parent::beforeSave($event);
	}

	/**
	* Gets the approprate user info
	*
	* @param string $attribute $attribute
	* @return mixed user info (eg Yii::app()->user->id)
	*/
	protected function getUserInfoByAttribute($attribute)
    {
		if ($this->userInfoExpression !== null)
            return @eval('return ' . $this->userInfoExpression . ';');

		return Yii::app()->user->id;
	}

}