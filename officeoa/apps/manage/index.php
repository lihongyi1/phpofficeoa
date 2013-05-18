<?php
	ini_set('display_errors','on');
	error_reporting ( E_ALL & ~ E_NOTICE );
	define ( APP_NAME, "manage" );
	define(MODE_NAME,"MyMode");
	define ( APP_PATH, "../manage/" );
	ini_set ( 'memory_limit', '128M' );
	require '../../define.inc.php';
	require '../../ThinkPHP/ThinkPHP.php';
?>
