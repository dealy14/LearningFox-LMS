<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<SCRIPT language="javascript" type="text/javascript">
<!--
function objReload()
{
//top.top1.objReload();
top.rmain.group_list.location.reload();
}

function addGroup()
{
window.open('create_group.php','ttt','height=80,width=300')
}

var rTree;
function objectTree()
{

	if(rTree=="closed"||rTree==null)
	{
	parent.document.all.objectManager.rows="60,*,300";
	document.tree.src="images/obtree_off.gif";
	document.tree.alt="Show Object Listings";
	rTree="open";
	}
	else
	{
	parent.document.all.objectManager.rows="60,*,0";	
	document.tree.src="images/obtree_on.gif";
	document.tree.alt="Show Object Tree";
	rTree="closed";
	}
	return rTree;

}
function jumpMenu(selObj,restore){ //v3.0
  eval(selObj.options[selObj.selectedIndex].value);
  if (restore) selObj.selectedIndex=0;
}
-->
</SCRIPT>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
<!--  <TR>
    <TD COLSPAN="2">
<applet Code="apTabMenu" Archive="apTabMenu.jar" Width=400 Height=22 MAYSCRIPT>
<param name="Copyright" value="Apycom Software - www.apycom.com">
<param name="bottomLine" value="true">
<param name="pressedItem" value="1">
<param name="tabType" value="0"> 
<param name="backColor" value="336699">
<param name="tabColor" value="93BEE2">
<param name="tabHighColor" value="93BEE2">
<param name="fontColor" value="666699">
<param name="fontHighColor" value="000000">
<param name="font" value="Arial,9,0">
<param name="menuItems" value="
      {Registered Students,object_manager.php?obtable=course,object_main,_}	    	  
      ">
</applet>
    </TD>
  </TR>-->
  
  <tr>
  	<td colspan="3" width="1%">&nbsp;</td>
<TD ALIGN="RIGHT" valign="top" NOWRAP rowspan="2" width="99%"><IMG SRC="images/edit_groups2.gif" ALIGN="top"></TD>
  </tr>
  <TR>
<?php
/*
<TD VALIGN="MIDDLE">&nbsp;
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = "200" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="93BEE2">
		<param name="backHighColor" value="93BEE2">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  { View ,_,_}  
		  {|By Name,javascript:1,_,_}
		  {|By Short Name,javascript:2,_,_}   
		  {|By ID,javascript:3,_,_}   
	 	  { Add New Group ,javascript:4,_self,images/add.gif}   
		">
		<param name="javascript:1" value="parent.group_list.orderObjects('name')">
		<param name="javascript:2" value="parent.group_list.orderObjects('sname')">
		<param name="javascript:3" value="parent.group_list.orderObjects('ID')">
		<param name="javascript:4" value="addGroup();">
		</applet>
</TD>
*/
?>
<td width="1%"><form name="form1">
  <select name="menu1" onChange="jumpMenu(this,0)">
    <option value="" selected="selected">order</option>
    <option value="javascript:parent.group_list.orderObjects('name');">by name</option>
    <option value="javascript:parent.group_list.orderObjects('sname')">by short name</option>
    <option value="javascript:parent.group_list.orderObjects('ID')">by ID</option>
  </select></form></td>
  <td valign="top" width="1%" NOWRAP><a href="javascript:addGroup();" target="_self" class="thebutton" ><img border="0" src="images/add.gif" alt="add"> Add </a></td>
<TD ALIGN="RIGHT" NOWRAP>&nbsp;</TD>

  </TR>
</TABLE>

</body>
</html>
<SCRIPT>
