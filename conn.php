<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("safetytraindemo.db.8609376.hostedresource.com", "safetytraindemo", "RZ8Lk55auNQv1e") or die(mysql_error());
$dbName = mysql_select_db("safetytraindemo") or die(mysql_error());

?>