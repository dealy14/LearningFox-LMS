<?php
session_start();

require_once("conn.php");

if($_POST['links'] != ''){	

	$user_link = 'http://'.$_POST['links'];
	
	$poslink = strpos($_POST['links'], 'http://');
	
	if ($poslink === false) {
		
		$query="INSERT INTO `library_link` (`userID` ,`links` ,`datetime`)
		   VALUES('".mysql_escape_string($_SESSION['lms_userID'])."','".$user_link."',NOW())"; 
																			
	   $result = mysql_query($query);
	   $userID = mysql_insert_id($db);
	   
	   if(!$result){
			print mysql_error();
			exit;
	   }

		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=1");
		$_SESSION['uploadedlink'] = 'Link Added';

	}else{
		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=1");
		$_SESSION['uploadedlink'] = 'Check Link , Link not Added';
	}

}else{
	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=1");
	$_SESSION['uploadedlink'] = 'Link must not be Null, Link not Added';
}
?>