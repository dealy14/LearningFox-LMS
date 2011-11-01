<?php
//for local
/*
$db = mysql_connect("localhost", "root", "") or die(mysql_error());
$dbName = mysql_select_db("lms") or die(mysql_error());
*/

$db = mysql_connect("p50mysql89.secureserver.net", "lmscecdb", "Davey14") or die(mysql_error());
$dbName = mysql_select_db("lmscecdb") or die(mysql_error());

?>