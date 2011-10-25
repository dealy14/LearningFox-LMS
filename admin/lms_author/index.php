<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<STYLE TYPE="text/css">
  .datalist{font-family:verdana;font-size=10;}
  .menu_text{FONT-FAMILY:ARIAL;FONT-SIZE:11;text-decoration:none;color:#000000;HEIGHT:20;}
  .rmenu{BACKGROUND:#cccccc;}  
</STYLE>		

<SCRIPT>
function insertItem(course_id,lesson_id,level,item)
{	
	if(level=="root")
	{
	lesson_id=0;
	}
	
	
	rpost.location="add_"+item+".php?course_id="+course_id+"&lesson_id="+lesson_id+"&level="+level+"&test_id="+top.test_id;
	
	if(item=="tf" || item=="mc" && level=="root")
	{
	top.properties_frame.properties.location="edit_test2.php?course_id="+course_id+"&lesson_id="+lesson_id+"&item_level="+level+"&ID="+top.test_id;
	}

}
</SCRIPT>
</head>

<body TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0">
<DIV ID="tester" CLASS="rd" NAME="dd" STYLE="position:absolute;z-index:20;width:150px;visibility:hidden;overflow: hidden" onClick="course_list.hideMenu();"><?php include("course_menu.php");?></DIV>
<P><BR>
<TABLE BORDER="1" CELLSPACING="0" CELLPADDING="0" ALIGN="CENTER">
	<TR>
	  <TD><IFRAME SRC="course_list_frame.php" WIDTH="250" HEIGHT="150" NAME="clist"></IFRAME></TD>
	  <TD ROWSPAN="2"><IFRAME SRC="properties_frame.php" WIDTH="500" HEIGHT="400" NAME="properties_frame"></IFRAME></TD>
	</TR>
	<TR>
	  <TD><IFRAME SRC="blank.php" WIDTH="250" HEIGHT="250" NAME="course_tree" ID="tree"></IFRAME></TD>
	</TR>	
	
</TABLE>
<IFRAME NAME="rpost" WIDTH="0" HEIGHT="0"></IFRAME>


</body>
</html>
