<html>
<head>
	<title>Untitled</title>
<STYLE TYPE="text/css">
  .col_text{font-family:verdana;font-size=10;}
  <?php include("admin_css.php");?>
</STYLE>	
<SCRIPT>
function order_list(order)
{
top.clist.list.location="course_list.php?order_by="+order+"&direction="+top.clist.list.direction;
}

function hideMenu()
{
top.document.all.tester.style.visibility="hidden";
}

function addHistory(value,show,level)
{
//formulate the new history element;
var course = top.course_name;
var lesson = top.lesson_name;
var course_ID = top.course_ID;

	if(level=="lesson" || level=="topic" || level=="test")
	{
	var show = course +" / "+show;
	}
	else
	{
	var show = course +" / "+lesson+" / "+show;
	}
	


	var tempOption = new Option(show,value,false,true);
	document.theform.d_history.options[document.theform.d_history.options.length]=tempOption;
	document.theform.d_history.options[document.theform.d_history.options.length-1].selected=true;

}

//document.oncontextmenu = function(){return false}
document.onclick = hideMenu;
</SCRIPT>
</head>
<body BGCOLOR="#CCCCCC" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<FORM NAME="theform">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" WIDTH="100%">
		<TR>
		<TD><IMG SRC="images/arrow_h.gif"><SELECT NAME="d_history" CLASS="input1" STYLE="width:534" onChange="top.properties_frame.properties.location=this.value"></SELECT></TD>
		</TR>	
			
</TABLE>
</FORM>
</body>
</html>