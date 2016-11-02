<?php
//error_reporting(0);
//include(FILE_PATH."protected/vendors/Smarty/smartyml.class.php");
//Yii::import("application.vendors.Smarty.smartyml.class.php");
class ApiController extends Controller 
{		
	public $msg;
	public $errorCode;
	
	function beforeAction() 
	{
		global $msg;
		global $errorCode;
		return true;
	}
	
	function actionindex($functionname=NULL,$id=NULL,$resFormat='xml')
	{	
		if(isset($_GET['uri']) && $_GET['uri']!='')
		{
			$this->get($_GET['uri']);
		}
		else if( (isset($_GET['functionname']) || $functionname!=NULL) && $_GET['functionname']!='get')
		{
			
			$functionname=$_GET['functionname'];
			$client_ip=$_SERVER['REMOTE_ADDR'];
			$restArray['clientIp']=$client_ip;
			$restArray['requestTime']=date('Y-m-d h:s:i');
			$restArray['functionname']=$functionname;
			if(!empty($_GET))
			{
				$restArray['getParameter']=serialize($_GET);
				error_log("INFO REST CALL GET PARA:".$this->getStructuredArray($_GET));
			}
			if(!empty($_FILES))
			{
				if(isset($_FILES['avatar']['name']) && isset($_REQUEST['accountManagerId']))
				{
					$_POST['accountManagerId']=$_REQUEST['accountManagerId'];
					$account_manager = new AccountManagers();
					$result=$account_manager->uploadAvatar($_POST,$_FILES);
					error_log("INFO ACM AVATAR:".$this->getStructuredArray($result));
					if($result['status']==0)
					{
						$_POST['file_name']=$result['result'];
					}
				}
				if(isset($_FILES['avatar']['name']) && isset($_REQUEST['seekerId']))
				{
					$_POST['seekerId']=$_REQUEST['seekerId'];
					$seekerObj = new Seeker();
					$result=$seekerObj->uploadAvatar($_POST,$_FILES);
					error_log("INFO SEEKER AVATAR:".$this->getStructuredArray($result));
					if($result['status']==0)
					{
						$_POST['file_name']=$result['result'];
					}
				}
			
				if(isset($_FILES['businessLogoFile']['name']))
				{
					$employerObj = new Employer();
					$result=$employerObj->uploadBusinessLogo($_POST,$_FILES);
					if($result['status']==0)
					{
						$_POST['logo_file_name']=$result['result'];
					}
				}
				
				
				if(isset($_FILES['businessProfileFile']['name']))
				{
					$employerObj = new Employer();
					$result=$employerObj->businessProfileImage($_POST,$_FILES);
					if($result['status']==0)
					{
						$_POST['profile_file_name']=$result['result'];
					}
				}
					
			}
			
			if(!empty($_POST))
			{
				$restArray['postParameter']=serialize($_POST);
				error_log("INFO REST CALL POST PARA:".$this->getStructuredArray($_POST));
			}
			
			$restArray['status']=200;
			$restArray['expiry']=time()+API_LINK_EXPIRY_TIME;
			$restArray['uri']=md5(date('Y-m-d h:s:i').rand());
			$restArray['created']=date('Y-m-d h:s:i');
			$incoming_rest_callObj=new IncomingRestCalls();
			
			$incoming_rest_callObj->setData($restArray);
			$id=$incoming_rest_callObj->insertData();
			error_log("INFO Deamon called for ID:".$id,3,"/var/www/html2/dlogs/log.txt");
			error_log("INFO Deamon called for ID:".$id,3,"/var/www/html2/dlogs/log.txt");
			
			error_log("INFO Deamon called for ID:".$id);
			error_log("INFO SET URI:".$restArray['uri']);
			error_log("INFO REQUEST FOR:".$restArray['uri']);
			$data=array('status'=>0,'uri'=>$restArray['uri']);
			$responseFunction=$this->format.'Response';
			$this->$responseFunction($data);
			$sig = new signals_lib();
			$sig->get_queue($this->arr['rcv_rest']);
            $sig->send_msg("rcv_rest");
			
		}
		else
		{
			$data=array('status'=>2,'message'=>'Invalid Url.');
			$responseFunction=$this->format.'Response';
			$this->$responseFunction($data);
				
		} 
	}
	
	function actionapilist()
	{		
		$this->renderPartial('apilist');
	}
	
	//-------------------------------------- Get language listing ------------------------------>
	function actiongetLanguageList()
	{	
		$languageObj=new HealthLang();
		if(isset($_REQUEST['country_id']) && $_REQUEST['country_id']!='')
		{
			$data=$languageObj->getLanguageListByCountryId($_REQUEST['country_id']);
		}
		else
		{
			$data=$languageObj->getLanguageList();
		}
		if(!empty($data))
		{
			$result['status'] = 1;
			$result['message'] = $data;		
		}
		else
		{
			$result['status'] = 0;
			$result['message'] = "No language found";	
		}
		echo json_encode($result);	
		
	}
	
	//-------------------------------------- Get country listing ------------------------------>
	function actiongetCountryList()
	{	
		$countryObj=new HealthCountry();
		$data=$countryObj->getCountryList();
		if(!empty($data))
		{
			$result['status'] = 1;
			$result['message'] = $data;		
		}
		else
		{
			$result['status'] = 0;
			$result['message'] = "No country found";	
		}
		echo json_encode($result);
	}
	
	//-------------------------------------- Get Disease listing ------------------------------>
	function actiongetDiseaseList()
	{	
		$diseaseObj=new HealthDisease();
		$data=$diseaseObj->getDiseaseList();
		if(isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='')
		{
			$languageId = $_REQUEST['language_id'];
		}
		else
		{
			$languageId = '1';
		}
		$i=0;
		foreach($data as $res)
		{
			$diseaseLanguageObj = new HealthDiseaseLanguageSupport();		
			$languageData = $diseaseLanguageObj->getDiseaseDetails($res['disease_id'],$languageId);
			if(isset($languageData['disease_name']))
			{
				$data[$i]['disease_name'] = $languageData['disease_name'];
			}
			else
			{
				unset($data[$i]);
			}
			$i++;
		}
					
		if(!empty($data))
		{
			$result['status'] = 1;
			$result['message'] = $data;		
		}
		else
		{
			$result['status'] = 0;
			$result['message'] = "No product found";	
		}
		echo json_encode($result);
	}
	
	// URL = http://localhost/healthapp/index.php?r=api/getProductList&language_id=2
	//-------------------------------------- Get product listing ------------------------------>
	function actiongetProductList()
	{	
		$productObj = new HealthMedicationProfile();
		if(isset($_REQUEST['disease_id']) && $_REQUEST['disease_id']!='')
		{
			$data=$productObj->getProductListByDeseaseId($_REQUEST['disease_id']);
		}
		else
		{
			$data=$productObj->getProductList();
			
		}
		
		if(isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='')
		{
			$languageId = $_REQUEST['language_id'];
		}
		else
		{
			$languageId = '1';
		}
		$i=0;
		$j=0;
		$array = array();
		foreach($data as $res)
		{	
			$productDetailsObj = new HealthMedicationLanguageSupport();		
			$languageData = $productDetailsObj->getProductDetails($res['medication_id'],$languageId);
			if(isset($languageData['medication_name']))
			{
				$array[$j] = $res;
				$array[$j]['medication_name'] = $languageData['medication_name'];
				$j++;
			
			}
			else
			{
				unset($data[$i]);
			}
			$i++;
		}
		
		if(!empty($array))
		{
			$result['status'] = 1;
			$result['message'] = $array;	
			
			
		}
		else
		{
			$result['status'] = 0;
			$result['message'] = "No product found";	
		}
		
		echo json_encode($result);
		
	}
	
	//-------------------------------------- Get product listing ------------------------------>
	function actiongetProductDetails()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='' && isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!='')
		{			
			$languageId = $_REQUEST['language_id'];
			$medicationId = $_REQUEST['medication_id'];
			
			$productDetailsObj=new HealthMedicationLanguageSupport();
			$data=$productDetailsObj->getProductDetails($medicationId,$languageId);
			
			$productObj = new HealthMedicationProfile();
			$logopath = $productObj->getProductDetailsByMedicationId($medicationId);
			
			$data['medication_image'] = $logopath['medication_image'];
			
			$profileCategoryObj=new HealthMedicationProfileCategory();		
			$categoryData = $profileCategoryObj->getCategoryIdByMedicationId($data['medication_id']);
			
			$i=0;
			$j=0;
			foreach($categoryData as $cat)
			{	
				$healthCategoryDetailsObj = new HealthCategoryLanguageSupport();		
				$categoryDetails = $healthCategoryDetailsObj->getCategoryDetails($cat['category_id'],$languageId);			
				//$categoryData[$i]['category_data'] = $languageData['medication_name'];
				if(!empty($categoryDetails))
				{
					$categoryArray[$j] = $categoryDetails;
					$j++;
				}
				$i++;
			}
			if(isset($categoryArray) && !empty($categoryArray))
			{
				$data['category'] = $categoryArray;	
			}
			else
			{
				$data['category'] = '';	
			}
			if(!empty($data))
			{
				$result['status'] = 1;
				$result['message'] = $data;		
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = "No product details found";	
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
	
	//-------------------------------------- Get category listing ------------------------------>
	function actiongetCategoryList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='' && isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!='')
		{			
			$languageId = $_REQUEST['language_id'];
			$medicationId = $_REQUEST['medication_id'];
						
			$profileCategoryObj=new HealthMedicationProfileCategory();		
			$categoryData = $profileCategoryObj->getCategoryIdByMedicationId($medicationId);
			$data = array();
			$i=0;
			$j=0;
			foreach($categoryData as $cat)
			{	
				$healthCategoryDetailsObj = new HealthCategoryLanguageSupport();		
				$categoryDetails = $healthCategoryDetailsObj->getCategoryDetailsForListing($cat['category_id'],$languageId);			
				if(!empty($categoryDetails))
				{
					$data[$j] = $categoryDetails;
					$j++;
				}
				$i++;
			}
			
			if(!empty($data))
			{
				if(isset($_REQUEST['medication_id']) && $_REQUEST['medication_id']!='' && isset($_REQUEST['user_udid']) && $_REQUEST['user_udid']!='')
				{
					$array['user_udid']= $_REQUEST['user_udid'];
					$array['medication_id']= $_REQUEST['medication_id'];
					$array['language_id']= $_REQUEST['language_id'];
					$array['view_date_time']= date("Y-m-d H:i:s");
					$array['creation_date']= date("Y-m-d H:i:s");
					$array['modify_date']= date("Y-m-d H:i:s");
					
					$analyticObj=new HealthMedicationProfileAnalytics();
					$analyticObj->setData($array);
					$analyticObj->insertData();
				}
				$result['status'] = 1;
				$result['message'] = $data;		
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = "No category found";	
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
	
	//-------------------------------------- Get sub category listing ------------------------------>
	function actiongetSubCategoryList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='' && isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
		{			
			$languageId = $_REQUEST['language_id'];
			$category_id = $_REQUEST['category_id'];
						
			$healthCategoryObj=new HealthCategory();		
			$data = $healthCategoryObj->getSubCategoryByCategoryId($category_id);
			$i=0;
			foreach($data as $res)
			{	
				$categoryDetailsObj=new HealthCategoryLanguageSupport();		
				$categoryData = $categoryDetailsObj->getCategoryDetails($res['category_id'],$languageId);
				if(isset($categoryData['category_name']) && $categoryData['category_name']!='')
				{
					$data[$i]['category_name'] = $categoryData['category_name'];
				
				}
				else
				{
					$data[$i]['category_name'] = "";
				}
				$i++;
			}			
			if(!empty($data))
			{
				$result['status'] = 1;
				$result['message'] = $data;		
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = "No sub category found";	
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
	
	//-------------------------------------- Get sub category listing ------------------------------>
	function actiongetSubCategoryDetails()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['language_id']) && $_REQUEST['language_id']!='' && isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
		{			
			$languageId = $_REQUEST['language_id'];
			$category_id = $_REQUEST['category_id'];
						
			$healthCategoryObj=new HealthCategory();		
			$data = $healthCategoryObj->getSubCategoryByCategoryId($category_id);
			if(!empty($data))
			{
				$i=0;
				foreach($data as $res)
				{	
					$categoryDetailsObj=new HealthCategoryLanguageSupport();		
					$categoryData = $categoryDetailsObj->getCategoryDetails($res['category_id'],$languageId);
					if(isset($categoryData['category_name']) && $categoryData['category_name']!='')
					{
						$data[$i]['category_name'] = $categoryData['category_name'];
					
					}
					else
					{
						$data[$i]['category_name'] = "";
					}
					$i++;
				}	
			}
			else
			{
				$categoryDetailsObj=new HealthCategoryLanguageSupport();		
				$categoryData = $categoryDetailsObj->getCategoryDetails($category_id,$languageId);
			}
			if(!empty($data))
			{
				$result['status'] = 1;
				$result['type'] = 1;
				$result['message'] = $data;		
			}
			else
			{				
				$result['status'] = 1;
				$result['type'] = 0;
				$result['message'] = $categoryData;	
				
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
			
	//-------------------------------------- Add favorite listing ------------------------------>
	function actionaddFavourite()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['user_udid']) && ((isset($_REQUEST['category_id']) || (isset($_REQUEST['medication_id'])))))
		{	
			if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
			{
				$commonId = $_REQUEST['category_id'];
				$type = 1;
			}
			else
			{
				$commonId = $_REQUEST['medication_id'];
				$type = 0;
			}
			$user_udid = $_REQUEST['user_udid'];
			$favoriteObj=new HealthFavourite();		
			$data = $favoriteObj->addFavourite($commonId,$type,$user_udid);
			
			if($data['status']==1)
			{
				$result['status'] = 1;
				$result['message'] = $data['message'];		
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = $data['message'];	
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
		
	//-------------------------------------- Remove favorite listing ------------------------------>
	function actionremoveFavourite()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['user_udid']) && ((isset($_REQUEST['category_id']) || (isset($_REQUEST['medication_id'])))))
		{	
			if(isset($_REQUEST['category_id']) && $_REQUEST['category_id']!='')
			{
				$commonId = $_REQUEST['category_id'];
				$type = 1;
			}
			else
			{
				$commonId = $_REQUEST['medication_id'];
				$type = 0;
			}
			$user_udid = $_REQUEST['user_udid'];
			$favoriteObj=new HealthFavourite();		
			$data = $favoriteObj->removeFavourite($commonId,$type,$user_udid);
			
			if($data['status']==1)
			{
				$result['status'] = 1;
				$result['message'] = $data['message'];		
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = $data['message'];	
			}
			echo json_encode($result);
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Permision denied'));
		}
	}
	
	function afterAction() 
	{
	
	}
}
