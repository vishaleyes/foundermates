<?php
error_reporting(0);
class EntrepreneurController extends Controller
{
	
	public $msg;
	public $errorCode;
	public function beforeAction()
	{
		if($this->isAjaxRequest())
		{
			if(!$this->isLogin())
			{
				Yii::app()->user->logout();
				$this->redirect(array('site/index'));
				exit;						
			}
		}
		else
		{
			if(!$this->isLogin())
			{
				Yii::app()->user->logout();
				$this->redirect(array('site/index'));
				exit;
			}
		}
		return true;
	}
	
	
	function testing()
	{
		echo "vishal panchal";
		exit;
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
	
	
	/*****************method - check login ***************/
	function isLogin()
	{
		
		if(!Yii::app()->session['fmuserId']){
			Yii::app()->session->destroy();
			$this->redirect(array("site/index"));
		}else{
			$userId	=	Yii::app()->session['fmuserId'];	
			$userObj	=	new Users();
			$data	=	$userObj->getLoginId($userId);
			
			if(!$data) {
				Yii::app()->session->destroy();
				return false;			
			} 
			$messageObj = new Messages();
			$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
			Yii::app()->session['unreadCount'] = $unreadCount;
			return true;
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actionIndex()
	{
		Yii::app()->session['currentTab'] = 'Profile';
		$userId = Yii::app()->session['fmuserId'] ; 
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur($userId); 
		
		$this->render('userProfile',$profileData);
	}
	
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		Yii::app()->session['currentTab'] = 'logout';
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
	
	
	public function actionLogOut()
	{
		Yii::app()->session['currentTab'] = 'logout';
		$sArray=array();
		 $session=new CHttpSession;
		 $adminSessionArray=array('adminUser','email','name');
		if(!empty($session))
		{ 
			foreach($session as $name=>$value)
			{
				if(!in_array($name,$adminSessionArray))
				{
					unset($session[$name]);
				}
			}
		}
		
		//Yii::app()->session->destroy();
		$this->redirect(array('site/index'));
	}
	
	public function actiongetAdvisorList()
	{
		Yii::app()->session['currentTab'] = 'Advisor List';
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
		
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		
		$userObj = new Users();
		$advisorList	=	$userObj->getPaginatedAdvisorList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['industry'],$_REQUEST['area_of_expertise'],$_REQUEST['mentorship_experience'],$_REQUEST['advisorType']);
		
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
			$this->renderPartial("advisorlistnew",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
		else
		{
			$this->render("advisorlistnew",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
	}
	
	
	
	public function actiongetAdvisorListForCompose()
	{
		Yii::app()->session['currentTab'] = 'Advisor List';
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
		
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		
		$userObj = new Users();
		$advisorList	=	$userObj->getPaginatedAdvisorList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['industry'],$_REQUEST['area_of_expertise'],$_REQUEST['mentorship_experience']);
		
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
		
		$data['pagination']	=	$advisorList['pagination'];
        $data['advisors']	=	$advisorList['advisors'];
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		/*print "<pre>";
		print_r($advisorList);
		exit;*/
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("advisorlistnew",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
		else
		{
			$this->render("advisorlistnew",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		}
	}
	
	public function actionadvisorListing()
	{
		Yii::app()->session['currentTab'] = 'Advisor List';
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
		if(!isset($_REQUEST['mentorship_details']))
		{
			$_REQUEST['mentorship_details']='';
			
		}
		$_REQUEST['currentSortType'] = $_REQUEST['sortType']; 
		$userObj = new Users();
		$advisorList	=	$userObj->getPaginatedAdvisorList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$_REQUEST['country'],$_REQUEST['city'],$_REQUEST['industry'],$_REQUEST['area_of_expertise'],$_REQUEST['mentorship_details']);
		
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
		$ext['mentorship_details']=$_REQUEST['mentorship_details'];
		
		$data['pagination']	=	$advisorList['pagination'];
        $data['advisors']	=	$advisorList['advisors'];
		
		$industryObj = new Industry();
		$industryData = $industryObj->getIndustryList();
		
		/*print "<pre>";
		print_r($advisorList);
		exit;*/
		$this->renderPartial("advisorListing",array("industryData"=>$industryData,"data"=>$data,'ext'=>$ext));
		
	}
	
	public function actionchangePassword()
	{
		Yii::app()->session['currentTab'] = 'changepassword';
		if(isset($_POST['submit']))
		{
			if(isset($_POST['oldpassword']) && $_POST['oldpassword'] != "" )
			{
				$_POST['userId']=Yii::app()->session['fmuserId'];
				$user = new Users();
				$result=$user->changePassword($_POST);

				if($result[0] == 1 )
				{
					Yii::app()->user->setFlash('success',$result[1]);
					$this->redirect(array('entrepreneur/changePassword'));
					exit;
				}
				else
				{
					Yii::app()->user->setFlash('error',$result[1]);
					$this->redirect(array('entrepreneur/changePassword'));
					exit;
				}			
			}
			else
			{
				Yii::app()->user->setFlash('error',"Please enter old password.");
				$this->redirect(array('entrepreneur/changePassword'));
				exit;
			}
		}
		else
		{
			$this->render("change_password");
		}
	}
	
	public function actionmessages()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Ent Messages';
		Yii::app()->session['msgTab'] = 'Inbox';
		
		$userId = Yii::app()->session['fmuserId'];
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
		}
		$messageObj = new Messages();
		$messageList	=	$messageObj->getPaginatedMessageList($userId,$limit=10,$_REQUEST['sortType'],$_REQUEST['sortBy']);
		
		/*echo "<pre>";
		print_r($customerList);exit;*/
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		
		$data['pagination']	=	$messageList['pagination'];
        $data['messages']	=	$messageList['messages'];
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
			
	}
	
	
	public function actiontrashMessages()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Trash';
		
		$userId = Yii::app()->session['fmuserId'];
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
		}
		$messageObj = new Messages();
		$messageList	=	$messageObj->getPaginatedTrashMessageList($userId,$limit=10,$_REQUEST['sortType'],$_REQUEST['sortBy']);
		
		/*echo "<pre>";
		print_r($messageList);exit;*/
		
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		
		$data['pagination']	=	$messageList['pagination'];
        $data['messages']	=	$messageList['messages'];
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("trash_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("trash_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
			
	}
	
	public function actionDraft()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Draft';
		
		$userId = Yii::app()->session['fmuserId'];
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
		}
		$messageObj = new Messages();
		$messageList	=	$messageObj->getPaginatedDraftMessageList($userId,$limit=10,$_REQUEST['sortType'],$_REQUEST['sortBy']);
		
		/*echo "<pre>";
		print_r($customerList);exit;*/
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		
		$data['pagination']	=	$messageList['pagination'];
        $data['messages']	=	$messageList['messages'];
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("draft_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("draft_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
	}
	
	public function actionmakeComposeSeession()
	{
		Yii::app()->session['subject_'.Yii::app()->session['fmuserId']] = $_REQUEST['subject'];
		Yii::app()->session['message_'.Yii::app()->session['fmuserId']] = $_REQUEST['message'];
		return true;
	}
	
	
	public function actionsendmessages()
	{
		
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Compose';
		
		
		$userId = Yii::app()->session['fmuserId'];
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		$this->render("sendmessage",array('draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
	}
	
	public function actionsendMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		
		unset(Yii::app()->session['subject_'.Yii::app()->session['fmuserId']]);
		unset(Yii::app()->session['message_'.Yii::app()->session['fmuserId']]);
		
	
			
		$data = array();
		if(isset($_POST['to']) && $_POST['to'] != '') { 
			$data['receiver_id'] = $_POST['to'];
		}
		else
		{
			Yii::app()->user->setFlash('error',"Please specify at least one recipient.");
			$this->redirect(array("entrepreneur/sendmessages"));
		}
		if(isset($_POST['subject']) && $_POST['subject'] != '') {
			$data['subject'] = $_POST['subject'];
		}
		$data['message'] = htmlspecialchars(htmlentities($_POST['message']));
		
		//$data['message'] = htmlentities($_POST['message']);
		
		$data['sender_id'] = Yii::app()->session['fmuserId'];
		$data['read'] = 0;
		$data['createdAt'] = date("Y-m-d H:i:s");
		
		$userMessageRelationObj = new UserMessageRelation();
		$cnt = $userMessageRelationObj->checkConversation($data['sender_id'],$data['receiver_id']);
		
		if($cnt == 0){
			
			$userData=Users::model()->findbyPk($data['sender_id']);
			$firstName = $userData->firstName ; 
			$lastName = $userData->lastName ;
			$uemail = $userData->email ;
			
			$advisorData=Users::model()->findbyPk($data['receiver_id']);
			if(empty($advisorData))
			{
				$data['status'] = 4;
				$messageObj = new Messages();
				$messageObj->setData($data);
				$messageObj->insertData($_REQUEST['mId']);
				
				Yii::app()->user->setFlash('error',"Please specify at least one recipient. Your message is stored in Draft.");
				$this->redirect(array('entrepreneur/draft'));
			}
			$advfirstName = $advisorData->firstName ; 
			$advlastName = $advisorData->lastName ;
			$email = $advisorData->email ;
			
			$data['status'] = 7;
			$subject= 'Message awaiting admin approval';
			$str = "Good question! We don't doubt your advisor needs, we just want to ensure that your first question is relevant to the advisors' skill set. Thereafter, you are free to exchange FounderMails with the advisors without any Admin approval. ";
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
    <td>Hello '.$firstName.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td>Your message to '.$advfirstName.' '.$advlastName.' has been sent to Admin for approval. As it is approved, it will    be submitted to '.$advfirstName.''.$advlastName.'. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td><b>Why is the message sent to Admin?</b></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td>'.$str.'</td>
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
		$mailResponse=$helperObj->sendMail($uemail,$subject,$message);
		
		$adminObj=Admin::model()->findbyPk(1);
		$adminEmail = $adminObj->email ; 
		
		$helperObj = new Helper();
		$mailResponse=$helperObj->sendMail($adminEmail,$subject,$message);
			
		}
		else
		{ 
			$data['status'] = 0;
/*------------------------Email notification to Advisor---------------------------------------------------*/
			$userObj=Users::model()->findbyPk($data['receiver_id']);
			$email = $userObj->email ;
			$firstName = $userObj->firstName ; 
			
			
			$userObj=Users::model()->findbyPk($data['sender_id']);
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
			
			$adminObj=Admin::model()->findbyPk(1);
			$adminEmail = $adminObj->email ; 
			
			$helperObj = new Helper();
			$mailResponse=$helperObj->sendMail($adminEmail,$subject,$data['message']);
	
	
/*------------------------Email notification to Advisor---------------------------------------------------*/
		}
		
		$messageObj = new Messages();
		$messageObj->setData($data);
		$res = $messageObj->insertData($_POST['mId']);
		
		if(isset(Yii::app()->session['message_Id_draft']) && Yii::app()->session['message_Id_draft'] != '')
		{
			$messageObj = Messages::model()->findbyPk(Yii::app()->session['message_Id_draft']);
			if(isset($messageObj) && !empty($messageObj)){
				$messageObj->delete();
			}
		}
		
		unset(Yii::app()->session['message_Id_draft']);
		
		Yii::app()->user->setFlash('success',"Succesfully sent.");
		$this->redirect(array('entrepreneur/messages'));
	}
	
	public function saveAsDraft()
	{
		$data = array(); 
		$data['status'] = 4;
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData();
	}
	
	public function actionshowMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Inbox';
		
		if(!isset($_REQUEST['message_id']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		$data['read'] = 1;
		$data['modifiedAt'] = date("Y-m-d H:i:s");
		
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData($_REQUEST['message_id']);
		
		$messageObj = new Messages();
		$data = $messageObj->getMessagesWithSenderDetail($_REQUEST['message_id']);
		
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount(Yii::app()->session['fmuserId']);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount(Yii::app()->session['fmuserId']);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		$this->renderPartial("show_messages",array("message"=>$data,'unreadCount'=>$unreadCount,'draftCount'=>$draftCount));
	}
	
	public function actionshowDraftMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Inbox';
		
		if(!isset($_REQUEST['message_id']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
		$messageObj = new Messages();
		$data = $messageObj->getMessagesWithSenderDetail($_REQUEST['message_id']);
		
		$userObj = new Users();
		$receiverData = $userObj->getUserById($data['receiver_id']);
		
		
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount(Yii::app()->session['fmuserId']);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount(Yii::app()->session['fmuserId']);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		$this->renderPartial("sendmessage_ajax",array("message"=>$data,'unreadCount'=>$unreadCount,'draftCount'=>$draftCount,'receiverData'=>$receiverData));
	}
	
	
	public function actionmakeSessionForMessage()
	{
		Yii::app()->session['message_Id_draft'] = $_POST['message_id'];
		Yii::app()->session['subject_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']] = $_REQUEST['subject'];
		Yii::app()->session['message_'.Yii::app()->session['fmuserId'].Yii::app()->session['message_Id_draft']] = $_REQUEST['message'];
		
		echo true;
		exit;
	}
	
	public function actionsaveAsRecieverTrash()
	{
		$data = array();
		//$data['status'] = 3;
		$data['receiver_trash'] = 1;
		$data['read'] = 1;
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData($_REQUEST['message_id']);
		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '')
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			$this->redirect(array("entrepreneur/error"));
		}
	}
	
	public function actionsaveAsSenderTrash()
	{
		$data = array();
		//$data['status'] = 3;
		$data['sender_trash'] = 1;
		//$data['read'] = 1;
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData($_REQUEST['message_id']);
		
		if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '')
		{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			$this->redirect(array("entrepreneur/error"));
		}
	}
	
	public function actionsaveAsDraft()
	{
		$data = array();
		$data['receiver_id'] = $_POST['to'];
		$data['subject'] = $_POST['subject'];
		$data['message'] = htmlspecialchars(htmlentities($_POST['message']));
		$data['sender_id'] = Yii::app()->session['fmuserId'];
		$data['read'] = 0;
		$data['createdAt'] = date("Y-m-d H:i:s");
		$data['status'] = 4;
		
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData();
		
		echo 1;
		exit;
		//$this->actionmessages();
	}
		
	
	public function actionshowSentMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Sent';
		
		if(isset($_REQUEST['message_id']) && $_REQUEST['message_id'] != '')
		{
			$messageObj = new Messages();
			$data = $messageObj->getMessagesWithReceiverDetail($_REQUEST['message_id']);
			
		
			$this->renderPartial("show_sentmessages",array("message"=>$data));
		}
		else
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
	}
	
	public function actionshowSentMail()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Sent';
		$userId = Yii::app()->session['fmuserId'];
		
		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='message_id';
		}
		$messageObj = new Messages();
		$messageList	=	$messageObj->getPaginatedSentMessageList($userId,$limit=10,$_REQUEST['sortType'],$_REQUEST['sortBy']);
		
		/*echo "<pre>";
		print_r($customerList);exit;*/
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		
		$data['pagination']	=	$messageList['pagination'];
        $data['messages']	=	$messageList['messages'];
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		$messageObj = new Messages();
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("show_sentmail",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("show_sentmail",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
			
	}
	
	public function actionreview()
	{
		Yii::app()->session['currentTab'] = 'Reviews';
		$userObj = new Users();
		$data = $userObj->getPaginatedPendingReviewList();
		
		/*echo "<pre>";
		print_r($data);
		exit;*/
		
		if($data == 0)
		{
			$this->redirect(array("site/index"));
		}
		else
		{
			$this->render("review",array('data'=>$data));
		}
	}
	
	public function actionaddRating()
	{
		 $validationOBJ = new Validation();
		 $result = $validationOBJ->reviewValidation($_POST);
	  	 if($result['status']==0)
		 {
			 $data = array();
			 $data['advisor_id'] = $_POST['advisorId'];
			 $data['entrepreneur_id'] = Yii::app()->session['fmuserId'];
			 $data['usefulness'] = $_POST['usefulness'];
			 $data['knowledge'] = $_POST['knowledge'];
			 $data['timeliness'] = $_POST['timeliness'];
			 $data['recommend_other'] = $_POST['recommend'];
			 $data['expertise_area'] = $_POST['expertisearea'];
			 $data['advisor_experience'] = $_POST['comment'];
			 $data['average'] = ( $_POST['usefulness'] + $_POST['knowledge'] + $_POST['timeliness'] + $_POST['recommend'] ) / 4;
			 $data['createdAt'] = date("Y-m-d H:i:s");
			 $reviewObj = new Reviews();
			 $reviewObj->setData($data);
			 $reviewObj->insertData();
/*-------------------------------- Send mail to Ent ----------------------------------*/
			$userObj=Users::model()->findbyPk($data['entrepreneur_id']);
			$email = $userObj->email ;
			$firstName = $userObj->firstName ; 
			
			
			$userObj=Users::model()->findbyPk($data['advisor_id']);
			$uemail = $userObj->email ; 
			$ufirstName = $userObj->firstName ; 
			$ulastName = $userObj->lastName ; 
			
			$subject= 'Review sent to Admin for Approval';
					
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
		<td>Thank you for submitting the review for '.$ufirstName.'. We hope you had a great experience receiving advice. Your review has been sent to Admin and will be available on the advisor’s profile after approval.</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
	  <tr>
		<td>We appreciate your efforts to make the FounderMates experience better.</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
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
			$mailResponse=$helperObj->sendMail($email,$subject,$message,"team@foundermates.com");
/*-------------------------------------------------------------------------------------*/			 

			 Yii::app()->session['currentTab'] = 'Reviews';
			 $userObj = new Users();
			 $data = $userObj->getPaginatedPendingReviewList();
			 Yii::app()->user->setFlash('success',"Succesfully reviewed.");
			 $this->render("review",array('data'=>$data));
		 }
		 else
		 {
			 Yii::app()->session['currentTab'] = 'Reviews';
			 $userObj = new Users();
			 $data = $userObj->getPaginatedPendingReviewList();
			Yii::app()->user->setFlash("error",$result['message']);
			 $this->render("review",array('data'=>$data));
		 }
			
	}
	
	public function actionrequestAdvice()
	{
		
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['current'] = 'Messages';
		$userId = Yii::app()->session['fmuserId'] ;
		
		$algoObj =  new Algoencryption();
		
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur($userId);
		
		if( $profileData['status'] == 0 )
		{
			Yii::app()->user->setFlash('error',"Please update your profile");
			$this->render('userProfile',$profileData);
			exit;	
		}
		else
		{
			$data = array();
			$data['userId'] = $algoObj->decrypt($_REQUEST['userId']);
			$data['firstName'] = htmlspecialchars($_REQUEST['firstName']);
			$data['lastName'] = htmlspecialchars($_REQUEST['lastName']);
			
			$messageObj = new Messages();
			$messages = $messageObj->getMessages();
			
			$messageObj = new Messages();
			$draftCount	=	$messageObj->getDraftMessageCount(Yii::app()->session['fmuserId']);
		
			$messageObj = new Messages();
			$unreadCount	=	$messageObj->getUnreadMessageCount(Yii::app()->session['fmuserId']);
			Yii::app()->session['unreadCount'] = $unreadCount;
			
			$this->render("messageForAdvice",array("data"=>$data,'message'=>$messages,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
			
		}
	}
	
	public function actionuserProfileAjax()
	{
		Yii::app()->session['currentTab'] = 'Profile';
		$userId = Yii::app()->session['fmuserId'] ;
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur($userId);
		$this->render('userProfile_ajax',$profileData);
	}
	
	public function actionadvisorlistnew()
	{
	
		$this->render("messages");	
	}
	
	public function actioneditUserProfile()
	{
		//$userObj=Entrepreneurs::model()->findbyPk(Yii::app()->session['fmuserId']);
		//$entId = $userObj->id ;
		
		if(isset($_FILES['userImage']['name']) &&  $_FILES['userImage']['name'] != '')
		{
			$userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
		}
		
		if(!isset($_REQUEST['firstName']) || !isset($_REQUEST['lastName']) || !isset($_REQUEST['city']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
		if( (isset($_REQUEST['firstName']) && $_REQUEST['firstName'] == '') || (isset($_REQUEST['business_stage']) && $_REQUEST['business_stage'] == '') || (isset($_REQUEST['lastName']) && $_REQUEST['lastName'] == '') || (isset($_REQUEST['country']) && $_REQUEST['country'] == '') || (isset($_REQUEST['city']) && $_REQUEST['city'] == '') || (isset($_REQUEST['industry']) && $_REQUEST['industry'] == '') || (isset($_REQUEST['need_from_mentor']) && $_REQUEST['need_from_mentor'] == '' ) || (isset($_REQUEST['idea']) && $_REQUEST['idea'] == '') || (isset($_REQUEST['website']) && $_REQUEST['website'] == ''))
		{
			Yii::app()->user->setFlash("error","Please fill all required field.");
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForEntrepreneur(Yii::app()->session['fmuserId']);
			$this->render('userProfile_ajax',$_REQUEST);
			exit;
		}
		
		$userData['firstName']=$_REQUEST['firstName'];
		$userData['lastName']=$_REQUEST['lastName'];
		$userData['city']=$_REQUEST['city'];
		$userData['country']=$_REQUEST['country'];
		
		$userObj = new Users();
		$userObj->setData($userData);
		$userObj->insertData(Yii::app()->session['fmuserId']);
		
		$entData['business_stage']=$_REQUEST['business_stage'];
		$entData['need_from_mentor']=htmlentities($_REQUEST['need_from_mentor']);
		$entData['idea']=htmlentities($_REQUEST['idea']);
		if(substr($_REQUEST['website'],0,4) == 'http')
		{
			$entData['website']=$_REQUEST['website'];
		}
		else
		{
			$entData['website']= "http://".$_REQUEST['website'];
		}
		$entData['industry']=$_REQUEST['industry'];
		$entData['status'] = 1 ;
		
		
		
		
		$entrepreneursObj = new Entrepreneurs();
		$id = $entrepreneursObj->getEntrepreneursIdByUserId(Yii::app()->session['fmuserId']);
		
		$entrepreneursObj = new Entrepreneurs();
		$entrepreneursObj->setData($entData);
		$entrepreneursObj->insertData($id);
		
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('entrepreneur/Index'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actioneditProfile()
	{
		//$userObj=Entrepreneurs::model()->findbyPk(Yii::app()->session['fmuserId']);
		//$entId = $userObj->id ;
		if(empty($_POST))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		$entrepreneursObj = new Entrepreneurs();
		$id = $entrepreneursObj->getEntrepreneursIdByUserId(Yii::app()->session['fmuserId']);
		
		
		$_POST['status'] = 1;
		$entrepreneursObj = new Entrepreneurs();
		$entrepreneursObj->setData($_POST);
		$entrepreneursObj->insertData($id);
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('entrepreneur/Index'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actioneditProfile2()
	{
		if(empty($_POST))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		if(isset($_FILES['userImage']['name']) &&  $_FILES['userImage']['name'] != '')
		{
			$_POST['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$_POST['avatar']);
		}
		
		$userObj = new Users();
		$userObj->setData($_POST);
		$userObj->insertData(Yii::app()->session['fmuserId']);
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('entrepreneur/Index'));
	}
	
	public function actionshowAdvisorProfile($userId)
	{
		if(!isset($userId) || $userId == '')
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
		Yii::app()->session['currentTab'] = 'Profile';
		
		$alogObj = new Algoencryption();
		$userId =  $alogObj->decrypt($userId);
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForAdvisor($userId); 
		
		
		if(empty($profileData))
		{
			Yii::app()->user->setFlash('error',"No user found.");
			$this->redirect(array("entrepreneur/error"));
		}
		/*print "<pre>";
		print_r($profileData);
		exit;*/
		
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
		//$this->render('advisorProfile',$profileData);
		exit;
		
	}
	
	function actiondeleteMessages()
	{
		if(!isset($_REQUEST['ids']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		$arr_id=explode(",",$_REQUEST['ids']);
		
		for($i=1;$i<sizeof($arr_id);$i++)
		{
			$data=array();
			$data['id']=$arr_id[$i];
			if($arr_id[$i] != "")
			{
				/*$messageObj = new Messages();
				$messageObj->deleteMessages($data['id']);*/
				$data1= array();
				$data1['status'] = 3;
				$data1['read'] = 1;
				$messageObj = new Messages();
				$messageObj->setData($data1);
				$messageObj->insertData($arr_id[$i]);
				
			}
		}	
		
		Yii::app()->user->setFlash('success',"Messages successfully deleted.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	function actionSendInRecieverTrashMessages()
	{
		if(!isset($_REQUEST['ids']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
		$arr_id=explode(",",$_REQUEST['ids']);
		
		
		for($i=1;$i<sizeof($arr_id);$i++)
		{
			$data=array();
			$data['id']=$arr_id[$i];
			if($arr_id[$i] != "")
			{
				/*$messageObj = new Messages();
				$messageObj->deleteMessages($data['id']);*/
				$data1= array();
				//$data1['status'] = 3;
				$data1['receiver_trash'] = 1;
				$data1['read'] = 1;
				$messageObj = new Messages();
				$messageObj->setData($data1);
				$messageObj->insertData($arr_id[$i]);
				
			}
		}	
		
		Yii::app()->user->setFlash('success',"Messages successfully deleted.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	function actionSendInSenderTrashMessages()
	{
		
		if(!isset($_REQUEST['ids']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		$arr_id=explode(",",$_REQUEST['ids']);
		
		for($i=1;$i<sizeof($arr_id);$i++)
		{
			$data=array();
			$data['id']=$arr_id[$i];
			if($arr_id[$i] != "")
			{
				/*$messageObj = new Messages();
				$messageObj->deleteMessages($data['id']);*/
				$data1= array();
				//$data1['status'] = 3;
				$data1['sender_trash'] = 1;
				//$data1['read'] = 1;
				$messageObj = new Messages();
				$messageObj->setData($data1);
				$messageObj->insertData($arr_id[$i]);
				
			}
		}	
		
		Yii::app()->user->setFlash('success',"Messages successfully deleted.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	function actionremoveFromTrash()
	{
		
		if(!isset($_REQUEST['ids']))
		{
			$this->redirect(array("entrepreneur/error"));
		}
		
		$arr_id=explode(",",$_REQUEST['ids']);
		
		for($i=1;$i<sizeof($arr_id);$i++)
		{
			$data=array();
			$data['id']=$arr_id[$i];
			if($arr_id[$i] != "")
			{
				/*$messageObj = new Messages();
				$messageObj->deleteMessages($data['id']);*/
				$data1= array();
				$data1['status'] = 9;
				//$data1['read'] = 1;
				$messageObj = new Messages();
				$messageObj->setData($data1);
				$messageObj->insertData($arr_id[$i]);
				
			}
		}	
		
		Yii::app()->user->setFlash('success',"Messages successfully deleted.");
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}