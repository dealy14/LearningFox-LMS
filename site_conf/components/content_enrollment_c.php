<div style="width:800px;">
<h2 align="center">Your Transcript</h2>
<div align="center"><?php include($dir_components."enrollment_toolbar.php"); ?></div>
<?php
$sfile=$dir_usercourselist.$lms_userID;
$gfile=$dir_groupfiles.$lms_usergroup_file.".grp";

if(file_exists($sfile)||file_exists($gfile))
{
  if(file_exists($sfile))
  {
   $mycourses=file($sfile);
   $mycourses=explode("|",$mycourses[0]);  
  }
  if(file_exists($gfile))
  {
   $mygcourses=file($gfile);
   $mygcourses=explode("|",$mygcourses[0]);  
  }  
  
  if(count($mycourses)>=1||count($mygcourses)>=1)
  {
	  //get course info;
	  $db = new db;
	  $db->connect();
	  $db->query("SELECT created,name,ID,type FROM course WHERE status='active'");
	  while($db->getRows())
	  { 
	  $course_ID=$db->row("ID");
	  $cID[$course_ID]=$db->row("ID");
	  $cname[$course_ID]=$course_name=$db->row("name");
	  $ccreated[$course_ID]=$db->row("created");
	  $ctype[$course_ID]=$db->row("type");
	  }
	  
	  //get user course history info;
	  $db = new db;
	  $db->connect();
	  $db->query("SELECT * FROM course_history WHERE user_ID=$lms_userID");
	  while($db->getRows())
	  { 
	  $ecourse_ID=$db->row("course_ID");
	  $start_date[$ecourse_ID]=$db->row("start_date");	 
	  $last_usage[$ecourse_ID]=$db->row("last_usage");
	  $course_status[$ecourse_ID]=$db->row("course_status");
	  $elesson[$ecourse_ID]=$db->row("lesson");		 
	  $etopic[$ecourse_ID]=$db->row("topic");			 
	  }   
  }  
}

if($mycourses[0]!="" || $mygcourses[0]!="")
{
   ?>
   Courses

   <TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" width="100%">
    <TR  class="descriptor_row">
	   <TD><FONT FACE="VERDANA" SIZE="1">&nbsp;</FONT></TD>		
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2">Course Title</FONT></TD>
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2">Date Started</FONT></TD>
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2">Last Attempt</FONT></TD>	   
	   <TD NOWRAP><FONT FACE="VERDANA" SIZE="2">Course Status</FONT></TD>
	   <TD><FONT FACE="VERDANA" SIZE="1">&nbsp;</FONT></TD>	   
     </TR>
   <?php
}
###############################################################################
# Personal Enrollment List here
###############################################################################	    
if($mycourses[0]!="")
{
     $x=0;
     while($x<count($mycourses))
     {
	   if(@!in_array($mycourses[$x],$mygcourses))
	   {
			 if($start_date[$mycourses[$x]]=="")
			 {
			 $start_date[$mycourses[$x]]="NA";
			 $last_usage[$mycourses[$x]]="NA";
			 $course_status[$mycourses[$x]]="Not Started";
			 }
			 
			 if(!$color_cnt||$color_cnt==1)
			 {
			 $bgcol="#f8f8ff";
			 $color_cnt=2;
			 }
			 else
			 {
			 $bgcol="#FFFFFF";	 
			 $color_cnt=1;	 
			 }
   ?>

<?php if(!is_null($cID[$mycourses[$x]])&&($course_status[$mycourses[$x]]=="completed" || $course_status[$mycourses[$x]]=="passed" || $course_status[$mycourses[$x]]=="failed")){?>
     <TR BGCOLOR="<?php echo $bgcol;?>">
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/course_list2.gif" BORDER="0" ALT="Click for more details on <?php echo $cname[$mycourses[$x]]; ?>"></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $cname[$mycourses[$x]]; ?></B></FONT></TD>	   
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $start_date[$mycourses[$x]]; ?></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"></FONT></TD>
	   <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php if($course_status[$mycourses[$last_usage[$mycourses[$x]]]]!="completed"){
	   echo "<FONT COLOR='RED'>";
	   }
	   echo $course_status[$mycourses[$x]];?></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=courselaunch&sid=<?php echo $sid; ?>&course_ID=<?php echo $cID[$mycourses[$x]]?>">Details</A>]</FONT></TD>
     </TR>
<?php }?>

   <?php  
      }
     $x++;
     }
}	 

	 
###############################################################################
# Group Enrollment List here
###############################################################################
if(count($mygcourses)>=1&&$mygcourses[0]!=""&&$lms_groups=="on")
{
?>
     <TR>
       <TD COLSPAN="6" BGCOLOR="#FFFFFF"><FONT FACE="VERDANA" SIZE="2">The courses below were added to your list by your administrator.</FONT></TD>
     </TR>
<?php
     $xn=0;
     while($xn<count($mygcourses))
     { 	 
	 
			 if($start_date[$mygcourses[$xn]]=="")
			 {
			 $start_date[$mygcourses[$xn]]="NA";
			 $last_usage[$mygcourses[$xn]]="NA";
			 $course_status[$mygcourses[$xn]]="Not Started";
			 }
			 	 
			 if(!$color_cnt||$color_cnt==1)
			 {
			 $bgcol="#f8f8ff";
			 $color_cnt=2;
			 }
			 else
			 {
			 $bgcol="#FFFFFF";	 
			 $color_cnt=1;	 
			 }
   ?>

<?php if(!is_null($cID[$mygcourses[$xn]])&&($course_status[$mycourses[$x]]=="completed" || $course_status[$mycourses[$x]]=="passed" || $course_status[$mycourses[$x]]=="failed")){?>
     <TR BGCOLOR="<?php echo $bgcol;?>">
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/course_list3.gif" BORDER="0" ALT="Click for more details on <?php echo $cname[$mygcourses[$xn]];?>"></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $cname[$mygcourses[$xn]];?></B></FONT></TD>	   
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $start_date[$mygcourses[$xn]];?></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $last_usage[$mygcourses[$xn]];?></FONT></TD>
	   <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php if($course_status[$mygcourses[$xn]]!="completed"){echo"<FONT COLOR='RED'>";}echo $course_status[$mygcourses[$xn]];?></FONT></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=courselaunch&sid=<?php echo $sid; ?>&course_ID=<?php echo $cID[$mygcourses[$xn]]?>">Details</A>]</FONT></TD>
     </TR>
<?php }?>

   <?php  
     $xn++;
     }	 
}


if($mycourses[0]!="" || $mygcourses[0]!="")
{
   ?>
   </TABLE>
   <?php
}   
if(count($mycourses)<1||$mycourses[0]=="")
{
echo"<P>You have no courses in your personal enrollment list at this time.<BR>Add courses by going to the <A HREF='index.php?section=courselist&sid=$sid'>Course List</A> section to see what's available..</p>";
}
else if(count($mygcourses)<1||$mygcourses[0]=="")
{
echo"<P>You have no courses in your group enrollment list at this time.</p>";
}
?>
</div>
