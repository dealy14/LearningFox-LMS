<?php
session_start();

require_once("conn.php");

if($_POST['nla'] == 'edit'){
	$qryUpdateNews = "UPDATE news SET title='".$_POST['fu_title']."', content='".$_POST['fu_content']."', uid='".$_POST['uid']."' ,datetime=NOW() WHERE id='".$_POST['news_id']."'";
	$rsUpdateNews = mysql_query($qryUpdateNews);
			
	if(!$rsUpdateNews){
		print mysql_error();
		exit;
	}
	
	header("Location: index.php?section=news&sid=".$_POST['sid']."&nc=nlist");
	$_SESSION['uploadedlink'] = 'News Updated';
	
}else if($_GET['nla'] == 'delete'){
	$qryDeleteNews = "DELETE from news WHERE id='".$_GET['news']."'";
	$rsDeleteNews = mysql_query($qryDeleteNews);
			
	if(!$rsDeleteNews){
		print mysql_error();
		exit;
	}
	
	header("Location: index.php?section=news&sid=".$_GET['sid']."&nc=nlist");
	$_SESSION['uploadedlink'] = 'News Deleted';
	
}else{
	
	if(($_POST['fu_title'] != '') && ($_POST['fu_content'] != '')){	
			
			$query="INSERT INTO `news` (`sid` ,`title` ,`content` ,`uid` ,`datetime`)
			   VALUES('".mysql_escape_string($_POST['sid'])."','".mysql_escape_string($_POST['fu_title'])."','".mysql_escape_string($_POST['fu_content'])."','".mysql_escape_string($_SESSION['lms_userID'])."',NOW())"; 
																				
		   $result = mysql_query($query);
		   $userID = mysql_insert_id($database);
		   
		   if(!$result){
				print mysql_error();
				exit;
		   }
	
			header("Location: index.php?section=news&sid=".$_POST['sid']."&nc=nlist");
			$_SESSION['uploadedlink'] = 'News Added';
	
	}else if(($_POST['fu_title'] == '') || ($_POST['fu_content'] == '')){
		header("Location: index.php?section=news&sid=".$_POST['sid']."&nc=nlist");
		$_SESSION['uploadedlink'] = 'News fields must not be Null, News not Added';
	}
}
?>