<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $message_id
 * @property string $subject
 * @property string $message
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $status
 * @property string $createdAt
 * @property string $modifiedAt
 */
class Messages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('sender_id, receiver_id, status', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('message, createdAt, modifiedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_id, subject, message, sender_id, receiver_id, status, createdAt, modifiedAt', 'safe', 'on'=>'search'),
		);*/
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
			'message_id' => 'Message',
			'subject' => 'Subject',
			'message' => 'Message',
			'sender_id' => 'Sender',
			'receiver_id' => 'Receiver',
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

		$criteria->compare('message_id',$this->message_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('receiver_id',$this->receiver_id);
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
	
	public function getMessages($userId = NULL)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('receiver_id=:receiver_id',
							 array(':receiver_id'=>$userId))	
					->order('createdAt DESC')
					->queryAll();
		
		return $result;
	}
	
	public function getSentMessages($userId = NULL)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('sender_id=:sender_id',
							 array(':sender_id'=>$userId))	
					->order('createdAt DESC')
					->queryAll();
		
		return $result;
	}
	
	public function getMessagesDetailById($id=NULL)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('message_id=:message_id',
							 array(':message_id'=>$id))	
					->queryRow();
		
		return $result;
	}
	
	public function getMessagesWithSenderDetail($id=NULL)
	{
		$sql = "select messages.createdAt as messageDate,messages.*,users.* from ".$this->tableName()." LEFT JOIN users ON (users.id = messages.sender_id)  where messages.message_id = ".$id ;
		
		$result	=	Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
	}
	
	public function getUnreadMessageCount($id=NULL)
	{
		$sql = "select count(message_id) from ".$this->tableName()." where messages.read = 0 and messages.status != 4 and messages.status != 7 and receiver_id = ".$id." ;" ;
		
		$result	=	Yii::app()->db->createCommand($sql)->queryScalar();
		
		return $result;
	}
	
	public function getDraftMessageCount($id=NULL)
	{
		$sql = "select count(message_id) from ".$this->tableName()." where messages.status = 4 and sender_id = ".$id." ;" ;
		
		$result	=	Yii::app()->db->createCommand($sql)->queryScalar();
		
		return $result;
	}
	
	public function getMessagesWithReceiverDetail($id=NULL)
	{
		$sql = "select messages.createdAt as messageDate,messages.*,users.* from ".$this->tableName()." LEFT JOIN users ON (users.id = messages.receiver_id)  where messages.message_id = ".$id ;
		
		$result	=	Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
	}
	

	public function getPaginatedMessageList($userId,$limit=5,$sortType="desc",$sortBy="message_id")
	{
		
		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		
		$sql_users = "select users.firstName,users.lastName, messages.* from ".$this->tableName()." LEFT JOIN users ON (users.id = messages.sender_id) where messages.receiver_id = ".$userId." and ( messages.status = 0 or messages.status = 1  or messages.status = 6  or messages.status = 9 ) and messages.receiver_trash = 0 ".$dateSearch." order by ".$sortBy." ".$sortType."";

		$sql_count = "select count(*) from  ".$this->tableName()."   where receiver_id = ".$userId." and ( status = 0 or status = 1 or status = 6 )  and messages.receiver_trash = 0 ".$dateSearch."";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>8,
						),
					));
		$index = 0;	
		
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());			
	}
	
	public function getPaginatedTrashMessageList($userId,$limit=5,$sortType="desc",$sortBy="message_id")
	{
		
		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		
		$sql_users = "select users.firstName,users.lastName, messages.* from messages LEFT JOIN users ON (users.id = messages.sender_id) where (( messages.receiver_id = ".$userId." and  messages.receiver_trash = 1 ) or ( messages.sender_id = ".$userId." and  messages.sender_trash = 1 )) and messages.status != 9 ".$dateSearch." order by ".$sortBy." ".$sortType."";

		$sql_count = "select count(*) from messages LEFT JOIN users ON (users.id = messages.sender_id) where (( messages.receiver_id = ".$userId." and  messages.receiver_trash = 1 ) or ( messages.sender_id = ".$userId." and  messages.sender_trash = 1 )) and messages.status != 9 ".$dateSearch."";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>8,
						),
					));
		$index = 0;	
		
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());			
	}
	
	public function getPaginatedDraftMessageList($userId,$limit=5,$sortType="desc",$sortBy="message_id")
	{
		
		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		
		$sql_users = "select users.firstName,users.lastName, messages.* from ".$this->tableName()." LEFT JOIN users ON (users.id = messages.sender_id) where messages.sender_id= ".$userId." and messages.status = 4".$dateSearch." order by ".$sortBy." ".$sortType."";

		$sql_count = "select count(*) from  ".$this->tableName()." where sender_id = ".$userId." and status = 4  ".$dateSearch."";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>8,
						),
					));
		$index = 0;	
		
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());			
	}
	
		
	
	public function getPaginatedSentMessageList($userId,$limit=5,$sortType="desc",$sortBy="message_id")
	{
		
		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		
		 $sql_users = "select users.firstName,users.lastName, messages.* from ".$this->tableName()." LEFT JOIN users ON (users.id = messages.receiver_id) where messages.sender_id = ".$userId." and  messages.status != 4 and messages.status != 3 and  messages.sender_trash = 0 ".$dateSearch." order by ".$sortBy." ".$sortType."";
	
		$sql_count = "select count(*) from  ".$this->tableName()." where sender_id = ".$userId." and  messages.status != 4  and messages.status != 3  and  messages.sender_trash = 0  ".$dateSearch."";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>8,
						),
					));
		$index = 0;	
		
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());			
	}
	
	public function getAllPaginatedEmailsForAdmin($limit=5,$sortType="desc",$sortBy="id",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (u.firstName like '%".$keyword."%' or u.lastName like '%".$keyword."%' or u.email like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and u.createdAt > '".date("Y-m-d",strtotime($startDate))."' and u.createdAt < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		// $sql_users = "select (select firstName from users where users.id = messages.sender_id) as sender ,(select firstName from users where users.id = messages.receiver_id) as receiver , messages.* from ".$this->tableName()." left join users on ( users.id = messages.sender_id ) where  messages.status = 0 or  messages.status = 1 or  messages.status = 2 or  messages.status = 6".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		 
		 
		 $sql_users = "select (select firstName from users where users.id = messages.sender_id) as sender ,(select firstName from users where users.id = messages.receiver_id) as receiver , messages.* from ".$this->tableName()." left join users on ( users.id = messages.sender_id ) where  messages.status = 0 or  messages.status = 1 or  messages.status = 2 or  messages.status = 6 or messages.status = 9".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		 $sql_count = "select  count(*) from ".$this->tableName()." left join users on ( users.id = messages.sender_id ) where  messages.status = 0 or  messages.status = 1 or  messages.status = 2 or  messages.status = 6".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>LIMIT_10,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());
	}
	
	function deleteMessages($id)
	{
		$sql = "delete from messages where message_id = ".$id."";
		return Yii::app()->db->createCommand($sql)->execute();
	}
	
	public function getAllPaginatedQuestionForApproval($limit=5,$sortType="desc",$sortBy="id",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (u.firstName like '%".$keyword."%' or u.lastName like '%".$keyword."%' or u.email like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and u.createdAt > '".date("Y-m-d",strtotime($startDate))."' and u.createdAt < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
		 $sql_users = "select (select firstName from users where users.id = messages.sender_id) as sender ,(select firstName from users where users.id = messages.receiver_id) as receiver , messages.* from ".$this->tableName()." left join users on ( users.id = messages.sender_id ) where  messages.status = 7 ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		 $sql_count = "select count(*) from ".$this->tableName()." where status = 7 ".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>LIMIT_10,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'messages'=>$item->getData());
	}
	
}