<?php
require_once("../conf.php");

$ID       = $_REQUEST["ID"];
$sel_item = $_REQUEST["sel_item"];



$db = new db;
$db->connect();
$db->query("SELECT * FROM tests WHERE ID='$ID'");
$xm=0;
while($db->getRows())
{ 
$rID=$db->row("ID");
$name = $db->row("name");
$type = $db->row("type");
$randomize = $db->row("randomize");
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

<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=test1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Survey Properties:</SPAN>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR>
	    <TD><SPAN CLASS=ttl>Survey Name:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="name" CLASS="input" VALUE="<?php echo $name;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Survey Type:</SPAN></TD>
		<?php
		/*
		if($type=="MC")
		{
		$type="MC||Multiple Choice";
		}
		else
		{
		$type="TF||True/False";		
		}
		*/
		?>
	    <TD><?php input_list("type",$type,0,0,"CLASS=input");?></TD>		
	  </TR>  	  	
	  <?php
	  /*<TR>
	    <TD><SPAN CLASS=ttl>Randomize:</SPAN></TD>
	    <TD>
		 input_list("randomize","Y,N",0,$randomize,"CLASS=input")
		</TD>		
	  </TR>
	  */
	  ?><input type="hidden" name="randomize" value="N">  
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