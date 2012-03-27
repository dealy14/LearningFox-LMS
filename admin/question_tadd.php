<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<STYLE TYPE="text/css">
.input2 {FONT-FAMILY:VERDANA;FONT-SIZE:11;BORDER-TOP:#000000;BORDER-RIGHT:#000000;BORDER-LEFT:#000000;BORDER-BOTTOM:#000000;BACKGROUND:#FFFFFF}
<?php include("admin_css.php");?>
.listtext {FONT-FAMILY:VERDANA;FONT-SIZE:10;}
.submit {FONT-FAMILY:VERDANA;BACKGROUND:#336699;}
</STYLE>
	<title> ::Import Test Questions:: </title>	
</head>
<?php
if(!$frame||$frame=="")
{
?>
<SCRIPT>
//setInterval("window.focus();",3600);
window.resizeTo(350,400);
</SCRIPT>
<FRAMESET ROWS="0,50,*,50" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
<FRAME NAME="formpost" SCROLLING="NO" noresize SRC="question_tadd.php?frame=top&lesson_ID=<?php echo $lesson_ID;?>&lname=<?php echo $lname;?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="data" SCROLLING="NO" noresize SRC="question_tadd.php?frame=middle" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="lists" noresize SRC="question_tadd.php?frame=bottom" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="subm" SCROLLING="NO" noresize  SCROLLING="NO" SRC="question_tadd.php?frame=bottom2" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<frame src="UntitledFrame-12"></FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
<?php
}
else if($frame=="top")
{
?>
<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="myform" METHOD="POST" ACTION="update_objects_sql.php?action=test2&formAction=UPDATE" TARGET="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="TEXT" NAME="lesson_ID" VALUE="<?php echo $lesson_ID;?>">


<?php
$db = new db;
$db->connect();
$db->query("SELECT qname,ID FROM questions");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
?>
<input type="Checkbox" name="topic_<?php echo $ID;?>" value="enter">
<INPUT TYPE="TEXT" NAME="topicID[<?php echo $ID;?>]" VALUE="<?php echo $ID;?>">
<INPUT TYPE="TEXT" NAME="topic_<?php echo $ID;?>_text" VALUE=""><BR>
<?php
$objArray[]="topic_".$ID;
}
?>

<INPUT TYPE="TEXT" NAME="topicArray" VALUE="">

</FORM>

<SCRIPT>
document.myform.topicArray.value="<?php echo implode(",",$objArray);?>";
</SCRIPT>
</body>

<?php
}
else if ($frame=="middle")
{
?>


<body bgcolor="#336699" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IMG SRC="images/test_new.gif" ALIGN="absmiddle"> <SPAN CLASS=hdr>Import Questions Into Test:</SPAN>
</body>

<?php
}
else if ($frame=="bottom")
{
?>

<SCRIPT>

function imgOn(theimg,imgName)
{
  if(eval("img"+theimg+"Status")=="off"||eval("img"+theimg+"Status")==null)
  {
  eval("document."+imgName+".src=\"images/question_list_on.gif\";");
  eval("this.img"+theimg+"Status=\"on\";");
  eval("top.formpost.document.myform."+imgName+".checked=true");
  //eval("document.topics.topic_"+theimg+"_text.select();");
  }
  else
  {
  eval("document."+imgName+".src=\"images/question_list_off.gif\";");
  eval("this.img"+theimg+"Status=\"off\";");
  eval("top.formpost.document.myform."+imgName+".checked=false");
  //eval("document.topics.topic_"+theimg+"_text.blur();");
  }
  return eval("this.img"+theimg+"Status");
}

function setText(tName)
{
 //eval("top.formpost.document.myform."+tName+".value=document.topics."+tName+".value"); 
}
</SCRIPT>	


<body bgcolor="#FFFFFF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" ALIGN="CENTER"><TR><TD BGCOLOR="#93BEE2">
<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="2" WIDTH="100%" ALIGN="CENTER">
<FORM NAME="topics">
  <TR>
    <TD COLSPAN="2"><SPAN CLASS="listtext">Import Topics into the Lesson:<BR><IMG SRC="images/spcr.gif" WIDTH="333" HEIGHT="1"><HR COLOR="#336699"></TD>
  </TR>
  <TR>
    <TD><SPAN CLASS="listtext"><B>Question ID</TD>
    <TD><SPAN CLASS="listtext"><B>Question Type</TD>
   <!-- <TD><SPAN CLASS="listtext"><B>Modified</TD>-->
  </TR>
<?php
$db = new db;
$db->connect();
$db->query("SELECT qname,question_type,ID FROM questions");
$xm=0;
while($db->getRows())
{ 
$ID=$db->row("ID");
?>
  <TR>
    <TD BGCOLOR="#FFFFFF"><SPAN CLASS="listtext"><A HREF="#" onClick="imgOn(<?php echo $ID;?>,'topic_<?php echo $ID;?>');setText('topic_<?php echo $ID;?>_text');return false;"><IMG SRC="images/question_list_off.gif" NAME="topic_<?php echo $ID;?>" BORDER="0" ALIGN="absmiddle"></A> <!--<INPUT TYPE="TEXT" ID=p<?echo$ID;?> NAME="topic_<?echo$ID;?>_text" VALUE="" onBlur="setText('topic_<?echo$ID;?>_text');" CLASS="input2">--><?php echo $db->row("qname");?></TD>
    <TD BGCOLOR="#FFFFFF"><SPAN CLASS="listtext"><?php echo $db->row("question_type");?></TD>
    <!--<TD BGCOLOR="#FFFFFF"><SPAN CLASS="listtext"><?php echo $db->row("modified");?></TD>-->
  </TR>
<SCRIPT>var img<?php echo $ID;?>Status;</SCRIPT> 
<?php
}
?>
</FORM>  
</TABLE>
</TD></TR></TABLE>


</body>
<?php
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


<?php
}
?>
</html>
