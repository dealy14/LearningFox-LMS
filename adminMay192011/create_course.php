<?php
require_once("../conf.php");
if($type=="")
{
$type="wbt";
}
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
<style type="text/css">

span.class1{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
color:#990033;

font-weight:900;

}
</style>
	<title>Untitled</title>	
</head>
<?php
	/*
	if(!$frame||$frame=="")
	{
	*/

?>
<SCRIPT>
//setInterval("window.focus();",3600);
window.resizeTo(500,200);


</SCRIPT>

<!--
<FRAMESET ROWS="30,*" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0" COLS="*"> 
<FRAME NAME="formpost" SCROLLING="NO" noresize SRC="create_course.php?frame=top" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
<FRAME NAME="data" noresize SRC="create_course.php?frame=bottom&subaction=<?php echo $subaction;?>" FRAMEBORDER="NO" BORDER="0" FRAMESPACING="0">
</FRAMESET>
<NOFRAMES><BODY BGCOLOR="#FFFFFF"  TOPMARGIN="0" LEFTMARGIN="0" MARGINHEIGHT="0" MARGINWIDTH="0"></NOFRAMES>
-->
<?php
	/*
	}
	else if($frame=="top")
	{
	*/
?>
<!--
<body BGCOLOR="#EFF7FF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IMG SRC="images/course2.gif" ALIGN="absmiddle"> <SPAN class="class1">Create a Course:</SPAN>
<FORM NAME="myform" METHOD="POST" ACTION="create_objects_sql.php?action=topic" TARGET="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="name">
<INPUT TYPE="HIDDEN" NAME="type" VALUE="<?php echo $type;?>">
</FORM>
</body>
-->
<?php
	/*
	}
	else if ($frame=="bottom")
	{
	*/
?>
<SCRIPT>
function setTextData(elName)
{
eval("top.formpost.document.myform."+elName+".value=document.thisform."+elName+".value;");
}
</SCRIPT>


<body BGCOLOR="#EFF7FF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

<FORM NAME="thisform" METHOD="POST" ACTION="nonscorm_db_entry.php" target="_top">
<INPUT TYPE="HIDDEN" NAME="created" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="subaction" VALUE="<?php echo $subaction;?>">
<INPUT TYPE="HIDDEN" NAME="type" VALUE="<?php echo $_GET['ctype'];?>">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4" ALIGN="CENTER"> 
	  <TR>
	    <TD ALIGN="RIGHT"><SPAN CLASS=ttl><?php echo $_GET['ctype'];?>Course Title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" ></TD>		
	  </TR> 	
	       <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel"  onClick="top.window.close();"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  ></TD>
	  </TR>				  
	</TABLE>

</FORM>

</body>

<?php
 //}
?>

</html>
