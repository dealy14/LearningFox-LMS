<?php
require_once("../conf.php");



$db = new db;
$db->connect();
$db->query("SELECT name,ID FROM lesson WHERE ID='$ID'");
$x=0;
while($db->getRows())
{
$rlesson_name = $db->row("name");
$rlesson_ID = $db->row("ID");
}

$db = new db;
$db->connect();
$db->query("SELECT lesson_name,lesson_ID,topic_name,topic_ID,ID FROM lessons_r WHERE lesson_ID='$ID'");
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
.ttl2 {FONT-FAMILY:VERDANA;FONT-SIZE:10;}
.input_sp {FONT-FAMILY:VERDANA;FONT-SIZE:10;BORDER-TOP:#EFF7FF 1px solid;BORDER-RIGHT:#EFF7FF 1px solid;BORDER-LEFT:#EFF7FF 1px solid;BORDER-BOTTOM:#EFF7FF 1px solid;BACKGROUND:#EFF7FF}
<?php include("admin_css.php");?>
.rows {BACKGROUND:#EFF7FF;}
</STYLE>

<SCRIPT>
top.top1.lessonItemSelect=2;

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
var tAdd = window.open("edit_lesson_tadd.php?lesson_ID=<?php echo $rlesson_ID;?>&lname=<?php echo $rlesson_name;?>","none","width=350,height=450");
}

function mReload()
{
document.location.href="edit_lesson_torder.php?lesson_ID=<?php echo $rlesson_ID;?>&lname=<?php echo $rlesson_name;?>&ID=<?php echo s$ID;?>";
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
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Topic Order:</SPAN><BR><BR>

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
		  {Import Topics,javascript:1,_self,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=lesson3" TARGET="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">	
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="2" WIDTH="90%" ALIGN="CENTER">
	  <TR>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Name</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Object ID &nbsp;</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Order</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Created</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Modified</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Remove</SPAN></TD>
	  </TR>	
<?php
$db = new db;
$db->connect();
//$db->query("SELECT lesson_name,lesson_ID,topic_name,topic_ID,topic_order,ID FROM lessons_r WHERE lesson_ID='$ID' ORDER BY topic_order ASC");
$db->query("SELECT lessons_r.lesson_name,lessons_r.lesson_ID,lessons_r.topic_name,lessons_r.topic_ID,lessons_r.topic_order,lessons_r.ID,topic.modified,topic.created,topic.name FROM lessons_r,topic WHERE lessons_r.lesson_ID='$ID' AND topic.ID=lessons_r.topic_ID ORDER BY lessons_r.topic_order ASC");
while($db->getRows())
{
$lesson_name = $db->row("lesson_name");
$topic_order = $db->row("topic_order");
$name = $db->row("name");
$lesson_ID = $db->row("lesson_ID");
$topic_name = $db->row("topic_name");
$topic_ID = $db->row("topic_ID");
$created = $db->row("created");
$modified = $db->row("modified");
$rID = $db->row("ID");

?>
	  <TR CLASS=rows ID="M<?php echo $rID;?>">
	     <TD><SPAN CLASS="ttl"><IMG SRC="images/topic_list_off.gif" BORDER="0" ALIGN="ABSMIDDLE"> <INPUT TYPE="TEXT" NAME="topic_name[]" LENGTH="30" VALUE="<?php echo $topic_name;?>" CLASS="input_sp" ID="J<?php echo $rID;?>"></SPAN></TD>
	     <TD><SPAN CLASS="ttl2">[<?php echo $name; ?>]</SPAN></TD>
	     <TD><?php input_list("topic_order[]","autonum,+,0,$x",0,$topic_order,"CLASS=input_sp"); ?></TD>
	     <TD><SPAN CLASS="ttl2"><?php echo $created;?></SPAN></TD>
	     <TD><SPAN CLASS="ttl2"><?php echo $modified;?></SPAN></TD>
           <TD ALIGN="CENTER">
		   <A HREF="update_objects_sql.php?action=lesson2&formAction=DELETE&ID=<?php echo $rID;?>" TARGET="edit_post" onMouseover="setBKG('<?php echo $rID;?>');" onMouseout="resetBKG('<?php echo $rID;?>');">
		   <IMG SRC="images/delete.gif" BORDER="0">
		   </TD>
	  </TR>		
		<INPUT TYPE="HIDDEN" NAME="gID[]" VALUE="<?php echo $rID;?>">
		<INPUT TYPE="HIDDEN" NAME="topic_ID" VALUE="<?php echo $topic_ID;?>">	
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