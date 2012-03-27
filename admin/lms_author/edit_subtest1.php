<?php
require_once("../../conf.php");
clear_cache();

//get the data values;
$result=MetabaseQuery($database,"SELECT lessons_tests.order_num,lessons.title as lesson_title,tests.* FROM tests,lessons_tests,lessons WHERE tests.test_id=$ID AND lessons_tests.test_id=$ID AND lessons.lesson_id=lessons_tests.lesson_id");
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
$lesson_title=MetabaseFetchResult($database,$result,$row,"lesson_title");
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
		<?php $tsection=1;require("test_toolbar1.inc");?>
		</TD>	
	</TR>		
	<TR>
		<TD COLSPAN="2" HEIGHT="1" BGCOLOR="#FFFFFF"></TD>	
	</TR>	
	<TR>
		<TD COLSPAN="2" HEIGHT="2" BGCOLOR="LightGrey"></TD>	
	</TR>		
	<TR BGCOLOR="#dddddd">		
		<TD COLSPAN="2" VALIGN="top" HEIGHT="10"><SPAN CLASS="small">Created:</SPAN><SPAN CLASS="small"><?php echo $created;?> &nbsp; &nbsp; &nbsp; &nbsp; <SPAN CLASS="small">Modified:</SPAN> <SPAN CLASS="small" ID="mod"><?php echo $modified;?></TD>
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Item Order: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="order_num" MAXLENGTH="3" SIZE="3" CLASS="input" VALUE="<?php echo $order_num;?>"> <SPAN CLASS="input_text">(Under "<?php echo $lesson_title;?>")</TD>
	</TR>			
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Test Title: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="title" MAXLENGTH="200" SIZE="60" CLASS="input" VALUE="<?php echo $title;?>" onKeyup="top.course_tree.subtest_<?php echo $lesson_id;?>_<?php echo $ID;?>.innerText=this.value"></TD>
	</TR>
	<TR BGCOLOR="#dddddd">		
		<TD VALIGN="top"><SPAN CLASS="input_text">Description: </TD>	
		<TD VALIGN="top"><TEXTAREA NAME="description" COLS="60" ROWS="6" CLASS="input"><?php echo $description;?></TEXTAREA></TD>	
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Launch String: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="launch_str" MAXLENGTH="200" SIZE="60" CLASS="input" VALUE="<?php echo $launch_str;?>"></TD>
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Time Limit: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="time_limit" MAXLENGTH="5" SIZE="5" CLASS="input" VALUE="<?php echo $time_limit;?>"> &nbsp; &nbsp; &nbsp; &nbsp; <SPAN CLASS="input_text">Time Req.: &nbsp; <INPUT TYPE="TEXT" NAME="time_req" MAXLENGTH="5" SIZE="5" CLASS="input" VALUE="<?php echo $time_req;?>"></TD>
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Randomize: </TD>	
		<TD><?php input_list("randomize","y,n",0,$randomize,"CLASS='input'");?> &nbsp; &nbsp; &nbsp; &nbsp; <SPAN CLASS="input_text">Random Limit: <INPUT TYPE="TEXT" NAME="randomize_limit" MAXLENGTH="5" SIZE="5" CLASS="input" VALUE="<?php echo $randomize_limit;?>"></TD>
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Scoring: </TD>	
		<TD><?php input_list("scoring",$dir_lib."score.txt",0,$scoring,"CLASS='input'");?></TD>
	</TR>	
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Passing Score: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="passing" MAXLENGTH="5" SIZE="5" CLASS="input" VALUE="<?php echo $passing;?>"> <SPAN CLASS="input_text">(%)</TD>
	</TR>		
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Retakes: </TD>	
		<TD><?php input_list("retake","yes,no",0,$retake,"CLASS='input'");?></TD>
	</TR>			
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Failing Action: </TD>	
		<TD><?php input_list("fail_action","Student Disabled,Force Retake,Nothing",0,$fail_action,"CLASS='input'");?></TD>
	</TR>			
		
	
		<INPUT TYPE="HIDDEN" NAME="test_id" VALUE="<?php echo $ID;?>">
		<INPUT TYPE="HIDDEN" NAME="course_id" VALUE="<?php echo $course_id;?>">
		<INPUT TYPE="HIDDEN" NAME="lesson_id" VALUE="<?php echo $lesson_id;?>">				
		<INPUT TYPE="HIDDEN" NAME="item_level" VALUE="<?php echo $item_level;?>">	
		<INPUT TYPE="HIDDEN" NAME="section" VALUE="properties">
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
echo"<SCRIPT>top.lesson_name='$lesson_title';top.document.properties_frame.properties_header.addHistory('edit_subtest1.php?ID=$ID&course_id=$course_id&lesson_id=$lesson_id','$title ['+document.theform.section.value+']','subtopic');top.course_id=$course_id;</SCRIPT>";
?>

</body>
</html>
