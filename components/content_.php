<table width="614" height="436" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td>	<FORM NAME="myform" METHOD="POST" ACTION="index.php?section=login&submit=yes">
	<TABLE BORDER="0" CELLPADDING="4" CELLSPACING="0">
	<?php
	if($lms_orgID=="on")
	{
	?>
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Organization ID:</TD>
	    <TD><INPUT TYPE="TEXT" NAME="org_id"></TD>
	  </TR>	
        <?php
	}
	?>	
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>UserName:</TD>
	    <TD><INPUT TYPE="TEXT" NAME="uname"></TD>
	  </TR>
	  <TR>
	    <TD ALIGN="RIGHT"><FONT FACE="VERDANA" SIZE="2"><B>Password:</TD>
	    <TD><INPUT TYPE="password" NAME="pwd"></TD>
	  </TR>
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="IMAGE" SRC="images/submit.gif" BORDER="0"></TD>
	  </TR>
	</TABLE>
	</FORM>	</td>
  </tr>
  <tr>
    <td><img src="images/LearningTrackLogo.jpg" width="343" height="159" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<!-- <img src="images/main.jpg" width="614" height="436"> -->