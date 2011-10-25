<?php
session_start();

require_once("conn.php");

	$qryDeleteLink = "DELETE from library_link WHERE linkID='".$_GET['linkid']."'";
	$rsDeleteLink = mysql_query($qryDeleteLink);
			
	if(!$rsDeleteLink){
		print mysql_error();
		exit;
	}
	
	header("Location: repository.php?section=library&lib=1");
	$_SESSION['uploadedlink'] = 'Link Deleted';
	
?>