<?php
/*
<applet Code="apTabMenu" Archive="apTabMenu.jar" Width=250 Height=22 MAYSCRIPT>
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
      {Tests,test_list.php,test_list,_}
      {Questions,question_list.php,test_list,_}	    	  
      ">
</applet>

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
		  {|By Type,javascript:2,_,_}   
		  {|By ID,javascript:4,_,_}  
	 	  { Add ,javascript:5,_self,images/add.gif}   
	 	  { Find ,search.php,_self,images/search.gif}  	
		">
		<param name="javascript:1" value="parent.test_list.orderObjects('name')">
		<param name="javascript:2" value="parent.test_list.orderObjects('type')">
		<param name="javascript:3" value="parent.test_list.orderObjects('modified')">
		<param name="javascript:4" value="parent.test_list.orderObjects('ID')">
		<param name="javascript:5" value="addObject();">
		<param name="javascript:6" value="objectTree();">
		</applet>
<!--<A HREF="#" onClick="objectTree();"><img src="images/obtree_on.gif" border="0"></A>-->
<!--
&nbsp;<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = "80" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="true">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="0">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="93BEE2">
		<param name="backHighColor" value="93BEE2">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		{ Search ,search.php,_self,images/search.gif}  	
		">
		<param name="javascript:1" value="newObject()">
		</applet>
-->
</TD>
*/
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<SCRIPT>
<!--
function objReload()
{
top.rmain.test_list.location.reload();
}

function addObject()
{
window.open('create_'+top.top1.test_object+'.php','ttt','height=100,width=250');
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
function getRight(rtable)
{
//var myID = eval("top.top1."+rtable+"ID");
top.object_manager.object_main.location="object_manager.php?obtable="+rtable;
top.rmain.location="frame_edit_object.php?selectedTab="+eval("top.top1."+rtable+"ItemSelect")+"&ID=blank&obtable="+rtable;
}

function jumpMenu(selObj,restore){ //v3.0
  eval(selObj.options[selObj.selectedIndex].value);
  if (restore) selObj.selectedIndex=0;
}
function custometabs(tabid)
{
document.getElementById('test_list_tab1').className='mytablinknotselected';
document.getElementById('test_list_tab2').className='mytablinknotselected';

document.getElementById( tabid          ).className='mytablinkselected';
}
-->
</SCRIPT>

<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD ALIGN="center" VALIGN="TOP" NOWRAP ><a id="test_list_tab1" href="test_list.php" onClick="custometabs('test_list_tab1')" target="test_list" class="mytablinkselected" >Survey</a></TD>
	<td ALIGN="center" VALIGN="TOP" NOWRAP ><a id="test_list_tab2" href="question_list.php" onClick="custometabs('test_list_tab2')"  target="test_list" class="mytablinknotselected">Questions</a></TD>
    <TD ALIGN="RIGHT" VALIGN="TOP" NOWRAP ROWSPAN="3"><IMG SRC="images/edit_tests2.gif"></TD>	
  </TR>
  <tr>
  <td colspan="3" height="5"><img src="images/spcr.gif" alt="nothing"></td>
  </tr>
  <TR>

<td width="1%"><form name="form1">
  <select name="menu1" onChange="jumpMenu(this,0)">
    <option value="" selected="selected">order</option>
    <option value="javascript:parent.test_list.orderObjects('name');">by name</option>
    <option value="javascript:parent.test_list.orderObjects('type')">by type</option>
    <option value="javascript:parent.test_list.orderObjects('modified')">by modified</option>
    <option value="javascript:parent.test_list.orderObjects('ID')">by ID</option>
  </select></form></td>
  <td valign="top" width="1%" NOWRAP><a href="javascript:addObject();" target="_self" class="thebutton" ><img border="0" src="images/add.gif" alt="add"> Add </a></td>
  </TR>
</TABLE>

</body>
</html>
<SCRIPT>
