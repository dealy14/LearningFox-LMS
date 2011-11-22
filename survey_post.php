<?php
include("lt/includes/class_db_mysql.php");
include("lt/includes/functions.php"); 
$myanswers = @implode(", ",$answers);
if($add_survey=="yes")
{
insertAction("INSERT INTO temp_wtest (user_ID,test_ID,answers)VALUES('1','$test_ID','$myanswers')");
?>
<wml>
<card id="step5" title="Data was sent">
<p>
Audit has been recorded.
</p>
</card>
</wml>
<?php
}
else if(!$ID && !$add_survey)
{
?>
<P><IMG SRC="ltl.gif" ALIGN="MIDDLE"> <FONT FACE="VERDANA" SIZE="2" COLOR="#a2a2a2"><B>Wireless Survey Results.</B></FONT>
<P>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="80%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="1" WIDTH="100%">
	<TR>
	  <TD><IMG SRC="lt/admin/images/search.gif" BORDER="0" ALIGN="MIDDLE"></TD>
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Survey Date</TD>
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Survey ID</TD>	
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Results</TD>	  
	</TR>
<?php	
	$db = new db;
	$db->connect();
	$db->query("SELECT temp_wtest.*, tests.name FROM temp_wtest,tests WHERE temp_wtest.ID=tests.ID order by date_taken DESC");
	while($db->getRows())
	{ 
?>
	<TR>
	  <TD BGCOLOR="#FFFFFF">&nbsp;</TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo substr($db->row("date_taken"),4,2);?>/<?php echo substr($db->row("date_taken"),6,2);?>/<?php echo substr($db->row("date_taken"),0,4);?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B>Daily Equipment Safety Check</TD>	  
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php $ta = explode(", ",$db->row("answers"));echo "<LI>".@implode("<LI>",$ta);?></TD>
	</TR>	
<?php
	}
?>	
</TABLE>
</TD></TR></TABLE>
<?php
}
else
{

//do nothing;
}
?>
