<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
top.top1.lessonItemSelect=3;
</SCRIPT>

<STYLE TYPE="text/css">
.input {FONT-FAMILY:VERDANA;FONT-SIZE:12;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#FFFFFF}
.ttl {FONT-FAMILY:VERDANA;FONT-SIZE:10;COLOR:#000000;}
.hdr {FONT-FAMILY:VERDANA;FONT-SIZE:12;COLOR:#000000;FONT-WEIGHT:BOLD;}
.submit {FONT-FAMILY:VERDANA;SIZE:11;BORDER-TOP:#336699 1px solid;BORDER-RIGHT:#336699 1px solid;BORDER-LEFT:#336699 1px solid;BORDER-BOTTOM:#336699 1px solid;BACKGROUND:#EFF7FF}
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">


<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=topic3" target="edit_post">
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
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Object Linkage:</SPAN>
<!----ADD TABLE HERE------------------------>
<P><BR>

  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0">

   <TR>
      <TD COLSPAN="2" ALIGN="RIGHT" BGCOLOR="#000000"><IMG SRC="images/blue_spcr.gif" WIDTH="20" HEIGHT="1"></TD>
      <TD></TD>			
   </TR>	
    <TR>
      <TD>
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="4">

<?php

$db = new db;
$db->connect();
$db->query("SELECT courses_r.course_name,courses_r.lesson_name,lesson.name FROM courses_r,lesson WHERE lesson.ID='$ID' AND courses_r.lesson_ID='$ID' ORDER BY courses_r.course_ID");
while($db->getRows())
{ 
$cname = $db->row("course_name");
$lname = $db->row("lesson_name");
$name =  $db->row("name");
?>
	  <TR>
	    <TD NOWRAP><SPAN CLASS="ttl">&nbsp;</SPAN></TD>		
	    <TD NOWRAP><SPAN CLASS="ttl"><IMG SRC="images/course_list_off.gif" ALIGN="ABSMIDDLE"> <?php echo"$cname ->";?></SPAN></TD>	
	    <TD NOWRAP><SPAN CLASS="ttl"><IMG SRC="images/lesson_list_off.gif" ALIGN="ABSMIDDLE"> <?php echo"$lname";?></SPAN></TD>	
	  </TR>		
<?php
}
?> 		  			  
	</TABLE>
      </TD>
      <TD BGCOLOR="#000000"><IMG SRC="images/spcr.gif" WIDTH="1" HEIGHT="5"></TD>
      <TD>__________<U><SPAN CLASS="hdr"><?php echo $name;?></SPAN></TD>
    </TR>
    <TR>
      <TD COLSPAN="2" ALIGN="RIGHT" BGCOLOR="#000000"><IMG SRC="images/blue_spcr.gif" WIDTH="20" HEIGHT="1"></TD>
      <TD></TD>			
    </TR>	
    </TR>
  </TABLE>

<!----ADD TABLE HERE------------------------>
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