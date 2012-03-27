<?
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#FFFFFF}
.input2 {FONT-FAMILY:VERDANA;FONT-SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#FFFFFF}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.listtext {FONT-FAMILY:VERDANA;FONT-SIZE:11;COLOR:#000000;}
.submit {FONT-FAMILY:VERDANA;BACKGROUND:#336699;}
</STYLE>
	<title> ::Create a Lesson:: </title>	
</head>
<?
if(!$frame||$frame=="")
{
?>
<SCRIPT>
//setInterval("window.focus();",3600);
window.resizeTo(350,400);
</SCRIPT>
<FRAMESET ROWS="0,0,*,50" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
<FRAME NAME="formpost" SCROLLING="NO" noresize SRC="create_lesson.php?frame=top" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<!--<FRAME NAME="data" SCROLLING="NO" noresize SRC="create_lesson.php?frame=middle" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">-->
<FRAME NAME="lists" noresize SRC="create_lesson.php?frame=bottom" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="subm" SCROLLING="NO" noresize  SCROLLING="NO" SRC="create_lesson.php?frame=bottom2" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<frame src="UntitledFrame-1"><frame src="UntitledFrame-2"></FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
<?
}
else if($frame=="top")
{
?>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="myform" METHOD="POST" ACTION="create_objects_sql.php?action=lesson" TARGET="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="lesson_ID" VALUE="<?echo$lesson_ID;?>">


<?
$db = new db;
$db->connect();
$db->query("SELECT name,ID,created,modified FROM topic");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
?>
<input type="Checkbox" name="topic_<?echo$ID;?>" value="enter">
<INPUT TYPE="TEXT" NAME="topicID[<?echo$ID;?>]" VALUE="<?echo$ID;?>">
<INPUT TYPE="TEXT" NAME="topic_<?echo$ID;?>_text" VALUE=""><BR>
<?
$objArray[]="topic_".$ID;
}
?>

<INPUT TYPE="TEXT" NAME="topicArray" VALUE="">

</FORM>

<SCRIPT>
document.myform.topicArray.value="<?echo implode(",",$objArray);?>";
</SCRIPT>
</body>

<?
}
else if ($frame=="middle")
{
?>


<SCRIPT>
function setTextData(elName)
{
eval("top.formpost.document.myform."+elName+".value=document.thisform."+elName+".value;");
}

</SCRIPT>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IMG SRC="images/lesson_sm.gif" ALIGN="absmiddle"> <SPAN CLASS=hdr>Create a Lesson:</SPAN>
<FORM NAME="thisform" METHOD="POST" ACTION="create_objects_sql.php?action=lesson" target="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?echo date(ymd);?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="Left">
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl>Lesson title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input" onBlur="setTextData('name');"></TD>		
	  </TR> 	  			  
	</TABLE>

</FORM>
</body>
<?
}
else if ($frame=="bottom")
{
?>

<SCRIPT>

function imgOn(theimg,imgName)
{
  if(eval("img"+theimg+"Status")=="off"||eval("img"+theimg+"Status")==null)
  {
  eval("document."+imgName+".src=\"images/topic_list_on.gif\";");
  eval("this.img"+theimg+"Status=\"on\";");
  eval("top.formpost.document.myform."+imgName+".checked=true");
  eval("document.topics.topic_"+theimg+"_text.select();");
  }
  else
  {
  eval("document."+imgName+".src=\"images/topic_list_off.gif\";");
  eval("this.img"+theimg+"Status=\"off\";");
  eval("top.formpost.document.myform."+imgName+".checked=false");
  eval("document.topics.topic_"+theimg+"_text.blur();");
  }
  return eval("this.img"+theimg+"Status");
}

function setText(tName)
{
 eval("top.formpost.document.myform."+tName+".value=document.topics."+tName+".value"); 
}
</SCRIPT>	


<body bgcolor="#FFFFFF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" ALIGN="CENTER"><TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="2" WIDTH="100%" ALIGN="CENTER">
<FORM NAME="topics">
  <TR>
    <TD COLSPAN="3"><SPAN CLASS="listtext">Import Topics into the Lesson:<BR><IMG SRC="images/spcr.gif" WIDTH="333" HEIGHT="1"><HR COLOR="#336699"></TD>
  </TR>
  <TR>
    <TD><SPAN CLASS="listtext"><B>Name</TD>
    <TD><SPAN CLASS="listtext"><B>Created</TD>
    <TD><SPAN CLASS="listtext"><B>Modified</TD>
  </TR>
<?
$db = new db;
$db->connect();
$db->query("SELECT name,ID,created,modified FROM topic");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
?>
  <TR>
    <TD BGCOLOR="#FFFFFF"><A HREF="#" onClick="imgOn(<?echo$ID;?>,'topic_<?echo$ID;?>');setText('topic_<?echo$ID;?>_text');return false;"><IMG SRC="images/topic_list_off.gif" NAME="topic_<?echo$ID;?>" BORDER="0" ALIGN="absmiddle"></A> <INPUT TYPE="TEXT" ID=p<?echo$ID;?> NAME="topic_<?echo$ID;?>_text" VALUE="<?echo$db->row("name");?>" onBlur="setText('topic_<?echo$ID;?>_text');" CLASS="input2"></TD>
    <TD BGCOLOR="#FFFFFF"><SPAN CLASS="listtext"><?echo$db->row("created");?></TD>
    <TD BGCOLOR="#FFFFFF"><SPAN CLASS="listtext"><?echo$db->row("modified");?></TD>
  </TR>
<SCRIPT>var img<?echo$ID;?>Status;</SCRIPT> 
<?
}
?>
</FORM>  
</TABLE>
</TD></TR></TABLE>


</body>
<?
}

else if($frame=="bottom2")
{
?>

<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<BR>
<TABLE BORDER="0" CELLSPACING="0" CELLPADING="4" WIDTH="100%">
  <TR>
    <TD ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel" CLASS=submit onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  onClick="top.formpost.document.myform.submit();return false;"  CLASS=submit></TD>
  </TR>		
</TABLE>


<?
}
?>
</html>
