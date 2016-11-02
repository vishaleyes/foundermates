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
/**
 *
 */
class Helper extends CFormModel
 {

	// method - send Mail
	// param $email -> receiver email address
	// param $subject
	// param $message -> email body
	// param $from
	 public function __construct()
	{
		
	}
	
	function sendMail(
				$email, 
				$subject, 
				$message, 
				$from = NULL) {
					if($from==NULL)
					{
						$from='team@'._SITENAME_NO_CAPS_.'.com';	
					}
		global $msg;	
		$pos = strstr( $email,'@fake.com');
		if($pos)
		{
			error_log( "FAKE email addresses used for testing are ignored.");
			return true;	
		}
		if(isset($_SERVER["HTTP_REFERER"]))
		{	
			if($_SERVER["REMOTE_ADDR"]!='' && $_SERVER["HTTP_USER_AGENT"]!='' && $_SERVER["HTTP_REFERER"]!='')
			{
				if($email==$msg['_ADMIN_EMAIL_']) {
					$msg   ="<table>";
					$msg  .= "<tr>---User information---</tr>"; //Title
					$msg  .= "<tr> <td>User IP</td> <td>  :  </td> <td>".$_SERVER["REMOTE_ADDR"]."</td> </tr>"; //Sender's IP
					$msg  .= "<tr> <td>Browser info</td> <td>  :  </td> <td>".$_SERVER["HTTP_USER_AGENT"]."</td> </tr>"; //User agent
					$msg  .= "<tr> <td>User come from</td> <td>  :  </td> <td>".$_SERVER["HTTP_REFERER"]."</td> </tr></table>"; //Referrer
					$msg   .="</table>";
					$message.='<br />'.$msg;
				}
			}
		}
		
		Yii::import('application.extensions.phpmailer.JPhpMailer');
		$mail = new JPhpMailer;	
		$mail->Subject = $subject;
		$mail->From       = $from;
		$mail->FromName   = $from;
		$mail->MsgHTML($message);
		$mail->AddAddress($email,'');
		$mailResponse = $mail->Send();
	
		if(!$mailResponse) 
		{
			error_log("Email:".$email);
			error_log("Mail Error Subject=>".$subject.'   Error:=>'.$mail->ErrorInfo);
			return false;
		} 
		else 
		{
			error_log("INFO Mail Success Subject=>".$subject."to=>".$email);
			return true;
		}
	}
	
	function setOutgoingSMS($smsReceiver,$smsBody,$jobId="",$hire_match_id="")
	{
		// insert data in outgoing_sms table
		$smsBody = str_replace("##",'',$smsBody);
		$outgoing_sms_data = array();
		$outgoing_sms_data['smsBody'] = substr($smsBody,0,160);
		$outgoing_sms_data['smsReceiver'] = $smsReceiver;
		$outgoing_sms_data['jobId'] = $jobId;
		$outgoing_sms_data['hire_matching_user_id'] = $hire_match_id;
		$outgoing_sms_data['status'] = STATE_NOT_READ;
		$outgoing_sms_data['created'] = date('Y-m-d h:m:s');
		$outgoingSmsObj	=	new OutgoingSMS();
		$outgoingSmsObj->setData($outgoing_sms_data);
		$outgoingSmsObj->insertData();
		///sends a signal to send_sms
		$outgoingSmsObj->callDaemon('send_sms');
	}
	

}
