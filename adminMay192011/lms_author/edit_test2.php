<?php
require_once("../../conf.php");
clear_cache();

//get the data values;
$result=MetabaseQuery($database,"SELECT courses_tests.order_num,tests.* FROM tests,courses_tests WHERE tests.test_id=$ID AND courses_tests.test_id=$ID");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$title=MetabaseFetchResult($database,$result,$row,"title");
$created=MetabaseFetchResult($database,$result,$row,"created");
$modified=MetabaseFetchResult($database,$result,$row,"modified");
$description=MetabaseFetchResult($database,$result,$row,"description");
$order_num=MetabaseFetchResult($database,$result,$row,"order_num");
$time_limit=MetabaseFetchResult($database,$result,$row,"time_limit");
$time_req=MetabaseFetchResult($database,$result,$row,"time_req");
$launch_str=MetabaseFetchResult($database,$result,$row,"launch_str");
$randomize=MetabaseFetchResult($database,$result,$row,"randomize");
$randomize_limit=MetabaseFetchResult($database,$result,$row,"randomize_limit");
$scoring=MetabaseFetchResult($database,$result,$row,"scoring");
$passing=MetabaseFetchResult($database,$result,$row,"passing");
$fail_action=MetabaseFetchResult($database,$result,$row,"fail_action");
$retake=MetabaseFetchResult($database,$result,$row,"retake");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	<STYLE><?php include("admin_css.php");?></STYLE>
</head>

<body BGCOLOR="#a2a2a2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IFRAME NAME="hpost" WIDTH="0" HEIGHT="0"></IFRAME>
<FORM NAME="theform" ACTION="update_test.php" TARGET="hpost">

<!------OUTER TABLE--------------->
<TABLE WIDTH="100%" ALIGN="CENTER" BORDER="0" CELLPADDING="0" CELLSPACING="0"><TR><TD WIDTH="1" BGCOLOR="#FFFFFF"></TD><TD WIDTH="2" BGCOLOR="LightGrey"></TD><TD VALIGN="TOP">
<!-------INNET TABLE-------------->
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="1" WIDTH="100%" HEIGHT="100%" ALIGN="CENTER">
	<TR>
		<TD COLSPAN="2" HEIGHT="1" BGCOLOR="#FFFFFF"></TD>	
	</TR>	
	<TR>
		<TD COLSPAN="2" HEIGHT="2" BGCOLOR="LightGrey"></TD>	
	</TR>		
	<TR>
		<TD COLSPAN="2" VALIGN="TOP" HEIGHT="20" BGCOLOR="#DDDDDD"><SPAN onClick="top.test_id=<?php echo $ID;?>;top.insertItem(<?php echo $course_id;?>,<?php echo $ID;?>,'root','tf');"><IMG SRC="images/add_tf.gif"></SPAN> <SPAN onClick="top.test_id=<?php echo $ID;?>;top.insertItem(<?php echo $course_id;?>,<?php echo $ID;?>,'root','mc');"><IMG SRC="images/add_mc.gif"></SPAN> <SPAN onClick="if(confirm('Are you sure you want to update this Topic?')){document.theform.do_action.value='UPDATE';document.theform.submit();mod.innerText=document.theform.modified.value;};"><IMG SRC="images/save.gif" BORDER="0"></SPAN> <SPAN onClick="if(confirm('Are you sure you want to Delete this Topic?')){document.theform.do_action.value='DELETE';document.theform.submit();};"><IMG SRC="images/delete.gif" BORDER="0"></SPAN></TD>	
	</TR>		
	<TR>
		<TD COLSPAN="2" VALIGN="TOP" HEIGHT="15" BGCOLOR="#BFBFBF">
		<?php $tsection=2;require("test_toolbar1.inc");?>
		</TD>	
	</TR>		
	<TR>
		<TD COLSPAN="2" HEIGHT="1" BGCOLOR="#FFFFFF"></TD>	
	</TR>	
	<TR>
		<TD COLSPAN="2" HEIGHT="2" BGCOLOR="LightGrey"></TD>	
	</TR>		
	<TR BGCOLOR="#dddddd">		
		<TD COLSPAN="2" VALIGN="top">
			<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
				<TR>
					<TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_left.gif"></TD>
					<TD onMouseOver="this.style.cursor='default';" onClick="question_list.order_list('question_type');" ID="col1" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="160"><SPAN CLASS="ttg">Question Type</TD>
				    <TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_inner.gif"></TD>
					<TD onMouseOver="this.style.cursor='default';" onClick="question_list.order_list('question_order');" ID="col2" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="100"><SPAN CLASS="ttg">Number/Order</TD>
				    <TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_inner.gif"></TD>
					<TD onMouseOver="this.style.cursor='default';" ID="col2" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="100"><SPAN CLASS="ttg">Edit</TD>					
				    <TD BACKGROUND="images/cheader_bkg.gif" WIDTH="8"><IMG SRC="images/cheader_inner.gif"></TD>
					<TD onMouseOver="this.style.cursor='default';" ID="col2" ALIGN="CENTER" BACKGROUND="images/cheader_bkg.gif" WIDTH="100"><SPAN CLASS="ttg">Delete</TD>						
					<TD BACKGROUND="images/cheader_bkg.gif" ALIGN="RIGHT" WIDTH="8"><IMG SRC="images/cheader_right.gif"></TD>					
				</TR>	
			</TABLE>			
		</TD>
	</TR>		
	<TR BGCOLOR="#dddddd">		
		<TD COLSPAN="2" VALIGN="top"><IFRAME SRC="question_list.php?test_id=<?php echo $ID; ?>" NAME="question_list" HEIGHT="300" WIDTH="490"></IFRAME></TD>
	</TR>			
		

	
	
		<INPUT TYPE="HIDDEN" NAME="test_id" VALUE="<?php echo $ID;?>">
		<INPUT TYPE="HIDDEN" NAME="course_id" VALUE="<?php echo $course_id;?>">
		<INPUT TYPE="HIDDEN" NAME="item_level" VALUE="<?php echo $item_level;?>">	
		<INPUT TYPE="HIDDEN" NAME="section" VALUE="test questions">
		<INPUT TYPE="HIDDEN" NAME="original_order" VALUE="<?php echo $order_num;?>">
		<INPUT TYPE="HIDDEN" NAME="modified" VALUE="<?php echo date('Y-m-d H:i:s');?>">
		<INPUT TYPE="HIDDEN" NAME="do_action">	
			
	
	
	<TR>
		<TD COLSPAN="2" HEIGHT="2" BGCOLOR="#b4b4b4"></TD>	
	</TR>	
	<TR>
		<TD COLSPAN="2" HEIGHT="1" BGCOLOR="#484848"></TD>	
	</TR>		
</TABLE>
<!--------END INNER TBALE-------------->
</TD><TD WIDTH="2" BGCOLOR="#b4b4b4"></TD><TD WIDTH="1" BGCOLOR="#484848"></TD></TR></TABLE>
<!--------END OUTER TBALE-------------->
</FORM>

<?php
echo"<SCRIPT>top.document.properties_frame.properties_header.addHistory('edit_test2.php?ID=$ID&course_id=$course_id','$title ['+document.theform.section.value+']','test');top.course_id=$course_id;</SCRIPT>";
?>

</body>
</html>

