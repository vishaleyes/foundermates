<?php

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
$signals_lib=dirname(__FILE__).'/lib/signals_lib.php';
//$SolrPhpClient=dirname(__FILE__).'/SolrPhpClient/config.php';
global $msg;
global $errorCode;
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
require_once($signals_lib);
//require_once($SolrPhpClient);
if(isset($_GET['r']) && $_GET['r']=="daemon/process_hirenow")
{
	error_log("Called Hirenow".print_r($_GET,1));	
}
setlocale(LC_TIME, 'en_US.ISO_8859-1');

Yii::createWebApplication($config)->run();