<html>
<head>
<meta http-equiv="expires" content="Tue, 20 Aug 1999 01:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title>ADL Sample Run-Time Environment Version 1.2.2 Frame</title>
<script language ="JAVASCRIPT" >

var API = null;

/****************************************************************************
**
** Function:  initAPI()
** Input:   none
** Output:  none
**
** Description:  This function sets an "API" variable equal to the API 
**               Applet.
**
***************************************************************************/
function initAPI()
{
   API = window.LMSFrame.document.APIAdapter;
}

function init(){
	
	//Specify SCORM 1.2:
	SCORM.version = "1.2";
	
	SCORM.debug.displayInfo("Initializing course.");
	var callSucceeded = SCORM.connection.initialize();
	SCORM.debug.displayInfo("Call succeeded? " +callSucceeded);
}
</script>
 <frameset rows="143,*" ONLOAD="initAPI();">
        <frame id="LMSFrame" name="LMSFrame" src="LMSFrame.jsp">
        <frameset cols="275,*">
            <frameset rows="0,*">
               <frame id="code" src="code.jsp" name="code">
               <frame src="show-listing.php?ref=<?php echo $_GET['ref'];?>&user_id=<?php echo $_GET['user_id'];?>" name="menu">
            </frameset>
            <frame id="Content" name="Content" src="LMSStart.htm">
        </frameset>
</frameset><noframes></noframes>

</head>

<body>
<?php
include("../conf.php");
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
</body>
</html>
