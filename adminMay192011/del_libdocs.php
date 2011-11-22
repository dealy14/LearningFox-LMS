<?php
session_start();

require_once("conn.php");

	$qryDeleteLink = "DELETE from library WHERE libdocID='".$_GET['libdocid']."'";
	$rsDeleteLink = mysql_query($qryDeleteLink);
			
	if(!$rsDeleteLink){
		print mysql_error();
		exit;
	}
	
	header("Location: repository.php?section=library&lib=2");
	$_SESSION['uploadedlink'] = 'File Deleted';
	
?>