<table width="100%">
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

	  <TD BGCOLOR="#FFFFFF" VALIGN=TOP colspan="5"><FONT FACE="VERDANA" SIZE="1"><?php echo $dbsurvey->row("lname").", ".$dbsurvey->row("fname");?></FONT></TD>

	</TR>
	
	<?php
	}

//index.php?section=reports&report=test_details&sid=$sid&course_ID=$course_ID&test_ID=$test_ID[$xn]&ruserID=$ID&uname=".urlencode("$fname $lname")."&cname=".urlencode($cname)."&tname=".urlencode($tname[$xn])
	$sql =  "select questions.question as question, questions.choice_1 as choice_1, questions.choice_2 as choice_2, questions.choice_3 as choice_3, questions.choice_4 as choice_4, questions.correct_answ as correct_ans, user_survey_question_log.answer as actual_ans, user_survey_log.fecha as fecha, user_survey_log.ID as survey_id ";
	$sql .= " from user_survey_log, user_survey_question_log, questions ";
	$sql .= " where user_survey_log.student = '$student_ID' AND user_survey_log.ID = $survey_ID AND user_survey_log.ID = user_survey_question_log.survey_log_ID AND questions.ID =  user_survey_question_log.qid;";
	//echo $sql;
	$dbsurvey2 = new db;
	$dbsurvey2->connect();
	$dbsurvey2->query($sql);
	$old_survey_id = "";//variable that will hold the id to separate different surveys
	$q_number = 1;
	while(      $dbsurvey2->getRows()          )
	{
		if(   $old_survey_id != $dbsurvey2->row('survey_id')   )
		{
			$old_survey_id = $dbsurvey2->row('survey_id');
			$q_number = 1;
			?>
			<tr><td colspan="5"><br />test taken on <?php echo $dbsurvey2->row('fecha');?></td></tr>
			<TR class="descriptor_row">
				<TD><FONT FACE=VERDANA SIZE=2><B>&nbsp;</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><B>#</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><B>Question</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><B>Your Answer</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><B>Correct Answer</B></FONT></TD>
			</TR>
			<?php
		}
		if($dbsurvey2->row('correct_ans') == $dbsurvey2->row('actual_ans'))
		{
			$correct_incorrect_ans = "<img src='../images/check.gif'>";
			$bg = " BGCOLOR=#FFFFFF ";
		}
		else
		{
			$correct_incorrect_ans = "<img src='../images/x.gif'>";
			$bg = " bgcolor='#FF8484' ";
		}
		?>
		<tr>
			<td <?php echo $bg; ?> ><?php echo  $correct_incorrect_ans; ?></td>
			<td <?php echo $bg; ?> ><?php echo  $q_number++ ;?></td>
			<td <?php echo $bg; ?> ><?php echo  $dbsurvey2->row('question');?></td>
			<td <?php echo $bg; ?> ><?php echo  $dbsurvey2->row('actual_ans');?></td>
			<td <?php echo  $bg; ?> ><?php echo  $dbsurvey2->row('correct_ans');?></td>
		</tr>
		<?php
	}
	$st="";
}
?>
</TABLE>