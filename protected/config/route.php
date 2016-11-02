<?php
/**
 * URL Map Config
 */
return array(
	'/'=>'user/index',
	'privacy' => 'user/privacy',
	'mobile' => 'user/mobile',	
	'about' => 'user/about',
	'term_and_condition' => 'tos/index',	
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
);
?>