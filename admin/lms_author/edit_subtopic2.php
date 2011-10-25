<?php
require_once("../../conf.php");
clear_cache();

//get the data values;
$result=MetabaseQuery($database,"SELECT lessons_topics.order_num,lessons.title as lesson_title,topics.title,topics.created,topics.modified,topics.content FROM topics,lessons_topics,lessons WHERE topics.topic_id=$ID AND lessons_topics.topic_id=$ID AND lessons.lesson_id=lessons_topics.lesson_id");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$title=MetabaseFetchResult($database,$result,$row,"title");
$created=MetabaseFetchResult($database,$result,$row,"created");
$modified=MetabaseFetchResult($database,$result,$row,"modified");
$lesson_title=MetabaseFetchResult($database,$result,$row,"lesson_title");
$content=MetabaseFetchResult($database,$result,$row,"content");

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
<FORM NAME="theform" ACTION="update_topic.php" TARGET="hpost">

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
		<TD COLSPAN="2" VALIGN="TOP" HEIGHT="20" BGCOLOR="#DDDDDD"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; <SPAN onClick="if(confirm('Are you sure you want to update this Topic?')){document.theform.do_action.value='UPDATE';document.theform.submit();mod.innerText=document.theform.modified.value;};"><IMG SRC="images/save.gif" BORDER="0"></SPAN> <SPAN onClick="if(confirm('Are you sure you want to Delete this Topic?')){document.theform.do_action.value='DELETE';document.theform.submit();};"><IMG SRC="images/delete.gif" BORDER="0"></SPAN></TD>	
	</TR>		
	<TR>
		<TD COLSPAN="2" VALIGN="TOP" HEIGHT="15" BGCOLOR="#BFBFBF">
		<?php $tsection=2;require("topic_toolbar2.inc");?>
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
		<TD COLSPAN="2"><TEXTAREA NAME="content" STYLE="width:497;height:309" CLASS="input"><?php echo $content;?></TEXTAREA></TD>	
	</TR>			
		
	
		<INPUT TYPE="HIDDEN" NAME="topic_id" VALUE="<?php echo $ID;?>">
		<INPUT TYPE="HIDDEN" NAME="course_id" VALUE="<?php echo $course_id;?>">
		<INPUT TYPE="HIDDEN" NAME="item_level" VALUE="<?php echo $item_level;?>">	
		<INPUT TYPE="HIDDEN" NAME="section" VALUE="content">
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
echo"<SCRIPT>top.lesson_name='$lesson_title';top.document.properties_frame.properties_header.addHistory('edit_subtopic2.php?ID=$ID&course_id=$course_id&lesson_id=$lesson_id','$title ['+document.theform.section.value+']','subtopic');top.course_id=$course_id;</SCRIPT>";
?>
</body>
</html>
