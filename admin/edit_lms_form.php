<?php
require_once("../conf.php");
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
<?include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	
</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">

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
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">LMS Registration From Properties:</SPAN>


<FORM METHOD="POST" ACTION="update_objects_sql.php?action=field&formAction=store" target="edit_post">
  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8">
    <TR>
      <TD COLSPAN="4">
	<?php input_list("field",1,"reg_form WHERE stored='n'||ID|field_name",0,"CLASS=INPUT");?>  
	<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" +Add Field+ " CLASS="submit"><HR>
      </TD>
  </TR>
</FORM>

<?php
$db = new db;
$db->connect();
$db->query("SELECT * FROM reg_form WHERE stored = 'y' ORDER BY forder ASC");
$nx=0;
while($db->getRows())
{ 
$nx++;
}


$db = new db;
$db->connect();
$db->query("SELECT * FROM reg_form WHERE stored = 'y' ORDER BY forder ASC");
$ox=1;
while($db->getRows())
{ 
$fID=$db->row("ID");
$field_name = $db->row("field_name");
$forder = $db->row("forder");
$status = $db->row("status");
$display = $db->row("display");
?>
    <FORM NAME="thisField_<?php echo $ox;?>" METHOD="POST" ACTION="update_objects_sql.php?action=field" target="edit_post">
    <TR>
      <?php if($field_name=="username" && $lms_username_link!="username"){?>	
      <INPUT TYPE="HIDDEN" NAME="formAction">
      <INPUT TYPE="HIDDEN" NAME="fID" VALUE="<?php echo $fID;?>">
      <TD><SPAN CLASS="ttl"><?php echo $field_name;?></SPAN></TD>
      <TD><INPUT TYPE-"TEXT" NAME="display" VALUE="::linked to <?php echo "$lms_username_link Field!";?>::" CLASS="input" DISABLED></TD>
      <TD><INPUT TYPE="HIDDEN" NAME="status" VALUE="off"></TD>
      <TD><INPUT TYPE="HIDDEN" NAME="forder" VALUE="0"></TD>
      <TD><A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='SAVE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/save.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> &nbsp;&nbsp;<A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='DELETE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>
      <?php }else{ ?>
      <INPUT TYPE="HIDDEN" NAME="formAction">
      <INPUT TYPE="HIDDEN" NAME="fID" VALUE="<?php echo $fID;?>">
      <TD><SPAN CLASS="ttl"><?php echo $field_name;?></SPAN></TD>
      <TD><INPUT TYPE-"TEXT" NAME="display" VALUE="<?php echo $display;?>" CLASS="input"></TD>
      <TD><?php input_list("status","on,off",0,$status,"CLASS=input");?></TD>
      <TD><?php input_list("forder","autonum,+,0,$nx",0,$forder,"CLASS=input");?></TD>
      <TD><A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='SAVE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/save.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> &nbsp;&nbsp;<A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='DELETE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>
      <?php }?>
      
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