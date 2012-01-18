<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("p50mysql107.secureserver.net", "lmsv1db", "Technologies14") or die(mysql_error());
$dbName = mysql_select_db("lmsv1db") or die(mysql_error());

?>