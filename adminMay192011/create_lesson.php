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
<?php
if(!$frame||$frame=="")
{
?>
<SCRIPT>
//setInterval("window.focus();",3600);
window.resizeTo(300,150);
</SCRIPT>
<FRAMESET ROWS="30,*" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
<FRAME NAME="formpost" SCROLLING="NO" noresize SRC="create_lesson.php?frame=top" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="data" noresize SRC="create_lesson.php?frame=bottom&subaction=<?php echo $subaction;?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
</FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
<?php
}
else if($frame=="top")
{
?>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IMG SRC="images/lesson_sm.gif" ALIGN="absmiddle"> <SPAN CLASS=hdr>Create a Lesson:</SPAN>
<FORM NAME="myform" METHOD="POST" ACTION="create_objects_sql.php?action=topic" TARGET="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="topic_name">
<INPUT TYPE="HIDDEN" NAME="topic_type" VALUE="normal">
<INPUT TYPE="HIDDEN" NAME="content_location" VALUE="local">
<INPUT TYPE="HIDDEN" NAME="content_link">
<INPUT TYPE="HIDDEN" NAME="time_limit">
<INPUT TYPE="HIDDEN" NAME="time_req">
</FORM>
</body>
<?php
}
else if ($frame=="bottom")
{
?>
<SCRIPT>
function setTextData(elName)
{
eval("top.formpost.document.myform."+elName+".value=document.thisform."+elName+".value;");
}



</SCRIPT>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="thisform" METHOD="POST" ACTION="create_objects_sql.php?action=lesson" target="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="subaction" VALUE="<?php echo $subaction;?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER">
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Lesson Title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input"></TD>		
	  </TR>	  	  	
	  <TR>
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS=submit></TD>
	  </TR>				  
	</TABLE>

</FORM>
</body>
<?php
}
?>
</html>
