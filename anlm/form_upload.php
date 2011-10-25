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
		   $userID = mysql_insert_id($db);
		   
		   if(!$result){
				print mysql_error();
				exit;
		   }
		   
		   $qryEmail = "SELECT email FROM students";
		   $rsEmail = mysql_query($qryEmail);
		   $to = "";
	       while($userEmail = mysql_fetch_assoc($rsEmail))
	       {
			   if(strlen(trim($userEmail['email']))>0&&preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$userEmail['email']))
			       $to .= $userEmail['email'].", ";
		   }
		   mysql_free_result($rsEmail);
		   
		   $username = "";
		   $qryUser = "SELECT username FROM students WHERE ID=".mysql_escape_string($_SESSION['lms_userID']);
           $rsUser = mysql_query($qryUser);
           if($user = mysql_fetch_assoc($rsUser))
			   $username = $user['username'];
		   mysql_free_result($rsUser);
		   
		   if(strlen($to)>0)
		   {
		       $to = substr($to,0,strlen($to)-2);
			   $subject = $username.' add news item "'.$_POST['fu_title'].'"';
			   $body = "<div>Date: ".date("l, F d, Y")."</div><div>".$username." added a news item</div><div>To access the site, <a href='http://www.davidealytechnologies.com/anlm/' target'_blank'>click here</a></div>";
			   $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		       $headers .= 'From: LearningFox Support <dealy@davidealytechnologies.com>' . "\r\n";
			   //die($to."<br/>".$subject."<br/>".$body);
			   //$to="jimwu2010@gmail.com";
			   mail($to,$subject,$body,$headers);
		   }
		   
		   mysql_query("INSERT INTO user_messages (USERID,CREATEDATE,MESSAGE,TYPE) VALUES (".mysql_escape_string($_SESSION['lms_userID']).",NOW(),'".mysql_escape_string($_POST['fu_title'])."','News')");
	
			header("Location: index.php?section=news&sid=".$_POST['sid']."&nc=nlist");
			$_SESSION['uploadedlink'] = 'News Added';
	
	}else if(($_POST['fu_title'] == '') || ($_POST['fu_content'] == '')){
		header("Location: index.php?section=news&sid=".$_POST['sid']."&nc=nlist");
		$_SESSION['uploadedlink'] = 'News fields must not be Null, News not Added';
	}
}
?>