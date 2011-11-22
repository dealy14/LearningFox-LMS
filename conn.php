<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("localhost", "cosmosco_lms", "jmk26040") or die(mysql_error());
$dbName = mysql_select_db("cosmosco_lms") or die(mysql_error());

?>