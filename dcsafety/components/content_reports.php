<?php
if(!$report)
{
?>
<P>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/report_roster.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">A report. <B>[<A HREF="index.php?section=reports&report=roster&sid=<?php echo $sid; ?>">Execute</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>

<P>
<FORM NAME="cprog" METHOD="POST" ACTION="index.php?section=reports&report=progress&sid=<?php echo $sid; ?>">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/report_progress.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Select a course: <?php input_list("course_ID",1,"course||ID|name",0,"STYLE='FONT-FAMILY:VERDANA;FONT-SIZE:10;'");?> <P ALIGN="RIGHT"><B>[<A HREF="JavaScript:document.cprog.submit();" onClick="document.cprog.submit();">Execute</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
</FORM>
<P>
<FORM NAME="trs" METHOD="POST" ACTION="index.php?section=reports&report=testresults&sid=<?php echo $sid; ?>">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" WIDTH="100%">
  <TR BGCOLOR="#FFFFFF">
    <TD><IMG SRC="images/report_testresults.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Select a course: <?php input_list("course_ID",1,"course||ID|name",0,"STYLE='FONT-FAMILY:VERDANA;FONT-SIZE:10;'");?> <P ALIGN="RIGHT"><B>[<A HREF="JavaScript:document.trs.submit();" onClick="document.cprog.submit();">Execute</A>]</B></TD>
  </TR>
</TABLE>
</TD></TR></TABLE>
</FORM>
<?php
}
else
{
include("components/report_".$report.".php");
}
?>
