<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<SCRIPT language="javascript" type="text/javascript">
<!--
function objReload(sp)
{
top.top1.objReload(sp);
}

function addObject()
{
window.open('create_'+top.top1.currobject+'.php?subaction=spAdd','ttt','height=50,width=50');
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
//-->
</SCRIPT>	

<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="100%">
  <TR>
    <TD COLSPAN="3">&nbsp;
    </TD>
  </TR>
  <TR>
  <?php
  /*
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
		  {|By Created,javascript:2,_,_}   
		  {|By Modified,javascript:3,_,_}  
		  {|By ID,javascript:4,_,_}  
	 	  { Add ,javascript:5,_self,images/add.gif}   
	 	  { Find ,search.php,_self,images/search.gif}  	
		">
		<param name="javascript:1" value="parent.object_main.orderObjects('name')">
		<param name="javascript:2" value="parent.object_main.orderObjects('created')">
		<param name="javascript:3" value="parent.object_main.orderObjects('modified')">
		<param name="javascript:4" value="parent.object_main.orderObjects('ID')">
		<param name="javascript:5" value="addObject();">
		<param name="javascript:6" value="objectTree();">
	  </applet>
	  */
	  ?>

<!--<td width="1%"><form name="form1">
  <select name="menu1" onChange="jumpMenu(this,0)">
    <option value="" selected="selected">order</option>
    <option value="javascript:parent.object_main.orderObjects('name');">by name</option>
    <option value="javascript:parent.object_main.orderObjects('created')">by created</option>
    <option value="javascript:parent.object_main.orderObjects('modified')">by modified</option>
    <option value="javascript:parent.object_main.orderObjects('ID')">by ID</option>
  </select></form></td>
  <td valign="top" width="1%" NOWRAP><a href="javascript:addObject();" target="_self" class="thebutton" ><img border="0" src="images/add.gif" alt="add"> Add </a></td>
 <?php
  /*
  <td><a href="search.php" target="_self" class="thebutton" ><img src="images/search.gif" border="0" alt="Find"> Find </a></td>
  */
  ?>
<!--<A HREF="#" onClick="objectTree();"><img src="images/obtree_on.gif" border="0"></A>-->
<TD ALIGN="RIGHT" NOWRAP valign="top">&nbsp;</TD>
  <?php
  /*
  <TD ALIGN="RIGHT" NOWRAP valign="top" width="1%">
<a href="javascript:top.top1.closeObman();" class="thebutton" style="width:16px;"><img src="images/x2.gif" alt="" width="16" height="16" border="0" ></a></TD>
 */
  ?>
  </TR>
</TABLE>

</body>
</html>
<SCRIPT>
