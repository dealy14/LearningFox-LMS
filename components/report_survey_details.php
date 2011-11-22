<table width="80%">
<?php
if( isset( $_GET['survey_ID']) &&  !  ereg('[^0-9]',  $_GET['survey_ID']) && isset($_GET['student_ID']) &&  !  ereg('[^0-9]',  $_GET['student_ID'])   )
{
	$survey_ID = $_GET['survey_ID'];
	$student_ID = $_GET[ 'student_ID'];
	$sql = "select students.fname as fname, students.lname as lname, students.ID as student_ID from students where students.ID = $student_ID";
	$dbsurvey = new db;
	$dbsurvey->connect();
	$dbsurvey->query($sql);
	while(      $dbsurvey->getRows()          )
	{
	?>
		<TR>

	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP><FONT FACE="VERDANA" SIZE="1"><?php echo $dbsurvey->row("lname").", ".$dbsurvey->row("fname");?></TD>

	</TR>
	
	<?php
	}

//index.php?section=reports&report=test_details&sid=$sid&course_ID=$course_ID&test_ID=$test_ID[$xn]&ruserID=$ID&uname=".urlencode("$fname $lname")."&cname=".urlencode($cname)."&tname=".urlencode($tname[$xn])
	$sql = "select questions.question as question, questions.choice_1 as choice_1, questions.choice_2 as choice_2, questions.choice_3 as choice_3, questions.choice_4 as choice_4, questions.correct_answ as correct_ans, user_survey_question_log.answer as actual_ans, user_survey_log.fecha as fecha from user_survey_log, user_survey_question_log, questions where user_survey_log.student = '$student_ID' AND user_survey_log.test = $survey_ID AND user_survey_log.ID = user_survey_question_log.survey_log_ID AND questions.ID =  user_survey_question_log.qid;";
	//echo $sql;
	$dbsurvey2 = new db;
	$dbsurvey2->connect();
	$dbsurvey2->query($sql);
	while(      $dbsurvey2->getRows()          )
	{
	?>
	<tr><td>fecha:<?php echo  $dbsurvey2->row('fecha');?></td></tr>
	<tr><td><?php echo  $dbsurvey2->row('question');?></td></tr>
	<tr><td>a.<?php echo  $dbsurvey2->row('choice_1');?></td></tr>
	<tr><td>b.<?php echo  $dbsurvey2->row('choice_2');?></td></tr>
	<tr><td>c.<?php echo  $dbsurvey2->row('choice_3');?></td></tr>
	<tr><td>d.<?php echo  $dbsurvey2->row('choice_4');?></td></tr>
	<tr><td>correct ans:<?php echo  $dbsurvey2->row('correct_ans');?></td></tr>
	<tr><td>actual ans:<?php echo  $dbsurvey2->row('actual_ans');?></td></tr>
	<tr><td>&nbsp;</td></tr>
	
	<?php
	}
	$st="";
}
?>
</TABLE>