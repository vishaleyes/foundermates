<?php

/**
 * This is the model class for table "reviews".
 *
 * The followings are the available columns in table 'reviews':
 * @property integer $review_id
 * @property integer $advisor_id
 * @property integer $entrepreneur_id
 * @property integer $usefulness
 * @property integer $knowledge
 * @property integer $timeliness
 * @property integer $recommend_other
 * @property string $expertise_area
 * @property string $advisor_experience
 * @property integer $average
 * @property string $createdAt
 * @property string $modifiedAt
 */
class Reviews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reviews the static model class
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
		return 'reviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('advisor_id, entrepreneur_id, usefulness, knowledge, timeliness, recommend_other, average', 'numerical', 'integerOnly'=>true),
			array('expertise_area, advisor_experience, createdAt, modifiedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('review_id, advisor_id, entrepreneur_id, usefulness, knowledge, timeliness, recommend_other, expertise_area, advisor_experience, average, createdAt, modifiedAt', 'safe', 'on'=>'search'),
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
			'review_id' => 'Review',
			'advisor_id' => 'Advisor',
			'entrepreneur_id' => 'Entrepreneur',
			'usefulness' => 'Usefulness',
			'knowledge' => 'Knowledge',
			'timeliness' => 'Timeliness',
			'recommend_other' => 'Recommend Other',
			'expertise_area' => 'Expertise Area',
			'advisor_experience' => 'Advisor Experience',
			'average' => 'Average',
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

		$criteria->compare('review_id',$this->review_id);
		$criteria->compare('advisor_id',$this->advisor_id);
		$criteria->compare('entrepreneur_id',$this->entrepreneur_id);
		$criteria->compare('usefulness',$this->usefulness);
		$criteria->compare('knowledge',$this->knowledge);
		$criteria->compare('timeliness',$this->timeliness);
		$criteria->compare('recommend_other',$this->recommend_other);
		$criteria->compare('expertise_area',$this->expertise_area,true);
		$criteria->compare('advisor_experience',$this->advisor_experience,true);
		$criteria->compare('average',$this->average);
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
	
	
	function getAverageRating($id)
	{
		$sql = "select avg(average) as average from ".$this->tableName()." where advisor_id = ".$id."";
		$count	=	Yii::app()->db->createCommand($sql)->queryScalar();
		return $count;
			
	}
	
	function getInduvidualRating($id,$entId)
	{
		$sql = "select average from ".$this->tableName()." where advisor_id = ".$id." and entrepreneur_id = ".$entId."";
		$count	=	Yii::app()->db->createCommand($sql)->queryScalar();
		return $count;
			
	}
	
	
	public function getAllPaginatedReviewsForAdmin($limit=5,$sortType="desc",$sortBy="id",$keyword=NULL,$startDate=NULL,$endDate=NULL)
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
		
		$sql_users = "select (select email from users where users.id = reviews.advisor_id) as advior_email ,(select email from users where users.id = reviews.entrepreneur_id) as entrepreneur_email ,(select firstName from users where users.id = reviews.advisor_id) as advior ,(select firstName from users where users.id = reviews.entrepreneur_id) as entrepreneur , reviews.* from ".$this->tableName()." left join users on ( users.id = reviews.advisor_id ) where reviews.status = 0  ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		 $sql_count = "select count(*) from ".$this->tableName()."  ".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>LIMIT_10,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'users'=>$item->getData());
	}
	
	function getReviewDetail($review_id=NULL)
	{
		$sql = "select (select email from users where users.id = reviews.advisor_id) as advior_email ,(select email from users where users.id = reviews.entrepreneur_id) as entrepreneur_email ,(select firstName from users where users.id = reviews.advisor_id) as advior ,(select firstName from users where users.id = reviews.entrepreneur_id) as entrepreneur , reviews.* from ".$this->tableName()." left join users on ( users.id = reviews.advisor_id )  where reviews.review_id = ".$review_id.";";	
		$result	=Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
		
	}
	
	public function getPaginatedReviewsForProfile($userId,$limit=5,$sortType="desc",$sortBy="id",$keyword=NULL,$startDate=NULL,$endDate=NULL)
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
		
		$sql_users = "select users.firstName as EntFirstName , users.lastName  as EntLastName , users.avatar as EntImage , users.linkedinLink as EntlinkedinLink,(select email from users where users.id = reviews.advisor_id) as advior_email ,(select email from users where users.id = reviews.entrepreneur_id) as entrepreneur_email ,(select firstName from users where users.id = reviews.advisor_id) as advior ,(select firstName from users where users.id = reviews.entrepreneur_id) as entrepreneur , reviews.* from ".$this->tableName()." left join users on ( users.id = reviews.entrepreneur_id ) where reviews.status = 1 and reviews.advisor_id = ".$userId."  ".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		 
		 $sql_count = "select count(*) from ".$this->tableName()."  where status = 1 and advisor_id = ".$userId."  ".$search." ".$dateSearch." ";
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>2,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'users'=>$item->getData());
	}
	
}