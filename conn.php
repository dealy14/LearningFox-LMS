<?php
/*
  NOTE: Eventually, this file should be eliminated 
	and script files dependent on it modified to use 
	the $db object directly
*/
require_once("conf.php"); // among other things, this will grab the db credentials

$db_temp_object = new db;
$db_params = $db_temp_object->get_connection_parameters();
$db_temp_object = null;

$database = mysql_connect($db_params['host'], $db_params['user'], $db_params['password']) 
					or die(mysql_error());
$dbName = mysql_select_db($db_params['database']) or die(mysql_error());
?>