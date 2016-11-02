<?php

/**
 * This is the model class for table "entrepreneurs".
 *
 * The followings are the available columns in table 'entrepreneurs':
 * @property integer $id
 * @property integer $userId
 * @property integer $business_stage
 * @property string $reason_for_mentor
 * @property string $need_from_mentor
 * @property string $website
 * @property integer $status
 * @property string $createdAt
 * @property string $modifiedAt
 */
class Entrepreneurs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Entrepreneurs the static model class
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
		return 'entrepreneurs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('userId', 'required'),
			array('userId, business_stage, status', 'numerical', 'integerOnly'=>true),
			array('website', 'length', 'max'=>100),
			array('reason_for_mentor, need_from_mentor, createdAt, modifiedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, business_stage, reason_for_mentor, need_from_mentor, website, status, createdAt, modifiedAt', 'safe', 'on'=>'search'),*/
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
			'userId' => 'User',
			'business_stage' => 'Business Stage',
			'reason_for_mentor' => 'Reason For Mentor',
			'need_from_mentor' => 'Need From Mentor',
			'website' => 'Website',
			'status' => 'Status',
			'createdAt' => 'Created At',
			'modifiedAt' => 'Modified At',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('business_stage',$this->business_stage);
		$criteria->compare('reason_for_mentor',$this->reason_for_mentor,true);
		$criteria->compare('need_from_mentor',$this->need_from_mentor,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('modifiedAt',$this->modifiedAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		
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
	
	function checkProfileStatus($userId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('status')
					->from($this->tableName())
					->where('userId=:userId',
							 array(':userId'=>$userId))	
					->queryScalar();
		
		return $result;
	}
	
	function getEntrepreneursIdByUserId($userId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('id')
					->from($this->tableName())
					->where('userId=:userId',
							 array(':userId'=>$userId))	
					->queryScalar();
		
		return $result;
	}
	
}