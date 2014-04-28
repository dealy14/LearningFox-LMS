<?php
session_start();


require_once("conf.php");

$course_info = array();

$db = new db;
$db->connect();
$_SESSION["course_id"] = $_GET['ref'];
$course_ID = $_GET['ref'];
$userid = $_GET["userid"];
$qry = "SELECT * FROM course_history, course, students WHERE course_history.user_ID = '$userid' AND
course_history.course_ID = '$course_ID' AND course.id = '$course_ID' AND students.ID = '$userid'";
$db->query($qry);
//echo "[$qry]";

while($db->getRows()) {
    $course_info['course_status'] = ucfirst($db->row("course_status"));
    $course_info['score_raw'] = $db->row("score_raw");

    // TODO: determine whether 'last_usage' is appropriate as the 'completion date'
    $course_info['completion_date'] = $db->row("last_usage");

    $course_info['course_name'] = $db->row("name");
    $course_info['first_name'] = $db->row("fname");
    $course_info['last_name'] = $db->row("lname");
}
$db->close();
$db = null;

?><!DOCTYPE html>
<html>
<head>
    <title>Certificate of Completion</title>
</head>
<body>
<div style="width:850px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:800px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
        <img src="site_conf/images/certificate_logo.png"/>
        <br><br>
        <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
        <br><br>
        <span style="font-size:25px"><i>This is to certify that</i></span>
        <br><br>
        <span style="font-size:30px"><b><?=$course_info['first_name'];?> <?=$course_info['last_name'];?></b></span><br/><br/>
        <span style="font-size:25px"><i>has completed the course</i></span> <br/><br/>
        <span style="font-size:30px"><?=$course_info['course_name'];?></span>
        <br/><br/>
        <span style="font-size:20px">with a score of <b><?=$course_info['score_raw'];?>%</b></span>
        <br/><br/><br/>
        <span style="font-size:22px"><i>dated</i></span><br>
        <span style="font-size:25px"><?=$course_info['completion_date'];?></span>
    </div>
</div>
</body>
</html>