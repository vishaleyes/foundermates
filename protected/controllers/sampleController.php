<?php

class SampleController extends Controller 
{		
	function actionindex()
	{	
		echo "Hello World";
	}
	
	function actiontest()
	{
		echo "Test";	
	}
	
	function actionUs()
	{
		$aboutUsText = "Some stuff about how great your new startup is...";
		$this->render('sampleView', array('content'=>$aboutUsText));
	}
	
	public function actionView()
	{
		$article = User::model()->findByPk($_REQUEST['user_id']);
		$array = $article->attributes;
		$this->render('sampleView',array('data'=>$array));
	}
	
	function actionData()
	{
		$article = User::model()->allData();
		$this->render('sampleView',array('alldata'=>$article));	
	}
	
	function actionaddData()
	{
		error_reporting(E_ALL);
		
		$userObj=new User();
		
		$userObj->user_pic = $this->fileUpload($_FILES);
		$userObj->user_name=$_REQUEST['user_name'];
		$userObj->phones=$_REQUEST['phones'];
		$userObj->email_id=$_REQUEST['email_id'];
		$userObj->save();
		$this->redirect(Yii::app()->params->base_path."sample/Data");
	}
	
	function actiondeleteData()
	{
		$userObj=User::model()->findByPk($_REQUEST['id']);
		$userObj->delete(); 	
		$this->redirect(Yii::app()->params->base_path."sample/Data");
	}
		
	function actionupdate()
	{
		$article = User::model()->findByPk($_REQUEST['id']);
		$array = $article->attributes;
		$this->render('editView',array('data'=>$array));	
	}
	
	function actionupdateData()
	{
		$userObj=User::model()->findByPk($_REQUEST['user_id']);
		$userObj->user_name=$_REQUEST['user_name'];
		$userObj->phones=$_REQUEST['phones'];
		$userObj->email_id=$_REQUEST['email_id'];
		$userObj->user_pic = $this->fileUpload($_FILES);
		echo "<pre>";
		print_r($userObj->user_pic);
		$userObj->save(); 
		$this->redirect(Yii::app()->params->base_path."sample/Data");
	}
	
	function fileUpload($_FILES)
	{
		
		$allowedExts = array("jpg", "jpeg", "gif", "png");
		$extension = end(explode(".", $_FILES["file"]["name"]));
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/png"))
		
		&& in_array($extension, $allowedExts))
		  { 
		  if ($_FILES["file"]["error"] > 0)
			{
			return  $_FILES["file"]["error"] . "<br />";
			}
		  else
			{
				$rand = rand(123456789,10000000000);
				if (file_exists("images/map-icon/" . $rand.'_'.$_FILES["file"]["name"]))
			  	{
			  		return  $_FILES["file"]["name"] . " already exists. ";
			  	}
				else
			  	{
			  		move_uploaded_file($_FILES["file"]["tmp_name"],
			  "images/map-icon/" . $rand.'_'.$_FILES["file"]["name"]);
			  	return $rand.'_'.$_FILES["file"]["name"];
			  	}
			}
		  }
		else
		  {
		  	return "Invalid file";
		  }
	}
}
?>