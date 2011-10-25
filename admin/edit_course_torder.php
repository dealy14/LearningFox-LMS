<?php
require_once("../conf.php");



$db = new db;
$db->connect();
$db->query("SELECT name,ID FROM course WHERE ID='$ID'");
$x=0;
while($db->getRows())
{
$rcourse_name = $db->row("name");
$rcourse_ID = $db->row("ID");
}

$db = new db;
$db->connect();
$db->query("SELECT course_name,course_ID,lesson_name,lesson_ID,ID FROM courses_r WHERE course_ID='$ID'");
$x=0;
while($db->getRows())
{
$x++;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>


<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
.input_sp {FONT-FAMILY:VERDANA;FONT-SIZE:10;BORDER-TOP:#EFF7FF 1px solid;BORDER-RIGHT:#EFF7FF 1px solid;BORDER-LEFT:#EFF7FF 1px solid;BORDER-BOTTOM:#EFF7FF 1px solid;BACKGROUND:#EFF7FF}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:10;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#EFF7FF}
.rows {BACKGROUND:#EFF7FF;}
</STYLE>

<SCRIPT>
top.top1.courseItemSelect=3;

function setBKG(rowNum)
{
eval("document.all.M"+rowNum+".style.background=\"#93BEE2\";");
eval("document.all.J"+rowNum+".style.background=\"#93BEE2\";");
eval("document.all.J"+rowNum+".style.border=\"#93BEE2\";");
}

function resetBKG(rowNum)
{
eval("document.all.M"+rowNum+".style.background=\"#EFF7FF\";");
eval("document.all.J"+rowNum+".style.background=\"#EFF7FF\";");
}

function opentAdd()
{
var tAdd = window.open("edit_course_tadd.php?course_ID=<?php echo $rcourse_ID;?>&lname=<?php echo $rcourse_name;?>","none","width=350,height=450");
}

function mReload()
{
document.location.href="edit_course_torder.php?course_ID=<?php echo $rcourse_ID;?>&lname=<?php echo $rcourse_name;?>&ID=<?php echo $ID;?>";
}
</SCRIPT>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	

	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Lesson Order:</SPAN><BR><BR>

<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 100" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {Import Lessons,javascript:1,_self,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=course3" TARGET="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="2" WIDTH="90%" ALIGN="CENTER">
	  <TR>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Name</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Order</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Created</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Modified</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Remove</SPAN></TD>
	  </TR>	
<?php
$db = new db;
$db->connect();
//$db->query("SELECT lesson_name,lesson_ID,topic_name,topic_ID,topic_order,ID FROM lessons_r WHERE lesson_ID='$ID' ORDER BY topic_order ASC");
$db->query("SELECT courses_r.course_name,courses_r.course_ID,courses_r.lesson_name,courses_r.lesson_ID,courses_r.lesson_order,courses_r.ID,lesson.modified,lesson.created FROM courses_r,lesson WHERE courses_r.course_ID='$ID' AND lesson.ID=courses_r.lesson_ID ORDER BY courses_r.lesson_order ASC");
while($db->getRows())
{
$lesson_name = $db->row("course_name");
$topic_order = $db->row("lesson_order");
$lesson_ID = $db->row("course_ID");
$topic_name = $db->row("lesson_name");
$topic_ID = $db->row("lesson_ID");
$created = $db->row("created");
$modified = $db->row("modified");
$rID = $db->row("ID");

?>
	  <TR CLASS=rows ID=M<?php echo $rID;?>>
	     <TD><IMG SRC="images/lesson_list_off.gif" BORDER="0" ALIGN="ABSMIDDLE"> <INPUT TYPE="TEXT" NAME="topic_name[]" LENGTH="30" VALUE="<?php echo $topic_name;?>" CLASS="input_sp" ID="J<?php echo $rID;?>"></TD>
	     <TD><?php input_list("topic_order[]","autonum,+,0,$x",0,$topic_order,"CLASS=input_sp")?></TD>
	     <TD><SPAN CLASS="ttl"><?php echo $created;?></SPAN></TD>
	     <TD><SPAN CLASS="ttl"><?php echo $modified;?></SPAN></TD>
             <TD ALIGN="CENTER"><A HREF="update_objects_sql.php?action=course2&formAction=DELETE&ID=<?php echo $rID;?>&cid=<?php echo $rcourse_ID;?>" TARGET="edit_post" onMouseover="setBKG('<?php echo $rID;?>');" onMouseout="resetBKG('<?php echo $rID;?>');"><IMG SRC="images/delete.gif" BORDER="0"></TD>
	  </TR>		
		<INPUT TYPE="HIDDEN" NAME="ID[]" VALUE="<?php echo $rID;?>">
		<INPUT TYPE="HIDDEN" NAME="lesson_ID" VALUE="<?php echo $topic_ID;?>">	
		<INPUT TYPE="HIDDEN" NAME="cname" VALUE="<?php echo $rcourse_name;?>">	
		<INPUT TYPE="HIDDEN" NAME="cid" VALUE="<?php echo $rcourse_ID;?>">	
<?php
}
?>  
	</TABLE>
	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>

</FORM>
</BODY>