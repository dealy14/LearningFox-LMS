
<?php
function getGname($gname,$usergroup)
{
$myug=explode("_",$usergroup);
return $gname[$myug[0]];
}


$db = new db;
$db->connect();

if($view=="Complete")
{
$db->query("SELECT count(students.ID) as totals FROM students,course_history WHERE students.orgID='$lms_org' AND students.ID=course_history.user_ID AND course_history.course_status='Complete' AND course_history.course_ID=$course_ID");
}
else if($view=="Incomplete")
{
$db->query("SELECT count(students.ID) as totals FROM students,course_history WHERE students.orgID='$lms_org' AND students.ID=course_history.user_ID AND course_history.course_status='Incomplete' AND course_history.course_ID=$course_ID");
}
else if($view=="Complete_and_Incomplete")
{
$db->query("SELECT count(students.ID) as totals FROM students,course_history WHERE students.orgID='$lms_org' AND students.ID=course_history.user_ID AND (course_history.course_status='Complete' OR course_history.course_status='Incomplete') AND course_history.course_ID=$course_ID");
}
else
{
$db->query("SELECT count(ID) as totals FROM students WHERE orgID='$lms_org'");
}

while($db->getRows())
{ 
$totals = $db->row("totals");

}
	
function hTop($xlink,$xstr,$order,$direction,$cnt,$totals)
{
	$nav_link=explode("&cnt=",$xlink);
	$order_link=explode("&direction=",$xlink);
	
	if($cnt>=50)
	{
	$last_link="<A HREF='$nav_link[0]&cnt=".($cnt-50)."&order=$order'><IMG SRC='images/_back.gif' BORDER='0'></A> <B><FONT COLOR='#FFFFFF'><BR>Last 50";
	}
	if($cnt<=($totals-50))
	{
	$next_link="<A HREF='$nav_link[0]&cnt=".($cnt+50)."&order=$order'><IMG SRC='images/_next.gif' BORDER='0'></A> <B><FONT COLOR='#FFFFFF'><BR>Next 50";
	}
	
	if($totals>50)
	{
	$page_expr="Page ".round(($cnt+50)/50)." of ".round(($totals)/50);
	}
	else
	{
	$page_expr="Page ".round(($cnt+50)/50)." of 1";
	}
	
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
		if(is_null($direction))
		{
		$direction="ASC";
		}
		  
		$upTxt.="<TD><FONT FACE=VERDANA SIZE=1 COLOR=#FFFFFF><B>".$tdd[0]."</TD>";
		$boTxt.="<TD BGCOLOR=".$bg." ALIGN=CENTER><A HREF='$order_link[0]&order=$tdd[1]&direction=$direction&cnt=$cnt'><IMG SRC='images/$img' BORDER='0' ALT='Sort By ".$tdd[0]." $direction'></TD>";	
		$x++;
		}
	echo "<TR  class='descriptor_row'><TD ALIGN='CENTER'><FONT FACE='VERDANA' SIZE='1'>$last_link</TD><TD ALIGN='CENTER'><FONT FACE='VERDANA' SIZE='1'>$next_link</TD><TD COLSPAN='2'><FONT FACE='VERDANA' SIZE='1' COLOR='#FFFFFF'><B>$page_expr</TD><TD COLSPAN=".(count($mystr)-4)." ALIGN=RIGHT>&nbsp; <A HREF='#' onClick=\"window.print();\"><IMG SRC='images/printer.gif' BORDER='0' ALT='Print This Report'></A></TD></TR><TR  class='descriptor_row'>".$upTxt."</TR>\n<TR>".$boTxt."</TR>";	
	}
	
	$course_name="undefined";
	
	if(isset($_POST['course_ID']) && ! ereg('[^0-9]',  $_POST['course_ID']))
	{
		$course_ID= $_POST['course_ID'];
		$course_name_sql = "select name from course where ID = $course_ID";
		$dbcoursename = new db;
		$dbcoursename->connect();
		$dbcoursename->query($course_name_sql);
		while(     $dbcoursename->getRows()     )
		{
			$course_name = $dbcoursename->row('name');
		}
	}
	
?>
<h2 align="center"><?php echo  $course_name; ?>: Course Progress</h2>

<FORM NAME="views" METHOD="POST" ACTION="<?php echo "index.php?section=reports&report=$report&course_ID=$course_ID&sid=$sid&direction=$direction&cnt=$cnt&order=$order";?>"><?php input_list("view","All||View All,Complete||View Complete,Incomplete||View Incomplete,Complete_and_Incomplete||View Complete & Incomplete",0,"View ".ereg_replace("_"," ",$view),"onChange='document.views.submit();'")?></FORM>

<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="3" WIDTH="100%">
<?php
hTop("index.php?section=reports&report=$report&course_ID=$course_ID&sid=$sid&view=$view&direction=$direction&cnt=$cnt","Last Name|lname,First Name|fname,Course Status|course_status,Last Lesson|lesson,Last Topic|topic,Last Login|last_usage,Start Date|start_date,Time Spent|total_time,Average Score|total_score",$order,$direction,$cnt,$totals);

if(!$cnt)
{
$cnt=0;
}
$lim= "limit $cnt, 50";



if($order!="" && $direction!="")
{
$extr="ORDER BY $order $direction";
}

	$db = new db;
	$db->connect();
	if($view=="Incomplete")
	{
	$db->query("SELECT students.fname,students.lname,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date,course_history.lesson,course_history.topic,course_history.total_time FROM students,course_history WHERE students.orgID='$lms_org' AND course_history.user_ID=students.ID AND course_history.course_ID=$course_ID AND course_history.course_status='Incomplete' $extr $lim");
	}
	else if($view=="Complete")
	{
	$db->query("SELECT students.fname,students.lname,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date,course_history.lesson,course_history.topic,course_history.total_time FROM students,course_history WHERE students.orgID='$lms_org' AND course_history.user_ID=students.ID AND course_history.course_ID=$course_ID AND course_history.course_status='Complete' $extr $lim");
	}	
	else if($view=="Complete_and_Incomplete")
	{
	$db->query("SELECT students.fname,students.lname,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date,course_history.lesson,course_history.topic,course_history.total_time FROM students,course_history WHERE students.orgID='$lms_org' AND course_history.user_ID=students.ID AND course_history.course_ID=$course_ID AND (course_history.course_status='Incomplete' OR course_history.course_status='Complete') $extr $lim");
	}	
	else
	{
	$db->query("SELECT students.fname,students.lname,students.orgID,students.ID,course_history.course_status,course_history.last_usage,course_history.total_score,course_history.start_date,course_history.lesson,course_history.topic,course_history.total_time FROM students LEFT JOIN course_history ON students.ID=course_history.user_ID AND students.orgID='$lms_org' AND course_history.course_ID=$course_ID GROUP BY students.ID HAVING students.orgID='$lms_org' $extr $lim");
	}	
		
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	if(is_null($db->row("course_status"))){$cstatus="<FONT COLOR='#b4b4b4'>Not Started";}else{$cstatus=$db->row("course_status");}
	$ID = $db->row("ID");
	?>
	<TR>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $lname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $fname;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $cstatus;?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("lesson");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("topic");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("last_usage");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("start_date");?></TD>	  
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo date("H:i:s", mktime (0,0,$db->row("total_time")));?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP ALIGN="center"><FONT FACE="VERDANA" SIZE="1"><?php echo $db->row("total_score");?></TD>
	</TR>
	<?php
	}	
?>
</TABLE>