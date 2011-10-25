<?php
require_once("../conf.php");
?>
<HTML>
<SCRIPT>
function time_begin()
{
this.time_start = Math.floor((new Date()).getTime()/1000);
return this.time_start;
}
</SCRIPT>
<?php
#######################################################################
#Logon Actions [+get info for GET function+]
#######################################################################
$db = new db;
$db->connect();
$db->query("SELECT * FROM course_history WHERE user_ID='$user_ID' AND course_ID='$course_ID'");
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
    insertAction("INSERT INTO course_history (last_usage,start_date,course_status,course_ID,lesson,topic,last_au,completed_aus,custom_inf,user_ID,total_time,total_score,start_time) VALUES ('$last_usage','$start_date','Incomplete','$course_ID','1','1','1','1','1_1-','$user_ID','$total_time','0','$start_time')");
    }


#######################################################################
#Actions for GET function
#######################################################################
if($formAction=="GET")
{
?>
<SCRIPT>
top.t_cnt=<?php echo $rlast_au;?>;
top.topic_number=<?php echo $rtopic;?>;
top.lesson_number=<?php echo $rlesson;?>;
top.course_status="<?php echo $rcourse_status;?>";
top.completed_aus="<?php echo $rcompleted_aus;?>";
top.custom_inf="<?php echo $rcustom_inf;?>";



var timer=new time_begin();
top.time_begin=timer.time_start;

top.data.document.userdata.lesson.value=<?php echo $rlesson;?>;
top.data.document.userdata.topic.value=<?php echo $rtopic;?>;
top.data.document.userdata.last_au.value=<?php echo $rlast_au;?>;
top.data.document.userdata.completed_aus.value="<?php echo $rcompleted_aus;?>";
top.data.document.userdata.course_status.value="<?php echo $rcourse_status;?>";
top.data.document.userdata.custom_inf.value="<?php echo $rcustom_inf;?>";
top.data.document.userdata.total_time.value="<?php echo $rtotal_time;?>";

var curlesson = top.lessons[<?php echo $rlesson;?>][<?php echo $rtopic;?>].split("|");
if(top.useToc==1)
{
top.lesson_location = "../<?php echo $course_ID;?>/course/"+curlesson[1];
top.content.location = "../<?php echo $course_ID;?>/course/"+curlesson[1];
}

if(top.useNav==1)
{
top.navState();
}

if(top.useToc==1)
{
top.setBG(<?php echo $rlast_au;?>);
}
top.visited=top.completed_aus.split(",");
top.checkReset();
top.gotten="YES";
</SCRIPT>
<?php
}

if($formAction=="PUSH")
{
echo"<P ALIGN='CENTER'><FONT FACE='VERDANA' SIZE='2'><B>Saving Data...";
//update actions;
$last_usage=date(ymd);
//$total_time = $rtotal_time+time();
insertAction("UPDATE course_history SET last_usage='$last_usage',course_status='$course_status',lesson='$lesson',topic='$topic',last_au='$last_au',completed_aus='$completed_aus',custom_inf='$custom_inf',total_time='$total_time' WHERE user_ID='$user_ID' AND course_ID='$course_ID'");
//echo"UPDATE course_history SET last_usage='$last_usage',course_status='$course_status',lesson='$lesson',topic='$topic',last_au='$last_au',completed_aus='$completed_aus',total_time='$total_time',total_score='$total_score' WHERE user_ID='$user_ID' AND course_ID='$course_ID'";
echo"<SCRIPT>window.close();</SCRIPT>";
}

if($formAction=="PUSH_SCORE")
{
  if(!file_exists($dir_testlogs.$user_ID."_".$course_ID."_".$test_ID))
  {
  //send test score to first log file;
  to_file($dir_testlogs.$user_ID."_".$course_ID."_".$test_ID,$tempscore,"w+");
  
  //second log file;
  $thisScore = explode("||",$tempscore);
  to_file($dir_testlogs.$user_ID."_".$course_ID,$thisScore[0]."|","a+");  
  
  $scores = file($dir_testlogs.$user_ID."_".$course_ID);
  $allscores = explode("|",$scores[0]);
  $score_total = array_sum($allscores);
  $score_average = round($score_total/(count($allscores)-1));  
  insertAction("UPDATE course_history SET total_score='$score_average' WHERE user_ID='$user_ID' AND course_ID='$course_ID'");  
  }
  else
  {
  echo"<SCRIPT>alert('** You have already taken this test. Only your orginal score will be recorded. **');</SCRIPT>";
  }
//echo $dir_testlogs.$user_ID."_".$course_ID."_".$test_ID.",".$tempscore.",w+";
}

if(!$formAction)
{
?>
<BODY onBeforeUnload="if(top.gotten=='YES'){var endt = new time_begin();top.time_end=endt.time_start;var tempval=document.userdata.completed_aus.value.split(',');if(tempval.length==top.Alltopics){document.userdata.course_status.value='Complete';}window.open('lt_track.php?formAction=PUSH&course_ID=<?php echo $course_ID;?>&user_ID=<?php echo $user_ID;?>&lesson='+document.userdata.lesson.value+'&topic='+document.userdata.topic.value+'&last_au='+document.userdata.last_au.value+'&completed_aus='+document.userdata.completed_aus.value+'&custom_inf='+document.userdata.custom_inf.value+'&course_status='+document.userdata.course_status.value+'&total_time='+((top.time_end - top.time_begin)+Number(document.userdata.total_time.value)),'Save_data','width=200,height=200');top.window.opener.location.reload();}">
<FORM NAME="userdata" METHOD="POST" ACTION="lt_track.php" TARGET="datapost">
<INPUT TYPE"TEXT" NAME="user_ID" VALUE="<?php echo $user_ID;?>">
<INPUT TYPE="TEXT" NAME="course_ID" VALUE="<?php echo $course_ID;?>">
<INPUT TYPE="TEXT" NAME="lesson" VALUE="1">
<INPUT TYPE="TEXT" NAME="topic" VALUE="1">
<INPUT TYPE="TEXT" NAME="last_au" VALUE="1">
<INPUT TYPE="TEXT" NAME="completed_aus" VALUE="1">
<INPUT TYPE="TEXT" NAME="course_status" VALUE="Incomplete">
<INPUT TYPE="TEXT" NAME="custom_inf" VALUE="">
<INPUT TYPE="TEXT" NAME="total_time" VALUE="">
<INPUT TYPE="TEXT" NAME="tempscore" VALUE="">
<INPUT TYPE="TEXT" NAME="test_ID" VALUE="">
<INPUT TYPE="TEXT" NAME="formAction" VALUE="NA">
</FORM>
<SCRIPT>
top.setLocations();
function beginRet()
{
  if(top.toc_loaded=="yes" || top.useToc!=1)
  {
  top.lms_GET();
  }
  else
  {
  setTimeout("beginRet();",200);
  }
}
beginRet();
</SCRIPT>
<?php
}
?>
</BODY>
</HTML>