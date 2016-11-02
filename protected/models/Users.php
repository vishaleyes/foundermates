<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $firstName
 * @property string $lastName
 * @property string $avatar
 * @property string $linkedinLink
 * @property string $facebookLink
 * @property string $twitterLink
 * @property string $createdAt
 * @property string $modifiedAt
 * @property string $deletedAt
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('firstName, lastName, avatar, linkedinLink, facebookLink, twitterLink, createdAt, modifiedAt, deletedAt', 'required'),
			array('firstName, lastName', 'length', 'max'=>50),
			array('avatar, linkedinLink, facebookLink, twitterLink', 'length', 'max'=>255),
			array('deletedAt', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstName, lastName, avatar, linkedinLink, facebookLink, twitterLink, createdAt, modifiedAt, deletedAt', 'safe', 'on'=>'search'),*/
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
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'avatar' => 'Avatar',
			'linkedinLink' => 'Linkedin Link',
			'facebookLink' => 'Facebook Link',
			'twitterLink' => 'Twitter Link',
			'createdAt' => 'Created At',
			'modifiedAt' => 'Modified At',
			'deletedAt' => 'Deleted At',
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
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('linkedinLink',$this->linkedinLink,true);
		$criteria->compare('facebookLink',$this->facebookLink,true);
		$criteria->compare('twitterLink',$this->twitterLink,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('modifiedAt',$this->modifiedAt,true);
		$criteria->compare('deletedAt',$this->deletedAt,true);

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
	
	/*
	DESCRIPTION : USER LOGIN
	*/
	function login($email,$password,$remember=0)
	{
		global $msg;
		$isSuccess=0;
		$successType='seeker';
		if($remember==1)
		{		
			setcookie("password_login", $password, time()+60*60*24*500, "/");
			setcookie("email_login",$email, time()+60*60*24*500, "/");
		}
		$generalObj=new General;
		
		$userObj	=	new Users();
		$users = $userObj->getVerifiedUser($email);
		
		$err_msg = NULL;
		if(!empty($users))
		{
			$users = $users[0];
			
			if($users['isVerified'] != 1)
			{
				$err_msg = 'ERROR_VERIFICATION_MSG';
			}
			elseif($users['status'] != 1)
			{
				$err_msg = 'ERROR_STATUS_MSG_0';
			}
			elseif(false==$generalObj->validate_password($password, $users['password']))
			{
				$err_msg	=	'EMAIL_PHONE_MSG';
			}
			else
			{
				
				$isSuccess=1;
				$algoObj = new Algoencryption();
				$fullname	=	$this->getUserById($users['id']);
				
				Yii::app()->session['fmuserId']=$users['id'];
				Yii::app()->session['fmloginId']=$users['email'];
				
				if(!empty($fullname))
				{
					Yii::app()->session['fullname'] =$fullname['firstName'].'&nbsp;'.$fullname['lastName'];
					Yii::app()->session['firstName']=$fullname['firstName'];
					
				}
				else
				{
					Yii::app()->session['fullname']='Username';
				}
					
				Yii::app()->session['userType'] =  $users['userType'];
				Yii::app()->session['email'] =  $users['email'];
				
				if(isset(Yii::app()->session['email_login']))
				{
					unset(Yii::app()->session['email_login']);
				}
			}
		}
		else
		{
			$err_msg = 'EMAIL_PHONE_MSG';
		}
		
		if($isSuccess==1)
		{	
			Yii::app()->session['firstLoadFlag']=1;
			return array("status"=>0,"message"=>$successType,"userId"=>$users['id']);
			
		}
		else
		{
			
			Yii::app()->session['email_login']=$email;
			return array('status'=>$this->errorCode['_LOGIN_ERROR_'],'message'=>$this->msg['_LOGIN_ERROR_']);
			
		}
	}
	

	/*
	DESCRIPTION : GET VERIFIED USER
	*/
	function getVerifiedUser($loginId)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('email=:email and isVerified=:isVerified',
							 array(':email'=>$loginId,':isVerified'=>'1'))	
					->queryAll();
		
		return $result;
	}
	
	
	function forgot_password($loginId,$mobile=0,$lng='eng')
	{
		error_reporting(E_ALL);
		$generalObj=new General();
		
		$id = $this->getUserIdByLoginId($loginId);
		
			if(!empty($id))
			{
				
				$new_password = $this->genPassword();
				$userObj=Users::model()->findByPk($id['id']);
				$userObj->fpasswordConfirm=$new_password;	
				$res = $userObj->save();				
				
				
				
					
					$url=Yii::app()->params->base_path.'templatemaster/job';
					$message = file_get_contents(Yii::app()->params->base_path.'templatemaster/job');
					$recipients = $loginId;							
					$email =$loginId;
					$subject = "Forgot Password Verification Code";
					$message = str_replace("_BASEPATHLOGO_",Yii::app()->params->base_url,$message);
					
					if($mobile==1)
					{
						$message = str_replace("_BASEPATH_",BASE_PATH.'m',$message);
					}
					else
					{
						$message = str_replace("_BASEPATH_",Yii::app()->params->base_path,$message);
					}
					$message = str_replace("_LOGOBASEPATH_",Yii::app()->params->base_url,$message);
					$message = str_replace("_PASSWORD_CODE_",$new_password,$message);
					$message = str_replace("_TOKEN_",$new_password,$message);
										
					$mail=new Helper();
					$mailResponse=$mail->sendMail($email,$subject,$message);
					
					if($mailResponse!=true) {		
						$msg= $mailResponse;
						return array('status'=>"200","message"=>"Email sending error".$msg);
					} 
					else
					{
						return  array('status'=>0,"message"=>"Reset password token successfully sent to your mail.",'token'=>$new_password);
					}
				
				if($res == 1)
				{
					return array('status'=>0,"message"=>"Successfully Changed");
				}
				else
				{
					return array("status"=>1,"message"=>"Some Problem in Forgot Password.");	
				}
			}
			else
			{
				return array('status'=>"2","message"=>"No registered user is available in our records with this
is/email address");
			}
	}
	
	public function getUserIdByLoginId($email)
	{
		$result = Yii::app()->db->createCommand()
    	->select('*')
    	->from($this->tableName())
   	 	->where('email=:email', array(':email'=>$email))	
   	 	->queryRow();
		return $result;
	}
	
	function genPassword()
	{
		$pass_char = array();
		$password = '';
		for($i=65 ; $i < 91 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=97 ; $i < 123 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=48 ; $i < 58 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=0 ; $i<8 ; $i++)
		{
			$password .= $pass_char[rand(0,61)];
		}
		return $password;
	}
	
	//reset password confirmation
	function resetpassword($data)
	{
		if($data['token']!='')
		{
			if(strlen($data['new_password'])>=6)
			{
				
					$generalObj = new General();
					$loginObj=new Users();
					$id=$this->getIdByfpasswordConfirm($data['token']);
					
					$new_password =$generalObj->encrypt_password($data['new_password']);
					$User_field['password'] = $data['new_password'];
					
					$userObj=Users::model()->findByPk($id['id']);
					if(isset($userObj) && $userObj != '')
					{
						$userObj->fpasswordConfirm = '';
						$userObj->password = $new_password;	
						$res = $userObj->save();	
					}
					return array("status"=>'0',"message"=>"Your password changed successfully.");						
						
				
			}
			else
			{
				return array('status'=>$this->errorCode['_VALIDATE_PASSWORD_GT_6_'],"message"=>$this->msg['_VALIDATE_PASSWORD_GT_6_']);
			}
		}
		else
		{
			return array('status'=>$this->errorCode['VALIDATE_TOKEN'],"message"=>$this->msg['VALIDATE_TOKEN']);
		}
	}
	
	function getIdByfpasswordConfirm($token)
	{
		$result = Yii::app()->db->createCommand()
		->select('id')
		->from($this->tableName())
		->where('fpasswordConfirm=:fpasswordConfirm', array(':fpasswordConfirm'=>$token))
		->queryRow();
		return $result;
	}
	
	function activate($loginId,$mobile=0)
	{
		$result = $this->getUserIdByLoginId($loginId);
		if(count($result) && $result!='')
		{
			if($result['isVerified']==1)
				{			
					$msgmsg=$this->msg['NAEMAIL_MSG'];
					$responceArray=array("status"=>$this->errorCode['NAEMAIL_MSG'],"message"=>$msgmsg);
					return $responceArray;	
				}
				else
				{
					$generalObj = new General();
					$algoObj = new Algoencryption();
					$everify_code=$generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
					$userArray=array();
					$userArray['isVerified']=$everify_code;
					$userArray['expiry']=time()+ACTIVATION_LINK_EXPIRY_TIME;
					$loginObj	=	new Login();					
					$loginObj->setData($userArray);
					$loginObj->insertData($result['id']);
					$emailLink = Yii::app()->params->base_path."site/verifyaccount/&key=".$everify_code.'&id='.$algoObj->encrypt($result['id']).'&lng=eng';	
					
					
					$url=Yii::app()->params->base_path.'templatemaster/setTemplate/&lng=eng&file='.$this->msg['_ET_ACCOUNT_ACTIVATION_LINK_TPL_'].'';
					$message = file_get_contents($url);
		
					$recipients = $loginId;							
					$email =$loginId;
					$subject = "KWEXC account confirmation";	
					$message = str_replace("_BASEPATHLOGO_",Yii::app()->params->image_path,$message);
					
					if($mobile==1)
					{
						$message = str_replace("_BASEPATH_",BASE_PATH.'m/',$message);
					}
					else
					{
						$message = str_replace("_BASEPATH_",BASE_PATH,$message);
					}
					$message = str_replace("_USER_NAME_",$email,$message);
					$message = str_replace("_EMAIL_LINK_",$emailLink,$message);
					$message = str_replace("_USER_CONFIRMATION_VERIFY_LINK_",$this->msg['_USER_CONFIRMATION_VERIFY_LINK_'],$message);
					$message = str_replace("_LOGOBASEPATH_",Yii::app()->params->image_path,$message);
				
					$mail=new Helper();
					$mailResponse=$mail->sendMail($email,$subject,$message);
				
					if($mailResponse!=true) {
						
						$msg= $mailResponse;
						return array('status'=>$this->errorCode['_USER_MAIL_ERROR_'],"message"=>$this->msg['_USER_MAIL_ERROR_'].$msg);
					} 
					else
					{						
						return  array('status'=>0,"message"=>$this->msg['ACT_MSG']);
					}		
				}
		}
		else
		{
			$msgmsg=$this->msg['AEMAIL_MSG'];
			$responceArray=array("status"=>$this->errorCode['AEMAIL_MSG'],"message"=>$msgmsg);
			return $responceArray;	
		}
	}
	
	function contactUs($data,$mobile=0,$lng='eng')
	{		
		$recipients = $data['email'];
		$to = "team@foundermates.com" ;							
		$email =$data['email'];							
		$name =$data['name'];
		$comment = htmlentities($data['comment']);
		$Yii = Yii::app();	
		
		$url=Yii::app()->params->base_path.'templatemaster/contact';
		
		$message = file_get_contents($url);
		$message = str_replace("_BASEPATH_",BASE_PATH,$message);
		$message = str_replace("_LOGOBASEPATH_",Yii::app()->params->base_url,$message);
		$message = str_replace("_NAME_",$name,$message);
		$message = str_replace("_COMMENT_",$comment,$message);
		$message = str_replace("_EMAIL_",$email,$message);
		$subject = "Contact Us";
		$mail=new Helper();
		$mailResponse=$mail->sendMail($to,$subject,$message,$email);
		
		if($mailResponse!=true) {	
				$msg= $mailResponse;
				return array('status'=>-1,'message'=>"error in mail sending");
		} else {
		   return array('status'=>0,'message'=>"Successfully sent.");
		}		
		
	}
	
	/*
	DESCRIPTION : GET USER BY ID
	*/
	public function getUserById($id=NULL, $fields='*')
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('id=:id', array(':id'=>$id))	
   	 	->queryRow();
		
		return $result;
	}	
	/*
	DESCRIPTION : GET USER BY ID
	*/
	public function getUserDetail($id=NULL, $fields='*')
	{
		
		$algoencryptionObj = new Algoencryption();	
		if(!is_numeric($id))
		{	
			$id=$algoencryptionObj->decrypt($id);
		}
		$userObj =  new Users();
		$loginArr = $userObj->getUserId($id);
		
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('id=:id', array(':id'=>$loginArr['id']))	
   	 	->queryRow();
		
		if(!empty($loginArr))
		{
			$result['id']=$loginArr['id'];
			$result['password']=$loginArr['password'];
			$result['isVerified']=$loginArr['isVerified'];
			$result['status']=$loginArr['status'];
			$res = array("status"=>0,"result"=>$result);
		}
		else
		{
			$res=array("status"=>"-1","message"=>"No Data Found.","result"=>"no data");
		}
		return $res;
	}
	
	/*
	DESCRIPTION : ADD USER
	*/
	function addRegisterUser($data)
	{
		
		$generalObj	=	new General();
		$algoObj	=	new Algoencryption();
		$loginObj	=	new Login();
		$flagerroremail	=	0;
		$flagsuccessemail	=	0;
		$flagsuccessmsg	=	0;	
		$flagerrormsg	=	0;
		$Password	=	$generalObj->encrypt_password($data['password']);
		$everify_code=$generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
		//Insert multiple entries in users table
		$User_value['isVerified']=$everify_code;//1;
		//$User_value['expiry']=time();//+ACTIVATION_LINK_EXPIRY_TIME;
		$User_value['createdAt'] = date('Y-m-d H:i:s');
		//$User_value['password'] = $Password;
		$email=$data['email'];
		
		
		$helperObj = new Helper();
	
		if($data['email'] != "" && $data['email'] != $this->msg['_EMAIL_'] )
		{
			if($generalObj->isValidEmail($data['email']))
			{
				$userData['password'] = $Password;
				$userData['country']	=	$data['country'];
				$userData['city'] = $data['city'];
				$userData['status']	=	1;
				$userData['isVerified'] = $everify_code;//1;
				$userData['firstName']	=	htmlentities($data['firstName']);
				$userData['lastName']	=	htmlentities($data['lastName']);
				$userData['tagline']	=	htmlentities($data['headline']);
				if(isset($data['avatar'])){
				$userData['avatar']	=	$data['avatar'];
				}
				if(isset($data['avatarlink'])){
					
					
				 $rawData = file_get_contents($data['avatarlink']);
 
 
				 $str = rand(1000,100000);
				 $file = 'assets/upload/avatar/foundermates_'.$userData['firstName'].'_'.$str.'.png';
				 $imageName = 'foundermates_'.$userData['firstName'].'_'.$str.'.png';
				 file_put_contents($file, $rawData);	
				$userData['avatar']	=	$imageName;
				}
				$userData['email']	=	$data['email'];
				$userData['userType']   =   $data['userType'];
				
				/*if(isset($userData['avatar']) && $userData['avatar']	!= '' )
				{
					if(isset($userData['avatarlink']) && $userData['avatarlink'] == '')
					{
						move_uploaded_file($_POST['tmp_name'],"assets/upload/avatar/".$_POST['avatar']);
					}
				}*/
				if(isset(Yii::app()->session['userImage']) && !empty(Yii::app()->session['userImage']))
				{
					
					$_FILES = Yii::app()->session['userImage'];
					$userData['avatar']=$_FILES['userImage']['name'];
					$tmp_name=$_FILES['userImage']['tmp_name'] ;
					
					//move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
				}	
				
				
				$userData['linkedinLink']	=	$data['linkedinLink'];
				$userData['createdAt']	=	date('Y-m-d H:i:s');
				$userData['modifiedAt']	=	date('Y-m-d H:i:s');
				$this->setData($userData);
				$this->setIsNewRecord(true);
				$userId=$this->insertData();
				
				if( $userData['userType'] == '1' )
				{
					$entData['userId']=	$userId ;
					$entData['idea']	=	htmlentities($data['idea']);
					if(isset($data['entType']))
					{
						$entData['entType']	=	$data['entType'];
					}
					$entData['business_stage']   =   $data['business_stage'];
					if(isset($data['reason_for_mentor']))
					{
						$entData['reason_for_mentor']   =   $data['reason_for_mentor'];
					}
					if(isset($data['need_from_mentor']))
					{
						$entData['need_from_mentor']   =   htmlentities($data['need_from_mentor']);
					}
					if(isset($data['mentorship_experience']))
					{
						$entData['mentorship_experience']   =  $data['mentorship_experience'];
					}
					if(isset($data['industry']))
					{
						$entData['industry']   =   $data['industry'];
					}
					if(isset($data['website']))
					{
						if(substr($data['website'],0,4) == 'http')
						{
							$entData['website']   =   $data['website'];
						}
						else
						{
							$entData['website']   =   "http://".$data['website'];
						}
					}
					if(isset($data['referral']))
					{
						$entData['referral']   =   $data['referral'];
					}
					
					$entData['createdAt']	=	date('Y-m-d H:i:s');
					$entData['status']	=	1 ;
					
					$entObj = new Entrepreneurs();
					$entObj->setData($entData);
					$entId=$entObj->insertData();
				}
				
				else if( $userData['userType'] == '2' )
				{
					$advisorData['userId']=	$userId ;
					if(isset($data['ent_industry']))
					{
						$str3  = implode(',',$data['area_of_expertise']);
						$advisorData['area_of_expertise']   =   $str3;
					}
					
					if(isset( $data['startup_experience']) &&  $data['startup_experience'] != '')
					{
						$advisorData['startup_experience']	=	$data['startup_experience'];
					}
					if(isset( $data['startup_roles']) &&  $data['startup_roles'] != '')
					{
						$advisorData['startup_roles']	=	$data['startup_roles'];
					}
					if(isset( $data['organisation']) &&  $data['organisation'] != '')
					{
						$advisorData['organisation']   =   $data['organisation'];
					}
					if(isset( $data['work_status']) &&  $data['work_status'] != '')
					{
						$advisorData['work_status']   =   $data['work_status'];
					}
					if(isset( $data['mentorship_experience']) &&  $data['mentorship_experience'] != '')
					{
						$advisorData['mentorship_experience']   =   $data['mentorship_experience'];
					}
					if(isset( $data['mentorship_details']) &&  $data['mentorship_details'] != '')
					{
						$advisorData['mentorship_details']   =   $data['mentorship_details'];
					}
					if(isset( $data['referral']) &&  $data['referral'] != '')
					{
						$advisorData['referral']   =   $data['referral'];
					}
					if(isset( $data['referralId']) &&  $data['referralId'] != '')
					{
						$advisorData['referralId']   =   $data['referralId'];
					}
					if(isset($data['stage']))
					{
						$str  = implode(',',$data['stage']);
						$advisorData['stage']   =   $str;
					}
					
					if(isset($data['ent_industry']))
					{
						$str1  = implode(',',$data['ent_industry']);
						$advisorData['ent_industry']   =   $str1;
					}
					
					if(isset($data['sme']))
					{
						$advisorData['sme']   =   $data['sme'];
					}
					
					if(isset($data['phone']))
					{
						$advisorData['phone']   =   $data['phone'];
					}
					
					if(isset($data['industry']))
					{
						$advisorData['industry']   =   $data['industry'];
					}
					if(isset($data['startups']))
					{
						$advisorData['startups']   =   $data['startups'];
					}
					if(isset($data['motivation']))
					{
						$advisorData['motivation']   =   $data['motivation'];
					}
					if(isset($data['hearabout']))
					{
						$advisorData['hearabout']   =   $data['hearabout'];
					}
					if(isset($data['referralId']))
					{
						$advisorData['referralId']   =   $data['referralId'];
					}
					if(isset($data['my_pitch']))
					{
						$advisorData['my_pitch']   =   htmlentities($data['my_pitch']);
					}
					if(isset($data['help']))
					{
						$advisorData['help']   =   htmlentities($data['help']);
					}
					if(isset($data['help']))
					{
						$advisorData['help']   =   htmlentities($data['help']);
					}
					if(isset($data['advisorType']))
					{
						$advisorData['advisorType']   =   $data['advisorType'];
					}
					
					$advisorData['createdAt']	=	date('Y-m-d H:i:s');
					$advisorData['status']	=	1 ;
					
					$advisorObj = new Advisors();
					$advisorObj->setData($advisorData);
					$advisoerId=$advisorObj->insertData();	
				}
				
				$Yii = Yii::app();	
				$emailLink = $Yii->params->base_path."site/verifyAccount/key/".$everify_code.'/id/'.$algoObj->encrypt($userId).'/lng/eng/email/'.$data['email'];
				
				$recipients = $data['email'];							
				$email =$data['email'];			
				$from = "registration@foundermates.com";				
				$fullname=$data['firstName'].' '.$data['lastName'];
				$subject= 'Foundermates Account Confirmation.';
				
				$Yii = Yii::app();	
				
				$url=$Yii->params->base_path.'templatemaster/userConfirmForAdvisor';
				
				$message = file_get_contents($url);

				$message = str_replace("_LOGOBASEPATH_",Yii::app()->params->base_url.'images',$message);
				
				$message = str_replace("_BASEPATH_",BASE_PATH,$message);
				
				$message = str_replace("_EMAIL_LINK_",$emailLink,$message);
				
				$message = str_replace("_ADV_FAQ_",Yii::app()->params->base_url."site/advisorfaq",$message);
				
				
				
				$message = str_replace("_LOGINID_",$data['email'],$message);
				$message = str_replace("_USER_CONFIRMATION_VERIFY_LINK_",$this->msg['_USER_CONFIRMATION_VERIFY_LINK_'],$message);
			//	$message = str_replace("_PASSWORD_",$data['password'],$message);
				
				$helperObj = new Helper();
				$mailResponse=$helperObj->sendMail($email,$subject,$message,$from);
				
				
				$adminObj = new Admin();
				$adminData = $adminObj->getAdmin();
				
				$helperObj = new Helper();
				$mailResponse=$helperObj->sendMail('team@foundermates.com',$subject,$message,$adminData['email']);
				
				
				$mailResponse = true;
				if($mailResponse!=true)
				{
				  $flagerroremail=1;
				}
				else
				{	  $flagsuccessemail=1;
					if(isset(Yii::app()->session['fmuserId']))
					{
						unset(Yii::app()->session['fmuserId']);
					}
				}	
			}
		}
	}
	
	function verifyaccount($key,$id,$by='WEB')
	{
		if(!is_numeric($id))
		{
			$algoObj= new Algoencryption();
			$pid=$algoObj->decrypt($id);
		}
		else
		{
			$pid=$id;
		}
		
		$result = Yii::app()->db->createCommand()
		->select('*')
		->from($this->tableName())
		->where('id=:id', array(':id'=>$pid))
		->queryRow();
		
		if(!empty($result))
		{
			if($result['isVerified'] == '1')
			{
		 		return 2;
			}
			else if($result['isVerified'] == $key)
			{
				$modifieddate= date('Y-m-d h:m:s');
				$UserArray['isVerified']='1';
				$UserArray['modifiedAt']=$modifieddate;
				
				$this->setData($UserArray);
				$this->insertData($pid);
				return 1;
			}
			else
			{	
				return 3;
			}
		}
		else
		{		
			return 3;
		}
	}
	
	/*
	DESCRIPTION : CHECK OTHER SAME EMAIL EXISTS OR NOT
	*/
	function checkOtherEmail($email,$chkUserId='-1',$type=NULL)
	{
		$condition='loginId=:loginId';
		$params=array(':loginId'=>$email);
		
		
		$result = Yii::app()->db->createCommand()
		->select('loginId')
		->from($this->tableName())
		->where($condition,$params)
		->order('id asc')
		->queryScalar();
	
		return $result;
	}
	
	/*
	DESCRIPTION : GET USER/AUTHOR PROFILE DETAILS FUNCTION
	PARAMS : $id -> USER/AUTHOR id
	*/
	function getProfileDetails($sessionArray=NULL, $type='user')
	{
		$algoencryptionObj=new Algoencryption();	
		if(isset($sessionArray['userId']) && !is_numeric($sessionArray['userId']))
		{
			$sessionArray['userId']=$algoencryptionObj->decrypt($sessionArray['userId']);	
		}
		
		if(isset($sessionArray['userId']) && !is_numeric($sessionArray['userId']))
		{
			$sessionArray['userId']=$algoencryptionObj->decrypt($sessionArray['userId']);
		}
		
		$details['loginDetails']	=	$this->getLoginId($sessionArray['userId']);
		if($details['loginDetails']['accountType']==0 ) {
			$details['userDetails']	=	$this->getUserDetailsByLoginId($sessionArray['userId'], $type);
			$details['avatarDir']	=	$algoencryptionObj->encrypt("USER_".$details['loginDetails']['userId']);
			$accountType	=	0;
			
		} else {
			$details['authorDetails']	=	$this->getUserDetailsByLoginId($sessionArray['userId'], $type);
			$details['avatarDir']	=	$algoencryptionObj->encrypt("AUTHOR_".$details['loginDetails']['id']);
			$accountType	=	1;
		}
		
		//$details['vPhone']	=	$this->getVerifiedPhone($details['loginDetails']['id'], $accountType);
		//$details['nvPhone']	=	$details['vPhone']==false?0:1;
		//$details['uPhone']	=	$this->getUnVerifiedPhone($details['loginDetails']['id'], $accountType);
		//$details['nuPhone']	=	$details['uPhone']==false?0:1;;
		//$details['verifiedEmail']	=	$this->getUserVerifiedEmail($details['loginDetails']['id'], $accountType);
		/*$details['allPhones']	=	$this->getAllPhones($id);*/
		return array("status"=>0,"result"=>$details);
	}
	
	function getLoginId($id = NULL)
	{		
	
		$result_user	=	Yii::app()->db->createCommand()
							->select("*")
							->from($this->tableName())
							->where('id=:id', array(':id'=>$id))
							->queryRow();
			
		return $result_user;
	}
	
	function getUserDetailsByLoginId($id=NULL,$type='user')
	{
		$login	=	$this->getLoginId($id);
		$usersObj	=	new Users();
		$userDetails	=	$usersObj->getUserById($login['id']);
		$userDetails['name']=$userDetails['firstName'].' '.$userDetails['lastName'];
		$userDetails['loginId']=$login['loginId'];
		$userDetails['id']=$login['id'];
		return $userDetails;
	}
	
	function getRecordByEmail($email = NULL)
	{		
	
		$id	=	Yii::app()->db->createCommand()
							->select("id")
							->from($this->tableName())
							->where('loginId=:loginId', array(':loginId'=>$email))
							->queryScalar();
		return $id;

	}
	
	function uploadAvatar($_POST=array(),$_FILES=array(),$stat=NULL)
	{
		if(isset($_POST['userId']))
		{
			if(!is_numeric($_POST['userId']))
			{
				$algObj = new Algoencryption();					
				$_POST['userId'] = $algObj->decrypt($_POST['userId']);
			}
		}
		else
		{
			$result['status'] = $this->errorCode['_INVALID_PARAMETERS_'];
			$result['message'] = $this->msg['_INVALID_PARAMETERS_'];
			return $result;
		}
		if($stat != NULL && $stat == "update")
		{
			
				if(isset($_POST['file_name']) && $_POST['file_name'] != "" && isset($_POST['userId']) && $_POST['userId']!='')
				{
					$this->setData(array('avatar'=>$_POST['file_name']));
					$this->insertData($_POST['userId']);
						
					//Deleting other file
					$algo=new Algoencryption();
					$newdir=$algo->encrypt("USER_".$_POST['userId']);
					
					$uploaddir = FILE_UPLOAD.'avatar/'.trim($newdir);
					if(is_dir($uploaddir))
					{
						if ($handle = opendir($uploaddir)) 
						{
							while (false !== ($file = readdir($handle))) 
							{
								
								$filepath=$uploaddir.'/'.$file;
								if(strlen($file)>6)
								{
									
									if(file_exists($filepath))
									{
										
										if($file!=$_POST['file_name'])
										{
												unlink($filepath);
										}
									}
								}
							}
						}
					}
					$response_data['status']=0;
					$response_data['dir']=$newdir;
					$response_data['result']=$_POST['file_name'];
					$response_data['message']=$this->msg['_AVATAR_UPLOAD_'];
					return $response_data;
				}
				else
				{
					$response_data['status']=$this->errorCode['_INVALID_PARAMETERS_'];
					$response_data['message']=$this->msg['_INVALID_PARAMETERS_'];
					$response_data['result']='';
					return $response_data;
				}
			
		}
		else
		{
		
        if(isset($_FILES['avatar']))
        {
            $uploaddir = FILE_UPLOAD.'avatar/';
			$extArray=unserialize(IMAGE_EXT);
			$filedata=explode('.',$_FILES['avatar']['name']);
           
			$fileext=$filedata[count($filedata)-1];
			
			if(in_array($fileext,$extArray))
			{
				
				//create new dir
				$algo=new Algoencryption();	
				$newdir=$algo->encrypt("USER_".$_POST['userId']);
				if(!is_dir($uploaddir.$newdir))
				{
					
					$oldmask = umask(0);
					mkdir($uploaddir.$newdir,0777);
					umask($oldmask);
					
					
				}
				
				//checking if file name is exist or not
				$filename=md5(rand()).'.'.$fileext;
				$file = $uploaddir.$newdir.'/'.$filename;
				while(file_exists($file))
				{
					$filename=md5(rand()).'.'.$fileext;
					$file = $uploaddir.$newdir.'/'.$filename;
				}
				if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file))
				{
					chmod($file, 0777);
					list($width,$height) = getimagesize($file);
					if($width > 90 || $height > 90)
					{
						$generalObj=new General();
						$generalObj->resizeImage($file, $file, 90, 90);
					}
					
					$response_data['status']=0;
					$response_data['result']=$filename;
					$response_data['dir']=$newdir;
					$response_data['message']='Success';
					return $response_data;
				}
				else
				{
					$response_data['status']=$this->errorCode['_INVALID_PARAMETERS_'];
					$response_data['message']=$this->msg['_FILE_UPLOAD_ERROR_'];
					$response_data['result']=$this->msg['_FILE_UPLOAD_ERROR_'];
					return $response_data;
				}
			}
			else
			{
				
				$response_data['status']=$this->errorCode['_INVALID_EXTENSION_'];
				$response_data['message']=$this->msg['_INVALID_EXTENSION_'];
				$response_data['result']=$this->msg['_INVALID_EXTENSION_'];
				return $response_data;
			}
        }
		}
		
	}
	
	public function getAllPaginatedUsers($limit=5,$sortType="desc",$sortBy="id",$keyword=NULL,$startDate=NULL,$endDate=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$dateSearch = '';
		if(isset($keyword) && $keyword != NULL )
		{
			$keyword = mysql_escape_string($keyword);
			$search = " and (email like '%".$keyword."%')";	
		}
		if(isset($startDate) && $startDate != NULL && isset($endDate) && $endDate != NULL)
		{
			$dateSearch = " and createdAt > '".date("Y-m-d",strtotime($startDate))."' and createdAt < '".date("Y-m-d",strtotime($endDate))."'";	
		}
		
	    $sql_users = "select * from users where ( isVerified!=1 or isVerified=1 )".$search." ".$dateSearch." order by ".$sortBy." ".$sortType." " ;
		
		 $sql_count = "select count(*) from users where isVerified!=1 or isVerified=1 ".$search." ".$dateSearch." ";
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
	
	public function getPaginatedAdvisorList($limit=10,$sortType="desc",$sortBy="u.id",$keyword=NULL,$country=NULL,$city=NULL,$industry=NULL,$area_of_expertise=NULL,$mentorship_experience=NULL,$advisorType=NULL)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$searchIndustry = '';
		
		$keyArr = explode(" ",$keyword);
		
		$keyword = mysql_escape_string($keyword);
		
		if($mentorship_experience == "10" )
		{
			$mentorship_experience = "10 +";
		}
		
		if(isset($keyword) && $keyword != "")
		{
			
			$keyword = mysql_escape_string($keyword);
			$keyword = strip_tags($keyword);
			$industryObj = new Industry();
			$industyArray = $industryObj->searchIndustryByName($keyword);
		
			for($j=0;$j<count($industyArray);$j++)
			{
				$searchIndustry .= " or  a.industry like '%".$industyArray[$j]['industry']."%'  ";
			}
			
			for($i=0;$i<count($keyArr);$i++)
			{
				if(isset($keyArr[$i]) && $keyArr[$i] != NULL )
				{
					if($i==0)
					{
						$cond = 'and';
					}
					else
					{
						$cond = 'and';
					}
					$keyArr[$i] = mysql_escape_string($keyArr[$i]);
					
					$search .= " ".$cond." (CONCAT(u.firstName,u.lastName) like '%".$keyArr[$i]."%' or CONCAT(u.lastName,u.firstName) like '%".$keyArr[$i]."%' or CONCAT(u.lastName,' ',u.firstName) like '%".$keyArr[$i]."%' or CONCAT(u.firstName,' ',u.lastName) like '%".$keyArr[$i]."%' or u.firstName like '%".$keyArr[$i]."%' or u.lastName like '%".$keyArr[$i]."%' or u.email like '%".$keyArr[$i]."%' or  u.country like '%".$keyArr[$i]."%' or  u.city like '%".$keyArr[$i]."%' or a.industry like '%".$keyArr[$i]."%' or a.area_of_expertise like '%".$keyArr[$i]."%' or a.mentorship_details like '%".$keyArr[$i]."%' or a.my_pitch like '%".$keyArr[$i]."%' or a.work_status like '%".$keyArr[$i]."%' or a.help like '%".$keyArr[$i]."%' or a.organisation like '%".$keyArr[$i]."%' or a.motivation like '%".$keyArr[$i]."%' or a.hearabout like '%".$keyArr[$i]."%'".$searchIndustry."  )";
					
				}
			}  
		
		}
		
		if(isset($country) && $country != NULL)
		{
			$country = " and u.country like '%".$country."%' ";	
		}
		if(isset($city) && $city != NULL)
		{
			$city = " and u.city like '%".$city."%' ";	
		}
		if(isset($industry) && $industry != NULL)
		{
			$industry = " and a.industry like '%".$industry."%' ";	
		}
		if(isset($area_of_expertise) && $area_of_expertise != NULL)
		{
			$area_of_expertise = " and a.area_of_expertise like '%".$area_of_expertise."%' ";	
		}
		if(isset($mentorship_experience) && $mentorship_experience != NULL)
		{
			$mentorship_experience = " and a.mentorship_experience like '%".$mentorship_experience."%' ";	
		}
		if(isset($advisorType) && $advisorType != NULL)
		{
			$advisorType = " and a.advisorType = '".$advisorType."' ";	
		}
		
		$sql_users = "select i.industry_name, u.id as user_id,(select avg(average) as average from reviews where advisor_id = u.id) as rating ,u.*,a.* from users u LEFT JOIN advisors a ON ( a.userId = u.id ) LEFT JOIN industry i ON ( i.industry = a.industry )  where u.isVerified=1 and u.userType = 2 ".$search." ".$country." ".$city." ".$industry."  ".$area_of_expertise."  ".$mentorship_experience."  ".$advisorType." order by ".$sortBy." ".$sortType." " ;
		
		$sql_count = "select count(*) from users u LEFT JOIN advisors a ON ( a.userId = u.id )  where u.isVerified=1 and u.userType = 2 ".$search." ".$country." ".$city." ".$industry."  ".$area_of_expertise."  ".$mentorship_experience ." ".$advisorType." ";
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>5,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'advisors'=>$item->getData());
	}
	
	public function getPaginatedEntReviewList($limit=10,$sortType="desc",$sortBy="u.id",$keyword=NULL,$userId)
	{
 		$criteria = new CDbCriteria();
		$search = '';
		$keyword = mysql_escape_string($keyword);
		
		if(isset($keyword) && $keyword != NULL )
		{
			$search = " and (u.firstName like '%".$keyword."%' or u.lastName like '%".$keyword."%' or u.email like '%".$keyword."%' or  u.country like '%".$keyword."%' or  u.city like '%".$keyword."%')";	
		}
		
		$sql_users = "select u.id as user_id,u.*,e.*,r.*,r.createdAt as reviewDate from users u LEFT JOIN entrepreneurs e ON ( e.userId = u.id ) LEFT JOIN reviews r ON ( r.entrepreneur_id = u.id ) where r.advisor_id = ".$userId." and r.status = 1  ". $search."  order by ".$sortBy." ".$sortType." " ;
		
		$sql_count = "select count(*) from users u LEFT JOIN entrepreneurs e ON ( e.userId = u.id ) LEFT JOIN reviews r ON ( r.entrepreneur_id = u.id ) where r.advisor_id = ".$userId." and r.status = 1  ". $search."  order by ".$sortBy." ".$sortType." " ;
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>LIMIT_10,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'entrepreneurs'=>$item->getData());
	}
	
	public function getAdvisorList()
	{
		$result	=	Yii::app()->db->createCommand()
							->select("u.id as advisorID,u.*,a.*")
							->from('users u')
							->leftjoin('advisors a', 'a.userId=u.id')
							->leftjoin('reviews r', 'r.advisor_id=u.id')
							->where('userType=:userType and isVerified=:isVerified', array(':userType'=>2,':isVerified'=>1))
							->group('a.area_of_expertise')
							->order('r.average desc') 
							->limit('9')
							->queryAll();
		return $result;
	}
	
	
	public function getPaginatedPendingReviewList()
	{
		$criteria = new CDbCriteria();
		
		
		if(isset(Yii::app()->session['fmuserId']) && Yii::app()->session['fmuserId'] != '')
		{
		  $sql_users = "
select *,u.id as advisorID,m.createdAt as messageDate from messages m left join  users u on (u.id = m.sender_id)  left join  advisors a on (u.id = a.userId) where m.receiver_id = ".Yii::app()->session['fmuserId']." and m.status = 6 and 0 = (select count(review_id) from reviews where advisor_id =  m.sender_id and entrepreneur_id = ".Yii::app()->session['fmuserId'].") and u.userType = 2 group by u.email;" ;
		
		$sql_count = "select count(*) from messages m left join  users u on (u.id = m.sender_id)  left join  advisors a on (u.id = a.userId) where m.receiver_id = ".Yii::app()->session['fmuserId']." and m.status = 6 and 0 = (select count(review_id) from reviews where advisor_id =  m.sender_id and entrepreneur_id = ".Yii::app()->session['fmuserId'].") and u.userType = 2  group by u.email;" ;
		
		$count	=	Yii::app()->db->createCommand($sql_count)->queryScalar();
		
		$item	=	new CSqlDataProvider($sql_users, array(
						'totalItemCount'=>$count,
						'pagination'=>array(
							'pageSize'=>LIMIT_10,
						),
					));
		$index = 0;	
		return array('pagination'=>$item->pagination, 'advisorList'=>$item->getData());
		}
		else
		{
			return 0;
		}
	}
	
	public function getProfileDataForEntrepreneur($id)
	{
		$result	=	Yii::app()->db->createCommand()
							->select("u.id as user_id,u.*,e.*,i.industry_name")
							->from('users u')
							->leftjoin('entrepreneurs e', 'e.userId=u.id')
							->leftjoin('industry i', 'i.industry=e.industry')
							->where('u.id=:id', array(':id'=>$id))
							->queryRow();
		return $result;
	}
	
	public function getProfileDataForAdvisor($id)
	{
		$result	=	Yii::app()->db->createCommand()
							->select("u.id as user_id,u.*,a.*,i.industry_name")
							->from('users u')
							->leftjoin('advisors a', 'a.userId=u.id')
							->leftjoin('industry i', 'i.industry=a.industry')
							->where('u.id=:id', array(':id'=>$id))
							->queryRow();
		return $result;
	}
	
	public function getUserId($id=NULL)
	{
		//echo "userId".$id;
		$result = Yii::app()->db->createCommand()
    	->select('*')
    	->from($this->tableName())
   	 	->where('id=:id', array(':id'=>$id))	
   	 	->queryRow();
		
		//print_r($result);
		return $result;
	}
	
	
	public function getAllUsers()
	{
		$result = Yii::app()->db->createCommand()
    	->select('*')
    	->from($this->tableName())
   	 	->queryAll();
		return $result;
	}
	
	function changePassword($data = array())
	{
		if(!empty($data))
		{
			if($data['newpassword']=='' || strlen($data['newpassword'])<6)
			{
				return array(false,Yii::app()->params->msg['_PASSWORD_LENGTH_ERROR_'],68);
			}
			if($data['newpassword']!=$data['confirmpassword'])
			{
				return array(false,Yii::app()->params->msg['_BOTH_PASSWORD_NOT_METCH_'],70);
			}
			if($data['oldpassword']==$data['newpassword'])
			{
				return array(false,Yii::app()->params->msg['_OLD_NEW_PASSWORD_SAME_'],114);
			}
			
			if(!is_numeric($data['userId'])){
				$algoencryptionObj	=	new Algoencryption();
				$data['userId']	=	$algoencryptionObj->decrypt($data['userId']);
			}
			$res = $this->getUserDetail($data['userId']);
			$userData = $res['result'];
			$generalObj = new General();
			
			if($generalObj->validate_password($data['oldpassword'],$userData['password']))
			{
				$res = true;
			}
			else
			{
				$res = false;
			}
			if($res==true)
			{
				
				$userObj=Users::model()->findbyPk($data['userId']);
				$password = $generalObj->encrypt_password($data['newpassword']);
				$arr = array();
				$arr['password'] = $password;
				$userObj->setData($arr);
				$userObj->insertData($data['userId']);
				return array(true,Yii::app()->params->msg['_PASSWORD_CHANGE_SUCCESS_'],0);
			}
			else
			{
				return array(false,Yii::app()->params->msg['_OLD_PASSWORD_NOT_METCH_'],69);
			}
		}
		else
		{
			echo "<pre>";
			print_r($data);
			exit;	
		}
	}
	
	function deleteUsers($id)
	{
		
		$result = Yii::app()->db->createCommand()
    	->select('*')
    	->from($this->tableName())
   	 	->where('id=:id', array(':id'=>$id))	
   	 	->queryRow();
		
		
		$userObj=Users::model()->findbyPk($id);
		$userObj->delete();		
		
		if(isset($result) && $result['userType'] == 1)
		{
			$sql_users = "delete from entrepreneurs where userId=".$id."" ;
			$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		}
		
		if(isset($result) && $result['userType'] == 2)
		{
			$sql_users = "delete from advisors where userId=".$id."" ;
			$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		}
		
		$sql_users = "delete from messages where sender_id=".$id."" ;
		$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		
		$sql_users = "delete from messages where receiver_id=".$id."" ;
		$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		
		$sql_users = "delete from reviews where advisor_id=".$id."" ;
		$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		
		$sql_users = "delete from reviews where entrepreneur_id=".$id."" ;
		$count	=	Yii::app()->db->createCommand($sql_users)->execute();
		
	}
	
	
	
}