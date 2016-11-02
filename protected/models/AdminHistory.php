<?php
/**
 * Copyright (c) 2011 All Right Reserved, Todooli, Inc.
 *
 * This source is subject to the Todooli Permissive License. Any Modification
 * must not alter or remove any copyright notices in the Software or Package,
 * generated or otherwise. All derivative work as well as any Distribution of
 * this asis or in Modified
form or derivative requires express written consent
 * from Todooli, Inc.
 *
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 *
 *
**/ 

/**
 * This is the model class for table "admin_history".
 *
 * The followings are the available columns in table 'admin_history':
 * @property integer $id
 * @property string $email
 * @property integer $expiry
 * @property string $userType
 * @property string $loginTime
 * @property string $logoutTime
 * @property integer $userId
 */
class AdminHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin_history the static model class
	 */
	 
	 public function __construct()
	{
		
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
		return 'admin_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, expiry, loginTime, logoutTime, userId', 'required'),
			array('expiry, userId', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>50),
			array('userType', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, expiry, userType, loginTime, logoutTime, userId', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'expiry' => 'Expiry',
			'userType' => 'User Type',
			'loginTime' => 'Login Time',
			'logoutTime' => 'Logout Time',
			'userId' => 'User',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('expiry',$this->expiry);
		$criteria->compare('userType',$this->userType,true);
		$criteria->compare('loginTime',$this->loginTime,true);
		$criteria->compare('logoutTime',$this->logoutTime,true);
		$criteria->compare('userId',$this->userId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public $total_pages = 0;
	public $total_rows = 0;
	
	 // set the user data
	function setData($data)
	{
		$this->data = $data;
	}
	
	// insert the user
	function insertData($id=NULL)
	{
		if($id!=NULL)
		{
			$transaction=$this->dbConnection->beginTransaction();
			try
			{
				$post=$this->findByPk($id);
				if(is_object($post))
				{
					$p=$this->data;
					
					foreach($p as $key=>$value)
					{
						$post->$key=$value;
					}
					$post->save(false);
				}
				$transaction->commit();
					
			
			}
			catch(Exception $e)
			{						
				$transaction->rollBack();
			}
		}
		else
		{
			$p=$this->data;
			foreach($p as $key=>$value)
			{
				$this->$key=$value;
			}
			$this->setIsNewRecord(true);
			$this->save(false);
			return Yii::app()->db->getLastInsertID();
		}
		
	}
	
	
	function getData($id,$filed)
	{
		$this->id=$id;
		$result=$this->getRow($filed);
		return $result;
	}
	function addLoginEntry($adminId,$email,$userType=1,$id=NULL)
	{
		global $SESS_LIFE, $db;
		$expiry = time() + $SESS_LIFE;
		$adminHistoryArray['email']=$email;
		$adminHistoryArray['expiry']=$expiry;
		$adminHistoryArray['loginTime']=date('Y-m-d H:s:i');
		$adminHistoryArray['userId']=$adminId;
		$adminHistoryArray['userType']=$userType;
		$adminObj = new AdminHistory;
		$adminObj->setData($adminHistoryArray);
		$admin_history_id=$adminObj->insertData();
		Yii::app()->session['admin_history_id']=$admin_history_id;
	}
	
	
	function updateExpiry($id)
	{
		global $SESS_LIFE, $db;
		$expiry = time() + $SESS_LIFE;
		$adminHistoryArray['expiry']=$expiry;
		$this->setData($adminHistoryArray);
		$this->insertData($id);
	}
	
	function addLogOutEntry($id,$adminId,$email,$UserType)
	{
		$adminHistoryArray['email']=$email;
		$adminHistoryArray['expiry']=0;
		$adminHistoryArray['logoutTime']=date('Y-m-d H:s:i');
		$adminHistoryArray['userId']=$adminId;
		$adminObj = new AdminHistory;
		$adminObj->setData($adminHistoryArray);
		$adminObj->insertData($id);
	}
	
	function getDetailById($id, $field='id')
	{
		$id = Yii::app()->db->createCommand()
			->select($field)
			->from($this->tableName())
			->where('id=:id', array(':id'=>$id))
			->queryScalar();
		
		return $id;
	}
	
}