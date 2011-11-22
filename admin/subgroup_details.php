<?php
require_once("../conf.php");

$sel_item = $_REQUEST["sel_item"];
$gID       = $_REQUEST["gID"];
$psname   = $_REQUEST["psname"];

$ID = $gID ;

$db = new db;
$db->connect();
$db->query("SELECT name FROM groups WHERE ID='$gID'");
while($db->getRows())
{ 
$gname = $db->row("name");
}
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
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	
	
<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=group1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $gID;?>">
</FORM>

	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Sub-Group Properties: <?php echo $gname;?></SPAN>

<FORM METHOD="POST" ACTION="update_objects_sql.php?action=field&formAction=store" target="edit_post">
  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="4">
    <TR>
      <TD><SPAN CLASS="hdr">Sub-Group Name</SPAN></TD>
      <TD><SPAN CLASS="hdr">Code</SPAN></TD>
      <?php
		/*
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
		  {Add Sub-Groups,create_objects_sql.php?action=subgroup&group_ID=<?php echo $gID;?>,edit_post,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>	
		*/
		?>
		<TD><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="1%">
  <TR><TD VALIGN="MIDDLE" nowrap="nowrap" width="1%"><a href="create_objects_sql.php?action=subgroup&group_ID=<?php echo $gID;?>" target="edit_post" class="thebutton"><img border="0" src="images/import.gif" alt="Edit This Group"> Add Sub-Groups</a> 
</TD>
</TR></TABLE></TD>
    </TR>	 
<FORM name="R_0">
</FORM>
<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM subgroups WHERE group_ID='$gID'");
$ox=1;
while($db->getRows())
{ 
$ID=$db->row("ID");
$sub_name = $db->row("sub_name");
$sub_sname = $db->row("sub_sname");

?>
    <FORM NAME="R_<?php echo $ox;?>" METHOD="POST" ACTION="update_objects_sql.php?action=subgroup" target="edit_post">
    <TR>
      <INPUT TYPE="HIDDEN" NAME="formAction">
      <INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">
      <INPUT TYPE="HIDDEN" NAME="group_ID" VALUE="<?php echo $gID;?>">	  
      <TD><SPAN CLASS="ttl"><INPUT TYPE="TEXT" NAME="sub_name" VALUE="<?php echo $sub_name;?>" CLASS="input"></SPAN></TD>
      <TD><SPAN CLASS="ttl"><INPUT TYPE="TEXT" NAME="sub_sname" VALUE="<?php echo $sub_sname;?>" CLASS="input" SIZE="10"></SPAN></TD>
      <TD><A HREF="#" onClick="document.R_<?php echo $ox;?>.formAction.value='SAVE';document.R_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/save.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> &nbsp;&nbsp;<A HREF="#" onClick="document.R_<?php echo $ox;?>.formAction.value='DELETE';document.R_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>
    </TR>
    </FORM>
<?php

$ox++;
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