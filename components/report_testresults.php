<?php
	$db = new db;
	$db->connect();
	$db->query("SELECT DISTINCT topic.test_link,course.name,tests.name AS tname FROM courses_r,lessons_r,topic,course,tests WHERE topic.ID=lessons_r.topic_ID AND lessons_r.lesson_ID=courses_r.lesson_ID AND courses_r.course_ID='$course_ID' AND course.ID='$course_ID' AND topic.test_link>0 AND tests.ID=topic.test_link");
	$nx=0;
	while($db->getRows())
	{ 
	$test_ID[]=$db->row("test_link");
	$tname[]=$db->row("tname");	
	$cname=$db->row("name");	
	}
	
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
<IMG SRC="images/report_testresults.gif" BORDER="0" ALIGN="ABSMIDDLE"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Report was run on: <?php echo date(ymd);?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">
<?php
hTop("index.php?section=reports&report=testresults&course_ID=$course_ID&sid=$sid","Register Date|date_of_reg,First Name|fname,Last Name|lname,Course Status|course_status,Last Login|last_usage,Start Date|start_date,Average Score|total_score,Ind. Tests Scores|",$order,$direction);

if($order!="" && $direction!="")
{
$extr="ORDER BY $order $direction";
}
	$db = new db;
	$db->connect();
	$db->query("SELECT students.date_of_reg,students.fname,students.lname,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date FROM students,course_history WHERE  course_history.user_ID=students.ID AND course_history.course_ID='$course_ID' $extr");
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	//$date_of_mod = $db->row("date_of_mod");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	$ID = $db->row("ID");
	if(file_exists($dir_testlogs.$ID."_".$course_ID))
	{
	$testr_file=file($dir_testlogs.$ID."_".$course_ID);
	$dif_tests = explode("|",$testr_file[0]);
	  $xn=0;
	  $st.="<OL>";
	  while($xn<(count($dif_tests)-1))
	  {
	  $st.="<LI><A HREF='index.php?section=reports&report=test_details&sid=$sid&course_ID=$course_ID&test_ID=$test_ID[$xn]&ruserID=$ID&uname=".urlencode("$fname $lname")."&cname=".urlencode($cname)."&tname=".urlencode($tname[$xn])."'>".$dif_tests[$xn]."%</A> ($tname[$xn])";
	  $xn++;
	  }
	  $st.="</OL>";	  
	}
	else
	{
	$st="None Taken Yet";
	}
	?>
	<TR>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $date_of_reg;?></TD>	
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $fname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $lname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("course_status");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("last_usage");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("start_date");?></TD>	  
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("total_score");?>%</TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $st;?></TD>	  
	</TR>
	<?php
	$st="";
	}
?>
</TABLE>
</TD></TR></TABLE>