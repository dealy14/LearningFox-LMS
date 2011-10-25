<?php
include("../includes/class_db_mysql.php");
include("../includes/functions.php"); 
$myanswers = @implode(", ",$answers);
if($add_survey=="yes")
{
insertAction("INSERT INTO temp_wtest2 (user_ID,test_ID,answers)VALUES('1','$test_ID','$myanswers')");
Header("Content-type:text/vnd.wap.wml");
echo"\n<"."? xml version=\"1.0\" ?".">";
?>
<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"
			"http://www.wapforum.org/DTD/wml_1.1.xml">
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
<P><IMG SRC="../../ltl.gif" ALIGN="MIDDLE"> <FONT FACE="VERDANA" SIZE="2" COLOR="#a2a2a2"><B>Wireless Survey Results.</B></FONT>
<P>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="80%"><TR><TD BGCOLOR="#CCCCCC">
<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="1" WIDTH="100%">
	<TR>
	  <TD><IMG SRC="../admin/images/search.gif" BORDER="0" ALIGN="MIDDLE"><FONT FACE="VERDANA" SIZE="2"><B>Survey #</TD>
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Survey Date</TD>
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Survey ID</TD>	
	  <TD><FONT FACE="VERDANA" SIZE="2"><B>Results</TD>	  
	</TR>
<?php	
	$db = new db;
	$db->connect();
	$db->query("SELECT temp_wtest2.*, tests.name FROM temp_wtest2,tests WHERE temp_wtest2.test_ID=tests.ID order by date_taken DESC");
	while($db->getRows())
	{ 
?>
	<TR>
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2">S00-<?php echo $db->row("ID");?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><?php echo substr($db->row("date_taken"),4,2);?>/<?php echo substr($db->row("date_taken"),6,2);?>/<?php echo substr($db->row("date_taken"),0,4);?></TD>
	  <TD BGCOLOR="#FFFFFF" VALIGN="TOP"><FONT FACE="VERDANA" SIZE="2"><B><?php echo $db->row("name");?></TD>	  
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
