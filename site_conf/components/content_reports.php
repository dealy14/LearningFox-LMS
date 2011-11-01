<div >
<?php
if(!$report)
{
?>
<h2 align="center">Reports</h2>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" >
  <TR>
    <TD><IMG SRC="images/report_roster.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Roster.</FONT></TD>
	<td align="right" valign="bottom"><FONT FACE="VERDANA" SIZE="2">[<A HREF="index.php?section=reports&report=roster&sid=<?php echo $sid; ?>">View</A>]</FONT></td>
  </TR>

<tr><td colspan="3">&nbsp;</td></tr>
<FORM NAME="cprog" METHOD="POST" ACTION="index.php?section=reports&report=progress&sid=<?php echo $sid; ?>">

  <TR>
    <TD><IMG SRC="images/report_progress.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2">Course Progress: <?php input_list("course_ID",1,"course WHERE status='active'||ID|name",0,"STYLE='FONT-FAMILY:VERDANA;FONT-SIZE:10;'"); ?></FONT></TD>
	<td align="right" valign="bottom"><FONT FACE="VERDANA" SIZE="2">[<A HREF="JavaScript:document.cprog.submit();" onClick="document.cprog.submit();">View</A>]</FONT></td>
  </TR>
  <INPUT TYPE="HIDDEN" NAME="cnt" VALUE="0">
</FORM>

<tr><td colspan="3">&nbsp;</td></tr>
<FORM NAME="trs" METHOD="get" ACTION="index.php?section=reports&report=survey_results&sid=<?php echo $sid; ?>">

  <TR>
    <TD><IMG SRC="images/report_testresults.gif" BORDER="0"></TD>
    <TD><FONT FACE="VERDANA" SIZE="2"><label>Survey Results: 
		<input type="hidden" name="sid" value="<?php echo $sid; ?>" /> 
		<input type="hidden" name="section" value="reports" /> 
		<input type="hidden" name="report" value="survey_results" />
		
      <select name="survey_ID" style="width:140px;">
	  <?php 
	  	$dbtest = new db;
		$dbtest->connect();
		$dbtest->query("SELECT * FROM tests");
		while(      $dbtest->getRows()          )
		{
		?>
		<option value="<?php echo $dbtest->row('ID');?>" ><?php echo $dbtest->row('name');?></option>
		<?php
		}
	  ?>
      </select>
      </label></FONT></TD>
	  <td align="right" valign="bottom"><FONT FACE="VERDANA" SIZE="2">[<A HREF="JavaScript:document.trs.submit();" onClick="document.cprog.submit();">View</A>]</FONT></td>
  </TR>
   <INPUT TYPE="HIDDEN" NAME="cnt" VALUE="0">
  </FORM>
</TABLE>

<?php
}
else
{
?>
<p align="right"><a href="?section=reports&sid=<?php echo $sid; ?>">Back to Reports</a></p>
<?php
include($dir_components."report_".$report.".php");
}
?>
</div>