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
<?php include("admin_css.php");?>
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


<FORM METHOD="POST" ACTION="update_objects_sql.php?action=addForum&formAction=SAVE" target="edit_post">
  <TABLE BORDER="0" CELLSPACING="0" CELLPADDING="8">
    <TR>
      <TD COLSPAN="4">
	<?php input_list("org_ID",1,"orgs||org_ID|name",0,"CLASS=INPUT");?>  
	<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE=" +Add A Forum For this Org+ " CLASS="submit"><HR>
      </TD>
  </TR>
</FORM>

<?php
/*
$db = new db;
$db->connect();
$db->query("SELECT * FROM reg_form WHERE stored = 'y' ORDER BY forder ASC");
$nx=0;
while($db->getRows())
{ 
$nx++;
}
*/

$db = new db;
$db->connect();
$db->query("SELECT forums.*,orgs.name as orgname FROM forums,orgs WHERE forums.orgID=orgs.org_ID");
$ox=1;
while($db->getRows())
{ 
$fID=$db->row("ID");
?>
    <FORM NAME="thisField_<?echo$ox;?>" METHOD="POST" ACTION="update_objects_sql.php?action=forums" target="edit_post">
    <TR>
      <INPUT TYPE="HIDDEN" NAME="formAction">
      <INPUT TYPE="HIDDEN" NAME="fID" VALUE="<?php echo $fID;?>">
      <TD><SPAN CLASS="ttl"><?php echo $db->row("orgname");?></SPAN></TD>
      <TD><INPUT TYPE-"TEXT" NAME="maxposts" VALUE="<?php echo $db->row("maxposts");?>" CLASS="input" SIZE="7"></TD>
	  <TD><SPAN CLASS="ttl"><A HREF="edit_lms_forum_topics.php?forum_name=<?php echo urlencode($db->row("orgname"));?>&org_ID=<?php $db->row("orgID")?>&forumID=<?php $fID;?>">View/Create Topics</A></SPAN></TD>
      <TD><A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='SAVE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/save.gif" BORDER="0" ALIGN="ABSMIDDLE"></A> &nbsp;&nbsp;<A HREF="#" onClick="document.thisField_<?php echo $ox;?>.formAction.value='DELETE';document.thisField_<?php echo $ox;?>.submit();return false;"><IMG SRC="images/delete.gif" BORDER="0" ALIGN="ABSMIDDLE"></A></TD>
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