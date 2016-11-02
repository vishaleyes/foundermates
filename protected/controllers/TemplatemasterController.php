<?php

class TemplatemasterController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionSetTemplate($file)
	{
		
		$this->renderPartial($file);
	}
	
	public function actionJob()
	{
		$this->renderPartial('forgot-password-link');
	}
	
	public function actioncontact()
	{
		$this->renderPartial('contact-us-link');
	}
	
	public function actionuserConfirmForAdvisor()
	{
		$this->renderPartial('user-confirmation-link - Advisor');
	}
	
	public function actionuserConfirmForEntrepreneur()
	{
		$this->renderPartial('user-confirmation-link');
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
}