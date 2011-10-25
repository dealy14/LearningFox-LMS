</UL>
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
<IMG SRC="images/report_progress.gif" BORDER="0" ALIGN="ABSMIDDLE"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Report was run on: <?php echo date(ymd);?> &nbsp; &nbsp; &nbsp; <A HREF="index.php?section=reports&sid=<?php echo $sid; ?>&course_ID=<?php echo $course_ID;?>&report=testresults">Return to test results page</A>
<!--<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4" WIDTH="100%">-->
<?php
$myfile=file($dir_testlogs.$ruserID."_".$course_ID."_".$test_ID);
$tempqs = explode("||",$myfile[0]);
$tempqs[1]="n|".$tempqs[1];
$q=explode("|",$tempqs[1]);
include("components/testpost.php");
?>
<UL>