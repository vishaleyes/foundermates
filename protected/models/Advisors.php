<?php

/**
 * This is the model class for table "advisors".
 *
 * The followings are the available columns in table 'advisors':
 * @property integer $id
 * @property integer $userId
 * @property string $organisation
 * @property string $work_status
 * @property string $industry
 * @property string $area_of_expertise
 * @property integer $mentorship_experience
 * @property string $mentorship_details
 * @property integer $startup_experience
 * @property string $startup_roles
 * @property integer $referral
 * @property string $referralId
 * @property integer $status
 * @property string $createdAt
 * @property string $modifiedAt
 */
class Advisors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advisors the static model class
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
		return 'advisors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('userId, organisation, work_status, industry, area_of_expertise, createdAt, modifiedAt', 'required'),
			array('userId, mentorship_experience, startup_experience, referral, status', 'numerical', 'integerOnly'=>true),
			array('organisation, work_status, industry, area_of_expertise', 'length', 'max'=>50),
			array('mentorship_details, startup_roles', 'length', 'max'=>255),
			array('referralId', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userId, organisation, work_status, industry, area_of_expertise, mentorship_experience, mentorship_details, startup_experience, startup_roles, referral, referralId, status, createdAt, modifiedAt', 'safe', 'on'=>'search'),*/
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
			'organisation' => 'Organisation',
			'work_status' => 'Work Status',
			'industry' => 'Industry',
			'area_of_expertise' => 'Area Of Expertise',
			'mentorship_experience' => 'Mentorship Experience',
			'mentorship_details' => 'Mentorship Details',
			'startup_experience' => 'Startup Experience',
			'startup_roles' => 'Startup Roles',
			'referral' => 'Referral',
			'referralId' => 'Referral',
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
		$criteria->compare('organisation',$this->organisation,true);
		$criteria->compare('work_status',$this->work_status,true);
		$criteria->compare('industry',$this->industry,true);
		$criteria->compare('area_of_expertise',$this->area_of_expertise,true);
		$criteria->compare('mentorship_experience',$this->mentorship_experience);
		$criteria->compare('mentorship_details',$this->mentorship_details,true);
		$criteria->compare('startup_experience',$this->startup_experience);
		$criteria->compare('startup_roles',$this->startup_roles,true);
		$criteria->compare('referral',$this->referral);
		$criteria->compare('referralId',$this->referralId,true);
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
	
	function getRatingAverage()
	{
		$sql = "select avg(average) from reviews where advisor_id = 3";
		
	}
	
	function getAdvisorIdByUserId($userId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('id')
					->from($this->tableName())
					->where('userId=:userId',
							 array(':userId'=>$userId))	
					->queryScalar();
		
		return $result;
	}
	
	function getAdvisorByUserId($userId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('userId=:userId',
							 array(':userId'=>$userId))	
					->queryRow();
		
		return $result;
	}
	
	
	
	
	
	
}