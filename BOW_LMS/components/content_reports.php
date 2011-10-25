<?php
if(!$report)
{
?>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="10" WIDTH="100%">
  <TR>
    <TD width="200"><IMG SRC="images/report_roster.gif" BORDER="0"></TD>
    <TD><h3>&nbsp;</h3>
	
    <p><FONT FACE="VERDANA" SIZE="2">Survey.
	<form action="index.php?section=reports&report=survey&sid=<?php echo $sid; ?>" id='survey' name='survey' method="get" >
		<input type="hidden" name="section" value="reports" />
		<input type="hidden" name="report" value="survey" />
		<input type="hidden" name="sid" value="<?php echo $sid; ?>" />
		<select name="thesurvey">
		<option value="question">Order by question</option>
		<option value="users">Order by Student</option>
		</select>
	</form> <B>[<A HREF="javascript:document.survey.submit();">Execute</A>]</B></FONT></p></TD>
  </TR>
</TABLE>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="10" WIDTH="100%">
  <TR>
    <TD width="200"><IMG SRC="images/report_roster.gif" BORDER="0"></TD>
    <TD><h3>&nbsp;</h3>
    <p><FONT FACE="VERDANA" SIZE="2">A report. <B>[<A HREF="index.php?section=reports&report=roster&sid=<?php echo $sid; ?>">Execute</A>]</B></FONT></p></TD>
  </TR>
</TABLE>
<br />
<FORM NAME="cprog" METHOD="POST" ACTION="index.php?section=reports&report=progress&sid=<?php echo $sid; ?>">

<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="10" WIDTH="100%">
  <TR>
    <TD width="200"><IMG SRC="images/report_progress.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Select a course: <?php input_list("course_ID",1,"course WHERE status='active'||ID|name",0,"STYLE='FONT-FAMILY:VERDANA;FONT-SIZE:10;'"); ?> <P ALIGN="RIGHT"><B>[<A HREF="JavaScript:document.cprog.submit();" onClick="document.cprog.submit();">Execute</A>]</B></FONT></TD>
  </TR>
  <INPUT TYPE="HIDDEN" NAME="cnt" VALUE="0">
</TABLE>
</FORM>
<br>
<FORM NAME="trs" METHOD="POST" ACTION="index.php?section=reports&report=testresults&sid=<?php echo $sid; ?>">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR>
    <TD width="200"><IMG SRC="images/report_testresults.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Select a course: <?php input_list("course_ID",1,"course WHERE status='active'||ID|name",0,"STYLE='FONT-FAMILY:VERDANA;FONT-SIZE:10;'"); ?> <P ALIGN="RIGHT"><B>[<A HREF="JavaScript:document.trs.submit();" onClick="document.cprog.submit();">Execute</A>]</B></FONT></TD>
  </TR>
   <INPUT TYPE="HIDDEN" NAME="cnt" VALUE="0">
</TABLE>
</FORM>
<?php
}
else
{
include($dir_components."report_".$report.".php");
}
?>
