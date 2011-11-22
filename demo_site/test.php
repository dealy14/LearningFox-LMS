<?php
session_start();
include("../conf.php");
$db = new db;
$db->connect();
$user_sco="select * from user_sco_info where user_id=".$_SESSION['student_id']." and course_id='course-1'";
echo $user_sco;
$db->connect();
$db->query($user_sco);
$masterscory='n';
$credit_flag="no-credit";
while($db->getRows()){
if($db->row("masterscory")>0){
	$masterscory='y';
	$credit_flag="credit";
	}
}
echo $credit_flag;
?>