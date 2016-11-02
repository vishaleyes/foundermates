<?php
define('API_KEY',      '33zh76ttu3th');
define('API_SECRET',   'b1IGg4beAWJawsnE');
define('REDIRECT_URI', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'].'?r=site/registerWithLinkedin');
define('SCOPE',        'r_fullprofile r_emailaddress');
define('TYPE','');
error_reporting(0);
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 private $arr = array("rcv_rest" => 200370,"rcv_rest_expire" => 200371,"send_sms" => 200372,"rcv_sms" => 200373,"send_email" => 200374,"todo_updated" => 200375, "reminder" => 200376, "notify_users" => 200377,"rcv_rest_expire"=>200378,"rcv_android_note"=>200379,"rcv_iphone_note"=>200380);
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	 
	public function beforeAction()
	{
		/*if(isset(Yii::app()->session['fmuserId']))
		{
			if(Yii::app()->session['userType'] == 1)
			{
				$this->redirect(Yii::app()->params->base_path."entrepreneur/getAdvisorList");
			}
			else
			{
				$this->redirect(Yii::app()->params->base_path."advisor/index");
			}
				exit;
		}*/
		return true;
	}
	 
	public function actionIndex()
	{
		
		if(isset(Yii::app()->session['fmuserId']))
		{
			if(Yii::app()->session['userType'] == 1)
			{
				$this->redirect(Yii::app()->params->base_path."entrepreneur/");
			}
			else
			{
				$this->redirect(Yii::app()->params->base_path."advisor/index");
			}
				exit;
		}
		else
		{			
			$options	=	array();
			$genralObj	=	new General();
			
			$site=_SITENAME_NO_CAPS_;
			
			$userObj = new Users();
			$data = $userObj->getAdvisorList();
			
			Yii::app()->session['loginflag']	=	0;
			Yii::app()->session['currentTab']	=	'Home';
			$this->render('index',array('site'=>$site,'data'=>$data));
		}
	}
	
	function actionadvisorlogin()
	{
		if(Yii::app()->session['userType'] == 2)
		{
			$this->redirect(Yii::app()->params->base_path."advisor/index");
		}
		
		Yii::app()->session['currentTab'] = 'Home';
		if(isset($_POST['submitLogin']))
		{
			
			$email_login = $_POST['email'];
			$password_login = $_POST['password'];
			$userType = $_POST['userType'];
			$time = time();
			
			if(isset($_POST['remember']) && $_POST['remember'] == 'on')
				{
					setcookie("email", $_POST['email'], $time + 3600);
        			setcookie("password", $_POST['password'], $time + 3600);
				}
			
			$Userobj=new Users();		
			$result = $Userobj->login(trim($email_login),$password_login);
			
			if(isset($result) && $result['status'] == 0)
			{
				$userData = $Userobj->findByPk($result['userId']);
				$type = $userData->userType;
				
				if($type == $userType)
				{
					$this->redirect(array('advisor/index'));
				}
				else
				{
					Yii::app()->session->destroy();
					Yii::app()->user->setFlash('error',"Invalid User");
					$this->redirect(array('site/advisorlogin'));
				}
				
			}
			else
			{
				Yii::app()->user->setFlash('error', $result['message']);
				$this->redirect(array('site/advisorlogin'));
			}
			
		}
		
		$this->render('advisorlogin');
	}
	
	function actionentlogin()
	{
		if(Yii::app()->session['userType'] == 1)
		{
			$this->redirect(Yii::app()->params->base_path."entrepreneur/getAdvisorList");
		}
		
		Yii::app()->session['currentTab'] = 'Home';
		if(isset($_POST['submitLogin']))
		{
			$email_login = $_POST['email'];
			$password_login = $_POST['password'];
			$userType = $_POST['userType'];
			$time = time();
			
			if(isset($_POST['remember']) && $_POST['remember'] == 'on')
			{
				setcookie("email", $_POST['email'], $time + 3600);
				setcookie("password", $_POST['password'], $time + 3600);
			}
			
			$Userobj=new Users();		
			$result = $Userobj->login(trim($email_login),$password_login);
			
			if($result['status'] == 0)
			{
				$userData = $Userobj->findByPk($result['userId']);
				$type = $userData->userType;
				
				
				if($type == $userType)
				{
					$entObj = new Entrepreneurs();
					$res = $entObj->checkProfileStatus($result['userId']);
					
					if($res == 0)
					{
						$this->redirect(array('entrepreneur/index'));
					}
					else
					{
						$this->redirect(array('entrepreneur/getAdvisorList'));
					}
				}
				else
				{
					Yii::app()->session->destroy();
					Yii::app()->user->setFlash('error',"Invalid User");
					$this->redirect(array('site/entlogin'));
				}
				
				
			}
			else
			{
				Yii::app()->user->setFlash('error', $result['message']);
				$this->redirect(array('site/entlogin'));
			}
		}
		$this->render('entlogin');
	}
	
	
	function actionregisterAdvisorFirst()
	{
		Yii::app()->session['currentTab'] = 'Home';
		$this->render("advisorsignup_first_step");
	}
	
	function actionregisterEnterpreneurFirst()
	{
		Yii::app()->session['currentTab']	=	'Home';
		$this->render("entsignup_first_step");
	}
	
	function actionregisterEnterpreneur()
	{
		error_reporting(0);
		global $msg;	
		Yii::app()->session['currentTab'] = 'Home';
		if(isset($_POST['submitEnt']))
		{
			$_POST['avatar']=$_FILES['userImage']['name'];
			$_POST['tmp_name']=$_FILES['userImage']['tmp_name'] ;
			
			$_POST['firstName'] = trim($_POST['firstName']);
			$_POST['lastName'] = trim($_POST['lastName']);
			$_POST['email'] = trim($_POST['email']);
			$_POST['email'] = trim($_POST['email']);
			
			$validationOBJ = new Validation();
			$result = $validationOBJ->registerEnterpreneur($_POST);
			if($result['status']==0)
			{
				$userObj = new Users();
				$userData	=	$userObj->getUserIdByLoginId($_POST['email']);
				
				if(empty($userData))
				{
					$userObj = new Users();
					$userResponse	=	$userObj->addRegisterUser($_POST);
					
					if($userResponse['status'] == 0)
					{
						unset(Yii::app()->session['fmuserId']);
						Yii::app()->user->setFlash('success',"We have sent a verification email to your email address.");
						$this->render("entsignup");
					}
					else
					{	
						Yii::app()->user->setFlash("error",$result['message']);
						$this->render("entsignup",$_POST);
						exit;
					}	
				}
				else
				{	
					Yii::app()->user->setFlash("error","Email already exist.");
					$this->render("entsignup",$_POST);
					exit;
				}
			}
			else
			{
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("entsignup",$_POST);
			}
		}
		else
		{
			$this->render("entsignup");
		}
	}
	
	
	
	
	function actionregisterAdvisorStep2()
	{
		
		if((isset($_REQUEST['firstName']) && trim($_REQUEST['firstName']) == '') || (isset($_REQUEST['lastName']) && trim($_REQUEST['lastName']) == '') || (isset($_REQUEST['email']) && trim($_REQUEST['email']) == '') || (isset($_REQUEST['city']) && $_REQUEST['city'] == '') || (isset($_REQUEST['country']) && $_REQUEST['country'] == '') || (isset($_REQUEST['password']) && $_REQUEST['password'] == '') || (isset($_REQUEST['organisation']) && $_REQUEST['organisation'] == '')  || (isset($_REQUEST['work_status']) && $_REQUEST['work_status'] == '')  || (isset($_REQUEST['industry']) && $_REQUEST['industry'] == '')) 
		{
			Yii::app()->user->setFlash('error',"Please fill all the required fields.");	
			$this->render("advisorsignup",$_REQUEST);
			exit;
		}
		
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		if(isset($_REQUEST['area_of_expertise']) && $_REQUEST['area_of_expertise'] != '' && is_array($_REQUEST['area_of_expertise'])) 
		{
			
			$cnt = count($_REQUEST['area_of_expertise']);
			if($cnt == 0)
			{
				Yii::app()->user->setFlash('error',"Please select at least one skills.");	
				$this->render("advisorsignup",$_REQUEST);
				exit;
			}
			else if( $cnt > 4 )
			{
				Yii::app()->user->setFlash('error',"You can only select 4 skills at a time");	
				$this->render("advisorsignup",$_REQUEST);
				exit;
			}
		}
		else
		{
			Yii::app()->user->setFlash('error',"Please select at least one skills.");	
			$this->render("advisorsignup",$_REQUEST);
			exit;
		}
		
		
		$userObj = new Users();
		$res = $userObj->getUserIdByLoginId($_REQUEST['email']);
		if(isset($res['email']) && $res['email']  != '' )
		{
			$_SESSION = array();
			Yii::app()->session['currentTab']	=	'Home';
			Yii::app()->user->setFlash("error","Email already exist.");
			$industryObj = new Industry();
			$industryData = $industryObj->getIndustryList();
			$data['industryData'] = $industryData;
			$this->render("advisorsignup",$_REQUEST);
			exit;
		}
		
		Yii::app()->session['currentTab'] = 'Home';
		Yii::app()->session['advisorSignup'] = $_POST;
		
		if(isset($_FILES['userImage']['name']) && !empty($_FILES['userImage']['name']))
		{
			$userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
			Yii::app()->session['userImage'] = $_FILES;
		}
		
		$this->render("advisorsignupstep3",$_REQUEST);
	}
	
	function actionregisterEntStep2()
	{
		
		if( (isset($_POST['firstName']) && $_POST['firstName'] == '') || (isset($_POST['email']) && $_POST['email'] == '') || (isset($_POST['lastName']) && $_POST['lastName'] == '') || (isset($_POST['country']) && $_POST['country'] == '') || (isset($_POST['city']) && $_POST['city'] == '') || (isset($_POST['industry']) && $_POST['industry'] == '') )
		{
			Yii::app()->user->setFlash("error","Please fill all required field.");
			$this->render("entsignup",$_POST);
			exit;
		}
		
		$userObj = new Users();
		$res = $userObj->getUserIdByLoginId($_POST['email']);
		
		if(isset($res['email']) && $res['email']  != '' )
		{
			Yii::app()->user->setFlash("error","Email already exist.");
			$this->render("entsignup",$_POST);
			exit;
		}
		
		Yii::app()->session['currentTab'] = 'Home';
		Yii::app()->session['entSignup'] = $_POST;
		
		if(isset($_FILES['userImage']['name']) && !empty($_FILES['userImage']['name']))
		{
			$userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
					
			Yii::app()->session['userImage'] = $_FILES;
		}
		
		$this->render("entsignupstep3");
	}
	
	function actionFinalRegistrationForAdvisor()
	{
		
		if((isset($_POST['phone']) && $_POST['phone'] == '') || (isset($_POST['help']) && $_POST['help'] == '') || (isset($_POST['startups']) && $_REQUEST['startups'] == '') || (isset($_POST['startup_experience']) && $_POST['startup_experience'] == '') || (isset($_POST['motivation']) && $_POST['motivation'] == '') || (isset($_POST['hearabout']) && $_POST['hearabout'] == '') || (isset($_POST['mentorship_experience']) && $_POST['mentorship_experience'] == '') || (isset($_POST['my_pitch']) && $_REQUEST['my_pitch'] == ''))
		{
			$industryObj = new Industry();
			$industryData = $industryObj->getIndustryList();
			$_POST['industryData'] = $industryData;
			Yii::app()->user->setFlash('error',"Please fill all the required fields.");	
			$this->render("advisorsignupstep3",$_POST);
			exit;
		}
		
		Yii::app()->session['currentTab'] = 'Home';
		if(isset(Yii::app()->session['advisorSignup']) &&  !empty(Yii::app()->session['advisorSignup']))
		{
			$data = array_merge(Yii::app()->session['advisorSignup'],$_POST);
		}
		else
		{
			$data = $_POST;
		}
		$validationOBJ = new Validation();
		$result = $validationOBJ->registerAdvisor($data);
		$userObj = new Users();
		if(!isset($data['email']))
		{
			$_SESSION = array();
			Yii::app()->session['currentTab']	=	'Home';
			Yii::app()->user->setFlash("error",$result['message']);
			$industryObj = new Industry();
			$industryData = $industryObj->getIndustryList();
			$data['industryData'] = $industryData;
			$this->render("advisorsignupstep3",$data);
		}
		
		if($result['status']==0)
		{
			
			$userObj = new Users();
			$res = $userObj->getUserIdByLoginId($data['email']);
			if(isset($res['email']) && $res['email']  != '' )
			{
				$_SESSION = array();
				Yii::app()->session['currentTab']	=	'Home';
				Yii::app()->user->setFlash("error","Email already exist.");
				$industryObj = new Industry();
				$industryData = $industryObj->getIndustryList();
				$data['industryData'] = $industryData;
				$this->render("advisorsignup",$data);
				exit;
			}
			
			$userObj = new Users();
			$userResponse	=	$userObj->addRegisterUser($data);
			unset(Yii::app()->session['advisorSignup']);
			unset(Yii::app()->session['userImage']);
			if($userResponse['status'] == 0)
			{
				unset(Yii::app()->session['fmuserId']);
				Yii::app()->user->setFlash('success',"Thank you for registering your interest to join as an advisor on FounderMates. Your profile has been sent to admin for approval.");
				//$this->render("advisorsignup",array('industryData'=>$industryData));
				$this->redirect(array("site/index"));
			}
			else
			{	
				Yii::app()->session['currentTab']	=	'Home';
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("advisorsignupstep3",$data);
				exit;
			}
		}
		else
			{
				Yii::app()->session['currentTab']	=	'Home';
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("advisorsignupstep3",$data);
			}
		exit;
	}
	
	function actionFinalRegistrationForEnt()
	{
		
		if( (isset($_POST['password']) && $_POST['password'] == '') || (isset($_POST['cpassword']) && $_POST['cpassword'] == '') || (isset($_POST['business_stage']) && $_POST['business_stage'] == '') || (isset($_POST['need_from_mentor']) && $_POST['need_from_mentor'] == '') || (isset($_POST['website']) && $_POST['website'] == '') || (isset($_POST['idea']) && $_POST['idea'] == ''))
		{
			Yii::app()->user->setFlash("error","Please enter all mandatory field.");
			$this->render("entsignupstep3",$_POST);
			exit;
		}
		
		if($_POST['password'] != $_POST['cpassword'])
		{
			Yii::app()->user->setFlash("error","Password and confirm password do not match.");
			$this->render("entsignupstep3",$_POST);
			exit;
		}
		
		
		
		Yii::app()->session['currentTab'] = 'Home';
		$data = array_merge(Yii::app()->session['entSignup'],$_POST);
		$validationOBJ = new Validation();
		$result = $validationOBJ->registerEnterpreneur($data);
		
		
		if($result['status']==0)
		{
			$userObj = new Users();
			$res = $userObj->getUserIdByLoginId($data['email']);
			
			if(isset($res['email']) && $res['email']  != '' )
			{
				Yii::app()->user->setFlash("error","Email already exist.");
				$this->render("entsignup",$data);
				exit;
			}
			
			$userObj = new Users();
			$userResponse	=	$userObj->addRegisterUser($data);
			unset(Yii::app()->session['entSignup']);
			unset(Yii::app()->session['userImage']);
			if($userResponse['status'] == 0)
			{
				unset(Yii::app()->session['fmuserId']);
				Yii::app()->user->setFlash('success',"Thank you for registering your interest to join as an entrepreneur on FounderMates. Your profile has been sent to admin for approval.");
				//$this->render("advisorsignup",array('industryData'=>$industryData));
				$this->redirect(array("site/index"));
			}
			else
			{	
				Yii::app()->session['currentTab']	=	'Home';
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("entsignupstep3",$data);
				exit;
			}
		}
		else
			{
				Yii::app()->session['currentTab']	=	'Home';
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("entsignupstep3",$data);
			}
		exit;
	}
	
	
	function actionregisterAdvisor()
	{
		error_reporting(E_ALL);
		
		Yii::app()->session['currentTab'] = 'Advisor Signup';
		global $msg;	
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		if(isset($_POST['submitAdvisor']))
		{
			$_POST['industryData'] = $industryData;
			$_POST['avatar']=$_FILES['userImage']['name'];
			$_POST['tmp_name']=$_FILES['userImage']['tmp_name'] ;
			
			$validationOBJ = new Validation();
			$result = $validationOBJ->registerAdvisor($_POST);
			
			if($result['status']==0)
			{
				$userObj = new Users();
				$userData	=	$userObj->getUserIdByLoginId($_POST['email']);
				
				if(empty($userData))
				{
					$userObj = new Users();
					$userResponse	=	$userObj->addRegisterUser($_POST);
					
					if($userResponse['status'] == 0)
					{
						unset(Yii::app()->session['fmuserId']);
						Yii::app()->user->setFlash('success',"We have sent a verification email to your email address.");
						$this->render("advisorsignup",array('industryData'=>$industryData));
					}
					else
					{	
						
						Yii::app()->user->setFlash("error",$result['message']);
						$this->render("advisorsignup",$_POST);
						exit;
					}	
				}
				else
				{	
					Yii::app()->user->setFlash("error","Email already exist.");
					$this->render("advisorsignup",$_POST);
					exit;
				}
			}
			else
			{
				Yii::app()->user->setFlash("error",$result['message']);
				$this->render("advisorsignup",$_POST);
			}
		}
		else
		{
			$this->render("advisorsignup",array('industryData'=>$industryData));
		}
	}
	
	public function actionforgotPassword()
	{
		Yii::app()->session['currentTab'] = 'Forgot Password';
		if(isset($_POST['submitforgotPassword']))
		{
			if(isset($_POST['email']) && $_POST['email'] != "")
			{
				$UserObj = new Users();
				$result=$UserObj->forgot_password($_POST['email'],0,Yii::app()->session['prefferd_language']);
				if($result['status']==0)
				{
					Yii::app()->user->setFlash('success', $result['message']);
					$data = array('message'=>$result['message']);
					$this->redirect(array("site/index"));
				}else{
					Yii::app()->user->setFlash('error', $result['message']);
					$this->redirect(array("site/index"));
				}
			}
			else
			{
				Yii::app()->user->setFlash('error', "Please enter email address.");
				$this->redirect(array("site/index"));	
			}
		}
	}
	
	public function actionresetpassword()
	{
		$data = array();
		$data['token'] = $_GET['token'];
		$userObj = new Users();
		$res = $userObj->getIdByfpasswordConfirm($_GET['token']);
		if(!empty($res) && isset($res['id']))
		{
			$this->render('password_confirm',$data);	
		}
		else
		{
			$data = array('loginId'=>'','message'=>'');
			Yii::app()->user->setFlash("error",'Invalid Token');
			$this->render('index',$data);
		}
		
	}
	
	public function actionsetResetPassword()
	{
			
			$validationOBJ = new Validation();
			$res = $validationOBJ->resetpassword($_POST);
			if($res['status']==0)
			{
				$userObj=new Users();
				$result=$userObj->resetpassword($_POST);
				$message=$result['message'];
				if($result['status']==0)
				{					
					Yii::app()->user->setFlash('success', $result['message']);
					header("Location: ".Yii::app()->params->base_path."site/index");
					exit;
				}
				$data = array('message'=>$result['message']);
			}else
			{
				Yii::app()->user->setFlash('error', $res['message']);
				$this->render('password_confirm',array("$_POST"=>$_POST));
				exit;
			}
		
		if($message!='')
		{
			Yii::app()->user->setFlash('error', $result['message']);
		}
	}
	
	public function actionhowworks()
	{
		Yii::app()->session['currentTab'] = 'How it Works';
		$this->render("howitworks");
	}
	
	public function actionabout()
	{
		Yii::app()->session['currentTab'] = 'Home';
		$this->render("aboutus");
	}
	
	public function actionadvisorFaq()
	{
		Yii::app()->session['currentTab'] = 'Advisor FAQ';
		$this->render("advisorfaq");
	}
	
	public function actionentFaq()
	{
		Yii::app()->session['currentTab'] = 'Entrepreneur FAQ';
		$this->render("entfaq");
	}
	public function actiontos()
	{
		Yii::app()->session['currentTab'] = 'Home';
		$this->render("terms");
	}
	
	
	public function actioncontact()
	{
		
		Yii::app()->session['currentTab'] = 'Contact Us';
		if(isset($_POST['FormSubmit']))
		{
			$userObj=new Users();
			$result=$userObj->contactus($_POST,0,Yii::app()->session['prefferd_language']);
			
			if($result['status']==0)
			{
				Yii::app()->user->setFlash('success', $result['message']);
			}else{
				Yii::app()->user->setFlash('error', $result['message']);
			}
		}
		
		$this->render("contactus");
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		error_reporting(0);
		Yii::app()->session['currentTab'] = 'error';
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
			{
	    		echo $error['message'];
			}
			else
			{
	        	$this->render('error', $error);
				exit;
			}
		}
		$this->render('error', $error);
	}
	
	public function actionverifyAccount($key,$id,$lng='eng')
	{
		global $msg;
		Yii::app()->session['currentTab'] = 'verify Account';
		Yii::app()->session['prefferd_language']=$lng;
		if($key=='' || $id=='')
		{	
			Yii::app()->user->setFlash('error', $msg['MISSING_PARAMETER']);
			$this->redirect(Yii::app()->params->base_path."site/index");
		}
		
	 	$userObj	=	new Users();
		$status	=	$userObj->verifyaccount($key,$id);
		if($status == 1)
		{
			$algoObj= new Algoencryption();
			$pid=$algoObj->decrypt($id);
			
			$userData= Users::model()->findByPk($pid);
			if($userData['userType'] == 1 )
			{
				Yii::app()->user->setFlash('success', $msg['VERIFY_LOG_MSG']);
				$this->redirect(Yii::app()->params->base_path."site/entlogin");	
			} 
			else if($userData['userType'] == 2 )
			{
				Yii::app()->user->setFlash('success', $msg['VERIFY_LOG_MSG']);
				$this->redirect(Yii::app()->params->base_path."site/advisorlogin");	
			}
		}
		else if($status == 2)
		{
			Yii::app()->user->setFlash('error', $msg['LOGIN_MSG']);
			$this->redirect(Yii::app()->params->base_path."user");
		} 
		else if($status == 3)
		{
			Yii::app()->user->setFlash('error', $msg['FAIL_MSG']);
			$this->redirect(Yii::app()->params->base_path."user");
		}
		else
		{
			Yii::app()->user->setFlash('error', $msg['_ACTIVATION_LINK_EXPIRE_']);
			$this->redirect(Yii::app()->params->base_path."user");
		}
	}
	
	function actionreviewAdvisor()
	{
		$this->render("reviewadvisor");
	}
	
	
	function actionregisterWithLinkedin()
	{
		// You'll probably use a database
		session_name('linkedin');
		//session_start();
		
		if(isset($_GET['type']))
		{
			//Yii::app()->session['type'] = $_GET['type'];
			//$_SESSION['user_type'] = $_GET['type'];
			$arr = array();
			$arr['temp_user_type'] = $_GET['type'];
			$TempUserTypeObj = new TempUserType();
			$TempUserTypeObj->setData($arr);
			$TempUserTypeObj->insertData();
		}
		
		// OAuth 2 Control Flow
		if (isset($_GET['error'])) {
			// LinkedIn returned an error
			//print $_GET['error'] . ': ' . $_GET['error_description'];
			Yii::app()->user->setFlash('error',"We are sorry that you changed your mind. We look forward to having you on board with us soon.");
			$this->redirect(array("site/index"));
			exit;
		} elseif (isset($_GET['code'])) {
			// User authorized your application
			if (isset($_SESSION['state']) && $_SESSION['state'] == $_GET['state']) {
				// Get token so you can make API calls
				$this->getAccessToken();
			} else {
				// CSRF attack? Or did you mix up your states?
				Yii::app()->user->setFlash('error',"We are sorry that you changed your mind. We look forward to having you on board with us soon.");
				$this->redirect(array("site/index"));
				exit;
			}
		} else { 
			if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
				// Token has expired, clear the state
				$_SESSION = array();
			}
			if (empty($_SESSION['access_token'])) {
				// Start authorization process
				$this->getAuthorizationCode();
			}
		}
		
		// Congratulations! You have a valid token. Now fetch your profile 
		$user = $this->fetch('GET', '/v1/people/~:(firstName,lastName,headline,email-address,location,picture-url,industry,specialties,role,positions,public-profile-url,volunteer,educations)');
		
		
		
				
		$data = array();
		if(isset($user->firstName)){
			$data['firstName'] = $user->firstName;
		}
		
		if(isset($user->lastName)){
			$data['lastName'] = $user->lastName;
		}
		
		if(isset($user->headline)){
			$data['headline'] = $user->headline;
		}
		
		$data['password'] = '';
		
		if(isset($user->pictureUrl))
		{
			$data['avatarlink'] = $user->pictureUrl;
		}
		
		if(isset($user->location->name))
		{
			$country = explode(',',$user->location->name);
		}
		
		if(isset($user->emailAddress))
		{
			$data['email'] = $user->emailAddress;
		}
		
		if(isset($country[1]))
		{
			$data['country'] = trim($country[1]);
		}
		if(isset($user->location->name))
		{
			$data['city'] = $country[0];
		}
		if(isset($user->industry))
		{
			$data['industry'] = $user->industry;
		}
		if(isset($user->industry))
		{
			$data['industry'] = $user->industry;
		}
		if(isset($user->positions))
		{
			if($user->positions->_total > 0)
			{
				$data['work_status'] = $user->positions->values[0]->title;
			}
		}
		if(isset($user->specialties))
		{
			$data['area_of_expertise'] = $user->specialties;
		}
		if(isset($user->positions))
		{
			if($user->positions->_total > 0)
			{
				$data['organisation'] = $user->positions->values[0]->company->name;
			}
		}
		
		if(isset($user->publicProfileUrl))
		{
			
			$data['linkedinLink'] = $user->publicProfileUrl;
			
		}
		
		
		/*$data['organization'] = $user->organization;
		$data['positions'] = $user->positions;
		$data['specialties'] = $user->specialties;
		$data['role'] = $user->role;*/
		
		$TempUserTypeObj = new TempUserType();
		$UserType = $TempUserTypeObj->getLastUserType();
		
			
		$TempUserTypeObj = new TempUserType();
		$TempUserTypeObj->deleteAllData();
		
		
		//deleteAllData
		$data['userType'] = $UserType['temp_user_type'];
		$_SESSION['userType'] = $UserType['temp_user_type'];
		$userObj = new Users();
		$userData	=	$userObj->getUserIdByLoginId($data['email']);
		//unset(Yii::app()->session['type']);		
		
		if($_SESSION['userType'] == 1)
		{
			Yii::app()->session['currentTab'] = 'Home';
			$userObj = new Users();
			$userData	=	$userObj->getUserIdByLoginId($data['email']);
				
			if(empty($userData))
			{
				$_SESSION = array();
				$this->render("entsignup",$data);
			}
			else
			{
				$_SESSION = array();
				Yii::app()->user->setFlash('error', "Email already registered.");
				$this->redirect(array("site/registerEnterpreneurFirst"));
			}
			
		}
		else
		{	
			Yii::app()->session['currentTab'] = 'Home';
			$userObj = new Users();
			$userData	=	$userObj->getUserIdByLoginId($data['email']);
				
			if(empty($userData))
			{
				$_SESSION = array();
				$this->render("advisorsignup",$data);
			}
			else
			{
				$_SESSION = array();
				Yii::app()->user->setFlash('error', "Email already registered.");
				$this->redirect(array("site/registerAdvisorFirst"));
			}
		}
		/*if(empty($userData))
		{
			$userObj = new Users();
			$userResponse	=	$userObj->addRegisterUser($data);
		}
		$userObj = new Users();
		$userData	=	$userObj->getUserIdByLoginId($data['email']);
		Yii::app()->session['fmuserId']=$userData['id'];
		Yii::app()->session['fmloginId']=$data['email'];
		
		if(!empty($data))
		{
			Yii::app()->session['fullname'] =$data['firstName'].'&nbsp;'.$data['lastName'];
			Yii::app()->session['firstName']=$data['firstName'];
			
		}
		else
		{
			Yii::app()->session['fullname']='Username';
		}
			
		Yii::app()->session['userType'] =  $data['userType'];
		Yii::app()->session['email'] =  $data['email'];
		
		if($_SESSION['userType'] == 1)
		{
			$this->redirect(array("Entrepreneur/index"));
		}
		else
		{
			$this->redirect(array("Advisor/index"));
		}*/
		//$this->redirect(array("site/fetchEntrepreneurData"));
	}
	
	
	function getAuthorizationCode() {
		$params = array('response_type' => 'code',
						'client_id' => API_KEY,
						'scope' => SCOPE,
						'state' => uniqid('', true), // unique long string
						'redirect_uri' => REDIRECT_URI,
				  );
	
		// Authentication request
		 $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
		
		// Needed to identify request when it returns to us
		$_SESSION['state'] = $params['state'];
	
		// Redirect user to authenticate
		header("Location: $url");
		exit;
	}
	
	function getAccessToken() {
		$params = array('grant_type' => 'authorization_code',
						'client_id' => API_KEY,
						'client_secret' => API_SECRET,
						'code' => $_GET['code'],
						'redirect_uri' => REDIRECT_URI,
				  );
		
		// Access Token request
		 $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
		
		// Tell streams to make a POST request
		$context = stream_context_create(
						array('http' => 
							array('method' => 'POST',
							)
						)
					);
	
		// Retrieve access token information
		$response = file_get_contents($url, false, $context);
	
		// Native PHP object, please
		$token = json_decode($response);
	
		// Store access token and expiration time
		$_SESSION['access_token'] = $token->access_token; // guard this! 
		$_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
		$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
		
		return true;
	}				

	function fetch($method, $resource, $body = '') {
		$params = array('oauth2_access_token' => $_SESSION['access_token'],
						'format' => 'json',
				  );
		
		// Need to use HTTPS
		$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
		// Tell streams to make a (GET, POST, PUT, or DELETE) request
		$context = stream_context_create(
						array('http' => 
							array('method' => $method,
							)
						)
					);
	
	
		// Hocus Pocus
		$response = file_get_contents($url, false, $context);
	
		// Native PHP object, please
		return json_decode($response);
	}
	
	
	public function actionfetchEntrepreneurData()
	{
		// You'll probably use a database
		//session_name('linkedin');
		//session_start();
		
		// OAuth 2 Control Flow
		if (isset($_GET['error'])) {
			// LinkedIn returned an error
			print $_GET['error'] . ': ' . $_GET['error_description'];
			exit;
		} elseif (isset($_GET['code'])) {
			// User authorized your application
			if ($_SESSION['state'] == $_GET['state']) {
				// Get token so you can make API calls
				$this->getAccessToken();
			} else {
				// CSRF attack? Or did you mix up your states?
				exit;
			}
		} else { 
			if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
				// Token has expired, clear the state
				$_SESSION = array();
			}
			if (empty($_SESSION['access_token'])) {
				// Start authorization process
				$this->getAuthorizationCode();
			}
		}
		
		// Congratulations! You have a valid token. Now fetch your profile 
		$user = $this->fetch('GET', '/v1/people/~:(firstName,lastName,email-address,location,picture-url,industry,organization,positions,specialties,role)');
		
		$data = array();
		$data['firstName'] = $user->firstName;
		$data['lastName'] = $user->lastName;
		$data['email'] = $user->emailAddress;
		$data['country'] = $user->location->country->code;
		$data['city'] = $user->location->name;
		$data['userType'] = $_SESSION['user_type'];
		$userObj = new Users();
		$userData	=	$userObj->getUserIdByLoginId($data['email']);
		//unset(Yii::app()->session['type']);		
		if(empty($userData))
		{
			$userObj = new Users();
			$userResponse	=	$userObj->addRegisterUser($data);
		}
		$userObj = new Users();
		$userData	=	$userObj->getUserIdByLoginId($data['email']);
		Yii::app()->session['fmuserId']=$userData['id'];
		Yii::app()->session['fmloginId']=$data['email'];
		
		if(!empty($data))
		{
			Yii::app()->session['fullname'] =$data['firstName'].'&nbsp;'.$data['lastName'];
			Yii::app()->session['firstName']=$data['firstName'];
			
		}
		else
		{
			Yii::app()->session['fullname']='Username';
		}
			
		Yii::app()->session['userType'] =  $data['userType'];
		Yii::app()->session['email'] =  $data['email'];
		
		if($_SESSION['user_type'] == 1)
		{
			$this->redirect(array("Entrepreneur/index"));
		}
		else
		{
			$this->redirect(array("Advisor/index"));
		}
		exit;
	}
	
	public function actionshowAdvisorProfile($userId)
	{
		if(isset($userId) && $userId != '')
		{
			Yii::app()->session['currentTab']	=	'Home';
			
			$alogObj = new Algoencryption();
			
			$userId =  $alogObj->decrypt($userId);
			
			if(!is_numeric($userId))
			{
				$this->redirect(array("site/error"));
				exit;
			}
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForAdvisor($userId);
			
			if(empty($profileData))
			{
				$this->redirect(array("site/error"));
				exit;
			}
			/*echo "<pre>";
			print_r($profileData);
			exit; */
			
			//$this->render('advisorProfile',$profileData);
			
			if(!isset($_REQUEST['sortType']))
			{
				$_REQUEST['sortType']='desc';
			}
			if(!isset($_REQUEST['sortBy']))
			{
				$_REQUEST['sortBy']='review_id';
			}
			if(!isset($_REQUEST['keyword']))
			{
				$_REQUEST['keyword']='';
				
			}
			if(!isset($_REQUEST['startdate']))
			{
				$_REQUEST['startdate']='';
				
			}
			if(!isset($_REQUEST['enddate']))
			{
				$_REQUEST['enddate']='';
				
			}
			$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
			
			$reviewObj	=	new Reviews();
			$users	=	$reviewObj->getPaginatedReviewsForProfile($userId,LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
			
			/*echo "<pre>";
			print_r($users);
			exit;*/
			
			if($_REQUEST['sortType'] == 'desc'){
				$ext['sortType']	=	'asc';
				$ext['img_name']	=	'arrow_up.png';
			} else {
				$ext['sortType']	=	'desc';
				$ext['img_name']	=	'arrow_down.png';
			}
			$ext['keyword']=$_REQUEST['keyword'];
			$ext['sortBy']=$_REQUEST['sortBy'];
			$ext['startdate']=$_REQUEST['startdate'];
			$ext['enddate']=$_REQUEST['enddate'];
			$ext['currentSortType']=$_REQUEST['currentSortType'];
			
			$data['pagination']	=	$users['pagination'];
			$data['messages']	=	$users['users'];
			Yii::app()->session['current']	=	'Reviews';
			$this->render("advisorProfile", array('data'=>$data,'ext'=>$ext,"profileData"=>$profileData));
		}
		else
		{
			Yii::app()->user->setFlash('error', "Invalid request.");
			$this->redirect(array("site/Error"));
		}
	}
	
	
	function actionentstep3()
	{
		Yii::app()->session['currentTab']	=	'Home';
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		$this->render("entsignupstep3",array('industryData'=>$industryData));
	}
	
	function actionadvisorstep3()
	{
		Yii::app()->session['currentTab']	=	'Home';
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		$this->render("advisorsignupstep3",array('industryData'=>$industryData));
	}
	
	function actionadvisorstep2()
	{
		Yii::app()->session['currentTab']	=	'Home';
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		$this->render("advisorsignup",array('industryData'=>$industryData));
	}
	
	function actionentstep2()
	{
		Yii::app()->session['currentTab']	=	'Home';
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		$this->render("entsignup",array('industryData'=>$industryData));
	}
	
	
	function actionsaveTwitterPic()
	 {
	  error_reporting(0);
	  set_time_limit(0);
	  
	  $userObj = new Users();
	  $userData = $userObj->getAllUsers();
	  
	  
	  foreach ($userData as $row)
	  {
	   	if( 0 === strpos($row['avatar'], 'http') )
	   	{
			$content = file_get_contents($row['avatar']);
		
			if(!empty($content))
			{
			 $str = rand(1000,100000);
			 $file = 'assets/upload/avatar/foundermates_'.$row['id'].'_'.$str.'.png';
			 file_put_contents($file, $content);
			 $data['avatar'] = 'foundermates_'.$row['id'].'_'.$str.'.png';
			 
			 $usersObj = new Users();
			 $usersObj->setData($data);
			 $usersObj->insertData($row['id']);
			 
			}
			else
			{
			 $data['avatar'] = 'image.png';
			 
			 $usersObj = new Users();
			 $usersObj->setData($data);
			 $usersObj->insertData($row['id']);
			}  
	  		}
  		}
 		 exit;
 }
	
	function actionsearchAdvisors()
	{
		//error_reporting(E_ALL);
		//set_time_limit(0);
		//Yii::app()->session['currentTab'] = 'Advisor List';
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']) || $_REQUEST['sortBy'] == "")
		{
			$_REQUEST['sortBy']='u.id';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		
		$_REQUEST['keyword'] = strip_tags($_REQUEST['keyword']);
		if(!isset($_REQUEST['country']))
		{
			$_REQUEST['country']='';
			
		}
		if(!isset($_REQUEST['city']))
		{
			$_REQUEST['city']='';
			
		}
		if(!isset($_REQUEST['industry']))
		{
			$_REQUEST['industry']='';
		}
		if(!isset($_REQUEST['area_of_expertise']))
		{
			$_REQUEST['area_of_expertise']='';
			
		}
		if(!isset($_REQUEST['mentorship_experience']))
		{
			$_REQUEST['mentorship_experience']='';
			
		}
		if(!isset($_REQUEST['advisorType']))
		{
			$_REQUEST['advisorType']='';
			
		}
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='';
		}
		
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		
		$userObj = new Users();
		$advisorList	=	$userObj->getPaginatedAdvisorList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['industry'],$_REQUEST['area_of_expertise'],$_REQUEST['mentorship_experience'],$_REQUEST['advisorType']);
		
		if(empty($advisorList['advisors']))
		{
			if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != "")
			{
				$keywordsObj = new Keywords();
				$data = $keywordsObj->getKeywordByWord($_REQUEST['keyword']);
			}
			
			if(!empty($data) && $data['similar_word'] != "")
			{
				$_REQUEST['keyword'] = $data['similar_word'];
				
				$userObj = new Users();
				$advisorList	=	$userObj->getPaginatedAdvisorList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['industry'],$_REQUEST['area_of_expertise'],$_REQUEST['mentorship_experience'],$_REQUEST['advisorType']);
			}
			else
			{
				
				 
				if(empty($data)){
					$keywordArr = array();
					$keywordArr['keyword'] = 	$_REQUEST['keyword'];
					$keywordArr['created'] = date("Y-m-d:H-m-s") ;
					
					if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '')
					{
						$keywordsObj = new Keywords();
						$keywordsObj->setData($keywordArr);
						$keywordsObj->insertData();
					}
				}
			}
		}
		
		/*echo "<pre>";
		print_r($advisorList);
		exit;*/
		
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['keyword']=$_REQUEST['keyword'];
		$ext['sortBy']=$_REQUEST['sortBy'];
		$ext['country']=$_REQUEST['country'];
		$ext['city']=$_REQUEST['city'];
		$ext['industry']=$_REQUEST['industry'];
		$ext['area_of_expertise']=$_REQUEST['area_of_expertise'];
		$ext['mentorship_experience']=$_REQUEST['mentorship_experience'];
		$ext['advisorType']=$_REQUEST['advisorType'];
		
		$data['pagination']	=	$advisorList['pagination'];
        $data['advisors']	=	$advisorList['advisors'];
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		/*print "<pre>";
		print_r($advisorList);
		exit;*/
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("searchresult",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
		else
		{
			$this->render("searchresult",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
		
	}
	
	function isAjaxRequest()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	
/*-------------------------------------------Foundermates Controller Finish------------------------------------*/
/*------------------------------------------------------------------------------------------------------------*/	
/*------------------------------------------------------------------------------------------------------------*/	
/*------------------------------------------------------------------------------------------------------------*/	
}