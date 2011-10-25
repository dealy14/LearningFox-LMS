<?php

//include_once("../conf.php");
$qid = addslashes($_GET['qid']);
if(isset($qid) && !empty($qid))
{
	$aquestion = addslashes($qid);
}
else
{
	$aquestion = 1;
}

include( $dir_components."report_survey_thequestionsarray.php");

$dbu = new db;
$dbu->setdb("storyboard");
$dbu->connect();
$sql = "select bow_user.fname as fname,bow_user.lname as lname,bow_user.ID as user_ID, bow_hrsurvey_questions.answer as answer, bow_hrsurvey_questions.question as question, bow_hrsurvey_questions.fecha as fecha from bow_user inner join bow_hrsurvey_questions on bow_hrsurvey_questions.user_ID=bow_user.ID where bow_hrsurvey_questions.question = $aquestion ;";
$dbu->query($sql);
?>
<table width="100%" border="0"  cellspacing="3" cellpadding="5" >
  <tr bgcolor="#999999">
    <td colspan="2" >quesion #<?php echo  $aquestion. ".- " .$thequestions[$aquestion]; ?></td>
  </tr>
<?php
while(  $dbu->getRows() )
{
	echo "  <tr bgcolor=\"#CCCCCC\">";
	//echo "    <td>". $dbu->row('lname').", ". $dbu->row('fname')."&nbsp;</td>";
	echo "    <td>". $dbu->row('fecha')."&nbsp;</td>";
	//echo "  </tr>";
	//echo "  <tr>";
	echo "    <td colspan='1'>". stripslashes( $dbu->row('answer') )."&nbsp;</td>";
	echo "  </tr>";
}
?>
</table>
