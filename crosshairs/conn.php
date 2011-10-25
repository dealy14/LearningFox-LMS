<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("sql5c6a.megasqlservers.com", "davidealyt445491", "ealy14") or die(mysql_error());
$dbName = mysql_select_db("LMS_davidealytechnologies_com") or die(mysql_error());

?>