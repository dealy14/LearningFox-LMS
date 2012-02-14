<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("safetytraining.db.8609376.hostedresource.com", "safetytraining", "K3RgmwVqh6") or die(mysql_error());
$dbName = mysql_select_db("safetytraining") or die(mysql_error());

?>