<?php
session_start();
session_register("username");

//$launch_size=file($dir_layout.$course_ID);
$hw=explode("|",$launch_size[0]);
//include($dir_includes."lt_track.php");
?>
<SCRIPT language="javascript1.2">
function launchCourse(cnum)
{
//newWin=window.open('../'+cnum+'/index.php?user_ID=<?php echo $lms_userID;?>','LT_COURSE','WIDTH=<?php echo $hw[0];?>,height=<?php echo $hw[1];?>');
window.open('LMSMain.php?ref='+cnum+'&user_id=<?php echo $lms_userID;?>');
}
</SCRIPT>
<?php
####################################################################################
# Get Info for the page
####################################################################################
//echo "hello".$course_ID.$lms_userID;
//$time = date(g:i ); 
// print strftime('%c');

 
// echo strftime('%l:%M %p', strtotime('14:35:00'));
  $db = new db;
  $db->connect();
  $db->query("SELECT created,name,description,type FROM course WHERE ID='$course_ID'");
  while($db->getRows())
  {   
  $name=$db->row("name");
  $created=$db->row("created");
  $type=$db->row("type");
  $description=$db->row("description");
  }  
     $db = new db;
     $db->connect();
     $db->query("SELECT * FROM course_history WHERE user_ID='$lms_userID' AND course_ID='$course_ID'");
     $xg=0;
	 while($db->getRows())
     { 
     $ecourse_ID=$db->row("course_ID");
	 $start_date=$db->row("start_date");	 
	 $last_usage=$db->row("last_usage");
	 $elesson=$db->row("lesson");		 
	 $etopic=$db->row("topic");			 
	 $course_status=$db->row("course_status");	
	 $total_time=date("H:i:s", mktime (0,0,$db->row("total_time")));		
	 $total_score=$db->row("total_score");	
	 	
	 $xg++; 
     } 
$smessage=" Start course";	 
if($xg>=1)
{	 
$smessage=" Continue course";

//get total score average;
if(file_exists($dir_testlogs.$lms_userID."_".$course_ID))
{
$scores = file($dir_testlogs.$lms_userID."_".$course_ID);
$allscores = explode("|",$scores[0]);
$score_total = array_sum($allscores);
$score_average = round($score_total/(count($allscores)-1));
}
?>
<TABLE BORDER="0" CELLSPACING="2" CELLPADDING="0" WIDTH="600">
  <TR>
    <TD COLSPAN="4" BGCOLOR="#eaeaea"><IMG SRC="images/c_progress.gif"></TD>
  </TR>
  <TR BGCOLOR="#eaeaea">
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Date Started:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo $start_date;?></TD>	
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Course Status:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo $course_status;?></TD>	
  </TR>
  <TR BGCOLOR="#eaeaea">
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Last Attempt:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo $last_usage;?></TD>	
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Total Time:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo $total_time;?></TD>	
  </TR>
  <TR BGCOLOR="#eaeaea">
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Last Lesson/topic:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo "$elesson/$etopic";?></TD>	
    <TD><FONT FACE='VERDANA' SIZE='2'><B>Score Average:</TD>
    <TD><FONT FACE='VERDANA' SIZE='2'><?php echo $total_score;?>%</TD>	
  </TR>    
</TABLE>
<?php }?>
<P>
<A HREF="index.php?section=enrollment&sid=<?php echo $sid; ?>">Back to Enrollment List.</A>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="600"><TR><TD BGCOLOR="#eaeaea">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#eaeaea">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
	echo"<FONT FACE='VERDANA' SIZE='2'>$smessage <A HREF='' onClick=\"launchCourse($course_ID);return false;\"><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Begin this course'></A>";
    ?>
   </TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Name:</B> <?php echo $name;?><BR><B>Created on: </B><?php echo $created;?></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Course Description:</B></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><?php echo nl2br($description);?></TD>
  </TR>
  
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Objectives:</TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><OL>
<?php
  $db2 = new db;
  $db2->connect();
  $db2->query("SELECT objective FROM objectives WHERE course_ID='$course_ID'");
  while($db2->getRows())
  { 
  $objective=$db2->row("objective");
  echo"<LI>".nl2br($objective);
  }
?>
  </OL></TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><B>Library References:</TD>
  </TR>
  <TR BGCOLOR="#FFFFFF">
    <TD COLSPAN="2"><FONT FACE="VERDANA" SIZE="2"><UL>
<?php
  $db2 = new db;
  $db2->connect();
  $db2->query("SELECT * FROM ref WHERE course_ID='$course_ID'");
  while($db2->getRows())
  { 
  echo"<LI><I><A HREF='../references/".$db2->row("filename")."' TARGET='_blank'>".$db2->row("rname")."</I></A>: ";
  echo nl2br($db2->row("description"));
  }
?>
    </OL></TD>
  </TR>  
  <TR BGCOLOR="#eaeaea">
    <TD COLSPAN="2" ALIGN="RIGHT">
    <?php
    echo"<FONT FACE='VERDANA' SIZE='2'>$smessage <A HREF='#' onClick=\"launchCourse($course_ID);return false;\"><IMG SRC='images/import.gif' BORDER='0' ALIGN='absmiddle' ALT='Begin this course'></A>";
    ?>
   </TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
</BODY>
</HTML>