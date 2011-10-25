<?php
require_once("../../conf.php");
clear_cache();

//get the data values;
$result=MetabaseQuery($database,"SELECT courses_lessons.order_num,lessons.title,lessons.created,lessons.modified FROM lessons,courses_lessons WHERE lessons.lesson_id=$ID AND courses_lessons.lesson_id=$ID");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$title=MetabaseFetchResult($database,$result,$row,"title");
$created=MetabaseFetchResult($database,$result,$row,"created");
$modified=MetabaseFetchResult($database,$result,$row,"modified");
$order_num=MetabaseFetchResult($database,$result,$row,"order_num");
//$modified=date("H:i:s", mktime (0,0,MetabaseFetchResult($database,$result,$row,"modified")));
}
MetabaseFreeResult($database,$result);

echo"<SCRIPT>top.document.properties_frame.properties_header.addHistory('edit_lesson.php?ID=$ID&course_id=$course_id','$title','lesson');top.course_id=$course_id;</SCRIPT>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	<STYLE><?php include("admin_css.php");?></STYLE>
</head>

<body BGCOLOR="#a2a2a2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<IFRAME NAME="hpost" WIDTH="0" HEIGHT="0"></IFRAME>
<FORM NAME="theform" ACTION="update_lesson.php" TARGET="hpost">

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
		<TD COLSPAN="2" VALIGN="TOP" HEIGHT="20" BGCOLOR="#DDDDDD"><SPAN onClick="top.insertItem(<?php echo $course_id;?>,<?php echo $ID;?>,'sub','topic');"><IMG SRC="images/insert_topic.gif"></SPAN> <SPAN onClick="top.insertItem(<?php echo $course_id;?>,<?php echo $ID;?>,'sub','test');"><IMG SRC="images/insert_test.gif"></SPAN> <SPAN onClick="if(confirm('Are you sure you want to update this Lesson?')){document.theform.do_action.value='UPDATE';document.theform.submit();mod.innerText=document.theform.modified.value;};"><IMG SRC="images/save.gif" BORDER="0"></SPAN> <SPAN onClick="if(confirm('Are you sure you want to Delete this Lesson and all of it\'s content?')){document.theform.do_action.value='DELETE';document.theform.submit();};"><IMG SRC="images/delete.gif" BORDER="0"></SPAN></TD>	
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
		<TD><INPUT TYPE="TEXT" NAME="order_num" MAXLENGTH="3" SIZE="3" CLASS="input" VALUE="<?php echo $order_num;?>"> <SPAN CLASS="input_text">(Root Level)</TD>
	</TR>		
	<TR BGCOLOR="#dddddd">		
		<TD><SPAN CLASS="input_text">Lesson Title: </TD>	
		<TD><INPUT TYPE="TEXT" NAME="title" MAXLENGTH="200" SIZE="60" CLASS="input" VALUE="<?php echo $title;?>" onKeyup="top.course_tree.lesson_<?php echo $ID;?>.innerText=this.value"></TD>
	</TR>
	<TR BGCOLOR="#dddddd">		
		<TD VALIGN="top"><SPAN CLASS="input_text">Description: </TD>	
		<TD VALIGN="top"><TEXTAREA NAME="description" COLS="60" ROWS="6" CLASS="input">test</TEXTAREA></TD>	
	</TR>	
	
		<INPUT TYPE="HIDDEN" NAME="lesson_id" VALUE="<?php echo $ID;?>">
		<INPUT TYPE="HIDDEN" NAME="course_id" VALUE="<?php echo $course_id;?>">		
		<INPUT TYPE="HIDDEN" NAME="item_level" VALUE="<?php echo $item_level;?>">	
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

</body>
</html>
