<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("cosmoscourseslms.db.8685149.hostedresource.com", "cosmoscourseslms", "K3RgmwVqh6") or die(mysql_error());
$dbName = mysql_select_db("cosmoscourseslms") or die(mysql_error());

?>