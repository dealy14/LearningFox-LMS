<?php
require("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	
	
<script language="javascript1.2" type="text/javascript" src="scorm_13.js"></script>

</head> 
	<frameset rows="20%,80%" ROWS="2" frameborder="yes" border="1" framespacing="0" >
	
	<FRAME NAME="les_top" SCROLLING="yes" SRC="preview-top.php" FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<frameset cols="35%,65%" COLS="2" frameborder="yes" border="1" framespacing="0" style="border:1px solid #000099;">
	<FRAME NAME="les_main" SRC="show-listing.php?ref=<?php echo $_GET['ref'];?>&user_id=<?php echo $_GET['user_id'];?> " FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	<FRAME NAME="les_tree" SCROLLING="yes" SRC="blank_import.php" FRAMEBORDER="yes" BORDER="1" BORDERCOLOR="#336699" FRAMESPACING="0">
	</frameset>
</frameset>

<NOFRAMES><BODY BGCOLOR="#FFFFFF" TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
<?php
$db = new db;
$db->connect();
$course_ID=$_GET['ref'];
$lms_userID=$_GET['user_id'];
$db->query("SELECT * FROM course_history WHERE user_ID='$lms_userID' AND course_ID='$course_ID'");
$xm=0;
  while($db->getRows())
  { 
  $rlesson=$db->row("lesson");
  $rtopic=$db->row("topic");
  $rlast_au=$db->row("last_au");
  $rcompleted_aus=$db->row("completed_aus");
  $rcustom_inf=$db->row("custom_inf");
  $rcourse_status=$db->row("course_status");
  $rtotal_time=$db->row("total_time");
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
    insertAction("INSERT INTO course_history (last_usage,start_date,course_status,course_ID,lesson,topic,last_au,completed_aus,custom_inf,user_ID,total_time,total_score,start_time) VALUES ('$last_usage','$start_date','Incomplete','$course_ID','1','1','1','1','1_1-','$lms_userID','$total_time','0','$start_time')");
    }
	if($xm>0){
	$total_time=date("h:i:s");
	 $last_usage=date(ymd);
	 $course_status='Incomplete';
insertAction("UPDATE course_history SET last_usage='$last_usage',course_status='$course_status',total_time='$total_time' WHERE user_ID='$lms_userID' AND course_ID='$course_ID'");
	}

?>
</BODY>
</HTML>