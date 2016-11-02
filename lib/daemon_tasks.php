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

class daemon_tasks{
	private $debug_on 				    = false;
	
	public function daemon_tasks()
	{
	}

	public function set_debug_level($debug_value)
	{
		if ($debug_value == "on") {
			  $this->debug_on = true;
		}
		if ($debug_value == "off") {
		  $this->debug_on = false;
		}
	}
	
	public function process_inbound_sms()
	{
		$this->do_process("daemon","process_inbound_sms");
	}
	
	public function process_outbound_sms()
	{
		$this->do_process("daemon","process_outbound_sms");
	}
	
	public function process_hirenow()
	{
		$this->do_process("daemon","process_hirenow");
	}

	public function process_rcv_rest()
	{
		$this->do_process("daemon","process_rcv_rest");
	}
	
		public function process_rcv_rest_expire()
	{
		$this->do_process("daemon","process_rcv_rest_expire");
	}
	
	public function process_contact_seekers()
	{
		$this->do_process("daemon","process_contact_seekers");
	}
	
	public function process_seekers_response()
	{
		$this->do_process("daemon","process_seekers_response");
	}
	
	public function process_outbound_email()
	{
		$this->do_process("daemon","process_outbound_email");
	}
	
	public function process_seeker_updated()
	{
		$this->do_process("daemon","process_seeker_updated");
	}
	
	public function process_bulk_update()
	{
		$this->do_process("daemon","process_bulk_update");
	}
	
	private function do_process($controller,$action)
	{
		$_GET['r'] = $controller."/".$action;
		//get_included_files();
		/*if (defined('YII_DEBUG'))
		{
			error_log("Daemon performAction Call Url:".print_r(Yii,true));
		}
		else
		{
			$_GET['r'] = $controller."/".$action;
			error_log("Daemon Call Url:".$_GET['r']);
			require_once("../index.php");
		}*/
		error_log("Daemon performAction Call Url:");
		require_once("/var/www/html/findjobsnear/index.php");
		//error_log("Daemon performAction Call Url:".print_r(Yii,true));
	}
	
	function log($message) {
		$trace=debug_backtrace();
		$args = $trace[1]['args'];
		if(isset($trace[1]['file']))
		{
			$filename = basename($trace[1]['file']);
		}
		else
		{
			$filename = '';			
		}
		$functionname = $trace[1]['function'];
		switch (count($args)) {
		    case 0: 
				$functionname = $functionname."()";
				break;
			case 1:
		        $functionname = $functionname."(".$args[0].")";
				break;
			case 2:
		        $functionname = $functionname."(".$args[0].",".$args[1].")";
				break;
			case 3:
		        $functionname = $functionname."(".$args[0].",".$args[1].",".$args[2].")";
				break;
			default:
		        $functionname = $functionname."(".$args[0].",".$args[1].",".$args[2]."+)";
				break;
		} 
		if(isset($trace[1]['line']))
		{
			$linename = $trace[1]['line'];
		}
		else
		{
			$linename = '';
		}
		if ($filename == "") {
		  $msg = "INFO [".$functionname."] ".$message;
		} else {
		  $msg = "INFO [".$filename.",".$functionname.",".$linename."] ".$message;
		}
		error_log($msg);
	}		
}


