<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php

/*
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 110" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {Add Objectives,create_objects_sql.php?action=objective&course_ID=<?php echo $ID;?>,edit_post,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>
//

		<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 110" Height = "22" MAYSCRIPT>   
		<param name="Copyright" value="Apycom Software - www.apycom.com">
		<param name="isHorizontal" value="true">
		<param name="3DBorder" value="false">
		<param name="systemSubFont" value="true">
		<param name="solidArrows" value="false">
		<param name="buttonType" value="1">	         	
		<param name="status" value="link">
		<param name="alignText" value="left">		         		
		<param name="backColor" value="EFF7FF">
		<param name="backHighColor" value="EFF7FF">
		<param name="fontColor" value="000000">
		<param name="fontHighColor" value="000000">
		<param name="font" value="VERDANA,10,1">
		<param name="menuItems" value="
		  {Add References,create_objects_sql.php?action=ref&course_ID=<?php echo $ID;?>,edit_post,images/import.gif}    		
		">
		<param name="javascript:1" value="opentAdd();">
		</applet>

*/

?>
<html>
<head>

<!--
<SCRIPT>
top.top1.courseItemSelect=1;
</SCRIPT>
-->

<script>
function rupdate()
{
	//var chckFrame = true;
	var chckFrame = true;
	//alert(parent.frames.length);
	/*
	for(i = 0; i<parent.frames.length;i++){
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				//chckFrame = false;
				chckFrame = 'wala';
				//break;
		}
	}*/
	
	
	
	if(chckFrame){
		/*
		top.rmain.edit_main.document.editForm.formAction.value="UPDATE";
		top.rmain.edit_main.document.editForm.submit();
		*/
		//document.getElementById('cidv').value
		top.rmain.edit_main.document.editForm.formAction.value="UPDATE";
		top.rmain.edit_main.document.editForm.submit();
		
	}
	
}

function rdelete()
{
	var chckFrame = true;
	//alert(parent.frames.length);
	/*
	for(i = 0; i<parent.frames.length;i++){
		//alert(i);
		pageName = parent.frames.item(i).location.href.substr(parent.frames.item(i).location.href.lastIndexOf("/")+1,parent.frames.item(i).location.href.length);
		//alert(pageName);
		if(pageName=="blank.php"  && parent.frames.item(i).name === "edit_main"){
				chckFrame = false;
				//break;
		}
	}
	*/
	if(chckFrame){
		a = confirm("Do You Really Want To Delete ?");
		if(a){
				
				top.rmain.edit_main.document.editForm.formAction.value="DELETE";
				//top.top1.currcourse=null;
				top.rmain.edit_main.document.editForm.submit();
				alert("Deleted");
		}
	}
}
</script>

<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<?php
$ID = $_REQUEST['ID'];
$getID = explode('a',$ID);
$ID = $getID[1];
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="100%" height="41">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP" width="57" height="41"><IMG SRC="images/edit_course.gif" width="57" height="41" ALIGN="absmiddle"> &nbsp;</TD>
    <TD COLSPAN="2" VALIGN="TOP"><B>Properties</B></TD>
<TD ROWSPAN="2" VALIGN="TOP" width="879">&nbsp;</TD>
  </TR>
  <TR>
<TD VALIGN="MIDDLE" nowrap="nowrap" width="114"><a href="javascript:rupdate();" class="thebutton"><img border="0" src="images/save.gif" alt="save course"> Save</a></TD>
<TD nowrap="nowrap" width="123" valign="middle">
<a href="javascript:rdelete();" class="thebutton"><img src="images/delete.gif" border="0" alt="Delete course">Delete</a></TD>
<TD nowrap="nowrap" width="78" valign="middle">
<a href="asset-preview.php?ref=<?php echo $ID;?>" class="thebutton" target="_blank"><img src="images/delete.gif" border="0" alt="Delete course"> Preview</a></TD>
</TR>
</TABLE>

</body>
</html>
