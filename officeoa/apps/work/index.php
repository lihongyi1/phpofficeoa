<?php
	ini_set('display_errors','on');
	error_reporting ( E_ALL & ~ E_NOTICE );
	if ( $_POST['sessionid'] )$_COOKIE['PHPSESSID'] = $_POST['sessionid'];
	define ( APP_NAME, "work" );
	define(MODE_NAME,"MyMode");
	define ( APP_PATH, "../work/" );
	ini_set ( 'memory_limit', '128M' );
	require '../../define.inc.php';
	require '../../ThinkPHP/ThinkPHP.php';
	
?>
