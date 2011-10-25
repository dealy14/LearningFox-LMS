<?php
require_once("../conf.php");
$db = new db;
$db->connect();

if($raction=="getCourses")
{
	$db->query("SELECT * FROM course");
	$xm=1;
	while($db->getRows())
	{ 
	$myArray[]=$db->row("name");
	$idArray[]=$db->row("ID");
	$satusArray[]=$db->row("status");
	$descArray[]=$db->row("description");
	$xm++;
	}
	if(count($myArray)>1)
	{
	$mr=implode("||",$myArray);
	$oID=implode("||",$idArray);
	$ostatus=implode("||",$satusArray);
	$odesc=implode("||",$descArray);
	}
	echo"&jn_Array=".ereg_replace("'","&#39;",$mr)."&";
	echo"&idArray=".$oID."&";
	echo"&statusArray=".$ostatus."&";
	echo"&descArray=".addslashes($odesc)."&";
	
	
	echo"&rinfo=loaded&";
}
else if($raction=="getCourseData")
{
	$db->query("SELECT * FROM course WHERE ID='$ID'");
	$xm=1;
	while($db->getRows())
	{ 
	$myName=$db->row("name");
	$myDesc=$db->row("description");
	$xm++;
	}
	echo"&object_name=".ereg_replace("'","&#39;",$myName)."&";
	echo"&object_desc=".$myDesc."&";
	
	
	echo"&rinfo=loaded&";
}
?>
