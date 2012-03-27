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


<FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=lms_properties" target="edit_post">
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="formAction">


	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">LMS Properties:</SPAN>



  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8">
    <TR>
      <TD><SPAN CLASS="ttl">Groups:</SPAN></TD>
      <TD><?php input_list("rlms_groups","on,off",0,$lms_groups,"CLASS=input");?></TD>
      <TD></TD>
      <TD></TD>
    </TR>
   <TR>
      <TD><SPAN CLASS="ttl">Group Display:</SPAN></TD>
      <TD><INPUT TYPE="TEXT" NAME="rlms_gtitle" VALUE="<?php echo $lms_gtitle;?>" CLASS="input" SIZE="5"></TD>
      <TD></TD>
      <TD></TD>
    </TR>
   <TR>
      <TD><SPAN CLASS="ttl">subGroup Display:</SPAN></TD>
      <TD><INPUT TYPE="TEXT" NAME="rlms_sgtitle" VALUE="<?php echo $lms_sgtitle;?>" CLASS="input" SIZE="5"></TD>
      <TD></TD>
      <TD></TD>
    </TR>	
   <TR>
     <TD COLSPAN="4"><HR></TD>
    </TR>		
    <TR>
      <TD><SPAN CLASS="ttl">Default UserLevel:</SPAN></TD>
      <TD><INPUT TYPE="TEXT" NAME="rlms_default_userlevel" VALUE="<?php echo $lms_default_userlevel;?>" CLASS="input" SIZE="3"></TD>
      <TD></TD>
      <TD></TD>
    </TR>
    <TR>
      <TD><SPAN CLASS="ttl">OrgID Qualifier:</SPAN></TD>
      <TD><?php input_list("rlms_orgID","on,off",0,$lms_orgID,"CLASS=input"); ?></TD>
      <TD></TD>
      <TD></TD>
    </TR>
    <TR>
      <TD><SPAN CLASS="ttl">Link Username Field to:</SPAN></TD>
      <TD><?php input_list("rlms_username_link",0,"reg_form WHERE stored='y'||field_name",$lms_username_link,"CLASS=INPUT");?> </TD>
      <TD></TD>
      <TD></TD>
    </TR>
    <TR>
      <TD><SPAN CLASS="ttl">Enforce Unique Usernames:</SPAN></TD>
      <TD><?php input_list("rlms_unique","on,off",0,$lms_unique,"CLASS=input");?></TD>
      <TD></TD>
      <TD></TD>
    </TR>
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