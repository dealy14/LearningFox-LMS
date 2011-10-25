<?php
require_once("../conf.php");

$ID = $_REQUEST[ 'ID' ];
$sel_item = $_REQUEST["sel_item"];

$group_name =  $_REQUEST["group_name"];

$db = new db;
$db->connect();
$db->query("SELECT name,sname,ID FROM groups WHERE ID='$ID'");
$xm=0;
while($db->getRows())
{ 
$rID=$db->row("ID");
$name = $db->row("name");
$sname = $db->row("sname");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
//top.top1.lessonItemSelect=1;
</SCRIPT>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=group1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $rID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Group Properties:</SPAN>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR>
	    <TD><SPAN CLASS=ttl>Group Name:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input" VALUE="<?php echo $name;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Group Code:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="sname" CLASS="input" VALUE="<?php echo $sname;?>"></TD>		
	  </TR>  	  	
	  <!--<TR BGCOLOR="#EFF7FF" >
	    <TD COLSPAN="2" ALIGN="RIGHT"><INPUT TYPE="SUBMIT" NAME="CANCEL" VALUE="Cancel"   CLASS="submit"> <INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" Finish "  CLASS="submit"></TD>
	  </TR>-->			  
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