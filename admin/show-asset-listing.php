<?php
require("../conf.php");
//print $_SERVER['DOCUMENT_ROOT'].'<br />';
$db = new db;
$db->connect();
//$str="select folder_name from course where ID=".$_GET['ref'];
$str="select * from efiles where ID=".$_REQUEST['ref'];
//echo $str;
$db->query($str);
$db->getRows();

$db = new db;
$db->connect();
$db->query("SELECT * FROM efiles WHERE ID=".$_REQUEST['ref']);
$xm=0;
while($db->getRows())
{
	$assetFname = $db->row("name");
} 

// ->> for iloilo travel code
$file_dir=$_SERVER['DOCUMENT_ROOT'].'/kenneth/lms/admin/efiles/'.$assetFname;
echo "<ul><li><a target='les_tree' href ='http://iloilotravel.com/kenneth/lms/admin/efiles/".$assetFname."' >".$assetFname."</a></li></ul>";

?>