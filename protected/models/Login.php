<?php

/**
 * This is the model class for table "login".
 *
 * The followings are the available columns in table 'login':
 * @property integer $id
 * @property string $isVerified
 * @property string $status
 * @property string $smsOk
 * @property string $created
 * @property string $modified
 * @property string $loginId
 * @property string $loginIdType
 * @property string $password
 * @property string $fpasswordConfirm
 * @property integer $userId
 * @property integer $expiry
 */
class Login extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Login the static model class
	 */
	 
	public $msg;
	public $errorCode;
	
	public function __construct()
	{
		$this->msg = Yii::app()->params->msg;
		$this->errorCode = Yii::app()->params->errorCode;
	}
 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isVerified, created, modified, loginId, password, fpasswordConfirm, userId, expiry', 'required'),
			array('userId, expiry', 'numerical', 'integerOnly'=>true),
			array('isVerified, loginId', 'length', 'max'=>100),
			array('status, smsOk, loginIdType', 'length', 'max'=>1),
			array('password, fpasswordConfirm', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, isVerified, status, smsOk, created, modified, loginId, loginIdType, password, fpasswordConfirm, userId, expiry', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'isVerified' => 'Is Verified',
			'status' => 'Status',
			'smsOk' => 'Sms Ok',
			'created' => 'Created',
			'modified' => 'Modified',
			'loginId' => 'Login',
			'loginIdType' => 'Login Id Type',
			'password' => 'Password',
			'fpasswordConfirm' => 'Fpassword Confirm',
			'userId' => 'User',
			'expiry' => 'Expiry',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('isVerified',$this->isVerified,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('smsOk',$this->smsOk,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('loginId',$this->loginId,true);
		$criteria->compare('loginIdType',$this->loginIdType,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fpasswordConfirm',$this->fpasswordConfirm,true);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('expiry',$this->expiry);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	
	
}