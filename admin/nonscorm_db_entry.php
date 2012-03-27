<?php
include("../conf.php");
$db=new db;
$db->connect();
$str="select ID from course where ID=(select MAX(ID) from course)";
$db->query($str);
$fileno=0;
while($db->getRows()){
$p =$db->row("ID");
$fileno=str_replace("course-","",$p);
}
$fileno=$fileno+1;
$courseid="course-".$fileno;
	$str1="insert into course set created='20".date("y/m/d")."',name='".$_POST['name']."',type='wbt',course_type='Non-Scorm',folder_name='Linkname',course_id='".$courseid."',cmi_credit='none'";
$db->connect();
$db->query($str1);
echo "<script>alert('Non-Scorm course has been successfully imported.');";
echo "window.close();</script>";
echo "<script>window.close();if (window.opener && !window.opener.closed) { window.opener.parent.location.reload(); } </script>";

?>