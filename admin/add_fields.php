<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
function openfAdd()
{
newwin = window.open('add_fields.php','nothing','width=250,height=50');
}
</SCRIPT>

<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;FONT-SIZE:12;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#FFFFFF}
.input2 {FONT-FAMILY:VERDANA;FONT-SIZE:10;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#336699}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#EFF7FF}
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="8" CELLSPACING="0" BORDER="0" ALIGN="CENTER" HEIGHT="100%">
  <TR>
    <TD VALIGN="MIDDLE"><?php input_list("field",1,"reg_form WHERE stored='n'||ID|field_name",0,"CLASS=INPUT");?></TD>
    <TD VALIGN="MIDDLE"><INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" ADD " CLASS="submit"></TD>
  </TR>
</TABLE>
</FORM>
</BODY>
<!--insert into reg_form VALUES('mname','off','','n','NULL')-->