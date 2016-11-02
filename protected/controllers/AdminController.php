<?php

//include("protected/vendors/lib/excel_reader2.php");
error_reporting(0);
class AdminController extends Controller {

    private $algo;
    private $adminmsg;
    private $msg;
    private $arr = array("rcv_rest" => 200370,"rcv_rest_expire" => 200371,"send_sms" => 200372,"rcv_sms" => 200373,"send_email" => 200374,"todo_updated" => 200375, "reminder" => 200376, "notify_users" => 200377,"rcv_rest_expire"=>200378,"rcv_android_note"=>200379,"rcv_iphone_note"=>200380);
	
	public function actions()
	{
		
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	
	/* =============== Content Of Check Login Session =============== */

    function isLogin() {
        if (isset(Yii::app()->session['adminUser'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Username or password required");
            header("Location: " . Yii::app()->params->base_path . "admin");
            exit;
        }
    }

    function actionindex() 
	{
		if(isset(Yii::app()->session['adminUser'])){
			//$this->actionFxListing();
			$this->actionUsers();
			
		} else {
			$this->render("index");
		}
    }
	
	/* function actionFx() 
	{
			$fxObj = new FxDetails();
			$result = $fxObj->getAllFx();
			
			
			$this->render("fxList",array('data'=>$result));
	}*/
	
	
	function rest($url,$fields_string)
	{
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
		return $result;

	}
	
	function actionAdminLogin()
	{
		error_reporting(E_ALL);
		$captcha = Yii::app()->getController()->createAction('captcha');
		
		if (isset($_POST['submit_login'])) {
			
			if(!$captcha->validate($_POST['verifyCode'],1)) {
				Yii::app()->user->setFlash("error","Enter valid captcha.");
				$this->render('index');
				exit;
			}
			
			if(isset($_POST['email_admin']))
			{
				$email_admin = $_POST['email_admin'];
				$pwd = $_POST['password_admin'];
					
				$adminObj	=	new Admin();
				$admin_data	=	$adminObj->getAdminDetailsByEmail($email_admin);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password_admin'], $admin_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['adminUser'] = $admin_data['id'];
				Yii::app()->session['type'] = $admin_data['type'];
				Yii::app()->session['email'] = $admin_data['email'];
				Yii::app()->session['fullName'] = $admin_data['first_name'] . ' ' . $admin_data['last_name'];
				//$this->actionIndex();
				$this->redirect(array("admin/users"));
				exit;
			} else {
				Yii::app()->user->setFlash("error","Username not valid");
				$this->redirect(array("admin/index"));
				exit;
			}	
		}
	}

	function actionLogout()
	{
		Yii::app()->session->destroy();
		$this->render('index');
	}
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
		
			$new_array = array();
			$sortable_array = array();
		
			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}
		
				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
					break;
					case SORT_DESC:
						arsort($sortable_array);
					break;
				}
		
				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}
			
			return $new_array;
	}
	
	/***** ALL USERS *****/
	function actionUsers() 
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='id';
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
		$usersObj	=	new Users();
		$users	=	$usersObj->getAllPaginatedUsers(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
        $data['users']	=	$users['users'];
		Yii::app()->session['current']	=	'users';
		$this->render("users_listing", array('data'=>$data,'ext'=>$ext));
    }
	
	function actionverifyUser()
	{
		$data = array();
		$data['isVerified'] = 1;
		
		$usersObj	=	new Users();
		$usersObj->setData($data);
		$usersObj->insertData($_GET['user_id']);
		
		$userObj = new Users();
		$usersData = $userObj->getUserById($_GET['user_id']);
		
		$link = Yii::app()->params->base_path."site";
		$from = "registration@foundermates.com";
		$subject = "Welcome to FounderMates";
		$message = "<table>";
		$message .= "<tr>
		<td align='left'>
    	<div><img src='".Yii::app()->params->base_url."images/founder_mates_logo.png'/></div>
    	
    </td>
	</tr><tr>
		<td>Hello ".$usersData['firstName'].",</td></tr>";
		$message .= "<tr><td>&nbsp;</td></tr>";
		$message .= "<tr><td>Your account is approved on FounderMates and we warmly welcome you on board.</td></tr>";
		$meesage .= "<tr><td>Although we think you would have taken a look at the 'How it Works' and the 'FAQ' sections, </td></tr>";
		$message .= "<tr><td>&nbsp;</td></tr>";
		$meesage .= "<tr><td>just in case you haven't, we strongly recommend you go through the General Guidelines.</td></tr>";
		
		if($usersData['userType'] == 1)
		{
		$message .= "<tr>
		<td>Entrepreneur Guidelines - <a href='".Yii::app()->params->base_url."assets/induction/ENTREPRENEUR_INDUCTION.pdf' target='_blank'>Click here</a></td></tr>";	
		}
		else
		{
			
		$message .= "<tr>
		<td>Advisor Guidelines - <a href='".Yii::app()->params->base_url."assets/induction/ADVISOR_INDUCTION.pdf'  target='_blank'>Click here</a></td></tr>";
		
		}
		
		$message .= "<tr><td>&nbsp;</td></tr>";
		$message .= "<tr><td>We aspire to create FounderMates as 'The go-to-place' for all advisory issues faced by entrepreneurs and we can do so only with your feedback and support. We invite honest feedback from you at all times regarding stuff you would like to see or won't like to see. In addition, please do spread the word about FounderMates and help us spread entrepreneurship to masses. </td></tr>";
		$message .= "<tr><td>To view your profile on FounderMates, log onto <a href='http://www.foundermates.com'>FounderMates</a>. </td></tr>";
		$message .= "</table>";
		$message .= "<tr>
    <td>
   
    <p>Warm Regards </p>
    <p>
      Team FounderMates <br />
    </p>
	</td>
  </tr>";
		
		$helperObj = new Helper();
		$mailResponse=$helperObj->sendMail($usersData['email'],$subject,$message,$from);
		Yii::app()->user->setFlash("success","Successfully approved.");
		$this->redirect(array("admin/users"));
	}
	
	function actionapproveQuestion()
	{
		$data = array();
		$data['status'] = 0;
		
		$messagesObj	=	new Messages();
		$messagesObj->setData($data);
		$messagesObj->insertData($_REQUEST['message_id']);
		
		$messagesObj=Messages::model()->findByPk($_REQUEST['message_id']);
		
		$relationData['sender_id'] = $messagesObj->sender_id ;
		$relationData['receiver_id'] = $messagesObj->receiver_id ;
		$relationData['status'] = 1 ;
		
		$userMessageRelationObj	=	new UserMessageRelation();
		$userMessageRelationObj->setData($relationData);
		$userMessageRelationObj->insertData();
/*------------------------Email notification to Advisor---------------------------------------------------*/
		$userObj=Users::model()->findbyPk($relationData['receiver_id']);
		$email = $userObj->email ;
		$firstName = $userObj->firstName ; 
		
		
		$userObj=Users::model()->findbyPk($relationData['sender_id']);
		$uemail = $userObj->email ; 
		$ufirstName = $userObj->firstName ; 
		$ulastName = $userObj->lastName ; 
		
		$subject= $ufirstName .''.$ulastName.' via FounderMates';
				
		$message = '<table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
  <tr>
	<td align="left">
		<div><img src="'.Yii::app()->params->base_url.'images/founder_mates_logo.png" style="height=100px; width=200px ;"/></div>
		
	</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>Hello, '.$firstName.'</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>'.$ufirstName.' has sent you an email on FounderMates. </td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
  <tr>
	<td>To reply, please <a href="http://www.foundermates.com">click here.</a></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>
   
	<p>Warm Regards </p>
	<p>
	  Team FounderMates <br />
	</p>
	</td>
  </tr>
</table>';
	   
		$helperObj = new Helper();
		$mailResponse=$helperObj->sendMail($email,$subject,$message,"team@foundermates.com");
	
	
/*------------------------Email notification to Advisor---------------------------------------------------*/
		
		
		Yii::app()->user->setFlash("success","Successfully approved.");
		$this->redirect(array("admin/QuestionApproval"));
	}
	
	function actiondeleteMessages()
	{
		$messagesObj = new Messages();
		$messagesObj->deleteMessages($_REQUEST['id']);
		Yii::app()->user->setFlash("success","Successfully deleted.");
		$this->redirect(array("admin/emails"));
	}
	
	function actiondeleteQuestion()
	{
		$messagesObj = new Messages();
		$messagesObj->deleteMessages($_REQUEST['id']);
		Yii::app()->user->setFlash("success","Successfully deleted.");
		$this->redirect(array("admin/QuestionApproval"));
	}
	

	/***** ALL USERS *****/
	function actionEmails() 
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
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
		$usersObj	=	new Messages();
		$users	=	$usersObj->getAllPaginatedEmailsForAdmin(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
        $data['messages']	=	$users['messages'];
		Yii::app()->session['current']	=	'Emails';
		$this->render("messages", array('data'=>$data,'ext'=>$ext));
    }
	
	/***** ALL USERS *****/
	function actionReviews() 
	{
		$this->isLogin();
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
		$users	=	$reviewObj->getAllPaginatedReviewsForAdmin(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
		$this->render("reviews", array('data'=>$data,'ext'=>$ext));
    }
	
	
	/***** ALL USERS *****/
	function actionDeleteUsers() 
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='id';
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
		$usersObj	=	new Users();
		$users	=	$usersObj->getAllPaginatedUsers(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
        $data['users']	=	$users['users'];
		Yii::app()->session['current']	=	'Delete Users';
		$this->render("delete_users_listing", array('data'=>$data,'ext'=>$ext));
    }
	
	function actiondeleteuser()
	{
		$userObj = new Users();
		$userObj->deleteUsers($_GET['user_id']);
		Yii::app()->user->setFlash("success","User deleted successfully");
		$this->redirect(array("admin/DeleteUsers"));
	}
	
	function actiondeleteRequest()
	{
		$userObj = new Users();
		$userObj->deleteUsers($_GET['user_id']);
		Yii::app()->user->setFlash("success","User deleted successfully.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	function actionQuestionApproval() 
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
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
		$usersObj	=	new Messages();
		$users	=	$usersObj->getAllPaginatedQuestionForApproval(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
        $data['messages']	=	$users['messages'];
		Yii::app()->session['current']	=	'Questions';
		$this->render("questions", array('data'=>$data,'ext'=>$ext));
    }
	
	function actionkeywordsListing() 
	{
		$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='asc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='id';
		}
		
		if(!isset($_REQUEST['startdate']))
		{
			$_REQUEST['startdate']='';
			
		}
		if(!isset($_REQUEST['enddate']))
		{
			$_REQUEST['enddate']='';
			
		}
		
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		$keywordsObj	=	new Keywords();
		$keywordsListing	=	$keywordsObj->getAllPaginatedKeywords(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['startdate'],$_REQUEST['enddate']);
		
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
		
		$data['pagination']	=	$keywordsListing['pagination'];
        $data['keywords']	=	$keywordsListing['keywords'];
		Yii::app()->session['current']	=	'adminTab';
		$this->render("keywordListing", array('data'=>$data,'ext'=>$ext));
    }
	
	function actioneditKeyword() 
	{
		if(isset($_REQUEST['submit']))
		{
			$data['similar_word'] = $_REQUEST['similar_word'];
			$data['modified'] = date("Y-m-d:H-m-s");
			
			$keywordsObj = new Keywords();
			$keywordsObj->setData($data);
			$keywordsObj->insertData($_REQUEST['id']);
			
			Yii::app()->user->setFlash("success","Keyword edit successfully.");
			$this->redirect(array("admin/keywordsListing"));
		}
		else
		{
			$id = $_REQUEST['id'];
			
			$keywordsObj = new Keywords();
			$data = $keywordsObj->getKeywordById($id);
			
			Yii::app()->session['current']	=	'adminTab';
			$this->render("editKeyword", array('data'=>$data));
		}
    }
	
	public function actionshowUserProfile($userId)
	{
		
		Yii::app()->session['currentTab'] = 'Profile';
		Yii::app()->session['fmuserId'] = $userId;
		$userObj=Users::model()->findbyPk($userId);
		$type = $userObj->userType ;
		
		if($type == 1)
		{
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForEntrepreneur($userId);
			$this->render('entrepreneurProfile',$profileData);
			exit;
		}
		else if ($type == 2)
		{
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForAdvisor($userId);
			
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
			Yii::app()->session['current']	=	'users';
			$this->render("advisorProfile", array('data'=>$data,'ext'=>$ext,"profileData"=>$profileData));
			//$this->render('advisorProfile',$profileData);
			exit;
		}
	}
	
	public function actionadvisorProfileAjax($userId)
	{
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForAdvisor($userId);
		
		$this->render('advisorProfile_ajax',$profileData);
	}
	
	public function actionreviewDetail($review_id)
	{
		
		$reviewObj = new Reviews();
		$reviewData = $reviewObj->getReviewDetail($review_id);
		
		/*echo "<pre>";
		print_r($reviewData);
		exit;*/
		
		$this->renderPartial('review_descreption',$reviewData);
	}
	
	public function actionapproveReview()
	{
		$data['modifiedAt'] = date('Y-m-d:H-m-s');
		$data['status'] = 1 ;
		$reviewObj = new Reviews();
		$reviewObj->setData($data);
		$reviewObj->insertData($_REQUEST['review_id']);
		
		$reviewObj=Reviews::model()->findbyPk($_REQUEST['review_id']);
		$advisorId = $reviewObj->advisor_id ;
		$entrepreneurId = $reviewObj->entrepreneur_id ;
		
/*-------------------------------- Send mail to Advisor --------------------------*/
		$userObj=Users::model()->findbyPk($advisorId);
		$email = $userObj->email ;
		$firstName = $userObj->firstName ; 
		
		
		$userObj=Users::model()->findbyPk($entrepreneurId);
		$uemail = $userObj->email ; 
		$ufirstName = $userObj->firstName ; 
		$ulastName = $userObj->lastName ; 
		
		$subject= 'Review received on FounderMates';
				
		$message = '<table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
  <tr>
	<td align="left">
		<div><img src="'.Yii::app()->params->base_url.'images/founder_mates_logo.png" style="height=100px; width=200px ;"/></div>
		
	</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>Hello '.$firstName.',</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>'.$ufirstName.' has given you reviews based on your recent interaction on FounderMates.</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
  <tr>
	<td><b>What happens now?</b></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>The Review has been converted to Ratings score, called “Influence”, which will be available to be viewed by all entrepreneurs on FounderMates.</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>You can view your review by <a href="'.Yii::app()->params->base_path.'advisor/review" target="_blank">clicking here.</a></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>We thank you for your efforts in making FounderMates a great platform for advisory.</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>
   
	<p>Warm Regards,</p>
	<p>
	  Team FounderMates <br />
	</p>
	</td>
  </tr>
</table>';
	   
		$helperObj = new Helper();
		$mailResponse=$helperObj->sendMail($email,$subject,$message);
/*-------------------------------------------------------------------------------------*/		
		
		
		Yii::app()->user->setFlash('success',"Review successfully approved");
		$this->redirect('admin/reviews');
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actiondeleteReview()
	{
		
		$reviewObj=Reviews::model()->findbyPk($_REQUEST['review_id']);
		$reviewObj->delete();	
		
		Yii::app()->user->setFlash('success',"Review successfully deleted");
		$this->redirect(array('admin/reviews'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actiondeleteKeyword()
	{
		$keywordObj=Keywords::model()->findbyPk($_REQUEST['id']);
		$keywordObj->delete();	
		
		Yii::app()->user->setFlash('success',"Keyword successfully deleted");
		$this->redirect(array('admin/keywordsListing'));
	}
	
	public function actionentProfileAjax($userId)
	{
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur($userId);
		
		$this->render('entrepreneurProfile_ajax',$profileData);
	}
	
	public function actioneditProfile()
	{
		/*echo "<pre>";
		print_r($_POST);
		exit;*/	
		$data = array();
		$data['city'] = $_POST['city'];
		
		
		$userObj = new Users();
		$userObj->setData($data);
		$userObj->insertData($_POST['userId']);
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect('admin/users');
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}

		
	function actioncleanDB() 
	{
 		$adminObj = new Admin();
		$adminObj->cleanDB();
		$command="/var/www/html/utils/msg_send 200369 restart";
		passthru($command);
		Yii::app()->user->setFlash("success","DataBase cleaned successfully");
        header("location:" . Yii::app()->params->base_path . "admin");
		exit;
    }
	
	/****** Api Doc ******/

    function actionapprovalApiFunction() {
        if (isset($_POST['statusName']) && isset($_POST['statusValue'])) {
            $Api_functionObj = new ApiFunction();
            $result = $Api_functionObj->setApproval($_POST);
			if($result['status'] == 0){
				return true;
			}else{
				return false;
			}
        }
        return false;
    }

    /*
     * Method:apiFunctions
     * Display function list for rest api
     * $page=>page no for pagination
     */

    function actionapiFunctions($module='-1', $page=1) 
	{
		error_reporting(E_ALL);
		$this->isLogin();
		if(isset($_POST['findname']) && $_POST['findname'] == '')
		{
			unset(Yii::app()->session['findname']);
		}
        $adminObj = new Admin();
        $adminId = $adminObj->getAdminDetailsByEmail(Yii::app()->session['email']);
		$adminDetails = $adminObj->getAdminDetailsById($adminId['id']);
       	
			$Api_functionObj = new ApiFunction();
        $Api_function_resourceObj = new ApiFunctionResource();
        if(isset($_POST['findname']) && $_POST['findname'] != '')
		{
			
	    	$result = $Api_functionObj->listFunction($module, $page,trim($_POST['findname']));
			$data['findname']=trim($_POST['findname']);
		}
		else
		{
			$result = $Api_functionObj->listFunction($module, $page);
		}
        $Api_moduleObj = new ApiModule();
		
        $i = 0;
        foreach ($result[1] as $data) {
            $moduleData = $Api_moduleObj->getModule($data['moduleId']);
            if (isset($moduleData['label'])) {
                $result[1][$i]['moduleLabel'] = $moduleData['label'];
            }
            $resourceData = $Api_function_resourceObj->getData($data['id']);

            if (!empty($resourceData)) {
                $httpmethod = "REQUEST";
                if ($resourceData['http_methods'] == '0') {
                    $httpmethod = "GET";
                }
                if ($resourceData['http_methods'] == '1') {
                    $httpmethod = "POST";
                }

                $response_formats = "XML,JSON";
                if ($resourceData['response_formats'] == '1') {
                    $response_formats = "XML";
                }
                if ($resourceData['response_formats'] == 2) {
                    $response_formats = "JSON";
                }
                $result[1][$i]['resource_url'] = $resourceData['resource_url'];
                $result[1][$i]['http_methods'] = $httpmethod;
                $result[1][$i]['response_formats'] = $response_formats;
            }
            $i++;
        }
		
	   if(isset($_POST['findname']) && $_POST['findname']!='')
	   {
	   		Yii::app()->session['findname'] = $_POST['findname'];
	   }
	    
		$data=array('pagination'=>$result[0],'functionList'=>$result[1],'adminDetails'=>$adminDetails,'advanced'=>"Selected",'title'=>$this->msg['_TITLE_FJN_ADMIN_API_FUNCTIONS_']);
		Yii::app()->session['current'] = 'apiFunctions';
		$this->render('api-functions',$data);
    }
	
	/*
     * Method:addApiFunction
     * Add/Edit function
     * $id=>id for function
     */

    function actionaddApiFunction($id=NULL) {
     
		$this->isLogin();
		
        $Api_moduleObj = new ApiModule();
        $modules = $Api_moduleObj->getModules();
        $Api_functionObj = new ApiFunction();
        $title = 'Add Function';
		$result=array();
        if ($id != NULL) {
            $title = 'Edit Functions';
            $result=$Api_functionObj->getFunction($id);
			$_POST['id']=$result['id'];
        }
        if (isset($_POST['FormSubmit'])) {
            $id = NULL;
            $Api_functionArray['function_name'] = $_POST['function_name'];
            $Api_functionArray['moduleId'] = $_POST['moduleId'];
            $Api_functionArray['fn_description'] = $_POST['fn_description'];
            $Api_functionArray['published'] = isset($_POST['published']) ? $_POST['published'] : 1;

            if (isset($_POST['id']) && $_POST['id'] != '') {
                $Api_functionArray['id'] = $_POST['id'];
                $Api_functionArray['modifiedAt'] = 'now()';
                $id = $_POST['id'];
            } else {
                $Api_functionArray['createdAt'] = 'now()';
            }
			
			if(isset($id) && $id!=NULL)
			{
				$Api_functionObj->setData($Api_functionArray);
				$Api_functionObj->insertData($id);
			}
			else
			{
				$Api_functionObj->setData($Api_functionArray);
				$insertedId= $Api_functionObj->insertData();
			}
            if(isset($insertedId) && $insertedId > 0) {
				Yii::app()->user->setFlash('success', "Function added successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/apiFunctions');
                exit;
            } else {
				Yii::app()->user->setFlash('success', "Function updated successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/apiFunctions');
                exit;
            }
        }
		
		$data=array('result'=>$result,'modules'=>$modules,'advanced'=>"Selected",'title'=>$title);
		Yii::app()->session['current'] = 'advanced';
		$this->render('add-api-function',$data);
    }

	/*
     * Method:deleteApiFunction
     * delete function
     * $id=>id for function
     */

    function actiondeleteApiFunction($id) {
        $this->isLogin();
        $Api_functionObj = new ApiFunction();
        $Api_functionObj->deleteFunction($id);
		
		Yii::app()->user->setFlash('success', "Function deleted successfully.");
        header('location:' . Yii::app()->params->base_path . 'admin/apiFunctions');
		exit;
    }

    /*
     * Method:functionParametes
     * Display list of function parameters
     * $fn_id=>function id
     * $page=>page no. for function parameters
     */

    function actionfunctionParametes($fn_id=NULL, $page=1) {
        $this->isLogin();
		if(!isset($fn_id)){
			header("Location:" . Yii::app()->params->base_path . "admin/apiFunctions");
		}
        $Api_function_paramObj = new ApiFunctionParam();
        $result = $Api_function_paramObj->listParam($fn_id, $page);
		$data=array('pagination'=>$result[0],'paramList'=>$result[1],'advanced'=>"Selected",'fun_ref_id'=>$fn_id);
		Yii::app()->session['current'] = 'apiFunctions';
		$this->render('function-parameters',$data);
    }

 	/*
     * Method:addFunctionParamete
     * Add/Edit function parameter
     * $id=>id for function parameter
     */

    function actionaddFunctionParameter($fn_id, $id=NULL) {
		
        $this->isLogin();
        $Api_function_paramObj = new ApiFunctionParam();
        $Api_functionObj = new ApiFunction();
        $functions = $Api_functionObj->getFunctions();
		$result=array();
        $title = 'Add Parameter';
        if ($id != NULL) {
            $title = 'Edit Parameter';
            $result = $Api_function_paramObj->getParameter($id);
            $fn_id = $result['fn_id'];
			$_POST['id'] = $result['id'];
        }
        if (isset($_POST['FormSubmit'])) {
            $id = NULL;
            $paramArray['fnParamName'] = $_POST['fnParamName'];
            $paramArray['fnParamDescription'] = $_POST['fnParamDescription'];
            $paramArray['example'] = $_POST['example'];
            $paramArray['uiValidationRule'] = $_POST['uiValidationRule'];
            $paramArray['fn_id'] = $_POST['fn_id'];
            $paramArray['ParamType'] = isset($_POST['ParamType']) ? $_POST['ParamType'] : 1;
            $paramArray['published'] = isset($_POST['published']) ? $_POST['published'] : 1;

            if (isset($_POST['id']) && $_POST['id'] != '') {
                $paramArray['id'] = $_POST['id'];
                $paramArray['modifiedAt'] = 'now()';
                $id = $_POST['id'];
            } else {
                $paramArray['createdAt'] = 'now()';
            }
			if(isset($id) && $id!=NULL)
			{
				$Api_function_paramObj->setData($paramArray);
				$Api_function_paramObj->insertData($id);
			}
			else
			{
				$Api_function_paramObj->setData($paramArray);
				$insertedId= $Api_function_paramObj->insertData();
			}
            if(isset($insertedId) && $insertedId > 0) {
				Yii::app()->user->setFlash('success', "Parameter added successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/functionParametes/&fn_id=' . $fn_id);
                exit;
            } else {
				Yii::app()->user->setFlash('success', "Parameter updated successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/functionParametes/&fn_id=' . $fn_id);
                exit;
            }
			
        }
		
		$data=array('result'=>$result,'functions'=>$functions,'fun_ref_id'=>$fn_id,'advanced'=>"Selected",'title'=>$title);
		Yii::app()->session['current'] = 'apiFunctions';
		$this->render('add-function-parameter',$data);
		
    }

    /*
     * Method:deleteFunctionParameter
     * delete function
     * $id=>id for function
     */

    function actiondeleteFunctionParameter($fn_id, $id) {
        $this->isLogin();
        $Api_function_paramObj = new ApiFunctionParam();
        $Api_function_paramObj->deleteParameter($id);
		Yii::app()->user->setFlash('success', "Parameter deleted successfully.");
        header('location:' . Yii::app()->params->base_path . 'admin/functionParametes/fn_id/' . $fn_id);
		exit;
    }

    function actionapiResource($fn_id=NULL) {
        $this->isLogin();
		error_reporting(E_ALL);
		if(!isset($fn_id)){
			header("Location:" . Yii::app()->params->base_path . "admin/apiFunctions");
		}
        $Api_function_resourceObj = new ApiFunctionResource();
        if (isset($_POST['FormSubmit'])) {
            $dataArray['resource_url'] = $_POST['resource_url'];
            $dataArray['authentication'] = $_POST['authentication'];
            $dataArray['response_formats'] = $_POST['response_formats'];
            $dataArray['http_methods'] = $_POST['http_methods'];
            $dataArray['example'] = $_POST['example'];
            $dataArray['response'] = $_POST['response'];
            $dataArray['fn_id'] = $fn_id;
            $Api_function_resourceObj->setData($dataArray);
            $Api_function_resourceObj->insertData($_POST['id']);
			Yii::app()->user->setFlash('success', "Resource url updated successfully.");
        }
        $data = $Api_function_resourceObj->getData($fn_id);
        $Response_formatObj = new ResponseFormat();
        $resResult = $Response_formatObj->getResponseFormat();
		$data=array('data'=>$data,'fn_id'=>$fn_id,'http_mth_id'=>array(0, 1, 2),'http_mth_val'=>array('GET ', 'POST', 'REQUEST'),'http_mth_selected'=>(isset($data['http_methods']) ? $data['http_methods'] : 0),'res_fr_id'=>$resResult['id'],'res_fr_val'=>$resResult['label'],'res_fr_selected'=>(isset($data['response_formats']) ? $data['response_formats'] : 1),'advanced'=>"Selected");
		
		Yii::app()->session['current'] = 'apiFunctions';
		$this->render('function-resource',$data);
    }
	
	/****** End Api Doc ******/
	
	/*
     * Method:apiModules
     * Display module list for rest api
     * $page=>page no for pagination
     */

    function actionapiModules($page=1) {
        $this->isLogin();
		Yii::app()->session['current'] = 'apiFunctions';
        $adminObj = new Admin();
        $adminId = $adminObj->getAdminDetailsByEmail(Yii::app()->session['email']);
        $adminDetails = $adminObj->getAdminDetailsById($adminId);
      
        $Api_moduleObj = new ApiModule();
        $result[0] = $Api_moduleObj->getModules($page);

		$data=array('moduleList'=>$result[0],'adminDetails'=>$adminDetails,'advanced'=>"Selected",'TITLE_ADMIN'=>$this->msg['_TITLE_FJN_ADMIN_API_MODULES_']);
		$this->render('api_modules',$data);
    }

    /*
     * Method:addApiModule
     * Add/Edit module
     * $id=>id for module
     */

    function actionaddApiModule($id=NULL) {
        $this->isLogin();
        $Api_moduleObj = new ApiModule();
        $title = 'Add Module';
		$result =array();
        if ($id != NULL) {
            $title = 'Edit Module';
			$result=$Api_moduleObj->getModule($id);
			$_POST['id']=$result['id'];
        }
        if (isset($_POST['FormSubmit'])) {
            $id = NULL;
            $Api_moduleArray['label'] = $_POST['label'];
            $Api_moduleArray['description'] = $_POST['description'];
            $Api_moduleArray['published'] = isset($_POST['published']) ? $_POST['published'] : 1;

            if (isset($_POST['id']) && $_POST['id'] != '') {
                $Api_moduleArray['id'] = $_POST['id'];
                $Api_moduleArray['modifiedAt'] = 'now()';
                $id = $_POST['id'];
            } else {
                $Api_moduleArray['createdAt'] = 'now()';
            }
			
			if(isset($id) && $id!=NULL)
			{
				$Api_moduleObj->setData($Api_moduleArray);
				$Api_moduleObj->insertData($id);
			}
			else
			{
				$Api_moduleObj->setData($Api_moduleArray);
				$insertedId= $Api_moduleObj->insertData();
			}
            if(isset($insertedId) && $insertedId > 0) {
				Yii::app()->user->setFlash('success', "Module added successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/apiModules');
                exit;
            } else {
				Yii::app()->user->setFlash('success', "Module updated successfully.");
                header('location:' . Yii::app()->params->base_path . 'admin/apiModules');
                exit;
            }
        }
		$data=array('result'=>$result,'advanced'=>"Selected",'title'=>$title);
		Yii::app()->session['current'] = 'apiFunctions';
		$this->render('add_api_module',$data);
    }

    /*
     * Method:deleteApiModule
     * delete module
     * $id=>id for module
     */

    function actiondeleteApiModule($id) {
        $this->isLogin();
        $Api_moduleObj = new ApiModule();
        $Api_moduleObj->deleteModule($id);
		Yii::app()->user->setFlash('success', "Module deleted successfully.");
        header('location:' . Yii::app()->params->base_path . 'admin/apiModules');
		exit;
    }
	
	function actionmyprofile()
	{
		
		Yii::app()->session['current']   =   'settings';
		$adminObj	=	new Admin();
		
		if(isset(Yii::app()->session['email'])){
    		$adminId	=	$adminObj->getAdminIdByLoginId(Yii::app()->session['email']);
    		$adminDetails	=	$adminObj->getAdminDetailsById($adminId);
            $data['adminDetails']   =   $adminDetails;
			$this->render('myprofile', array('data'=>$data));
		}else{
            $this->redirect(Yii::app()->params->base_path.'admin/index');
		}
	}
	
	function actionsaveProfile()
	{	
		   error_reporting(E_ALL);
		   $adminObj	=	new Admin();
           $Admin_value['first_name'] = $_POST['FirstName'];
		   $Admin_value['last_name'] = $_POST['LastName'];
		   $validationObj = new Validation();
		   $res = $validationObj->updateAdminProfile($Admin_value);	
		   if($res['status'] == 0)
		   {
		   		 $adminObj->updateProfile($Admin_value,$_POST['AdminID']);
		  		 Yii::app()->session['FullName'] = $Admin_value['first_name'] .''.$Admin_value['last_name'];
		   		 Yii::app()->user->setFlash('success', Yii::app()->params->adminmsg['_UPDATE_SUCC_MSG_']);
		   }
		   else
		   {
			    Yii::app()->user->setFlash('error',$res['message']);
		   }
		   $this->actionmyprofile();   
	}
	
	function actionchangePassword()
	{
		$this->isLogin();
		Yii::app()->session['current']	=	'adminTab';
		if(!isset($_REQUEST['ajax']))
		{
			$_REQUEST['ajax']='false';
		}
		$resultArray['ajax']=$_REQUEST['ajax'];
		if(isset($_GET['id']) && $_GET['id'] != '')
		{
			$resultArray['id']=$_GET['id'];
		}
		else
		{
			$resultArray['id']=Yii::app()->session['adminUser'];
		}
		if($_REQUEST['ajax']=='true')
		{
			$this->render('change_password',$resultArray);	
		}
		else
		{
			$this->render('change_password',$resultArray);	
		}	
	}
	
	function actionchangeAdminPassword()
	{
		$this->isLogin();
		if(isset($_REQUEST['id']) && $_REQUEST['id'] != '')
		{
			$adminObj = new Admin();
			$adminId = $adminObj->getAdminIdByLoginId(Yii::app()->session['email']);
			$adminDetails = $adminObj->getAdminDetailsById($adminId);
			Yii::app()->session['current'] =   'settings';
			$data['adminDetails']=$adminDetails;
			$data['id']=$adminId;
			$data["settings"]= "Selected";
			$data['TITLE_ADMIN']=$this->msg['_TITLE_FJN_ADMIN_CHANGE_PASSWORD_'];
			$pass_flag = 0;
			if (isset($_POST['Save'])) {
				$adminObj=Admin::model()->findbyPk($adminId);
				$res = $adminObj->attributes;
				$generalObj = new General();
				$res = $generalObj->validate_password($_POST['opassword'],$res['password']);
				if($res!=true)
				{	
					Yii::app()->user->setFlash("error","Old Password is wrong.");
				}
				else
				{
					$generalObj = new General();
					$password_flag = $generalObj->check_password($_POST['password'], $_POST['cpassword']);
		
					switch ($password_flag) {
						case 0:
							$pass_flag = 0;
							break;
						case 1:
							
							Yii::app()->user->setFlash("error","Please don't blank password.");
							$pass_flag = 1;
							break;
						case 2:
							
							Yii::app()->user->setFlash("error","Password minimum length need to eight character.");
							$pass_flag = 1;
							break;
						case 3:
							Yii::app()->user->setFlash("error","Password minimum need to one lowercase.");
							
							$pass_flag = 1;
							break;
						case 4:
							Yii::app()->user->setFlash("error","Password minimum need to one upercase.");
							$pass_flag = 1;
							break;
						case 5:
							Yii::app()->user->setFlash("error","Password minimum need to one digit number.");
							$pass_flag = 1;
							break;
						case 6:
							Yii::app()->user->setFlash("error","Password minimum need to one special character.");
							$pass_flag = 1;
							break;
						case 7:
							Yii::app()->user->setFlash("error","Password is not match with confirm password.");
							$pass_flag = 1;
							break;
					}
				
					if ($pass_flag == 0) {
						if (isset($_POST['opassword'])) {
							if (strlen($_POST['opassword']) < 1) {
								
								 Yii::app()->user->setFlash("error",$this->msg['WRONG_PASS_MSG']);
							} else if (strlen($_POST['password']) < 5) {
								
								 Yii::app()->user->setFlash("error",$this->msg['_VALIDATE_PASSWORD_GT_6_']);
							} else if ($_POST['password'] != $_POST['cpassword']) {
								
								 Yii::app()->user->setFlash("error",$this->msg['_CONFIRM_PASSWORD_NOT_MATCH_']);
							} else {
								$admin = new admin();
								$result = $admin->changePassword(Yii::app()->session['adminUser'], $_POST);
								if ($result == '2') {
								   
									Yii::app()->user->setFlash("error","Old Password don't match with over database.");
								} else {
								  
									Yii::app()->user->setFlash("error",$this->msg['_PASSWORD_CHANGE_SUCCESS_']);
									Yii::app()->user->setFlash('success',"Successfully Changed Password.");
								}
							}
						}
					}
				}
			}
		}
		if(isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '')
		{
			if (isset($_POST['Save'])) {
				$loginObj=Login::model()->findbyPk($_REQUEST['user_id']);
				$res = $loginObj->attributes;
				$generalObj = new General();
				$res = $generalObj->validate_password($_POST['opassword'],$res['password']);
				if($res!=true)
				{	
					Yii::app()->user->setFlash("error","Old Password is wrong.");
				}
				$adminObj = new admin();
				$result = $adminObj->changeUserPassword($_REQUEST['user_id'], $_REQUEST);
				Yii::app()->user->setFlash("error",$this->msg['_PASSWORD_CHANGE_SUCCESS_']);
				Yii::app()->user->setFlash('success',"Successfully Changed Password.");
			}
		}
		
		$this->render("change_password",$data);
	}
	
	function actionforgotPassword() 
	{
		$captcha = Yii::app()->getController()->createAction('captcha');
        if (isset(Yii::app()->session['adminUser'])) {
			 Yii::app()->request->redirect( Yii::app()->params->base_path . 'admin');
        }
		
        if (isset($_POST['verifyCode']) && !$captcha->validate($_POST['verifyCode'],1)) 
		{
			Yii::app()->user->setFlash("error",Yii::app()->params->msg['_INVALID_CAPTCHA_']);
            header("Location: " . Yii::app()->params->base_path . 'admin/forgotPassword');
            exit;
        } else {
            if (isset($_POST['loginId'])) {
                $AdminObj = new Admin();
                $result = $AdminObj->forgot_password($_POST['loginId']);
                if ($result[0] == 'success') {
					Yii::app()->user->setFlash("success",$result[1]);
                    $data['message_static']=$result[1];
                    $this->render("password_confirm",array("data"=>$data));
					exit;
                } else {
					Yii::app()->user->setFlash("error",$result[1]);
                    $this->render("forgot_password");
					exit;
                }
            }
        }
		if(empty($_POST))
		{
			$this->render("forgot_password");
		}
    }

    function actionresetPassword() 
	{
        $message = '';
        if (isset($_POST['submit_reset_password_btn'])) {
            $adminObj = new Admin();
            $result = $adminObj->resetpassword($_POST);
            $message = $result[1];
            if ($result[0] == 'success') {
				Yii::app()->user->setFlash("success",$message);
                header("Location: " . Yii::app()->params->base_path . 'admin/');
                exit;
            }
			else
			{
				Yii::app()->user->setFlash("error",$message);
                header("Location: " . Yii::app()->params->base_path . 'admin/resetpassword');
                exit;
			}
        }
        if ($message != '') {
			Yii::app()->user->setFlash("success",$message);
        }
        $this->render("password_confirm");
    }
	
	/* =============== Contain Of Approve User Login ============== */

    function actionapproveUser($id=NULL) 
	{
		error_reporting(E_ALL);
        $this->isLogin();
        if(!isset($id)){
			header("Location: " . Yii::app()->params->base_path . "admin/clientRequest");
		}
		//	DELETE OTHER VERIFIED PHONE NUMBERS
		$userObj	=	new Users();
		$incoming_sms_sender	=	$userObj->getPhoneById($id);
		
		if($incoming_sms_sender!=''){
			$userObj = new Users();
			//$userObj->deletePhoneNumber($incoming_sms_sender,$id);
			//$userObj->deleteOtherVerifiedPhone($id);
		}
		
		$userObj=Users::model()->findByPk($id);
		$user_value['id'] = $id;
        $user_value['modifiedAt']=date('Y-m-d h:m:s');
        $user_value['isVerified'] = '1';
		$userObj = new Users();
		$userObj->veriryUser($user_value,$id);
		$vefiry = "Verified Successfully";
		Yii::app()->user->setFlash('success',$vefiry);
        $this->actionclientRequest();
    }
	
	function actionapproveAllUser($email=NULL) 
	{
		error_reporting(E_ALL);
        $this->isLogin();
        if(!isset($email)){
			header("Location: " . Yii::app()->params->base_path . "admin/clientRequest");
		}
		//	DELETE OTHER VERIFIED PHONE NUMBERS
		$userObj	=	new Users();
		$incoming_sms_sender	=	$userObj->getEmailById($email);
		
		if($incoming_sms_sender!=''){
			$userObj = new Users();
			//$userObj->deletePhoneNumber($incoming_sms_sender,$id);
			//$userObj->deleteOtherVerifiedPhone($id);
		}
		foreach($incoming_sms_sender as $row)
		{
			$userObj=Users::model()->findByPk($row['id']);
			$user_value['id'] = $row['id'];
			$user_value['modifiedAt']=date('Y-m-d h:m:s');
			$user_value['isVerified'] = '1';
			$userObj = new Users();
			$userObj->veriryUser($user_value,$row['id']);
		}
		$vefiry = "Verified Successfully";
		Yii::app()->user->setFlash('success',$vefiry);
        $this->actionclientRequest();
    }
	
	
	function actionaddEmployee($employee_id=NULL)
	{
		$this->isLogin();
		
		$employeeObj = new Employees();
		
        $title = 'Add Employee';
        $result = array();
        if ($employee_id != NULL) {
            $title = 'Edit Employee';
            $result = $employeeObj->getEmployeeDetails($employee_id);
            $_POST['employee_id'] = $result['employee_id'];
        }
        if (isset($_POST['FormSubmit'])) 
		{
			$employee_id = NULL;
			$data['admin_id'] = Yii::app()->session['adminUser'];
            $data['firstName'] = $_POST['firstName'];
			$data['lastName'] = $_POST['lastName'];
			$data['email'] = $_POST['email'];
			$data['contact_no'] = $_POST['contact_no'];
			$data['salary'] = $_POST['salary'];
			$data['status'] = $_POST['status'];

            if (isset($_POST['employee_id']) && $_POST['employee_id'] != '') 
			{
                $data['admin_id'] = Yii::app()->session['adminUser'];
				$data['employee_id'] = $_POST['employee_id'];
                $data['modified_date'] = date("Y-m-d H:i:s");
                $employee_id = $_POST['employee_id'];
            } 
			else 
			{
				$data['joining_date'] = date("Y-m-d H:i:s");
                $data['created_date'] = date("Y-m-d H:i:s");
            }
			if (isset($employee_id) && $employee_id != NULL) {                
				$employeeObj->setData($data);
                $employeeObj->insertData($employee_id);
            } else {
				$employeeObj->setData($data);
                $insertedId = $employeeObj->insertData();				
            }
			
            if (isset($insertedId) && $insertedId > 0) {
                Yii::app()->user->setFlash('success', "Employee added successfully.");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success', "Employee updated successfully.");
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['current'] = 'employees';
		$this->render('addEmployee', $data);
	}
	
	 /*     * ***************	Delete Employee  ************** */

    function actiondeleteEmployee($id) {
        $this->isLogin();
        $employeeObj = new Employees();
        $employeeObj->deleteEmployee($id);

        Yii::app()->user->setFlash('success', "Employee deleted successfully.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
		 /*     * ***************	Add store  ************** */
	function actionaddStore($store_id=NULL)
	{
		error_reporting(E_ALL);
		$this->isLogin();
		
		$storeObj = new Stores();
		
        $title = 'Add Store';
        $result = array();
        if ($store_id != NULL) {
		
            $title = 'Edit Store';
            $result = $storeObj->getStoreDetails($store_id);
            $_POST['store_id'] = $result['store_id'];
        }
		
		 if (isset($_POST['FormSubmit'])) 
		{
			$store_id = NULL;
			$data['admin_id'] = Yii::app()->session['adminUser'];
            $data['store_name'] = $_POST['store_name'];
			$data['city'] = $_POST['city'];
			
			$data['status'] = $_POST['status'];

            if (isset($_POST['store_id']) && $_POST['store_id'] != '') 
			{
                $data['admin_id'] = Yii::app()->session['adminUser'];
				$data['store_id'] = $_POST['store_id'];
                $data['modified_date'] = date("Y-m-d H:i:s");
                $store_id = $_POST['store_id'];
            } 
			else 
			{
				$data['modified_date'] = date("Y-m-d H:i:s");
                $data['created_date'] = date("Y-m-d H:i:s");
            }
			if (isset($store_id) && $store_id != NULL) {                
				$storeObj->setData($data);
                $storeObj->insertData($store_id);
            } else {
				$storeObj->setData($data);
                $insertedId = $storeObj->insertData();				
            }
			
            if (isset($insertedId) && $insertedId > 0) {
                Yii::app()->user->setFlash('success', "Store added successfully.");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success', "Stores updated successfully.");
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['current'] = 'stores';
		$this->render('addStore', $data);
        
	}


    function actiondeleteStore($id) {
        $this->isLogin();
        $storeObj = new Stores();
        $storeObj->deleteStore($id);

        Yii::app()->user->setFlash('success', "Store deleted successfully.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
	
	
	
	function actionaddProduct($product_id=NULL)
	{
		$this->isLogin();
		
		$productObj = new Product();
		
        $title = 'Add Product';
        $result = array();
        if ($product_id != NULL) {
            $title = 'Edit Product';
            $result = $productObj->getProductDetails($product_id);
            $_POST['product_id'] = $result['product_id'];
        }
        if (isset($_POST['FormSubmit'])) 
		{
			$product_id = NULL;
			$data['admin_id'] = Yii::app()->session['adminUser'];
            $data['product_name'] = $_POST['product_name'];
			$data['product_price'] = $_POST['product_price'];
			$data['upc_code'] = $_POST['upc_code'];
			$data['quantity'] = $_POST['quantity'];
			$data['product_desc'] = $_POST['product_desc'];
			$data['status'] = $_POST['status'];

            if (isset($_POST['product_id']) && $_POST['product_id'] != '') 
			{
       			$data['admin_id'] = Yii::app()->session['adminUser'];
				$data['product_id'] = $_POST['product_id'];
                $data['modified_date'] = date("Y-m-d H:i:s");
                $product_id = $_POST['product_id'];
            } 
			else 
			{
                $data['created_date'] = date("Y-m-d H:i:s");
            }
			if (isset($product_id) && $product_id != NULL) {                
				$productObj->setData($data);
                $productObj->insertData($product_id);
            } else {
				$productObj->setData($data);
                $insertedId = $productObj->insertData();				
            }
			
            if (isset($insertedId) && $insertedId > 0) {
                Yii::app()->user->setFlash('success', "Product added successfully.");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success', "Product updated successfully.");
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['current'] = 'product';
		$this->render('addProduct', $data);
	}
	
	
	 /*     * ***************	Delete Product  ************** */

    function actiondeleteProduct($id) {
        $this->isLogin();
        $productObj = new Product();
        $productObj->deleteProduct($id);

        Yii::app()->user->setFlash('success', "Product deleted successfully.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
	//messages
	
	function actionmessage()
	{	
				$this->isLogin();
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='id';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		$messageObj = new MessageTemplate();

		$message =	$messageObj->getAllPaginatedMessage(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword']);
		
		
	/*	echo "<pre>";
		print_r($message);
		exit;*/
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else 
		{
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['keyword']=$_REQUEST['keyword'];
		$ext['sortBy']=$_REQUEST['sortBy'];
		$ext['currentSortType']=$_REQUEST['currentSortType'];
		
		$data['pagination']	=	$message['pagination'];
        $data['message']	=	$message['message_template'];
		Yii::app()->session['current']	= 'message_template';
		$this->render("message", array('data'=>$data,'ext'=>$ext));
		
	}
	
	//message add
	function actionaddMessage($id=NULL)
	{
		$this->isLogin();
		$messageObj = new MessageTemplate();
	    $title = 'Add Message';
        $result = array();
        if ($id != NULL) {
            $title = 'Edit Message';
            $result = $messageObj->getMessageDetails($id);
            $_POST['id'] = $result['id'];
		}
        if (isset($_POST['FormSubmit'])) 
		{
			
			$id = NULL;
		   $data['message'] = $_POST['message'];
		   if (isset($_POST['id']) && $_POST['id'] != '') 
			{
               	$data['id'] = $_POST['id'];
                $id = $_POST['id'];
            } 
			if (isset($id) && $id != NULL) {                
				$messageObj->setData($data);
                $messageObj->insertData($id);
            } else {
				$messageObj->setData($data);
                $insertedId = $messageObj->insertData();				
            }
            if (isset($insertedId) && $insertedId > 0) {
                Yii::app()->user->setFlash('success', "Message added successfully.");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success', "Message updated successfully.");
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['current'] = 'message';
		$this->render('addMessage', $data);
	}
	
	//delete message
	function actiondeleteMessage($id) 
	{
        $this->isLogin();
        $messageObj = new MessageTemplate();
        $messageObj->deleteMessage($id);

        Yii::app()->user->setFlash('success', "Message deleted successfully.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
	function actionaddSupplier($supplier_id=NULL)
	{
		$this->isLogin();
		
		$supplierObj = new Supplier();
		
        $title = 'Add Supplier';
        $result = array();
        if ($supplier_id != NULL) {
            $title = 'Edit Supplier';
            $result = $supplierObj->getSupplierDetails($supplier_id);
            $_POST['supplier_id'] = $result['supplier_id'];
        }
        if (isset($_POST['FormSubmit'])) 
		{
			$supplier_id = NULL;
			$data['admin_id'] = Yii::app()->session['adminUser'];
            $data['supplier_name'] = $_POST['supplier_name'];
			$data['email'] = $_POST['email'];
			$data['contact_no'] = $_POST['contact_no'];
			$data['address'] = $_POST['address'];
			$data['product_id'] = $_POST['product_id'];
			$data['status'] = $_POST['status'];

            if (isset($_POST['supplier_id']) && $_POST['supplier_id'] != '') 
			{
                $data['admin_id'] = Yii::app()->session['adminUser'];
				$data['supplier_id'] = $_POST['supplier_id'];
                $data['modified_date'] = date("Y-m-d H:i:s");
                $supplier_id = $_POST['supplier_id'];
            } 
			else 
			{
                $data['created_date'] = date("Y-m-d H:i:s");
            }
			if (isset($supplier_id) && $supplier_id != NULL) {                
				$supplierObj->setData($data);
                $supplierObj->insertData($supplier_id);
            } else {
				$supplierObj->setData($data);
                $insertedId = $supplierObj->insertData();				
            }
			
            if (isset($insertedId) && $insertedId > 0) {
                Yii::app()->user->setFlash('success', "Supplier added successfully.");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                Yii::app()->user->setFlash('success', "Supplier updated successfully.");
                header('location:' .  $_SERVER['HTTP_REFERER']);
                exit;
            }
        }

        $data = array('result' => $result,'advanced' => "Selected", 'title' => $title);
        Yii::app()->session['current'] = 'supplier';
		$this->render('addSupplier', $data);
	}
	
	 /*     * ***************	Delete Product  ************** */

    function actiondeleteSupplier($id) {
        $this->isLogin();
        $supplierObj = new Supplier();
        $supplierObj->deleteSupplier($id);

        Yii::app()->user->setFlash('success', "Supplier deleted successfully.");
		header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
	
	function actionvalidateBICDetails($_POST=NULL)
	{
		
		$base_url = "https://devapi.thecurrencycloud.com/api/en/v1.0/authentication/token/new";
		$fields_string="login_id=info@kwanji.com&api_key=17e11e857c88739e21512e80fec8aecb7832795d4b6ac48a0c854bba6ed1161b";	
		$result = $this->rest($base_url,$fields_string);
		$obj = json_decode($result);
		
		$_POST['nickname']="GBP Account";	
		$_POST['acct_ccy'] = "GBP";
		
		$base_url = "https://devapi.thecurrencycloud.com/api/en/v1.0/".$obj->data."/bank_account/validate_details?nickname=".urlencode($_POST['nickname'])."&acct_ccy=".$_POST['acct_ccy']."&beneficiary_name=".urlencode($_POST['person_firstName'])."&iban=".$_POST['iban_no']."&bic_swift=".$_POST['bic_code']."&destination_country_code=GB&is_beneficiary=true&is_source=false";
	
	  	$result = file_get_contents($base_url);
		$objVal = json_decode($result);
		
		 $result = file_get_contents('https://devapi.thecurrencycloud.com/api/en/v1.0/'.$obj->data.'/close_session');
		 $objDATA = json_decode($result);
		
		if($objVal->status=='success')
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	public function actionuserProfileAjax()
	{
		Yii::app()->session['currentTab'] = 'Profile';
		$userId = Yii::app()->session['fmuserId'] ;
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur($userId);
		$this->render('entrepreneurProfile_ajax',$profileData);
	}
	
	public function actioneditUserProfile()
	{
		//$userObj=Entrepreneurs::model()->findbyPk(Yii::app()->session['fmuserId']);
		//$entId = $userObj->id ;
		if(isset($_FILES['userImage']['name']) &&  $_FILES['userImage']['name'] != '')
		{
			echo $userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
		}
		
		$userData['firstName']=$_REQUEST['firstName'];
		$userData['lastName']=$_REQUEST['lastName'];
		$userData['city']=$_REQUEST['city'];
		$userData['country']=$_REQUEST['country'];
		
		$userObj = new Users();
		$userObj->setData($userData);
		$userObj->insertData(Yii::app()->session['fmuserId']);
		
		$entData['business_stage']=$_REQUEST['business_stage'];
		$entData['need_from_mentor']=$_REQUEST['need_from_mentor'];
		$entData['idea']=$_REQUEST['idea'];
		$entData['website']=$_REQUEST['website'];
		$entData['status'] = 1 ;
		
		$entrepreneursObj = new Entrepreneurs();
		$id = $entrepreneursObj->getEntrepreneursIdByUserId(Yii::app()->session['fmuserId']);
		
		
		$entrepreneursObj = new Entrepreneurs();
		$entrepreneursObj->setData($entData);
		$entrepreneursObj->insertData($id);
		
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('admin/users'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actionuserAdvisorProfileAjax()
	{
		/*Yii::app()->session['currentTab'] = 'Profile';
		$userId = Yii::app()->session['fmuserId'] ;
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForAdvisor($userId);
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		$this->render('userProfile_ajax',array('industryData'=>$industryData,'profileData'=>$profileData));*/
		Yii::app()->session['currentTab'] = 'Profile';
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur(Yii::app()->session['fmuserId']); 
		
		$advisorsObj = new Advisors();
		$advisorData = $advisorsObj->getAdvisorByUserId(Yii::app()->session['fmuserId']); 
		
		$data = array_merge($profileData,$advisorData);
		/*print "<pre>";
		print_r($data);
		exit;*/
		$this->render('advisorProfile_ajax',$data);
	}
	
	public function actioneditAdvisorUserProfile()
	{
		//$userObj=Entrepreneurs::model()->findbyPk(Yii::app()->session['fmuserId']);
		//$entId = $userObj->id ;
		
		
		if(isset($_FILES['userImage']['name']) &&  $_FILES['userImage']['name'] != '')
		{
			echo $userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
		}
		
		$userData['firstName']=$_REQUEST['firstName'];
		$userData['lastName']=$_REQUEST['lastName'];
		$userData['city']=$_REQUEST['city'];
		$userData['country']=$_REQUEST['country'];
		
		$userObj = new Users();
		$userObj->setData($userData);
		$userObj->insertData(Yii::app()->session['fmuserId']);
		
		$advisorObj = new Advisors();
		$adv_id = $advisorObj->getAdvisorIdByUserId(Yii::app()->session['fmuserId']);
		
		$entData = array();
		$entData['organisation']=$_REQUEST['organisation'];
		$entData['work_status']=$_REQUEST['work_status'];
		$entData['area_of_expertise']=$_REQUEST['area_of_expertise'];
		$entData['industry']=$_REQUEST['industry'];
		$entData['my_pitch']=$_REQUEST['my_pitch'];
		$entData['help']=$_REQUEST['help'];
		if(isset($_REQUEST['ent_industry'])){
		$entData['ent_industry']= implode(',',$_REQUEST['ent_industry']);
		}
		$entData['mentorship_experience']=$_REQUEST['mentorship_experience'];
		if(isset($_REQUEST['stage'])){
			$entData['stage']=implode(',',$_REQUEST['stage']);
		}
		$advisorObj = new Advisors();
		$advisorObj->setData($entData);
		$advisorObj->insertData($adv_id);
		
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('admin/users'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	function actionexportView()
	{
		Yii::app()->session['current']	=	'adminTab';
		$this->render("export");	
	}
	
	function actionexportEntData()
	{
		set_time_limit(0);
		include_once('ExportToExcel.class.php'); 
		//$conn=mysql_connect('localhost','root','')or die('Sorry Could not make connection');
		$conn=mysql_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD) or die('Sorry Could not make connection');
		mysql_select_db(DB_DATABASE); 

		$exp=new ExportToExcel();
		
		mysql_query("SET NAMES utf8;");
							
		mysql_query("SET character_set_results = 'utf8'");
		
		$qry="select c.id as UserId, c.firstName as FirstName, c.lastName as LastName, c.email as Email, c.country as Country, c.city as City, c.avatar as Avatar, c.linkedinLink as LinkedinLink, c.tagline as TagLine, e.idea as Idea, e.business_stage as BusinessStage, e.need_from_mentor as NeedForMentor, e.website as Website, i.industry_name as Industry, c.createdAt as CreateDate, c.modifiedAt as ModifyDate from users c LEFT JOIN entrepreneurs e ON (e.userId = c.id) LEFT JOIN industry i ON (i.industry = e.industry) WHERE c.userType = 1;  "; 
	   
	
		$exp->exportWithQuery($qry,"ExportData.xls",$conn);

	}
	
	function actionexportAdvisorsData()
	{
		set_time_limit(0);
		//error_reporting(E_ALL);
		include_once('ExportAdvisorToExcel.class.php'); 
		//$conn=mysql_connect('localhost','root','')or die('Sorry Could not make connection');
		$conn=mysql_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD)or die('Sorry Could not make connection');
		mysql_select_db(DB_DATABASE); 

		$exp=new ExportToExcel();
		
		mysql_query("SET NAMES utf8;");
							
		mysql_query("SET character_set_results = 'utf8'");
		
		$qry="select c.id as UserId, c.firstName as FirstName, c.lastName as LastName, c.email as Email, c.country as Country, c.city as City, c.avatar as Avatar, c.linkedinLink as LinkedinLink, c.tagline as TagLine, a.organisation as Organisation, a.work_status as JobTitle, i.industry_name as Industry, a.area_of_expertise as AreaOfExpertise, a.ent_industry as EntIndustry, a.help as Help, a.my_pitch as MyPitch, a.mentorship_experience as MentorshipExperience, a.startup_experience as StartupExperience, a.phone as ContactNo, a.stage as InterestedInAdvising, a.motivation as Motivation, a.hearabout as HearFrom, a.referralId as ReferralId, a.advisorType as AdvisorType,  c.createdAt as CreateDate, c.modifiedAt as ModifyDate from users c LEFT JOIN advisors a ON (a.userId = c.id) LEFT JOIN industry i ON (i.industry = a.industry) WHERE c.userType = 2;  "; 
	   
	
		$exp->exportWithQuery($qry,"ExportData.xls",$conn);

	}
	
	
}
//classs