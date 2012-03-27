<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#93BEE2}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;BACKGROUND:#336699;}
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="thisform" METHOD="POST" ACTION="create_objects_sql.php?action=test">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>survey Title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input"></TD>		
	  </TR>	  
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>survey Type:</SPAN></TD>
	    <TD>
		<SELECT NAME="type" CLASS="input">
		  <OPTION VALUE="normal" SELECTED>normal</OPTION>
		  <OPTION VALUE="wireless survey">wireless survey</OPTION>		  
		</SELECT>
		</TD>		
	  </TR>	  		  	  	
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS=submit></TD>
	  </TR>				  
	</TABLE>

</FORM>
</body>
</html>
