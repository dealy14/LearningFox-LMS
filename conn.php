<?php
//for local connection
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("db407049122.db.1and1.com", "dbo407049122", "miCKey2012!") or die(mysql_error());
$dbName = mysql_select_db("db407049122") or die(mysql_error());

?>