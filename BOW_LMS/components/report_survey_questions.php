<?php

//include_once("../conf.php");

?>
<table width="100%" border="0" cellspacing="3" cellpadding="5" >
<?php
include( $dir_components."report_survey_thequestionsarray.php");

foreach( $thequestions as $qid => $ques   )
{
	echo "  <tr bgcolor=\"#CCCCCC\">";
	echo "    <td><a href='index.php?section=reports&report=survey&sid=$sid&qid=$qid&'>View&nbsp;</a></td>";
	echo "    <td>$qid.- $ques&nbsp;</td>";
	echo "  </tr>";
}
?>
</table>