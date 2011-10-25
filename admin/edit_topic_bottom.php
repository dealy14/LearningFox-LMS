<?php
require_once("../conf.php");

$db = new db;
$db->connect();
$db->query("SELECT * FROM topic WHERE ID=$ID");
$xm=0;
while($db->getRows())
{ 
$rID=$db->row("ID");
$created = $db->row("created");
$modified = $db->row("modified");
$name = $db->row("name");
$time_req = $db->row("time_req");
$topic_type = $db->row("topic_type");
$content_location = $db->row("content_location");
$content_link = $db->row("content_link");
$content = $db->row("content");
$time_req = $db->row("time_req");
$time_limit = $db->row("time_limit");
$test_link = $db->row("test_link");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<SCRIPT>
top.top1.topicItemSelect=1;
</SCRIPT>
<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;FONT-SIZE:12;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#FFFFFF}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#EFF7FF}
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=topic1" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo$rID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Topic Properties:</SPAN>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">
	  <TR>
	    <TD><SPAN CLASS=ttl>Topic Title:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="topic_name" CLASS="input" VALUE="<?php echo $name;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Topic Type:</SPAN></TD>
	    <TD><?php input_list("topic_type",$dir_includes."topic_types.txt",0,$topic_type,"CLASS=input"); ?></TD>			
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Content Location:</SPAN></TD>
	    <TD><?php input_list("content_location","local,remote",0,$content_location,"CLASS=input");?></TD>
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Remote Content Link:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="content_link" CLASS=input VALUE="<?php echo $content_link;?>"></TD>
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Local Test/Survey Link:</SPAN></TD>
	    <TD>
		<SELECT NAME="test_link">
		<OPTION VALUE="na"></OPTION>
		<?php
		$db = new db;
		$db->connect();
		$db->query("SELECT ID,name FROM tests ORDER BY name ASC");
		$xm=0;
		while($db->getRows())
		{ 
		$rID=$db->row("ID");
		$tname=$db->row("name");		
        ?>
		<OPTION VALUE="<?php echo $rID;?>" <?php if($rID==$test_link){echo "SELECTED";}?>><?php echo $tname;?></OPTION>
		<?php
		}		
		?>
		</SELECT>
		</TD>
	  </TR>	  
	  <TR>
	    <TD><SPAN CLASS=ttl>Time Limit:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="time_limit" CLASS=input VALUE="<?php echo $time_limit;?>"></TD>		
	  </TR>
	  <TR>
	    <TD><SPAN CLASS=ttl>Time Requirement:</SPAN></TD>
	    <TD><INPUT TYPE="TEXT" NAME="time_req" CLASS=input VALUE="<?php echo $time_req;?>"></TD>		
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