<?php
session_start();
//error_reporting(E_ALL);

$myconf="demo_site";
require_once("../conf.php");
$userID = $_SESSION['lms_userID'];
$fecha = date("Y-m-d H:i:s");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Survey</title>
</head>
<BODY TOPMARGIN=0 LEFTMARGIN=0 RIGHTMARGIN=0>
<?php
//echo $main_dir;
//echo $userID;
if((!is_null($_GET['sid'])) )//&& $session_error =="none"
{//if logged in

	//echo "test";
	$showtest="";
	
	//testIDcheck
	if(       !  ereg('[^0-9]',  $_GET['survey_ID'])       )
	{// test ID is correctly set
		/**************************************************/
		//check database for test assignment if the test is
		// not assigned to the student the student will not
		// be able to take test.
		/**************************************************/
		$survey_ID = $_GET['survey_ID'];
		/**/
		$dbtest = new db;
		$dbtest->connect();
		$dbtest->query("SELECT * FROM user_surveys WHERE survey=$survey_ID AND student = $userID");
		if(      $dbtest->getRows()          )
		{//passes its in the db
			$showtest=true;
		}
		else
		{//test is not in student's test list.
			$showtest=false;
		}
	}// test ID is correctly set  
	else
	{//test_id does not pass check. 
		$showtest=false;
	}// test ID is correctly set  
	  
	if(    $showtest    )//showtest pretest 
	{//display questions.
	  $dbquestion = new db;
	  $dbquestion->connect();
	  $dbquestion->query("SELECT questions.*, tests_r.question_order FROM tests_r, questions WHERE tests_r.question_ID = questions.ID and tests_r.test_ID=$survey_ID ORDER BY tests_r.question_order");

if( @$_GET['checkans'] == "true" )
{//the survey was answered
	//check each question and upload results to DB.
	$checkans = "true";
	$sql_survey_entry = "INSERT INTO user_survey_log (student, test, fecha) values ($userID,$survey_ID, '".$fecha."' )";
	$dbsurvey = new db;
	$dbsurvey->connect();
	$dbsurvey->query( $sql_survey_entry );
	

	$dbsurvey->query( "select * from user_survey_log where student = $userID AND test = $survey_ID AND fecha = '$fecha';" );
	$dbsurvey->getRows();
	$user_survey_log_id = $dbsurvey->row('ID');
	$dbsurvey->close();
	
	$sql_user_ans = "INSERT INTO user_survey_question_log (survey_log_ID, answer, qid ) values ";
	$coma="";//keep the first set of values to add a coma
	
}
$correct_incorrect_ans = "";
$i=1;
?>
<FORM NAME="myquiz" METHOD="GET" ACTION="" onSubmit="checkTest();">
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=1 WIDTH=100%><TR><TD BGCOLOR=#d8d8d8>
<TABLE BORDER=0 CELLPADDING=4 CELLSPACING=1 WIDTH=100%>
  <?php
  if( $checkans != "true" )
  {
  ?>
  <TR>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Number</B></FONT></TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Question</B></FONT></TD>
  </TR>
  <?php
  }
  else
  {
  ?>
  <TR>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>&nbsp;</B></FONT></TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>#</B></FONT></TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Question</B></FONT></TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Your Answer</B></FONT></TD>
    <TD BGCOLOR=Black><FONT FACE=VERDANA SIZE=2 COLOR=#FFFFFF><B>Correct Answer</B></FONT></TD>
  </TR>
  <?php
  }
  ?>
<?php
while($dbquestion->getRows())
{ 
	//check answers.
	if( $checkans == "true"   )
	{//the survey was answered
		//check each question and upload results to DB.
		if( isset($_GET['q'.$i]) &&  (!  ereg('[^0-9A-Za-z]',$_GET['q'.$i])  ) )
		{
			
			$sql_user_ans .= "$coma (".$user_survey_log_id.", '".$_GET['q'.$i]."',".$dbquestion->row("ID").") ";
			$coma=",";
		}
		
		
		$bg = " BGCOLOR=#FFFFFF ";
		if( $_GET['q'.$i] == $dbquestion->row("correct_answ"))
		{
			$correct_incorrect_ans = "<img src='../images/check.gif'>";
		}
		else
		{
			$correct_incorrect_ans = "<img src='../images/x.gif'>";
			$bg = " bgcolor='#FF8484' ";
		}
		?>
		 <TR <?php echo $bg; ?> >
			<TD <?php echo $bg; ?> VALIGN=TOP><FONT FACE=VERDANA SIZE=2><B><?php echo $correct_incorrect_ans; ?></B></FONT></TD>
			<TD <?php echo $bg; ?> VALIGN=TOP><FONT FACE=VERDANA SIZE=2><B>#<?php echo $i++; ?></B></FONT></TD>
			<TD <?php echo $bg; ?> ><FONT FACE=VERDANA SIZE=2><B><?php echo $dbquestion->row("question");?></B></FONT></TD>
			<TD <?php echo $bg ;?> ><FONT FACE=VERDANA SIZE=2><B><?php echo $_GET['q'.$i]; ?></B></FONT></TD>
			<TD <?php echo $bg; ?> ><FONT FACE=VERDANA SIZE=2><B><?php echo $dbquestion->row("correct_answ");?></B></FONT></TD>	
	  	</TR>	
		<?php
	}
	else
	{
?>
	  <TR>
	    <TD BGCOLOR=#FFFFFF VALIGN=TOP><FONT FACE=VERDANA SIZE=2><B><?php echo  $i++ ;?></B></FONT></TD>
	    <TD BGCOLOR=#FFFFFF><FONT FACE=VERDANA SIZE=2><B><?php echo $dbquestion->row("question"); ?></B></FONT>
		<UL>
			<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=2>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name="q<?php echo $dbquestion->row("ID"); ?>" value=A><FONT FACE=VERDANA SIZE=2><B>A</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><?php echo $dbquestion->row("choice_1"); ?></FONT></TD>
			  </TR>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name="q<?php echo $dbquestion->row("ID");?>" value=B><FONT FACE=VERDANA SIZE=2><B>B</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><?php echo $dbquestion->row("choice_2");?></FONT></TD>
			  </TR>			
			<?php
			if( $dbquestion->row("choice_3") != "")
			{
			?>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name="q<?php echo $dbquestion->row("ID"); ?>" value=C><FONT FACE=VERDANA SIZE=2><B>C</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><?php echo $dbquestion->row("choice_3"); ?></FONT></TD>
			  </TR>
			 <?php
			 }
			if( $dbquestion->row("choice_3") != "")
			{
			?>
			  <TR>
			    <TD BGCOLOR=#CCCCCC><input type=Radio name="q<?php echo $dbquestion->row("ID");?>" value=D><FONT FACE=VERDANA SIZE=2><B>D</B></FONT></TD>
				<TD><FONT FACE=VERDANA SIZE=2><?php echo $dbquestion->row("choice_4");?></FONT></TD>
			  </TR>	
			 <?php
			 }
			 ?>
			</TABLE>
			</UL>
		</TD>	
	  </TR>	
<?php
	}
}
?>	
	  <TR>
	    <TD BGCOLOR=Black COLSPAN=5 ALIGN=RIGHT>
			<?php
				if( $checkans != "true")
				{
					?><INPUT TYPE=SUBMIT NAME=SUBMIT VALUE="Submit Answers"><?php
				}
				else
				{
					?><font color="#FFFFFF">Thanks</font><?php
				}
			?>	  </TD>	
	  </TR>
    </TABLE></TD></TR></TABLE>
	
<INPUT TYPE='HIDDEN' NAME='checkans' VALUE='true'>
<INPUT TYPE='HIDDEN' NAME='sid' VALUE='<?php echo $sid; ?>'>
<INPUT TYPE='HIDDEN' NAME='survey_ID' VALUE='<?php echo $survey_ID; ?>'>
</FORM>
<?php
		if( $checkans == "true")
		{
			//echo $sql_user_ans;
			
			$dbsurvey2 = new db;
			$dbsurvey2->connect();
			$dbsurvey2->query( $sql_user_ans );
			//$dbsurvey2->getRows();
			$dbsurvey2->close();
			/**/
		}
	}// if $showtest
}//if logged in

?>
</BODY>
</HTML>