<?php
require_once("../conf.php");

$ID = $_REQUEST[ 'ID' ];
$group_name = $_REQUEST["group_name"];


if($_REQUEST[ 'ID' ])
{
$gID=$_REQUEST[ 'ID' ];
}

$db = new db;
$db->connect();
$db->query("SELECT * FROM subgroups WHERE group_ID='$gID'");
$xm=0;
while($db->getRows())
{ 
//$rID=$db->row("ID");
$nsub_ID = $db->row("ID");
$sub_ID[] = $db->row("ID");
$sub_name[] = $db->row("sub_name");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<SCRIPT>
//top.top1.lessonItemSelect=1;
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">

function Check(check_array, check_all)
{
    if(check_all.value=="Check All")
	{
	    if(check_array.length > 0)
		{
            for (i = 0; i < check_array.length; i++)
		    {		    
                check_array[i].checked = true;
             }
		}
		else
		{
		    check_array.checked = true;
		}
		check_all.value="UnCheck All";
    }
	else
	{
        if(check_array.length > 0)
		{
            for (i = 0; i < check_array.length; i++)
		    {		    
                check_array[i].checked = false;
             }
		}
		else
		{
		    check_array.checked = false;
		}
        check_all.value="Check All";
    }
}

</script>
<STYLE TYPE="text/css">
<?php include("admin_css.php");?>
</STYLE>
	<title>Untitled</title>	

<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<!--
<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date(ymd);?>">
<INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo$rID;?>">
<INPUT TYPE="HIDDEN" NAME="formAction">
-->
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%" HEIGHT="100%">
	  <TR>
	    <TD><IMG SRC="images/bev_left_t_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_top.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_t_corner.gif"></TD>	
	  </TR>	
	<TR>
       	  <TD BACKGROUND="images/bev_left.gif" WIDTH="8"></TD>	
	  <TD BGCOLOR="#EFF7FF" VALIGN="TOP"><SPAN CLASS="hdr">Assign Courses:</SPAN>
	
    <FORM NAME="editForm" METHOD="POST" ACTION="update_objects_sql.php?action=group2" TARGET="edit_post">
	<INPUT TYPE="HIDDEN" NAME="formAction">
    <INPUT TYPE="HIDDEN" NAME="ID" VALUE="<?php echo $gID;?>">
	<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="1%">
  <TR><TD VALIGN="MIDDLE" nowrap="nowrap" width="1%"><a href="frame_group_details.php?ID=<?php echo $gID;?>&psname=<?php echo $group_name;?>&sel_item=1" target="_parent" class="thebutton"><img border="0" src="images/import.gif" alt="Edit This Group"> Edit This Group</a> 
</TD>
<td nowrap="nowrap" width="1%">
<a href="frame_group_details.php?ID=<?php echo $gID; ?>&psname=<?php echo $group_name; ?>&sel_item=2"  target="_parent" class="thebutton"><img src="images/import.gif" border="0" alt="Manage Subgroups"> Manage Subgroups</a>
</TD>
</TR></TABLE>
	
	<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%"><TR><TD BGCOLOR="#93BEE2">
	<TABLE BORDER="0" CELLSPACING="1" CELLPADDING="3" WIDTH="100%">
		  <TR>
		    <TD BGCOLOR="#FFFFFF" VALOGN="TOP"><SPAN CLASS="ttl"><FONT SIZE=1><B><IMG SRC="images/groups.gif" ALIGN="ABSMIDDLE"> <?php echo $group_name;?></SPAN></TD>
			 <?php
			 if(count($sub_name) > 0)
			 {
			 ?>
			 <TD BGCOLOR="#FFFFFF" ALIGN="CENTER"><SPAN CLASS="ttg"><BR></SPAN></TD>
			 <?php
			 }
			$xn=0;
			while($xn<count($sub_name))
			{
			?>
		    <TD BGCOLOR="#FFFFFF" ALIGN="CENTER"><SPAN CLASS="ttg"><IMG SRC="images/subgroups.gif"><BR><?php echo $sub_name[$xn]; ?></SPAN></TD>	
			<?php
			$xn++;
			}
			?>
		  </TR>			
	   <?php
		$db = new db;
		$db->connect();
		$db->query("SELECT name,status,ID FROM course");
		$xm=0;
		while($db->getRows())
		{ 
		$course_ID = $db->row("ID");		
		$course_name = $db->row("name");
		$status = $db->row("status");	
		
		if($status=="active")
		{
		$img="course_list_off.gif";
		}
		else
		{
		$img="course_list_inactive.gif";
		}	
		
		?>
		  <TR BGCOLOR="#FFFFFF">
		    <TD NOWRAP><IMG SRC="images/<?php echo $img; ?>" ALIGN="ABSMIDDLE"> <SPAN CLASS="ttg"><?php echo $course_name;?> </SPAN><IMG SRC="images/find_sm2.gif" BORDER="0" ALIGN="TEXTTOP" ALT="Click here for more course info."></TD>	
			<?php
			 if(count($sub_name) > 0)
			 {
			 ?>
			<TD NOWRAP ALIGN="CENTER"><input type="button" name="check_all_<?php echo $course_ID; ?>" value="Check All" onClick="Check(document.editForm.check_list_<?php echo $course_ID; ?>, document.editForm.check_all_<?php echo $course_ID; ?>)" ></TD>	
			<?php
			}
			$xn=0;	
			while($xn<count($sub_name))
			{
				if(file_exists($dir_groupfiles.$gID."_".$sub_ID[$xn].".grp"))
				{
			    $gfile=file($dir_groupfiles.$gID."_".$sub_ID[$xn].".grp");
				$ngfile=explode("|",$gfile[0]);
				  if(in_array($course_ID,$ngfile,TRUE))
				  {
				  $ch="CHECKED";
				  }
				  else
				  {
				  $ch="";
				  }
				}					
			?>
		    <TD NOWRAP ALIGN="CENTER"><INPUT TYPE="CHECKBOX" NAME="check_list_<?php echo $course_ID; ?>" ID="check_list_<?php echo $course_ID; ?>" VALUE="<?php echo $course_ID.$ch;?>"></TD>	
			<?php
			$xn++;
			}
			?>
		  </TR>		
		<?php
		$xm++;
		}		  
	   ?>
	</TABLE>
	</TD></TR></TABLE>

	<INPUT TYPE="HIDDEN" NAME="group_ID" VALUE="<?php echo $gID;?>">
	</FORM>
	
	</TD>
	<TD BACKGROUND="images/bev_right.gif" WIDTH="8"></TD>	
	  </TR>
	  <TR>
	    <TD><IMG SRC="images/bev_left_b_corner.gif"></TD>	
	    <TD BACKGROUND="images/bev_bottom.gif" HEIGHT="8"></TD>	
	    <TD><IMG SRC="images/bev_right_b_corner.gif"></TD>	
	  </TR>		
	</TABLE>
</BODY>