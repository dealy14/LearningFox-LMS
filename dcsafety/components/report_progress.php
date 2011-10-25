
<?php
function hTop($xlink,$xstr,$order,$direction)
{
$mystr=explode(",",$xstr);
$x=0;
	while($x<count($mystr))
	{
	$tdd=explode("|",$mystr[$x]);
	  if($tdd[1]==$order)
	  {
	  $bg="#FFFFFF";
	    if($direction=="ASC")
		{
		$img="arrow_up.gif";
		$direction="DESC";		
		}
		else
		{
		$img="arrow_down.gif";
		$direction="ASC";
		}
	  }
	  else
	  {
	  $bg="#c6c6c6";
	  $img="arrow_down.gif";
	  }
	$upTxt.="<TD><FONT FACE=VERDANA SIZE=1 COLOR=#FFFFFF><B>".$tdd[0]."</TD>";
	$boTxt.="<TD BGCOLOR=".$bg." ALIGN=LEFT><A HREF='$xlink&order=".$tdd[1]."&direction=$direction'><IMG SRC='images/$img' BORDER='0' ALT='Sort By ".$tdd[0]." $direction'></TD>";	
	$x++;
	}
echo "<TR BGCOLOR=#000000><TD COLSPAN=".count($mystr)." ALIGN=RIGHT>&nbsp; <A HREF='#' onClick=\"window.print();\"><IMG SRC='images/printer.gif' BORDER='0' ALT='Print This Report'></A></TD></TR><TR BGCOLOR=#000000>".$upTxt."</TR>\n<TR>".$boTxt."</TR>";	
}
?>
<IMG SRC="images/report_progress.gif" BORDER="0" ALIGN="ABSMIDDLE"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Report was run on: <?php echo date(ymd);?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="3" WIDTH="100%">
<?php
hTop("index.php?section=reports&report=testresults&course_ID=$course_ID&sid=$sid","Register Date|date_ofreg,First Name|fname,Last Name|lname,Course Status|course_status,Last Lesson|lesson,Last Topic|topic,Last Login|last_usage,Start Date|start_date,Average Score|total_score",$order,$direction);

if($order!="" && $direction!="")
{
$extr="ORDER BY $order $direction";
}
	$db = new db;
	$db->connect();
	$db->query("SELECT students.date_of_reg,students.fname,students.lname,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date,course_history.lesson,course_history.topic FROM students,course_history WHERE  course_history.user_ID=students.ID AND course_history.course_ID='$course_ID' $extr");
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	//$date_of_mod = $db->row("date_of_mod");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	$ID = $db->row("ID");
	?>
	<TR>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $date_of_reg;?></TD>	
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $fname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $lname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("course_status");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("lesson");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("topic");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("last_usage");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("start_date");?></TD>	  
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("total_score");?></TD>
	</TR>
	<?php
	}
?>
</TABLE>
</TD></TR></TABLE>