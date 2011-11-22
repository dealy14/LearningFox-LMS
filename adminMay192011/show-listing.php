<?php
require("../conf.php");
//print $_SERVER['DOCUMENT_ROOT'].'<br />';
$cid = $_GET['ref'];
$db = new db;
$db->connect();
$db->query("SELECT * FROM course WHERE ID=$cid");
//$db->query($str);
//$db->getRows();
$xm=0;
	
while($db->getRows())
{
	print "<a href ='blank_import.php?cID=".$db->row("ID")."' target='les_tree' >".$db->row("name").'</a><br />';
}
?>