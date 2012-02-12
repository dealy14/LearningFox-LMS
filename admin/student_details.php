<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
top.top1.topicItemSelect=3;
</SCRIPT>

<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">


<FORM NAME="editForm" METHOD="POST" ACTION="update_students_sql.php?action=student_details" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="formAction">

	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Student Details:</SPAN>

  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="6">
	<?php
    $ID = $_GET['ID'];
	$db = new db;
	$db->connect();
	$db->query("SELECT * FROM students WHERE ID=$ID");
	$nx=0;
	while($db->getRows())
	{ 
	$date_of_reg = $db->row("date_of_reg");
	$date_of_mod = $db->row("date_of_mod");
	$date_of_hire = $db->row("date_of_hire");
	$fname = $db->row("fname");
	$lname = $db->row("lname");
	$mname = $db->row("mname");
	$org_ID = $db->row("org_ID");
	$user_group = $db->row("user_group");
	$user_subgroup = $db->row("user_subgroup");
	$date_of_birth = $db->row("date_of_birth");
	$sex = $db->row("sex");
	$phone = $db->row("phone");
	$email = $db->row("email");
	$address = $db->row("address");
	$city = $db->row("city");
	$state = $db->row("state");
	$zip = $db->row("zip");
	$username = $db->row("username");
	$password = $db->row("password");
	$userlevel = $db->row("userlevel");
	$provider_number = $db->row('provider_number');
	$ID = $db->row("ID");	
	}
?>
	<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $ID;?>">
<?php
	$db = new db;
	$db->connect();
	 $db->query("SELECT * FROM reg_form WHERE stored = 'y' AND forder>=1 AND status='on' ORDER BY forder ASC");
	 
	$nx=0;
	
	while($db->getRows())
	{ 
	$nvalue = $db->row("field_name");
	
	?>
	<TR>
	  <TD><SPAN CLASS="ttl"><?php echo $db->row("display");?></SPAN></TD>
	  <TD><?php makeFieldEdit($db->row("field_name"),$$nvalue);?></TD>
	</TR>
	<?php
	$nx++;
	
	}
	?>
	<TR>
	  <TD><SPAN CLASS="ttl">User Level</SPAN></TD>
	  <TD><?php input_list("userlevel","0,1,2,3,4",0,$userlevel,"CLASS=input");?></TD>
	</TR>
	<TR>
	  <TD><SPAN CLASS="ttl">User ID</SPAN></TD>
	  <TD><INPUT TYPE="TEXT" NAME="id" VALUE="<?php echo $ID;?>" READONLY="READONLY"></td>
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