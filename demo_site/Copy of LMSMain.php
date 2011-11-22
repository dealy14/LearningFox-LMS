<?php
require("../conf.php");
?>
<html>
<!--
/*******************************************************************************
**
** Filename:  LMSMain.htm
**
** File Description:    This is the main page that contains a frameset which
**                      in turn contains three frames.  The top frame contains
**                      login, logout, Quit, Previous, and Next buttons. The
**                      lower left frame contains a menu constructed from the
**                      items in the currently selected course.  The content
**                      frame (right-side) initially contains the start page.
**                      When the user logs in and selects a course, lesson,
**                      etc., the right-side frame displays this content.
**                      This page exposes the DOM API Object so that a
**                      launched SCO is able to find it.  This page will
**                      be the parent, or the parent of the opener window, of
**                      launched SCOs.
**
** Author: ADL Technical Team
**
** Contract Number:
** Company Name: CTC
**
** Module/Package Name:
** Module/Package Description:
**
** Design Issues:
**
** Implementation Issues:
** Known Problems:
** Side Effects:
**
** References: ADL SCORM
**
/*******************************************************************************
**
** Advanced Distributed Learning Co-Laboratory (ADL Co-Lab) Hub grants you 
** ("Licensee") a non-exclusive, royalty free, license to use, modify and 
** redistribute this software in source and binary code form, provided that 
** i) this copyright notice and license appear on all copies of the software; 
** and ii) Licensee does not utilize the software in a manner which is 
** disparaging to ADL Co-Lab Hub.
**
** This software is provided "AS IS," without a warranty of any kind.  ALL 
** EXPRESS OR IMPLIED CONDITIONS, REPRESENTATIONS AND WARRANTIES, INCLUDING 
** ANY IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE 
** OR NON-INFRINGEMENT, ARE HEREBY EXCLUDED.  ADL Co-Lab Hub AND ITS LICENSORS 
** SHALL NOT BE LIABLE FOR ANY DAMAGES SUFFERED BY LICENSEE AS A RESULT OF 
** USING, MODIFYING OR DISTRIBUTING THE SOFTWARE OR ITS DERIVATIVES.  IN NO 
** EVENT WILL ADL Co-Lab Hub OR ITS LICENSORS BE LIABLE FOR ANY LOST REVENUE, 
** PROFIT OR DATA, OR FOR DIRECT, INDIRECT, SPECIAL, CONSEQUENTIAL, 
** INCIDENTAL OR PUNITIVE DAMAGES, HOWEVER CAUSED AND REGARDLESS OF THE 
** THEORY OF LIABILITY, ARISING OUT OF THE USE OF OR INABILITY TO USE 
** SOFTWARE, EVEN IF ADL Co-Lab Hub HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH 
** DAMAGES. 
**
*******************************************************************************/
-->
<head>
<meta http-equiv="expires" content="Tue, 20 Aug 1999 01:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<title>SCORM 2004 3rd Edition Sample Run-Time Environment Version 1.0.2</title>
<script language ="JAVASCRIPT" >

var API_1484_11 = null;

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
   API_1484_11 = window.LMSFrame.document.APIAdapter;
}
</script>
<frameset rows="143,*" ONLOAD="initAPI();">
        <frame id="LMSFrame" name="LMSFrame" title="Applet Frame" src="LMSFrame.php">
        <frameset cols="275,*">
            <frameset rows="0,80%,15%,45">
               <frame id="code" src="code.jsp" name="code" title="code.jsp Frame">
               <frame src="show-listing.php?ref=<?php echo $_GET['ref'];?>&user_id=<?php echo $_GET['user_id'];?>" name="menu" title="Navigation Menu Frame">
                <frame id="log" name="log" src="log.htm" title="API-Datamodel Log Frame">
                <frame id="buttons" name="buttons" src="button.htm" title="Logging Button Frame" scrolling="no" noresize marginheight="1">
            </frameset>
            <frame id="Content" name="Content" title="Content Frame" src="LMSStart.htm">
        </frameset>
</frameset><noframes></noframes>
</head>
<body>
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
</body>
</html>
