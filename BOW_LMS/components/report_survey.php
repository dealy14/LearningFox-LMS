<?php

//include_once("../conf.php");

if( isset($_GET['qid']) && ! empty($_GET['qid']) )
{
	$qid = addslashes($_GET['qid']);
	include( $dir_components."report_survey_question.php");
}
else if( isset($_GET['uid']) && ! empty($_GET['uid']) )
{
	$uid = addslashes($_GET['uid']);
	include( $dir_components."report_survey_single.php");
}
else if(isset($_GET['thesurvey']) && ! empty($_GET['thesurvey']) && $_GET['thesurvey'] == 'question' )
{
	include( $dir_components."report_survey_questions.php");
}
else
{//$_GET['thesurvey'] == 'users'
	include( $dir_components."report_survey_users.php");
}
?>