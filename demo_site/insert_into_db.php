<?php
session_start();
include("../conf.php");
$_SESSION['session_time']=$_POST['session_time'];
$_SESSION['suspend_data']=$_POST['suspend_data'];
if($_POST['sco_entry']=='ab-initio'){
$_POST['sco_entry']='';
}
if($_POST['lesson_status']=='completed'){
$_POST['sco_entry']='';
}
//echo $_POST['lesson_status']." ".$_SESSION["sco_id"];
$update_sco="update user_sco_info set lesson_status='".$_POST['lesson_status']."',sco_entry='".$_POST['sco_entry']."',sco_exit='".$_POST['sco_exit']."',total_time='".$_POST['total_time']."',score=".$_POST['score'].",lesson_location='".$_POST['lesson_location']."',suspend_data='".$_POST['suspend_data']."' where sco_id='".$_POST["sco_id"]."' and course_id='".$_SESSION['course_identifier']."' and user_id=".$_SESSION['student_id'];
//echo $update_sco;
$db=new db;
$db->connect();
$db->query($update_sco);
$flag=false;
$lesson_count=0;
$get_user_sco_info="select * from user_sco_info where course_id='".$_SESSION['course_identifier']."' and user_id=".$_SESSION['student_id'];
$db->connect();
$db->query($get_user_sco_info);
while($db->getRows()){
	if($db->row("lesson_status")=="not attempted" || $db->row("lesson_status")=="incomplete"){
		$flag=true;
	}
	if($db->row("lesson_status")=="completed" || $db->row("lesson_status")=="passed" || $db->row("lesson_status")=="failed"){
		$lesson_count=$lesson_count+1;
	}					
}
if($flag==true){
$_POST['lesson_status']='incomplete';
}
$up_course_his="update course_history set last_usage='".date("ymd")."',course_status='".$_POST['lesson_status']."',lesson=".$lesson_count.",";
$up_course_his.="total_time='".$_POST['total_time']."',total_score='".$_POST['score']."',lesson_location='";
$up_course_his.=$_POST['lesson_location']."',core_exit='".$_POST['sco_exit']."',score_raw='".$_POST['score']."' where course_ID=".$_SESSION['course_id']." and user_id=".$_SESSION['student_id'];
$db->connect();
$db->query($up_course_his);
?>