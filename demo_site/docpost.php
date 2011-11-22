<?php
session_start();
require_once("conn.php");

	$getftyle = explode("/",$_FILES['uploadedfile']['type']);
	
	if($getftyle[1] == 'msword'){
		$img_type = 'word-thumb';
	}else{
		$img_type = 'pdf-thumb';
	}



if($getftyle[1] != ''){
	
	if($_FILES['uploadedfile']['size']<=1024*1024*10){
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "libdocs/".$_FILES['uploadedfile']['name']);


		$query="INSERT INTO `library` (`userID` ,`filename` ,`filetype` ,`img_type` ,`datetime`)
		   VALUES('".mysql_escape_string($_SESSION['lms_userID'])."','".$_FILES['uploadedfile']['name']."',
				  '".mysql_escape_string($getftyle[1])."','".mysql_escape_string($img_type)."', NOW())"; 
																			
	   $result = mysql_query($query);
	   $userID = mysql_insert_id($db);
	   
	   if(!$result){
			print mysql_error();
			exit;
	   }

		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'File Uploaded';

	}else{
		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'File must not be more that 10mb in size';
	}
	
}else{
	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
	$_SESSION['uploadeddoc'] = 'Please select a file';
}
?>