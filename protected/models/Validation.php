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
class Validation extends CFormModel 
{
	/*
	Validation for Seeker Sign Up Form
	PARAM : Array of Post Data
	*/
	public $msg;
	public $errorCode;
	
	public function __construct()
	{
		$this->msg = Yii::app()->params->msg;
		$this->errorCode = Yii::app()->params->errorCode;
	}
	
	
	function signup($_POST,$isBulkUpload=0)
	{
		$validator	=	new FormValidator();
		$userObj	=	new Users();
		$generalObj	=	new General();
		
		
		$validator->addValidation("email","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("email","minlen=7",'_CONTACT_US_INVALID_EMAIL_VALIDATE_');
		$validator->addValidation("companyName","req",'_COMPANY_VALIDATE_SPECIAL_CHAR_');
		$validator->addValidation("companyName","minlen=3",'_CNAME_VALIDATE_LENGTH_');
		/*$validator->addValidation("password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("password","maxlen=50",'_PASSWORD_VALIDATE_LENGTH_');
		//$validator->addValidation("password","alphanumeric",'_PASSWORD_VALIDATE_ALPHANUMERIC');
		$validator->addValidation("cpassword","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("cpassword","maxlen=50",'_PASSWORD_VALIDATE_LENGTH_');
		$validator->addValidation("password","minlen=8",'_PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("cpassword","minlen=8",'_PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER_');*/
		$validator->addValidation("country","req",'please enter the country name.');
		if(isset($_POST['email']) && $_POST['email']!='' && trim($_POST['email'])!=$this->msg['_EMAIL_'])
		{
			$validator->addValidation("email","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
			$result = $userObj->checkOtherEmail($_POST['email'],'',1);
				
			if(!empty($result)){
				$validator->addValidation("email_unique","req",'EMAIL_ERR_MSG');
			}
		}
		
		/*if(trim($_POST['password'])!=trim($_POST['cpassword']))
		{
			
			return $status = array('status'=>$this->errorCode['_CONFIRM_PASSWORD_NOT_MATCH_'],'message'=>$this->msg['_CONFIRM_PASSWORD_NOT_MATCH_']);
			
		}*/
		/*if (!preg_match("/^([0-9a-zA-Z])+$/",$_POST['password'])) 
   		 {
			 return $status = array('status'=>$this->errorCode['_PASSWORD_VALIDATE_ALPHANUMERIC'],'message'=>$this->msg['_PASSWORD_VALIDATE_ALPHANUMERIC']);
		 }*/
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function registerEnterpreneur($_POST)
	{
		$validator	=	new FormValidator();
		if(isset($_POST['firstName']) && $_POST['firstName']== '1')
		{
			$validator->addValidation("firstName","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['lastName']) && $_POST['lastName']== '1')
		{
			$validator->addValidation("lastName","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['email']) && $_POST['email']== '1')
		{
			$validator->addValidation("email","req",'_EMAIL_REQ_');
		}
		if(isset($_POST['email']) && $_POST['email']== '1')
		{
			$validator->addValidation("email","email",'_EMAIL_VALID_');
		}
		if(isset($_POST['password']) && $_POST['password']== '1')
		{
			$validator->addValidation("password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['country']) && $_POST['country']== '1')
		{
			$validator->addValidation("country","req",'_COUNTRY_NAME_VALIDATE_');
		}
		//$validator->addValidation("city","req",'_CITY_VALIDATE_');
		//$validator->addValidation("avatar","req",'_CITY_VALIDATE_');

		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function registerAdvisor($_POST)
	{
		
		$validator	=	new FormValidator();
		
		if(isset($_POST['firstName']) && $_POST['firstName']== '1')
		{
			$validator->addValidation("firstName","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['lastName']) && $_POST['lastName']== '1')
		{
			$validator->addValidation("lastName","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['email']) && $_POST['email']== '1')
		{
			$validator->addValidation("email","req",'_EMAIL_REQ_');
		}
		if(isset($_POST['email']) && $_POST['email']== '1')
		{
			$validator->addValidation("email","email",'_EMAIL_VALID_');
		}
		if(isset($_POST['password']) && $_POST['password']== '1')
		{
			$validator->addValidation("password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		}
		if(isset($_POST['country']) && $_POST['country']== '1')
		{
			$validator->addValidation("country","req",'_COUNTRY_NAME_VALIDATE_');
		}
		//$validator->addValidation("city","req",'_CITY_VALIDATE_');
		//$validator->addValidation("avatar","req",'_CITY_VALIDATE_');
		//$validator->addValidation("area_of_expertise","req",'_EXP_AREA_');
		if(isset($_POST['startup_experience']) && $_POST['startup_experience']== '1')
		{
			$validator->addValidation("startup_experience","req",'_STARTUP_EXP_');
		}
		
		/*if(isset($_POST['startup_experience']) && $_POST['startup_experience']== '1')
		{
		
			$validator->addValidation("startup_roles","req",'_STARTUP_ROLE_');
		}*/
		
		$validator->addValidation("mentorship_experience","req",'_MENTOR_EXP_');
		
		if(isset($_POST['mentorship_experience']) && $_POST['mentorship_experience']== '1')
		{
		
			$validator->addValidation("mentorship_details","req",'_MENTOR_DETAILS_');
		}
		
		//$validator->addValidation("referral","req",'_REFERRAL_');
		
		/*if($_POST['referral']== '1')
		{
		
			$validator->addValidation("referralId","req",'_REFERRALId_');
		}*/
		if(isset($_POST['organisation']) && $_POST['organisation']== '1')
		{
			$validator->addValidation("organisation","req",'_ORG_VALIDATE_');
		}
		
		if(isset($_POST['work_status']) && $_POST['work_status']== '1')
		{
			$validator->addValidation("work_status","req",'_WORK_VALIDATE_');
		}
		//$validator->addValidation("industry","req",'_INDUSTRY_');

		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function reviewValidation($_POST)
	{
		$validator	=	new FormValidator();

		$validator->addValidation("usefulness","req",'_USEFULNESS_');
		$validator->addValidation("knowledge","req",'_KNOWLEDGE_');
		$validator->addValidation("timeliness","req",'_TIMELINESS_');
		$validator->addValidation("recommend","req",'_RECOMMEND_');
		$validator->addValidation("expertisearea","req",'_EXPERTISEAREA_');
		$validator->addValidation("comment","req",'_COMMENT_');
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function register_first($_POST)
	{
		$validator	=	new FormValidator();

		$validator->addValidation("companyType","req",'_COMPANY_TYPE_VALIDE_');
		if($_POST['companyType']== 'Other')
		{
			$validator->addValidation("specify","req",'_COMPANY_TYPE_SPECIFY_VALIDE_');
		}
		$validator->addValidation("companyName","req",'_COMPANY_VALIDATE_SPECIAL_CHAR_');
		$validator->addValidation("companyName","minlen=3",'_CNAME_VALIDATE_LENGTH_');
		$validator->addValidation("companyName","maxlen=60",'_FNAME_VALIDATE_LENGTH_');
		$validator->addValidation("phoneNumber","req",'_PHONE_VALIDATE_');
		$validator->addValidation("nature","req",'_NATURE_VALIDATE_');
		$validator->addValidation("bus_postal_code","req",'_BUSS_POSTAL_VALIDATE_');
		$validator->addValidation("bus_address","req",'_COMPANY_ADD_VALIDATE_');
		$validator->addValidation("bus_city","req",'_COMPANY_CITY_VALIDATE_');
		$validator->addValidation("bus_country","req",'_COMPANY_COUNTRY_VALIDATE_');
		
		if($_POST['bus_reg_add']== 'No')
		{
		
			$validator->addValidation("trd_postal_code","req",'_TRD_POSTAL_VALIDATE_');
			$validator->addValidation("trd_address","req",'_TRD_ADD_VALIDATE_');
			$validator->addValidation("trd_city","req",'_TRD_CITY_VALIDATE_');
			$validator->addValidation("trd_coutry","req",'_TRD_COUNTRY_VALIDATE_');
		}
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	
	
	function register_second($_POST)
	{
		$validator	=	new FormValidator();
		
		$validator->addValidation("title","req",'_TITLE_VALIDE_');
		$validator->addValidation("firstName","req",'_FNAME_VALIDATE_');
		//$validator->addValidation("middleName","req",'_MNAME_VALIDATE_');
		$validator->addValidation("lastName","req",'_LNAME_VALIDATE_');
		$validator->addValidation("phone","req",'_COMPANY_PHONE_VALIDATE_');
		$validator->addValidation("email","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("email","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("birthDate","req",'_BIRTHDATE_VALIDATE_');
		
		if(isset($_POST['authorizePerson']) && $_POST['authorizePerson'] == '1')
		{
		
			$validator->addValidation("authtitle","req",'_TITLE_VALIDE_');
			$validator->addValidation("authfirstName","req",'_FNAME_VALIDATE_');
			//$validator->addValidation("authmiddleName","req",'_MNAME_VALIDATE_');
			$validator->addValidation("authlastName","req",'_LNAME_VALIDATE_');
			$validator->addValidation("authphone","req",'_COMPANY_PHONE_VALIDATE_');
			$validator->addValidation("authemail","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
			$validator->addValidation("authemail","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
			$validator->addValidation("authbirthDate","req",'_BIRTHDATE_VALIDATE_');
		}
		$validator->addValidation("postal_code","req",'_POSTAL_VALIDATE_');
		$validator->addValidation("address","req",'_ADD_VALIDATE_');
		$validator->addValidation("city","req",'_CITY_VALIDATE_');
		$validator->addValidation("country","req",'_COUNTRY_VALIDATE_');
			
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}


	function register_third($_POST)
	{
		$validator	=	new FormValidator();
		
		$validator->addValidation("reason","req",'_REASON_VALIDE_');
		$validator->addValidation("paymentFrom","req",'_FROM_VALIDATE_');
		$validator->addValidation("paymentTo","req",'_TO_VALIDATE_');
		$validator->addValidation("currency","req",'_CURR_VALIDATE_');
		$validator->addValidation("volume","req",'_COMPANY_VOLUME_VALIDATE_');
		$validator->addValidation("checkbox1","req",'_CHECKBOX1_VALIDATE_');
		$validator->addValidation("checkbox2","req",'_CHECKBOX2_VALIDATE_');
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}


	/*
	For Contact us form validation in both side
	PARAM : Array of Post Data
	*/
	function createOrder($_POST)
	{
		$validator	=	new FormValidator();

		$validator->addValidation("senderFirstName","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("senderLastName","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("senderEmail","req",'_EMAIL_VALIDATE_');
		$validator->addValidation("senderEmail","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		//$validator->addValidation("senderBirthDate","req",'_BIRTHDATE_VALIDATE_');
		$validator->addValidation("senderPhoneNumber","req",'_PHONE_VALIDATE_');
		$validator->addValidation("senderPostalCode","req",'_POSTAL_VALIDATE_');
		$validator->addValidation("senderAddress","req",'_SENDER_ADD_VALIDATE_');
		//$validator->addValidation("senderCity","req",'_SENDER_CITY_VALIDATE_');
		$validator->addValidation("senderCountry","req",'_SENDER_COUNTRY_VALIDATE_');
		$validator->addValidation("payment","req",'_PAY_VALIDATE_');
		$validator->addValidation("recipientName","req",'_RECIVER_NAME_VALIDATE_');
		$validator->addValidation("recipientEmail","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("recipientEmail","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("ibanNo","req",'_IBAN_VALIDATE_');
		$validator->addValidation("reference","req",'_REFER_VALIDATE_');
		$validator->addValidation("bicNo","req",'_BIC_VALIDATE_');

		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function register_person_receipient($_POST)
	{
		$validator	=	new FormValidator();

		$validator->addValidation("rec_title","req",'_TITLE_VALIDE_');
		$validator->addValidation("rec_firstName","req",'_FNAME_VALIDATE_');
		$validator->addValidation("rec_lastName","req",'_LNAME_VALIDATE_');
		$validator->addValidation("rec_phone","req",'_PHONE_VALIDATE_');
		$validator->addValidation("rec_phone","num",'ACCOUNT_NOT_AVAILABLE');
		$validator->addValidation("rec_mobile","num",'_MOBILE_NOT_VALEDATE_');
		$validator->addValidation("rec_email","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("rec_email","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("rec_address","req",'_ADD_VALIDATE_');
		$validator->addValidation("rec_city","req",'_CITY_VALIDATE_');
		$validator->addValidation("rec_postal_code","req",'_POSTAL_VALIDATE_');
		$validator->addValidation("rec_country","req",'_COUNTRY_VALIDATE_');		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
		function register_buss_receipient($_POST)
	{
		$validator	=	new FormValidator();
		
		/*$validator->addValidation("rec_companyName","req",'_COMPANY_VALIDATE_SPECIAL_CHAR_');
		$validator->addValidation("rec_companyType","req",'_COMPANY_TYPE_VALIDE_');
		$validator->addValidation("rec_phoneNumber","req",'_PHONE_VALIDATE_');
		$validator->addValidation("rec_nature","req",'_NATURE_VALIDATE_');
		$validator->addValidation("rec_bus_postal_code","req",'_BUSS_POSTAL_VALIDATE_');
		$validator->addValidation("rec_bus_address","req",'_COMPANY_ADD_VALIDATE_');
		$validator->addValidation("rec_bus_city","req",'_COMPANY_CITY_VALIDATE_');
		$validator->addValidation("rec_bus_country","req",'_COMPANY_COUNTRY_VALIDATE_');
		
		if($_POST['rec_bus_reg_add']== 'No')
		{
		
			$validator->addValidation("rec_trd_postal_code","req",'_TRD_POSTAL_VALIDATE_');
			$validator->addValidation("rec_trd_address","req",'_TRD_ADD_VALIDATE_');
			$validator->addValidation("rec_trd_city","req",'_TRD_CITY_VALIDATE_');
			$validator->addValidation("rec_trd_coutry","req",'_TRD_COUNTRY_VALIDATE_');
		}*/
		
		$validator->addValidation("rec_bankName","req",'_BANK_NAME_VALIDE_');
		$validator->addValidation("rec_bank_accountNo","req",'_BANK_ACC_VALIDATE_');
		$validator->addValidation("rec_iban_no","req",'_IBAN_VALIDATE_');
		$validator->addValidation("rec_branch_no","req",'_BANK_BRANCH_VALIDATE_');
		$validator->addValidation("rec_bic_no","req",'_BIC_VALIDATE_');
		
		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function register_person_UserProfile($_POST)
	{
		$validator	=	new FormValidator();

		$validator->addValidation("title","req",'_TITLE_VALIDE_');
		$validator->addValidation("firstName","req",'_FNAME_VALIDATE_');
		$validator->addValidation("lastName","req",'_LNAME_VALIDATE_');
		$validator->addValidation("phone","req",'_PHONE_VALIDATE_');
		$validator->addValidation("phone","num",'ACCOUNT_NOT_AVAILABLE');
		//$validator->addValidation("mobile","num",'_MOBILE_NOT_VALEDATE_');
		$validator->addValidation("email","req",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("email","email",'_EMAIL_VALIDATE_ACCOUNTMANAGER_');
		$validator->addValidation("address","req",'_ADD_VALIDATE_');
		$validator->addValidation("city","req",'_CITY_VALIDATE_');
		$validator->addValidation("postal_code","req",'_POSTAL_VALIDATE_');
		$validator->addValidation("country","req",'_COUNTRY_VALIDATE_');		
		if(!$validator->ValidateForm())
		{
			$error_hash = $validator->GetError();
			
			if($this->errorCode[$error_hash] == 164)
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);
			}
			else
			{
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			}			
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
		
	}
	
	function contactUs($_POST)
	{
		 $validator = new FormValidator();
		 $validator->addValidation("name","req",'_CONTACT_US_NAME_VALIDATE_');
		 $validator->addValidation("name","fullname",'_NAME_VALIDATE_SPECIAL_CHAR_');
		 $validator->addValidation("name","maxlen=25",'_NAME_VALIDATE_MAX_LEN_');
		
		 if(!isset($_POST['email']))
		 {
			 $validator->addValidation("email","req",'_CONTACT_US_EMAIL_VALIDATE_');
		 }
		 $validator->addValidation("email","req",'_CONTACT_US_EMAIL_VALIDATE_');
		 $validator->addValidation("email","email",'_CONTACT_US_INVALID_EMAIL_VALIDATE_');
		 $validator->addValidation("comment","req",'_CONTACT_US_COMMENT_VALIDATE_');
		 $validator->addValidation("comment","comment",'_COMMENT_VALIDATE_SPECIAL_CHAR_');
		 $validator->addValidation("comment","minlen=20",'_CONTACT_US_COMMENT_LENGTH_VALIDATE_');
		 
		 if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();
			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
			return $status;
		}
		else
		{
			return array('status'=>0,'message'=>'success');
		}
			
	}
	
	/*
	Validation for Forgot Password Form
	PARAM : Array of Post Data
	*/
	function forgot_password($_POST)
	{
		 $validator = new FormValidator();
		 $validator->addValidation("loginId","req",'EMAIL_PHONE_MSG');
		 
		 if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();
			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
	 		return $status;
		 }
		 else
		 {
			return array('status'=>0,'message'=>'success');
		 } 	
	}
	
	/*
	Validation for Reset Password Form
	PARAM : Array of Post Data
	*/
	function resetpassword($_POST)
	{
		 $validator = new FormValidator();
		// $validator->addValidation("token","req",'VALIDATE_TOKEN');
		 $validator->addValidation("new_password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		 $validator->addValidation("new_password","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		 //$validator->addValidation("new_password_confirm","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');
		 //$validator->addValidation("new_password_confirm","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		
		/* if(trim($_POST['new_password'])!=trim($_POST['new_password_confirm']))
  		{
     		$validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');
  		}
		*/
		if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();
			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
	 		return $status;
		 }
		 else
		 {
			return array('status'=>0,'message'=>'success');
		 } 	 
	}
	
	
	function is_valid_email($email) 
	{
		$result = TRUE;
		 if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) { 
			  $result = false; 
		  } 
		  else { 
		  $result = true; }
			return $result;
	}
	 
	function checkArrayDiff($dbArray,$chkArray)
	{		 
	
		if(!is_array($dbArray) || !is_array($chkArray) || empty($chkArray))
		{			
			return false; 
		}
		 
		$result = array_diff($dbArray,$chkArray);
		if(count($result)==count($dbArray))
		{
			return false; 
		}
		else
		{			
			return true; 
		}
	
	}
	 
	function sendEmail()
	{
		$validator = new FormValidator();
		$validator->addValidation("seekerId", "req", '_NO_SEEKER_SELECTED_');
		$validator->addValidation("subject", "req", '_EMPTY_EMAIL_SUBJECT_');
		$validator->addValidation("subject", "comment", '_EMAIL_SUBJECT_NO_SPECIAL_CHARACTER_');
		$validator->addValidation("subject", "maxlen=50", '_EMAIL_SUBJECT_');
		$validator->addValidation("body", "req", '_EMPTY_EMAIL_BODY_');
		$validator->addValidation("body", "comment", '_EMPTY_EMAIL_BODY_');
		$validator->addValidation("body", "maxlen=120", '_EMAIL_BODY_NO_SPECIAL_CHARACTER_');
		if(!$validator->ValidateForm())
		{
				$error_hash = $validator->GetError();
				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
				return $status;
		}
		else
		{
				return array('status'=>0,'message'=>'success');
		}
	 }
	 
	  function updateAdminProfile($post)
	 {
		$validator = new FormValidator();
            
			$validator->addValidation("FirstName", "req", $this->msg['_FNAME_VALIDATE_ACCOUNTMANAGER_']);
            $validator->addValidation("LastName", "name", $this->msg['_LNAME_VALIDATE_SPECIAL_CHAR_']);
            $validator->addValidation("Email", "req", $this->msg['_INVALID_PARAMETERS_']);
            
			if (!$validator->ValidateForm()) {
                $error_hash = $validator->GetError();
                $result[1] = $error_hash;
				return array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]); 	
            }else{	
				return array('status'=>0,'message'=>'success'); 	
			}
	 }
	 
}
