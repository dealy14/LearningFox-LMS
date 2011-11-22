<?php
$menu_item[]="Properties||";
$menu_item[]="[sep]";
$menu_item[]="Insert New Lesson||top.rpost.location='add_lesson.php?course_id='+top.course_id;";
$menu_item[]="Insert New Page||top.insertItem(top.course_id,'','root','topic');";
$menu_item[]="Insert New Test||top.insertItem(top.course_id,'','root','test');";
$menu_item[]="[sep]";
$menu_item[]="Import Lesson||";
$menu_item[]="Import Page||";
$menu_item[]="Import Test||";
$menu_item[]="[sep]";
$menu_item[]="Publish||";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Untitled</title>
	<STYLE TYPE="text/css">
  .datalist{font-family:verdana;font-size=10;}
  .menu_text{FONT-FAMILY:ARIAL;FONT-SIZE:11;text-decoration:none;color:#000000;HEIGHT:20;}
  .rmenu{BACKGROUND:#cccccc;}  
</STYLE>	
<BODY TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0" BGCOLOR="#000000">

<SCRIPT>
function hlName()
{
tempVar = document.f_prop.ID.value;
eval("document.courses"+tempVar+".rname.select();");
}
var total_menu_items=<?php echo count($menu_item)?>;

function menuHighlight(rmenu)
{
	eval("top.jmenu.document.all."+rmenu+".style.background='#29299A';");
	eval("top.jmenu.document.all.t"+rmenu+".style.color='#FFFFFF';");	
}
function menuHighlight_off(rmenu)
{
	eval("top.jmenu.document.all."+rmenu+".style.background='#cccccc';");
	eval("top.jmenu.document.all.t"+rmenu+".style.color='#000000';");		
}

function hideMenu()
{
top.document.all.tester.style.visibility="hidden";
}
document.oncontextmenu = function(){return false}
</SCRIPT>
<TABLE BORDER="0" CELLSPACING="0" CELLPADDING="0" ID="cmenu">
  <TR>
    <TD COLSPAN="3" BGCOLOR="#FFFFFF"><IMG SRC="images/spcr.gif" WIDTH="5" HEIGHT="1"></TD>
  </TR>
<?$x=0;while($x<count($menu_item)){$mi = explode("||",$menu_item[$x]);?>  
  <TR> 
	<TD BGCOLOR="#FFFFFF" WIDTH="1"><IMG SRC="images/spcr.gif" WIDTH="1" HEIGHT="1"></TD>
	<?php if($mi[0]=="[sep]"){?>
	<TD NOWRAP BACKGROUND="images/menu_bottom.gif" VALIGN="MIDDLE"><IMG SRC="images/spcr.gif" WIDTH="25" HEIGHT="2"></TD>
	<?php }else{?>
    <TD CLASS="rmenu" ID="m<?php echo $x;?>" onClick="<?php echo $mi[1];?>hideMenu();" onMouseOver="this.style.cursor='default';menuHighlight('m<?php echo $x;?>');" onMouseOut="menuHighlight_off('m<?php echo $x;?>')" NOWRAP VALIGN="MIDDLE"><IMG SRC="images/spcr.gif" WIDTH="21" HEIGHT="1"><SPAN ID="tm<?php echo $x;?>" CLASS="menu_text"><?php echo $mi[0];?></A><IMG SRC="images/spcr.gif" WIDTH="21" HEIGHT="1"></TD>
	 <?php }?>
	<TD BGCOLOR="#5a5a5a"><IMG SRC="images/spcr.gif" WIDTH="1" HEIGHT="1"></TD>	
  </TR>   
<?php $x++;}?>    
  <TR>
    <TD COLSPAN="3" BGCOLOR="#5a5a5a"><IMG SRC="images/spcr.gif" WIDTH="5" HEIGHT="2"></TD>
  </TR>     
</TABLE>
</BODY>
</HTML>
