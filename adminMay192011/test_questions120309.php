<?php
require_once("../conf.php");



$db = new db;
$db->connect();
$db->query("SELECT name,ID FROM tests WHERE ID='$ID'");
$x=0;
while($db->getRows())
{
$rtest_name = $db->row("name");
$rtest_ID = $db->row("ID");
}

$db = new db;
$db->connect();
$db->query("SELECT test_ID,question_ID,ID FROM tests_r WHERE test_ID='$ID'");
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
//eval("document.all.J"+rowNum+".style.background=\"#93BEE2\";");
//eval("document.all.J"+rowNum+".style.border=\"#93BEE2\";");
}

function resetBKG(rowNum)
{
eval("document.all.M"+rowNum+".style.background=\"#EFF7FF\";");
//eval("document.all.J"+rowNum+".style.background=\"#EFF7FF\";");
}

function opentAdd()
{
var tAdd = window.open("question_tadd.php?lesson_ID=<?php echo $ID;?>","none","width=350,height=450");
}

function mReload()
{
document.location.href="test_questions.php?ID=<?php echo $ID;?>&lname=<?php echo $rtest_name;?>&ID=<?php echo $ID;?>";
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
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Test Questions:</SPAN><BR><BR>

<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 150" Height = "22" MAYSCRIPT>   
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
		  {Import Test Questions,javascript:1,_self,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=test3" TARGET="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">	
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="2" WIDTH="90%" ALIGN="CENTER">
	  <TR>
	     <TD><SPAN CLASS="hdr">Question ID</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Question Type</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Order</SPAN></TD>
	     <!--<TD ALIGN="CENTER"><SPAN CLASS="hdr">Created</SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Modified</SPAN></TD>-->
	     <TD ALIGN="CENTER"><SPAN CLASS="hdr">Remove</SPAN></TD>
	  </TR>	
<?php
$db = new db;
$db->connect();
//$db->query("SELECT lesson_name,lesson_ID,topic_name,topic_ID,topic_order,ID FROM lessons_r WHERE lesson_ID='$ID' ORDER BY topic_order ASC");
$db->query("SELECT questions.qname,questions.question_type,tests_r.question_ID,tests_r.ID,tests_r.question_order FROM tests_r,questions WHERE tests_r.test_ID='$ID' AND questions.ID=tests_r.question_ID ORDER BY tests_r.question_order ASC");
while($db->getRows())
{
$qname = $db->row("qname");
$question_order = $db->row("question_order");
$question_type = $db->row("question_type");
$lesson_ID = $db->row("lesson_ID");
$topic_ID = $db->row("question_ID"); 
$rID = $db->row("ID");

?>
	  <TR CLASS=rows ID="M<?php echo $rID;?>">
	     <TD><SPAN CLASS="ttl"><IMG SRC="images/question.gif" BORDER="0" ALIGN="ABSMIDDLE"> <?php echo $qname;?><!--<INPUT TYPE="TEXT" NAME="topic_name[]" LENGTH="30" VALUE="<?php echo $topic_name;?>" CLASS="input_sp" ID="J<?php echo $rID;?>">--></SPAN></TD>
	     <TD ALIGN="CENTER"><SPAN CLASS="ttl2">[<?php echo $question_type;?>]</SPAN></TD>
	     <TD ALIGN="CENTER"><?input_list("topic_order[]","autonum,+,0,$x",0,$question_order,"CLASS=input_sp")?></TD>
	    <!-- <TD><SPAN CLASS="ttl2"><?php echo $created;?></SPAN></TD>
	     <TD><SPAN CLASS="ttl2"><?php echo $modified;?></SPAN></TD>-->
             <TD ALIGN="CENTER">
			 <A HREF="update_objects_sql.php?action=test3&formAction=REMOVE&rmvID=<?php echo $rID;?>" TARGET="edit_post" onMouseover="setBKG('<?php echo $rID;?>');" onMouseout="resetBKG('<?php echo $rID;?>');">
			 <IMG SRC="images/delete.gif" BORDER="0"></TD>
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