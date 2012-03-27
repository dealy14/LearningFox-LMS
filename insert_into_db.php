<?php
session_start();
require_once("conf.php");
if (isset($_POST['session_time']))
  $_SESSION['session_time']=$_POST['session_time'];
if (isset($_POST['suspend_data']))
  $_SESSION['suspend_data']=$_POST['suspend_data'];
if($_POST['sco_entry']=='ab-initio')
	$_POST['sco_entry']='';
if($_POST['lesson_status']=='completed')
	$_POST['sco_entry']='';
//echo $_POST['lesson_status']." ".$_SESSION["sco_id"];
$db=new db;
$db->connect();
$update_sco="update user_sco_info set lesson_status='".$db->escape_string($_POST['lesson_status']).
			"',sco_entry='".$db->escape_string($_POST['sco_entry']) ."'";
if (isset($_POST['sco_exit'])) 
	$update_sco .= ",sco_exit='".$db->escape_string($_POST['sco_exit'])."'";
if (isset($_POST['total_time']))
	$update_sco .= ",total_time='".$db->escape_string($_POST['total_time'])."'";
if (isset($_POST['score']))
	$update_sco .= ",score=".$db->escape_string($_POST['score']).",";
if (isset($_POST['lesson_location']))
	$update_sco .= "lesson_location='".$db->escape_string($_POST['lesson_location'])."'";
if (isset($_POST['suspend_data']))
	$update_sco .= ",suspend_data='".$db->escape_string($_POST['suspend_data'])."'";
$update_sco .= "where sco_id='".$db->escape_string($_POST["sco_id"]).
				"' and course_id='".$db->escape_string($_SESSION['course_identifier']).
				"' and user_id=".$_SESSION['student_id'];
//echo $update_sco;
$db->query($update_sco);
$flag=false;
$lesson_count=0;
$db->connect();
$get_user_sco_info="select * from user_sco_info where course_id='".$db->escape_string($_SESSION['course_identifier'])."' and user_id=".$_SESSION['student_id'];
$db->query($get_user_sco_info);
while($db->getRows()){
	if($db->row("lesson_status")=="not attempted" || $db->row("lesson_status")=="incomplete"){
		$flag=true;
	}
	if($db->row("lesson_status")=="completed" || $db->row("lesson_status")=="passed" || $db->row("lesson_status")=="failed"){
		$lesson_count=$lesson_count+1;
	}					
}
if($flag==true)
	$_POST['lesson_status']='incomplete';
$db->connect();
$up_course_his="update course_history set last_usage='".date("ymd").
			   "',course_status='".$db->escape_string($_POST['lesson_status']).
			   "',lesson=".$lesson_count;
if (isset($_POST['total_time']))
	$up_course_his .= ",total_time='".$db->escape_string($_POST['total_time']) . "'";
if (isset($_POST['total_score']))
	$up_course_his .= ",total_score='".$db->escape_string($_POST['score']) ."'";
if (isset($_POST['lesson_location']))
	$up_course_his .= ",lesson_location='".$db->escape_string($_POST['lesson_location'])."'";
if (isset($_POST['sco_exit']))	
	$up_course_his .= ",core_exit='".$db->escape_string($_POST['sco_exit'])."'";
if (isset($_POST['score']))
	$up_course_his .=  ",score_raw='".$db->escape_string($_POST['score'])."'";
$up_course_his .= " where course_ID=".$_SESSION['course_id']." and user_id=".$_SESSION['student_id'];
$db->query($up_course_his);
echo $_POST['sco_id'];  // Return the SCO id to the caller
?>