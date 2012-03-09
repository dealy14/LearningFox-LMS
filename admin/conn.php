<?php
//for local
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("db376428105.db.1and1.com", "dbo376428105", "MICKey2011!") or die(mysql_error());
$dbName = mysql_select_db("db376428105") or die(mysql_error());

?>