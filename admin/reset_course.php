<?php
include("../conf.php");
$upuser_sco="update user_sco_info set lesson_status='not attempted',sco_exit='',sco_entry='ab-initio',total_time='00:00:00.00',score=0,lesson_location=''";
$upuser_sco.=" where user_id=".$_GET['userid']; 
$db=new db;
$db->connect();
$db->query($upuser_sco);
$uphis="update course_history set course_status='Not Attempted',start_date='NA',last_usage='NA',total_time='00:00:00.00',total_score=0 where user_id=".$_GET['userid'];
$db->connect();
$db->query($uphis);
?>