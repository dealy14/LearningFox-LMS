<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("localhost", "cosmoscolms", "tTTS9wVUUW7ZjY") or die(mysql_error());
$dbName = mysql_select_db("cosmoscolms") or die(mysql_error());

?>