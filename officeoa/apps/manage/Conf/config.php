<?php
if (!defined('THINK_PATH')) exit();
$LoginConfig = array (

        );

$array = require_once( THINK_PATH.'../config.inc.php' );

$array = array_merge($array, $LoginConfig );

return $array;
?>
