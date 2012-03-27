<?php
session_start();
require_once("conn.php");

$operation = $_REQUEST['operation'];
$new_folder_name = $_REQUEST['new_folder_name'];
$delete_folder_id = $_REQUEST['delete_folder_id'];

$update_folder_name = $_REQUEST['update_folder_name'];
$update_folder_id = $_REQUEST['update_folder_id'];

$delete_file_id = $_REQUEST['delete_file_id'];
switch($operation)
{
    case "create_folder" :
    {
	    if(trim($new_folder_name)!="")
		{
	        $folder_query="INSERT INTO `library_folders` (`folder_name`,`user_id`, `created_date`) VALUES('".mysql_escape_string($new_folder_name)."', ".mysql_escape_string($_SESSION['lms_userID']).", NOW())"; 																			
	        $result = mysql_query($folder_query);
		    header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		    $_SESSION['uploadeddoc'] = 'Folder Created';
		}
		else
		{
		     header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		     $_SESSION['uploadeddoc'] = 'Folder name should not be empty';
		}
	}break;
	case "update_folder" :
    {
		$update_qry = "UPDATE library_folders SET folder_name='".mysql_escape_string($update_folder_name)."' WHERE folder_id=".$update_folder_id;
		mysql_query($update_qry);
      	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'Folder updated';
	}break;	
    case "delete_folder" :
    {
		$delete_qry = "DELETE FROM library_folders WHERE folder_id=".$delete_folder_id;
		mysql_query($delete_qry);
      	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'Folder Deleted';
	}break;	
	case "delete_file" :
    {
		$delete_qry = "DELETE FROM library WHERE libdocID=".$delete_file_id;
		mysql_query($delete_qry);
      	header("Location: index.php?section=library&sid=".$_GET['sid']."&lib=2");
		$_SESSION['uploadeddoc'] = 'File Deleted';
	}break;
}
?>