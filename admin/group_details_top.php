<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php

$ID = $_REQUEST[ 'ID' ];
$sel_item = $_REQUEST["sel_item"];
$group_name =  $_REQUEST["group_name"];

if(!$sel_item)
{
$sel_item=1;
}
?>
<html>
<head>
	<title>Untitled</title>
<SCRIPT language="javascript" type="text/javascript">
<!--
function rupdate()
{
	var chckFrame = true;

	for(i = 0; i<parent.frames.length;i++){
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				chckFrame = false;
				//break;
		}
	}

if(chckFrame){
alert("Record Saved");
top.rmain.details.edit_main.document.editForm.formAction.value="UPDATE";
top.rmain.details.edit_main.document.editForm.submit();
}
}

function rdelete()
{
	var chckFrame = true;

	for(i = 0; i<parent.frames.length;i++){
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				chckFrame = false;
				//break;
		}
	}

	if(chckFrame){
		a = confirm("Do You Really Want To Delete ?");
			if(a){
				alert("Deleted");
				top.top1.currGroup=null;
				top.rmain.details.edit_main.document.editForm.formAction.value="DELETE";
				top.rmain.details.edit_main.document.editForm.submit();
			}
	}
}
function custometabs2(tabid)
{
document.getElementById('group_prop_tab1').className='mytablinknotselected';
document.getElementById('group_prop_tab2').className='mytablinknotselected';
document.getElementById('group_prop_tab3').className='mytablinknotselected';

document.getElementById( tabid          ).className='mytablinkselected';
}
-->
</SCRIPT>

<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP"><IMG SRC="images/edit_groups.gif" ALIGN="absmiddle"> &nbsp;</TD>
<?php
/*
    <TD COLSPAN="2" VALIGN="TOP">
<applet Code="apTabMenu" Archive="apTabMenu.jar" Width=400 Height=22 MAYSCRIPT>
<param name="Copyright" value="Apycom Software - www.apycom.com">
<param name="bottomLine" value="true">
<param name="pressedItem" value="<?php echo $sel_item; ?>">
<param name="tabType" value="0"> 
<param name="backColor" value="336699">
<param name="tabColor" value="93BEE2">
<param name="tabHighColor" value="93BEE2">
<param name="fontColor" value="666699">
<param name="fontHighColor" value="000000">
<param name="font" value="Arial,11,1">
<param name="menuItems" value="
      {Group Properties,group_details.php?ID=<?php echo $ID;?>,edit_main,_}
      {Sub-Group Properies,subgroup_details.php?gID=<?php echo $ID;?>,edit_main,_}	    	  
	  {Assign Courses,assign_courses.php?gID=<?php echo $ID;?>&group_name=<?php echo $group_name; ?>,edit_main,_}
      ">
</applet>
    </TD>
	*/
	?>
	<td colspan="2" valign="top" align="left"><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
	  <TR>
	 <TD ALIGN="center" VALIGN="TOP" NOWRAP ><a id="group_prop_tab1" href="group_details.php?ID=<?php echo $ID;?>" onClick="custometabs2('group_prop_tab1')" target="edit_main" class="mytablinknotselected" >Group Properties</a></TD>
	<td ALIGN="center" VALIGN="TOP" NOWRAP ><a id="group_prop_tab2" href="subgroup_details.php?gID=<?php echo $ID;?>" onClick="custometabs2('group_prop_tab2')"  target="edit_main" class="mytablinknotselected">Sub-Group Properies</a></TD>
	<td ALIGN="center" VALIGN="TOP" NOWRAP ><a id="group_prop_tab3" href="assign_courses.php?gID=<?php echo$ID;?>&group_name=<?php echo $group_name;?>" onClick="custometabs2('group_prop_tab3')"  target="edit_main" class="mytablinkselected">Assign Courses</a></TD>
	</TR></TABLE></td>
<TD ROWSPAN="2" VALIGN="TOP" width="99%">&nbsp;</TD>
  </TR>
  <TR>
<?php
/*
<TD VALIGN="MIDDLE">&nbsp;
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 220" Height = "22" MAYSCRIPT>   
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
		  {Save Group,javascript:1,_self,images/save.gif}    		
		  {Delete Group,javascript:2,_self,images/delete.gif} 		  
		">
		<param name="javascript:1" value="rupdate();">
		<param name="javascript:2" value="rdelete();">
		</applet>

</TD>
*/
?>
<td><TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR><TD VALIGN="MIDDLE" nowrap="nowrap" width="1%"><a href="javascript:rupdate();" class="thebutton"><img border="0" src="images/save.gif" alt="Save Group"> Save Group</a> 
</TD>
<td nowrap="nowrap" width="1%">
<a href="javascript:rdelete();" class="thebutton"><img src="images/delete.gif" border="0" alt="Delete Group"> Delete Group</a>
</TD>
</TR></TABLE></td>
<TD ALIGN="RIGHT">&nbsp;</TD>
  </TR>
</TABLE>

</body>
</html>
<SCRIPT>
