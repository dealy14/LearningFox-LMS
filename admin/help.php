<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<SCRIPT>
var helpstate;
function openHelp()
{
top.document.all.helpme.cols="*,300";
}

function closeHelp()
{
top.document.all.helpme.cols="*,20";
}

function toggleHelp(helpstate)
{
	if(helpstate=="open")
	{
	closeHelp();
	this.helpstate="closed";
	return helpstate;
	}
	else
	{
	openHelp();
	this.helpstate="open";
	return helpstate;	
	}
}
</SCRIPT>	
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" LEFTMARGIN="0" BOTTOMMARGIN="0">
<TABLE HEIGHT="100%" CELLPADDING="0" CELLSPACING="0">
 <TR>
   <TD VALIGN="BOTTOM" BGCOLOR="#336699"><A HREF="#" onClick="toggleHelp(helpstate);return false;"><IMG SRC="images/help.gif" BORDER="0" ALT="Nexus Help"></TD>
 </TR>
</TABLE>

</body>
</html>
