<?php
error_reporting(0);
class AdvisorController extends Controller
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
	
	public function actionIndex()
	{
		error_reporting(E_ALL);
		set_time_limit(0);
		$this->redirect(array('advisor/messages'));
	}
	
		/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		error_reporting(E_ALL);
		Yii::app()->session['currentTab'] = 'Profile';
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
	
	public function actionshowAdvisorProfile()
	{
		Yii::app()->session['currentTab'] = 'Profile';
		$userId = Yii::app()->session['fmuserId'] ; 
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForAdvisor($userId);
		
		/*echo "<pre>";
		print_r($profileData);
		exit; */
		
		$this->render('userProfile',$profileData);
	}
	
	public function actionuserProfileAjax()
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
		
		/*print "<pre>";
		print_r($profileData);
		print_r($advisorData);
		exit;*/ 
		if((isset($advisorData) && !empty($advisorData)) || (isset($profileData) && !empty($profileData)))
		
		{
		
			$data = array_merge($profileData,$advisorData);
			$this->render('userProfile_ajax',$data);
		}
		else
		{
			$this->render('userProfile_ajax');
		}
		
	}
	
	public function actioneditUserProfile()
	{
		//$userObj=Entrepreneurs::model()->findbyPk(Yii::app()->session['fmuserId']);
		//$entId = $userObj->id ;
		
		
		if(isset($_REQUEST['area_of_expertise']))
		{
			
			$cnt = count($_REQUEST['area_of_expertise']);
			
			if( $cnt == 0 )
			{
				Yii::app()->user->setFlash('error',"Please select at least one skill.");	
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}
			
			if( $cnt > 4 )
			{
				Yii::app()->user->setFlash('error',"You can only select 4 skills at a time");	
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}
		}
		
		
		if(isset($_FILES['userImage']['name']) &&  $_FILES['userImage']['name'] != '')
		{
			$userData['avatar']=$_FILES['userImage']['name'];
			$tmp_name=$_FILES['userImage']['tmp_name'] ;
			move_uploaded_file($tmp_name,"assets/upload/avatar/".$userData['avatar']);
		}
		
		$userData['firstName']=htmlentities($_REQUEST['firstName']);
		$userData['lastName']=htmlentities($_REQUEST['lastName']);
		$userData['city']=$_REQUEST['city'];
		$userData['country']=$_REQUEST['country'];
		
		
		
		if((isset($_REQUEST['firstName']) && trim($_REQUEST['firstName']) == '') || (isset($_REQUEST['lastName']) && trim($_REQUEST['lastName']) == '') || (isset($_REQUEST['city']) && trim($_REQUEST['city']) == '') || (isset($_REQUEST['country']) && $_REQUEST['country'] == '')) 
		{
			Yii::app()->user->setFlash('error',"Please fill all the required fields.");	
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForAdvisor(Yii::app()->session['fmuserId']);
			$this->render('userProfile_ajax',$profileData);
			exit;
		}
		
		$userObj = new Users();
		$userObj->setData($userData);
		$userObj->insertData(Yii::app()->session['fmuserId']);
		
		
		$advisorObj = new Advisors();
		$adv_id = $advisorObj->getAdvisorIdByUserId(Yii::app()->session['fmuserId']);
		
		$entData = array();
		$entData['organisation']=$_REQUEST['organisation'];
		$entData['work_status']=$_REQUEST['work_status'];
		if(isset($_REQUEST['area_of_expertise']) && $_REQUEST['area_of_expertise'] != "" ){
			$entData['area_of_expertise']= implode(',',$_REQUEST['area_of_expertise']);
		}
		
		$entData['industry']=$_REQUEST['industry'];
		$entData['advisorType']=$_REQUEST['advisorType'];
		$entData['my_pitch']=htmlentities($_REQUEST['my_pitch']);
		if(isset($_REQUEST['startup_experience'])) { 
			$entData['startup_experience']=htmlentities($_REQUEST['startup_experience']);
		}
		$entData['help']=htmlentities($_REQUEST['help']);
		if(isset($_REQUEST['ent_industry']) &&  $_REQUEST['ent_industry'] != "" ){
		$entData['ent_industry']= implode(',',$_REQUEST['ent_industry']);
		}
		$entData['mentorship_experience']=$_REQUEST['mentorship_experience'];
		if(isset($_REQUEST['stage'])){
			$entData['stage']=implode(',',$_REQUEST['stage']);
		}
		
		if((isset($_REQUEST['organisation']) && $_REQUEST['organisation'] == '') || (isset($_REQUEST['industry']) && $_REQUEST['industry'] == '') || (isset($_REQUEST['advisorType']) && $_REQUEST['advisorType'] == '') || (isset($_REQUEST['my_pitch']) && $_REQUEST['my_pitch'] == '') || (isset($_REQUEST['startup_experience']) && $_REQUEST['startup_experience'] == '') || (isset($_REQUEST['help']) && $_REQUEST['help'] == '') || (isset($_REQUEST['ent_industry']) && $_REQUEST['ent_industry'] == '') || (isset($_REQUEST['mentorship_experience']) && $_REQUEST['mentorship_experience'] == '')) 
		{
			Yii::app()->user->setFlash('error',"Please fill all the required fields.");	
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForAdvisor(Yii::app()->session['fmuserId']);
			$this->render('userProfile_ajax',$profileData);
			exit;
		}
		
		$advisorObj = new Advisors();
		$advisorObj->setData($entData);
		$advisorObj->insertData($adv_id);
		
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('advisor/showAdvisorProfile'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
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
		$unreadCount	=	$messageObj->getUnreadMessageCount($userId);
		Yii::app()->session['unreadCount'] = $unreadCount;
		
		$messageObj = new Messages();
		$draftCount	=	$messageObj->getDraftMessageCount($userId);
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("messages",array('data'=>$data,'ext'=>$ext,'unreadCount'=>$unreadCount,'draftCount'=>$draftCount));
		}
		else
		{
			$this->render("messages",array('data'=>$data,'ext'=>$ext,'unreadCount'=>$unreadCount,'draftCount'=>$draftCount));
		}
			
	}
	
	public function actionshowMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		Yii::app()->session['msgTab'] = 'Inbox';
		
		$data['read'] = 1;
		$data['modifiedAt'] = date("Y-m-d H:i:s");
		
		if(isset($_REQUEST['message_id']) && $_REQUEST['message_id'] != ""){
			$messageObj = new Messages();
			$messageObj->setData($data);
			$messageObj->insertData($_REQUEST['message_id']);
		
			$messageObj = new Messages();
			$data = $messageObj->getMessagesWithSenderDetail($_REQUEST['message_id']);
		}else{
			$this->redirect(array("advisor/error"));	
		}
		$this->renderPartial("show_messages",array("message"=>$data));
	}
	
	public function actionshowInbox()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		$userId = Yii::app()->session['fmuserId'];
		
		$messageObj = new Messages();
		$data = $messageObj->getMessages($userId);
		try{
		$this->renderPartial("show_inbox",array("message"=>$data));
		}
		catch(Exception $o)
		{
			$this->redirect(array("advisor/error"));
		}
	}
	
	public function actionsendMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		
		$data = array();
		if(isset($_POST['to']) && $_POST['to'] != "") {
			$data['receiver_id'] = $_POST['to'];
		}else{
				$this->redirect(array('advisor/error'));
		}
		
		$data['subject'] = $_POST['subject'];
		$data['message'] = htmlspecialchars(htmlentities($_POST['message']));
		$data['sender_id'] = Yii::app()->session['fmuserId'];
		$data['status'] = 6;
		$data['read'] = 0 ;
		$data['createdAt'] = date("Y-m-d H:i:s");
		
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData();
/*------------------------Email notification to Ent---------------------------------------------------*/
		$userObj=Users::model()->findbyPk($data['receiver_id']);
		$email = $userObj->email ; 
		$firstName = $userObj->firstName;
		
		
		$userObj=Users::model()->findbyPk($data['sender_id']);
		$uemail = $userObj->email ; 
		$ufirstName = $userObj->firstName;
		$ulastName = $userObj->lastName;
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


/*------------------------Email notification to Ent---------------------------------------------------*/

		Yii::app()->user->setFlash('success',"Succesfully sent.");
		
		$this->redirect(array('advisor/messages'));
	}
	
	public function actionshowSentMessage()
	{
		Yii::app()->session['currentTab'] = 'Messages';
		
		if(isset($_REQUEST['message_id']) && $_REQUEST['message_id'] != ""){
			
			$messageObj = new Messages();
			$data = $messageObj->getMessagesWithReceiverDetail($_REQUEST['message_id']);
		}else{
			$this->redirect(array("advisor/error"));	
		}
		$this->renderPartial("show_sentmessages",array("message"=>$data));
	}
	
	public function actionshowSentMail()
	{
		Yii::app()->session['currentTab'] = 'Messages';
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
		
		if($this->isAjaxRequest())
		{	
			$this->renderPartial("show_sentmail",array('data'=>$data,'ext'=>$ext));
		}
		else
		{
			$this->render("show_sentmail",array('data'=>$data,'ext'=>$ext));
		}
			
	}
	
	public function actionreview()
	{
		Yii::app()->session['currentTab'] = 'Reviews';

		if(!isset($_REQUEST['sortType']))
		{
			$_REQUEST['sortType']='desc';
		}
		if(!isset($_REQUEST['sortBy']))
		{
			$_REQUEST['sortBy']='u.id';
		}
		if(!isset($_REQUEST['keyword']))
		{
			$_REQUEST['keyword']='';
			
		}
		$userId = Yii::app()->session['fmuserId'];
		$userObj = new Users();
		$entrepreneursList	=	$userObj->getPaginatedEntReviewList(LIMIT_10,$_REQUEST['sortType'],$_REQUEST['sortBy'],$_REQUEST['keyword'],$userId);
		
		
		if($_REQUEST['sortType'] == 'desc'){
			$ext['sortType']	=	'asc';
			$ext['img_name']	=	'arrow_up.png';
		} else {
			$ext['sortType']	=	'desc';
			$ext['img_name']	=	'arrow_down.png';
		}
		$ext['keyword']=$_REQUEST['keyword'];
		
		$data['pagination']	=	$entrepreneursList['pagination'];
        $data['entrepreneurs']	=	$entrepreneursList['entrepreneurs'];
		
		/*print "<pre>";
		print_r($entrepreneursList);
		exit;*/
		$this->render("review",array("data"=>$data,'ext'=>$ext));
		
	}
	
	public function actiontrashMessages()
	{
		Yii::app()->session['currentTab'] = 'Messages';
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
			$this->renderPartial("trash_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("trash_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
			
	}
	
	public function actionshowEntrepreneurProfile($userId)
	{
		if(isset($userId) && $userId != '')
		{
			Yii::app()->session['currentTab'] = 'Reviews';
			
			$alogObj = new Algoencryption();
			$userId =  $alogObj->decrypt($userId);
			
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForEntrepreneur($userId); 
			
			if(empty($profileData))
			{
				Yii::app()->user->setFlash('error',"No user found.");
				$this->redirect(array("entrepreneur/error"));
			}
			
			$this->render('entProfile',$profileData);
		
		}
		else
		{
			$this->redirect(array("advisor/error"));
		}
	}
	
	public function actionsaveAsRecieverTrash()
	{
		
		$data = array();
		//$data['status'] = 3;
		$data['receiver_trash'] = 1;
		$data['read'] = 1;
		if(isset($_REQUEST['message_id']) && $_REQUEST['message_id'] != "")
		{
			$messageObj = new Messages();
			$messageObj->setData($data);
			$messageObj->insertData($_REQUEST['message_id']);
		}else{
			$this->redirect(array("advisor/error"));	
		}
		
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	public function actionsaveAsSenderTrash()
	{
		$data = array();
		//$data['status'] = 3;
		$data['sender_trash'] = 1;
		//$data['read'] = 1;
		
		if(isset($_REQUEST['message_id']) && $_REQUEST['message_id'] != "")
		{
			$messageObj = new Messages();
			$messageObj->setData($data);
			$messageObj->insertData($_REQUEST['message_id']);
		}else{
			$this->redirect(array("advisor/error"));	
		}
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
	public function actionsaveAsDraft()
	{
		if(!isset($_REQUEST['message_id']) || $_REQUEST['message_id'] == "")
		{
			$this->redirect(array("advisor/error"));	
		}
		$data = array();
		$data['status'] = 4;
		$messageObj = new Messages();
		$messageObj->setData($data);
		$messageObj->insertData($_REQUEST['message_id']);
		
		$this->actionmessages();
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
			$this->renderPartial("draft_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
		else
		{
			$this->render("draft_messages",array('data'=>$data,'ext'=>$ext,'draftCount'=>$draftCount,'unreadCount'=>$unreadCount));
		}
	}
	
	public function actioneditProfile()
	{
		
		$advisorObj = new Advisors();
		$id = $advisorObj->getAdvisorIdByUserId(Yii::app()->session['fmuserId']);
		
		$advisorObj = new Advisors();
		$advisorObj->setData($_POST);
		$advisorObj->insertData($id);
		Yii::app()->user->setFlash('success',"Successfully updated");
		$this->redirect(array('advisor/showAdvisorProfile'));
		//Yii::app()->user->setFlash('error',"Please update your profile");
		//$this->render('userProfile',$profileData);
	
	}
	
	public function actioneditProfile2()
	{
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
		$this->redirect(array('advisor/showAdvisorProfile'));
	}
	
	public function actionshowEntProfile($userId)
	{
		if(isset($userId) && $userId != '')
		{
			Yii::app()->session['currentTab'] = 'Profile';
			
			$alogObj = new Algoencryption();
			$userId =  $alogObj->decrypt($userId);
			$userObj = new Users();
			$profileData = $userObj->getProfileDataForEntrepreneur($userId); 
			if(empty($profileData))
			{
				$this->redirect(array("advisor/error"));
			}
			else
			{
				$this->render('entrepreneurProfile',$profileData);
			}
			exit;
		
		}
		else
		{
			$this->redirect(array("advisor/error"));
		}
		
	}
	
	public function actionshowAdvisorProfileAjax()
	{
		Yii::app()->session['currentTab'] = 'Profile';
		
		$userObj = new Users();
		$profileData = $userObj->getProfileDataForEntrepreneur(Yii::app()->session['fmuserId']); 
		
		$advisorsObj = new Advisors();
		$advisorData = $advisorsObj->getAdvisorByUserId(Yii::app()->session['fmuserId']); 
		
		if((isset($advisorData) && !empty($advisorData)) || (isset($profileData) && !empty($profileData)))
		
		{
		
			$data = array_merge($profileData,$advisorData);
			$this->render('userProfile_ajax',$data);
		}
		else
		{
			$this->render('userProfile_ajax');
		}
		
	}
	
	function actiondeleteMessages()
	{
		if(!isset($_REQUEST['ids']) || $_REQUEST['ids'] == "")
		{
			$this->redirect(array("advisor/error"));
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
		if(!isset($_REQUEST['ids']) || $_REQUEST['ids'] == "")
		{
			$this->redirect(array("advisor/error"));
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
		if(!isset($_REQUEST['ids']) || $_REQUEST['ids'] == "")
		{
			$this->redirect(array("advisor/error"));
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
		if(!isset($_REQUEST['ids']) || $_REQUEST['ids'] == "")
		{
			$this->redirect(array("advisor/error"));
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