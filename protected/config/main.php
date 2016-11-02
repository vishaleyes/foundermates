<?php
error_reporting(E_ALL);
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

	define('DEFAULT_CONTROLLER',"site");
	define('DEFAULT_ACTION',"index");
	define('DEFAULT_LANGUAGE',"eng");
	define('DEFAULT_THEME',1);
	
	global $adminmsg;
	// charset for web pages and emails

	$basepath = str_replace("\\","/",dirname(dirname(__FILE__)));
	$basepath .= "/";
	//Site name info
	define("_SITENAME_",'foundermates');
	define("_SITENAME_NO_CAPS_",'foundermates');
	define("_SITENAME_CAPS_",'FOUNDERMATES');
	define('BASEPATH',  $basepath);
	
	$is_live = true;  // for live dfault
	
	if(isset($_SERVER['SERVER_NAME'])) {
		if($_SERVER['SERVER_NAME'] == "localhost") {
			$is_live = false;  //false is for local		
		}
	}
	$baseUrl="";
	if($is_live)
	{
		  define('HOST_NAME','foundermates.com');	
		  define('WEB_HOST_NAME','foundermates.com');
		  $baseUrl.=WEB_HOST_NAME;	
		  define('SITE_NAME','foundermates');
		  define('FILE_UPLOAD', '/home/content/44/10265144/html/assets/upload/');
		  define('FILE_PATH','/home/content/44/10265144/html/');
		  define('DEFAULT_FILE_PATH','/home/content/44/10265144/html/');
		  define('LOGS_PATH','/home/content/44/10265144/html/dlogs/');
		  define('DB_SERVER', 'byptfoundermates.db.10265144.hostedresource.com');
		  define('DB_SERVER_USERNAME', 'byptfoundermates');
		  define('DB_SERVER_PASSWORD', 'Bypt@2012');
		  define('DB_DATABASE', 'byptfoundermates');
		  define('MAIL_SERVER_FROMNAME', 'no-reply@kukuphi.com');
		  define('MAIL_SERVER', 'foundermates.com');
		  define('MAIL_SERVER_USERNAME', 'no-reply');
		  define('MAIL_SERVER_PASSWORD', 'nor373');
		  define('MAIL_SERVER_PORT_DEFAULT', true);
		  define('MAIL_SERVER_SMTP_SECURE', false);
		  define('MAIL_SERVER_SMTP_AUTH', false);
		  define('BASE_PATH', 'http://'.WEB_HOST_NAME.'/');		  
		  define('MBASE_PATH', 'http://'.WEB_HOST_NAME.'/m/');
		  define('HTTP_SERVER', 'http://'.WEB_HOST_NAME.'/');
		  define('HTTPS_SERVER', 'https://'.WEB_HOST_NAME.'/');
		  define('DOMAIN_NAME', 'foundermates.com');
		  define('SMS_NUMBER', '4086457916');
	      define('USE_SOLR', 'true'); // false -> no, true -> yes
		  define('ADMIN_EMAIL','ronnie.bi@gmail.com');
		  define('API_KEY_GOOGLE_MAP','ABQIAAAAGadnb68hworsU9g2Ph1YBRQtlEzpQNiw_VFD179wQexLmE_W-xSNBeBdeZKJg37poRNks4BNN4lExQ');		
		
	}
	else
	{	
		//Local
		define('HOST_NAME','localhost');
		define('SITE_NAME','foundermates');
		$filename="E:/wamp/www/foundermates/config.php";
		
		define('FILE_UPLOAD', 'E:/wamp/www/foundermates/assets/upload/');
		define('FILE_PATH','E:/wamp/www/foundermates/');
		define('LOGS_PATH','E:/wamp/www/foundermates/dlogs/');
	
		// Data base
		define('DB_SERVER', 'localhost');
		define('DB_SERVER_USERNAME', 'root');
		define('DB_SERVER_PASSWORD', '');
		define('DB_DATABASE', 'foundermates');
		define('MAIL_SERVER', 'smtp.gmail.com');
		define('MAIL_SERVER_FROMNAME', 'no-reply@'._SITENAME_NO_CAPS_.'.com');
		define('MAIL_SERVER_USERNAME', 'byptserv@gmail.com');
		define('MAIL_SERVER_PASSWORD', 'findjob123');
		define('MAIL_SERVER_PORT_DEFAULT', false);
		define('MAIL_SERVER_SMTP_SECURE', true);
		define('MAIL_SERVER_SMTP_AUTH', true);
		define('SMS_NUMBER', '4086457901');
		define('BASE_PATH', 'http://'.HOST_NAME.'/'.SITE_NAME.'/');
		define('MBASE_PATH', 'http://'.HOST_NAME.'/'.SITE_NAME.'/m/');
		define('HTTP_SERVER', 'http://'.HOST_NAME.'/'.SITE_NAME.'/');
		define('HTTPS_SERVER', 'https://'.HOST_NAME.'/'.SITE_NAME.'/');
		define('USE_SOLR', 'false');
		define('ADMIN_EMAIL','vpanchal911@gmail.com');
		define('API_KEY_GOOGLE_MAP','ABQIAAAAoKEOVeH5Ak8SaEmM-hRytBRSYwPj9khfICxBbljTfsfiJS8R_BRzFQ9tZSd52bOGUKRQru8MIcs0aA');
	}
	
	
	define('ENCRIPT_KEY','test123');
	/////////////////////////////////////////////////
	define('MAIL_FROM_NAME',_SITENAME_.'.com');
	define('MAIL_FROM','no-reply@'._SITENAME_NO_CAPS_.'.com');
	
	define('DB_TYPE', 'mysql');
	define('DB_PREFIX', '');
	
	define('USE_PCONNECT', 'false');		
	define('STORE_SESSIONS', 'db');
	define('SQL_CACHE_METHOD', 'none'); 
	
	define('PAGINATE_LIMIT', '5');
	define('ADMIN_PAGINATE_LIMIT', '10');
	define('SEEKER_PAGINATE_LIMIT', '6');
	define('RECENT_ACTIVITY_PAGINATE_LIMIT', '10');
	define('LIMIT_10', '10');
	
	//SMTP Server Settings
	define('SMTP_SERVER', 'smtp.1and1.com');
	define('SMTP_PORT', 465);
	define('SMTP_USER', 'test@kukuphi.com');
	define('SMTP_PASS', 'm@il-r0ute');
	
	define('SOLR_SEEKER_SEARCH_LIMIT', 50); // 0 -> no, 1 -> yes


	//Allow image extention
	$extArray=array('jpg','jpeg','png','PNG','JPEG','JPG');
	define("IMAGE_EXT",serialize($extArray));
	//Allow file extention
	$fileExtNotAllowArray=array('php','exe');
	define("FILE_NOT_EXT",serialize($fileExtNotAllowArray));
	
	
	define('CHARSET', 'iso-8859-15');
	//For rest Api
	define("REST_REQUEST_STATUS",200);
	
	ini_set('memory_limit', '-1');
	ini_set("session.gc_maxlifetime", 172800);
	
	$session	=	new CHttpSession;
	$session->open();
	$prefferd_language	=	$session['prefferd_language'];
	
	if(isset($prefferd_language))
	{
		$languagePath=FILE_PATH."languages/".$prefferd_language."/global.php";
	}
	else
	{
		$languagePath=FILE_PATH."languages/".DEFAULT_LANGUAGE."/global.php";
	}
	
	//error_log($prefferd_language);
	//error_log($languagePath);
	if (file_exists($languagePath))
	{	
		global $msg;
		$msg = include_once($languagePath);
	} else {
		//error_log("FATAL ERROR: do not know the language! Using English");
		global $msg;
		$prefferd_language=DEFAULT_LANGUAGE;
		$languagePath=FILE_PATH."languages/".$prefferd_language."/global.php";
		$msg = include_once($languagePath);
		
	}
	$adminLanguagePath=FILE_PATH."languages/".DEFAULT_LANGUAGE."/admin_global.php";
	
	if(isset($adminLanguagePath))
	{
		$adminmsg = include_once($adminLanguagePath);
	}
	$errorCodePath=FILE_PATH."languages/errorcode.php";
	if (file_exists($errorCodePath))
	{
		global $errorCode;
		$errorCode = include_once($errorCodePath);
	}
	
	global $themename;
	if(isset($_REQUEST['r']) && substr($_REQUEST['r'],0,5)=='admin')
	{
		$themename = '';
	}
	else
	{
		$themename = 'basic';
	}
ini_set('memory_limit', '512M');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'foundermates',
	'defaultController'=>'site',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111111',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		
		
		
			'viewRenderer'=>array(
		  'class'=>'application.extensions.ESmartyViewRenderer',
			'fileExtension' => '.tpl',
			//'pluginsDir' => 'application.smartyPlugins',
			//'configDir' => 'application.smartyConfig',
		),
		// uncomment the following to enable URLs in path-format
	/*	
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
	
		'db'=>array(
			'connectionString' => 'mysql:host='.DB_SERVER.';dbname='.DB_DATABASE,
			'emulatePrepare' => true,
			'username' => DB_SERVER_USERNAME,
			'password' => DB_SERVER_PASSWORD,
			'tablePrefix' => '',
			'charset' => 'utf8',
			// 'enableProfiling'=>true,
         //'enableParamLogging' => true,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				/*array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					 'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
               		 'ipFilters'=>array('127.0.0.1','173.1.156.250'),
				),*/
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
		
	
	 'theme'=>$themename,
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'base_path'=>'http://'.HOST_NAME.'/'.SITE_NAME.'/index.php?r=',
		'base_url'=>'http://'.HOST_NAME.'/'.SITE_NAME.'/',
		'base_path_language'=>'http://'.HOST_NAME.'/'.SITE_NAME.'/languages',
		'image_path'=>'http://'.HOST_NAME.'/'.SITE_NAME.'/images/',
		'msg'=>$msg,
		'adminmsg'=>$adminmsg,
		'errorCode'=>$errorCode,
		
	),
);