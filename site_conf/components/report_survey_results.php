<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-size: x-small;}
-->
</style>
<?php
	
	$survey_name= "undefined";
	if(isset($_GET['survey_ID']) && ! ereg('[^0-9]',  $_GET['survey_ID']))
	{
		$survey_ID = $_GET['survey_ID'];
		$course_name_sql = "select name from tests where ID = $survey_ID";
		$dbsurveyename = new db;
		$dbsurveyename->connect();
		$dbsurveyename->query($course_name_sql);
		while(     $dbsurveyename->getRows()     )
		{
			$survey_name = $dbsurveyename->row('name');
		}
		
	}
?>
<h2 align="center"><?php echo  $survey_name; ?>: Survey Results</h2>
<table width="100%" align="left">
<tr>
	<td  class="descriptor_row" colspan="4" align="right" ><div align="right"><span class="style3"><img src="images/printer.gif" /></span></div></td>
</tr>
<tr  class="descriptor_row">
	<td><div align="left"><span class="style3">First Name</span></div></td>
	<td><span class="style3">Last Name</span></td>
	<td><span class="style3">Date Taken</span></td>
	<td>&nbsp;</td>
</tr>
<?php
if( isset( $_GET['survey_ID']) &&  !  ereg('[^0-9]',  $_GET['survey_ID'])    )
{
	$survey_ID = $_GET['survey_ID'];
	$sql  = "select students.fname as fname, students.lname as lname, students.ID as student_ID, user_survey_log.fecha as fecha, user_survey_log.ID as survey_ID  ";
	$sql .= "from user_survey_log, students ";
	$sql .= "where user_survey_log.test = $survey_ID AND user_survey_log.student = students.ID ";
	$sql .= " order by  fecha, fname, lname";
	$dbsurvey = new db;
	$dbsurvey->connect();
	$dbsurvey->query($sql);
	//echo $sql;
	while(      $dbsurvey->getRows()          )
	{
	?>
		<TR>
			  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><div align="left"><FONT FACE="VERDANA" SIZE="1">
		      <?php echo $dbsurvey->row("fname");?>
		      </FONT></div></TD>
			  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $dbsurvey->row("lname");?></FONT></TD>
			  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $dbsurvey->row("fecha");?></FONT></TD>
				<td><FONT FACE="VERDANA" SIZE="1">[<a href="<?php echo "index.php?sid=$sid&section=reports&report=survey_details&survey_ID=".$dbsurvey->row("survey_ID")."&student_ID=".$dbsurvey->row('student_ID');?>&" >View</a>]</FONT></td>
		</TR>
	
	<?php
	}

//index.php?section=reports&report=test_details&sid=$sid&course_ID=$course_ID&test_ID=$test_ID[$xn]&ruserID=$ID&uname=".urlencode("$fname $lname")."&cname=".urlencode($cname)."&tname=".urlencode($tname[$xn])
?>

	<?php
	$st="";
}
?>
</TABLE>
