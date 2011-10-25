<table width="80%">
<tr>
	<td>Student Name</td>
	<td>&nbsp;</td>
</tr>
<?php
if( isset( $_GET['survey_ID']) &&  !  ereg('[^0-9]',  $_GET['survey_ID'])    )
{
	$survey_ID = $_GET['survey_ID'];
	$sql = "select students.fname as fname, students.lname as lname, students.ID as student_ID from user_surveys, students where survey = $survey_ID AND user_surveys.student = students.ID";
	$dbsurvey = new db;
	$dbsurvey->connect();
	$dbsurvey->query($sql);
	while(      $dbsurvey->getRows()          )
	{
	?>
		<TR>

	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $dbsurvey->row("lname").", ".$dbsurvey->row("fname")?></TD>
		<td><a href="<?php echo "index.php?sid=$sid&section=reports&report=survey_details&survey_ID=$survey_ID&student_ID=".$dbsurvey->row('student_ID')?>" >View <img src="images/import.gif" border="0" /></a></td>
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