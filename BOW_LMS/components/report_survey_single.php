<?php

//include_once("../conf.php");
$uid = addslashes($_GET['uid']);
if(isset($uid) && !empty($uid))
{
	$user = addslashes($uid);
}
else
{
	$user = 1;
}

$dbu = new db;
$dbu->setdb("storyboard");
$dbu->connect();
$sql = "select * from bow_user where ID = $user;";
$dbu->query($sql);
?>
<table width="100%" border="0" cellspacing="3" cellpadding="5"  >
  <tr bgcolor="#999999">
    <td>first name </td>
    <td>last name</td>
    <td>organization</td>
    <td>date</td>
  </tr>
<?php
while(  $dbu->getRows() )
{
	echo "  <tr>";
	echo "    <td>". $dbu->row('fname')."&nbsp;</td>";
	echo "    <td>". $dbu->row('lname')."&nbsp;</td>";
	echo "    <td>". $dbu->row('org')."&nbsp;</td>";
	echo "    <td>". $dbu->row('fecha')."&nbsp;</td>";
	echo "  </tr>";
}
?>
</table>
<?php
$dbq = new db;
$dbq->setdb("storyboard");
$dbq->connect();
$thequestions = array();
$thequestions[1]="Who do you see as the main customer(s) of the HR department - who does it serve?";
$thequestions[2]="With these customers in mind, list each service or product HR provides.";
$thequestions[3]="List 3-5 words or phrases that describe HR’s ideal image from a customer's point-of-view.";
$thequestions[4]="Who are other stakeholders of the HR department (people or groups who have a vested interested in the success of HR) other than the customers described above?  Briefly describe their role(s).";
$thequestions[5]="List 3-5 words or phrases that describe HR’s ideal image from a stakeholder point-of-view.";
$thequestions[6]="List 5-10 words or phrases that describe the HR function within Eagle Ottawa. Highlight the three most important.";
$thequestions[7]="List 5-10 words or phrases that describe the behaviors and personal attributes all members of HR should aspire to.  Highlight the three most important.";
$thequestions[8]="List your most important resource needs as a member of the HR group (skills, training & development, technology, equipment, facility, etc.).";
$thequestions[9]="What additional support do you feel you need in order to achieve your business objectives?";



$sql = "select * from bow_hrsurvey_questions where user_ID = $user order by question;";
$dbq->query($sql);
?>
<table border="0" cellspacing="3"  cellpadding="5" >
<tr>
<td align="left"></td><td></td>
</tr>
<?php

while(  $dbq->getRows() )
{
	echo  "<tr bgcolor=\"#CCCCCC\">";
	$theqid = $dbq->row('question');
	echo  "<td align=\"left\"> Question $theqid  </td><td align=\"right\">".$dbq->row('fecha')."</td>";
	echo  "</tr>";
	echo  "<tr bgcolor=\"#CCCCCC\">";
	echo  "<td align=\"left\" colspan=\"2\">".$thequestions[(0+$theqid)]."<br>".stripslashes($dbq->row('answer'))."</td>";
	echo  "</tr>";
	echo  "<tr>";
	echo  "<td colspan=\"2\">&nbsp;</td>";
	echo  "</tr>";
}
?>
</table>