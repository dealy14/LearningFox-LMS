<?php include($dir_components."enrollment_toolbar.php"); ?>
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
   <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#eaeaea">
   <TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
    <TR BGCOLOR="#000000">
	   <TD><FONT FACE="VERDANA" SIZE="1" COLOR="#FFFFFF">&nbsp;</TD>		
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF">Course Title</TD>
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF">Date Started</TD>
       <TD NOWRAP><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF">Last Attempt</TD>	   
	   <TD NOWRAP><FONT FACE="VERDANA" SIZE="2" COLOR="#FFFFFF">Course Status</TD>
	   <TD><FONT FACE="VERDANA" SIZE="1" COLOR="#FFFFFF">&nbsp;</TD>	   
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
	   if(!in_array($mycourses[$x],$mygcourses))
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

<?php if(!is_null($cID[$mycourses[$x]])&&$course_status[$mycourses[$x]]=="Complete"){?>
     <TR BGCOLOR="<?php echo $bgcol;?>">
       <TD VALIGN="TOP"><A HREF="#"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/course_list2.gif" BORDER="0" ALT="Click for more details on <?php echo $cname[$mycourses[$x]];?>"></A></TD>
       <TD VALIGN="TOP"><A HREF="#" STYLE="text-decoration:none;color:#000000;"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $cname[$mycourses[$x]]; ?></TD>	   
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $start_date[$mycourses[$x]]; ?></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $last_usage[$mycourses[$x]]; ?></TD>
	   <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php if($course_status[$mycourses[$x]]!="Complete"){echo"<FONT COLOR='RED'>";}echo $course_status[$mycourses[$x]];?></TD>
       <TD VALIGN="TOP"><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=courselaunch&sid=<?php echo $sid; ?>&course_ID=<?php echo $cID[$mycourses[$x]]; ?>">Details</A>]</TD>
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
       <TD COLSPAN="6" BGCOLOR="#FFFFFF"><FONT FACE="VERDANA" SIZE="2"><BR>The courses below were added to your list by your administrator.</TD>
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

<?php if(!is_null($cID[$mygcourses[$xn]])&&$course_status[$mygcourses[$xn]]=="Complete"){?>
     <TR BGCOLOR="<?php echo $bgcol; ?>">
       <TD VALIGN="TOP"><A HREF="#"><FONT FACE="VERDANA" SIZE="2"><IMG SRC="images/course_list3.gif" BORDER="0" ALT="Click for more details on <?php $cname[$mygcourses[$xn]]; ?>"></A></TD>
       <TD VALIGN="TOP"><A HREF="#" STYLE="text-decoration:none;color:#000000;"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $cname[$mygcourses[$xn]]; ?></TD>	   
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $start_date[$mygcourses[$xn]];?></TD>
       <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo $last_usage[$mygcourses[$xn]]; ?></TD>
	   <TD VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php if($course_status[$mygcourses[$xn]]!="Complete"){echo"<FONT COLOR='RED'>";}echo $course_status[$mygcourses[$xn]]; ?></TD>
       <TD VALIGN="TOP"><A HREF="#"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=courselaunch&sid=<?php echo $sid; ?>&course_ID=<?php echo $cID[$mygcourses[$xn]]; ?>">Details</A>]</TD>
     </TR>
<?php }?>

   <?php  
     $xn++;
     }	 
}


if(count($mycourses)>=1&&count($mygcourses)>=1)
{ 
   ?>
   </TABLE>
   </TD></TR></TABLE>
   <?php
}   
if(count($mycourses)<1||$mycourses[0]=="")
{
echo"<P>You have no courses in your personal enrollment list at this time.<BR>Add courses by going to the <A HREF='index.php?section=courselist&sid=$sid'>Course List</A> section to see what's available..";
}
else if(count($mygcourses)<1||$mygcourses[0]=="")
{
echo"<P>You have no courses in your group enrollment list at this time.";
}
?>

