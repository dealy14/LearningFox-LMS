<?php
require("../conf.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?php
$db = new db;
$db->connect();
$total_time=$_SESSION['start_time'];
$course_ID=$_GET['course'];
$lms_userID=$_GET['user_id'];
$db->query("SELECT * FROM end_time WHERE user_ID='$lms_userID' AND course_ID='$course_ID'");
$xm=0;
  while($db->getRows())
  { 
  $t2=$db->row("e_time");
  $t1=$db->row("s_time");
  $total_time=$t2-$t1;
  
  
  $xm++;
  }
 
    if($xm<1)
    {
	//insert actions;
    $start_time=0;
    $start_date=date(ymd);
    $last_usage=date(ymd);
	$total_time=date("h:i:s");
	$course_ID=$_GET['ref'];
	$lms_userID=$_GET['user_id'];
	//echo "time:-".$total_time."<br>";
    insertAction("INSERT INTO end_time set course_id='".$_GET['course']."',user_id='".$_GET['user_id']."',s_time='".date("H:i:s")."',e_time='".date("H:i:s")."',tot_time='$total_time',last_visit='".date("m/d/y")."'");
    }
	if($xm>0){
	$total_time=date("h:i:s");
	 $last_usage=date(ymd);
	 $course_status='Incomplete';
insertAction("UPDATE end_time set e_time='".date("H:i:s")."',tot_time='$total_time' where course_id='".$_GET['course']."' and user_id='".$_GET['user_id']."'");
	}




?>

</body>
</html>
