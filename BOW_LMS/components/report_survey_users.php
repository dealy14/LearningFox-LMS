<?php

//include_once("../conf.php");
	
$dbu = new db;
$dbu->setdb("storyboard");
$dbu->connect();
$sql = "select * from bow_user;";
$dbu->query($sql);
?>
<table width="100%" border="0" cellspacing="3" cellpadding="5" >
  <tr bgcolor="#999999">
    <td>ID</td>
    <td>first name </td>
    <td>last name</td>
    <td>organization</td>
    <td>date</td>
  </tr>
<?php
while(  $dbu->getRows() )
{
	echo "  <tr bgcolor=\"#CCCCCC\">";
	echo "    <td><a href='index.php?section=reports&report=survey&sid=$sid&uid=".$dbu->row('ID')."&'>". $dbu->row('ID')."&nbsp;</a></td>";
	echo "    <td>". $dbu->row('fname')."&nbsp;</td>";
	echo "    <td>". $dbu->row('lname')."&nbsp;</td>";
	echo "    <td>". $dbu->row('org')."&nbsp;</td>";
	echo "    <td>". $dbu->row('fecha')."&nbsp;</td>";
	echo "  </tr>";
}
?>
</table>