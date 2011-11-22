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

document.oncontextmenu = function(){return false}
document.onclick = hideMenu;

</SCRIPT>
</head>
<SCRIPT>
<?php
if(is_null($direction) && !is_null($order_by))
{
?>var direction="ASC";<?php
$direction="ASC";
$order_clause="ORDER BY $order_by $direction";
}
else if($direction=="ASC" && !is_null($order_by))
{
?>var direction="DESC";<?php
$direction="DESC";
$order_clause="ORDER BY $order_by $direction";
}
else if($direction=="DESC" && !is_null($order_by))
{
?>var direction="ASC";<?php
$direction="ASC";
$order_clause="ORDER BY $order_by $direction";
}
else
{
?>var direction="ASC";<?php
}
?>
</SCRIPT>
<body BGCOLOR="#FFFFFF" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="1" WIDTH="250">
<?php
$result=MetabaseQuery($database,"SELECT title,status,course_id FROM courses $order_clause");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$ID=MetabaseFetchResult($database,$result,$row,"course_id");
?>
	<TR ID="r<?php echo $ID;?>">
		<TD VALIGN="TOP"><SPAN onClick="top.course_name='<?php MetabaseFetchResult($database,$result,$row,"title");?>';top.course_id=<?php echo $ID;?>;top.course_tree.location='course_tree.php?course_name=<?php urlencode(MetabaseFetchResult($database,$result,$row,"title"));?>&course_id=<?php echo $ID;?>';selectAny('r',<?php echo $ID;?>,'#FFFFFF','#d8d8d8');return false;" onMouseDown="top.course_id=<?php echo $ID;?>;selectAny('r',<?php echo $ID;?>,'#FFFFFF','#d8d8d8');mAction('r<?php echo $ID;?>');"><IMG SRC='images/course_folder_sm.gif' ALT='' NAME='folder_r<?php echo $ID;?>' BORDER=0></TD>
		<TD VALIGN='TOP' WIDTH='174'><SPAN CLASS='dataList'><?php MetabaseFetchResult($database,$result,$row,"title");?></SPAN></TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>	
		<TD VALIGN='TOP' WIDTH='60'><SPAN CLASS='dataList'><?php MetabaseFetchResult($database,$result,$row,"status");?></SPAN></TD>
		<TD WIDTH='8'><IMG SRC='images/spcr.gif' WIDTH='8'></TD>
	</TR>	
	<TR>
		<TD COLSPAN="5" HEIGHT="1" BGCOLOR="#c6c6c6"></TD>
	</TR>	
<?php
}
MetabaseFreeResult($database,$result);
?>																		
</TABLE>
</body>
</html>
