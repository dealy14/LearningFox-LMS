<?php
session_start();
require_once("conn.php");

	$getftyle = explode("/",$_FILES['uploadedfile']['type']);
	
	if($getftyle[1] == 'msword'){
		$img_type = 'word-thumb';
	}else{
		$img_type = 'pdf-thumb';
	}



  if($getftyle[1] != '')
  {	
	if($_FILES['uploadedfile']['size']<=1024*1024*10)
	{
		/*$folder = $_SERVER["APPL_PHYSICAL_PATH"]."LMS/anlm/libdocs/".mysql_escape_string($_SESSION['lms_userID']);
		if (!file_exists($folder))
        {
			mkdir($folder);
		}*/
		$destfile = $_SERVER["DOCUMENT_ROOT"]."/LMS/anlm/libdocs/".$_FILES['uploadedfile']['name'];
		if(file_exists($destfile))
		    $isOverwriteFile = true;
		else
		    $isOverwriteFile = false;
		move_uploaded_file($_FILES['uploadedfile']['tmp_name'], "libdocs/".$_FILES['uploadedfile']['name']);
		
		if(!$isOverwriteFile)
		{
          if(isset($_POST['rdbUploadTo'])&&!is_null($_POST['rdbUploadTo']))
	      {
		    if($_POST['rdbUploadTo']=='own')
	            $targetID = mysql_escape_string($_SESSION['lms_userID']);
	        else if($_POST['rdbUploadTo']=='priority')
	            $targetID = -1;
	        else
	            $targetID = 0;
	      }
	      else
	        $targetID = 0;
		
		  $query="INSERT INTO `library` (`userID` ,`filename` ,`filetype` ,`img_type` ,`datetime`, targetID)
		   VALUES(".mysql_escape_string($_SESSION['lms_userID']).",'".$_FILES['uploadedfile']['name']."',
				  '".mysql_escape_string($getftyle[1])."','".mysql_escape_string($img_type)."', NOW(), ".$targetID.")"; 
																			
	      $result = mysql_query($query);
	      $userID = mysql_insert_id($db);
	   
	      if(!$result){
			print mysql_error();
			exit;
	      }
	    }
		
		if(isset($_POST['rdbUploadTo'])&&!is_null($_POST['rdbUploadTo'])&&$_POST['rdbUploadTo']=='priority'&&!$isOverwriteFile)
	    {
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
		   
		   /*switch($_POST['rdbUploadTo'])
		   {
			   case "global":$displayFolder="Board Meeting Documents";break;
			   case "priority":$displayFolder="Priority";break;
			   case "own":$displayFolder=$username;break;
			   default:$displayFolder="Board Meeting Documents";break;
		   }*/
		   
		   if(strlen($to)>0)
		   {
		       $to = substr($to,0,strlen($to)-2);
			   $subject = $username.' uploaded a document "'.$_FILES['uploadedfile']['name'].'"';
			   $body = "<div>Date: ".date("l, F d, Y")."</div><div>".$username." uploaded a document to the Priority folder</div><div>To access the site, <a href='http://www.davidealytechnologies.com/anlm/' target'_blank'>click here</a></div>";
			   /*if(!$isOverwriteFile)
			   {
				   $subject = $username.' upload file "'.$_FILES['uploadedfile']['name'].'"';
				   $body = "<div>Date: ".date("l, F d, Y")."</div><div>file name: ".$_FILES['uploadedfile']['name']."</div><div>Folder: ".$displayFolder."<div>file link: <a href='http://davidealytechnologies.com/LMS/anlm/libdocs/".$_FILES['uploadedfile']['name']."' target'_blank'>click here</a></div>";
			   }
			   else
			   {
				   $subject = $username.' update file "'.$_FILES['uploadedfile']['name'].'"';
				   $body = "<div>Date: ".date("l, F d, Y")."</div><div>file name: ".$_FILES['uploadedfile']['name']."</div><div>Folder: ".$displayFolder."<div>file link: <a href='http://davidealytechnologies.com/LMS/anlm/libdocs/".$_FILES['uploadedfile']['name']."' target='_blank'>click here</a></div>";
			   }*/
			   $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		       $headers .= 'From: LearningFox Support <dealy@davidealytechnologies.com>' . "\r\n";
			   //die($to."<br/>".$subject."<br/>".$body);
			   //$to="jimwu2010@gmail.com";
			   mail($to,$subject,$body,$headers);
		   }
	   }
	   
	   mysql_query("INSERT INTO user_messages (USERID,CREATEDATE,MESSAGE,TYPE) VALUES (".mysql_escape_string($_SESSION['lms_userID']).",NOW(),'".($isOverwriteFile?"Update":"Upload")."<a href=&quot;libdocs/".$_FILES['uploadedfile']['name']."&quot; target=&quot;_blank&quot;>".$_FILES['uploadedfile']['name']."</a>','Repository')");

		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'File Uploaded';

	}
	else
	{
		header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'File must not be more that 10mb in size';
	}
  }
  else
  {
	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
	$_SESSION['uploadeddoc'] = 'Please select a file';
  }
?>