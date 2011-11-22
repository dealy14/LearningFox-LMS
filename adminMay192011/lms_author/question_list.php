<?php
require_once("../../conf.php");
//clear_cache();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	<STYLE TYPE="text/css">
  .datalist{font-family:verdana;font-size=10;}
  .menu_text{FONT-FAMILY:ARIAL;FONT-SIZE:10;text-decoration:none;color:#000000;HEIGHT:20;}
  .rmenu{BACKGROUND:#cccccc;}  
</STYLE>	
<SCRIPT>
function showMenu()
{
	top.document.all.tester.style.visibility="visible";
	top.document.all.tester.style.top=(window.event.y+35);
	top.document.all.tester.style.left=(window.event.x+75);

}

function mAction(objID)
{
	if(window.event.button==2||window.event.button==3)
	{
	showMenu();
	top.jmenu.currentID=objID;
	}
}

function hideMenu()
{
top.document.all.tester.style.visibility="hidden";
}

var rselected;
var rselected_old;
function selectAny(basedID,numID,returnColor,hlColor)
{
	//first set the variables for the current and old rows;
	rselected_old = rselected;
	rselected = basedID+numID;
	
	//if there is an old row, return it to the correct color;
	if(rselected_old!=null)
	{
	eval("document.all."+rselected_old+".style.background='"+returnColor+"';");
	eval("folder_"+rselected_old+".src='images/course_folder_sm.gif';");
	}
		
	//now select appropriate row;
	eval("document.all."+rselected+".style.background='"+hlColor+"';");	
	eval("folder_"+rselected+".src='images/course_folder_sm_sel.gif';");
}


function order_list(order)
{
	if(direction=="ASC")
	{
	direction="DESC";
	}
	else
	{
	direction="ASC";
	}
document.location="question_list.php?test_id=<?php echo $test_id;?>&order_by="+order+"&direction="+direction;
}

//document.oncontextmenu = function(){return false}
//document.onclick = hideMenu;

</SCRIPT>
</head>
<SCRIPT>
<?php
if($order_by=="")
{
$order_by="question_order";
$direction="ASC";
}

echo "var direction='$direction';";
$order_clause="ORDER BY $order_by $direction";

?>
</SCRIPT>
<body BGCOLOR="#FFFFFF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="1" WIDTH="485">
<?php
$result=MetabaseQuery($database,"SELECT test_questions.* FROM test_questions WHERE test_questions.test_id=$test_id $order_clause");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$ID=MetabaseFetchResult($database,$result,$row,"question_id");

if(MetabaseFetchResult($database,$result,$row,"question_type")=="tf")
{
$qt="True or False";
}
else if(MetabaseFetchResult($database,$result,$row,"question_type")=="mc")
{
$qt="Multiple Choice";
}
?>
	<TR ID="r<?php echo $ID;?>" onMouseOver="this.style.cursor='default';" onMouseDown="top.course_id=<?php echo $ID;?>;selectAny('r',<?php echo $ID;?>,'#FFFFFF','#d8d8d8');">
		<TD VALIGN="TOP"><SPAN><IMG SRC='images/course_folder_sm.gif' ALT='' NAME='folder_r<?php echo $ID;?>' BORDER=0></TD>
		<TD VALIGN='TOP' WIDTH='160'><SPAN CLASS='dataList'><?php echo $qt;?></SPAN></TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>	
		<TD VALIGN='TOP' ALIGN='CENTER'  WIDTH='100'><SPAN CLASS='dataList'>#<?php MetabaseFetchResult($database,$result,$row,"question_order");?></SPAN></TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>
		<TD VALIGN='TOP' ALIGN='CENTER'  WIDTH='100'><SPAN CLASS='dataList'>[Edit]</SPAN></TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>	
		<TD VALIGN='TOP' ALIGN='CENTER'  WIDTH='100'><SPAN CLASS='dataList'>[Delete]</TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>				
	</TR>	
	<TR>
		<TD COLSPAN="9" HEIGHT="1" BGCOLOR="#c6c6c6"></TD>
	</TR>	
<?php
}
MetabaseFreeResult($database,$result);
?>																		
</TABLE>
</body>
</html>
