<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<SCRIPT>
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
	top.rmain.edit_main.document.editForm.formAction.value="UPDATE";
	top.rmain.edit_main.document.editForm.submit();
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
					top.rmain.edit_main.document.editForm.formAction.value="DELETE";
					top.top1.currtopic=null;
					top.rmain.edit_main.document.editForm.submit();
			}
	}
}
</SCRIPT>
</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP"><IMG SRC="images/edit_lms_prop.gif" ALIGN="absmiddle"> &nbsp;</TD>
    <TD COLSPAN="2" VALIGN="TOP">
<applet Code="apTabMenu" Archive="apTabMenu.jar" Width=350 Height=22 MAYSCRIPT>
<param name="Copyright" value="Apycom Software - www.apycom.com">
<param name="bottomLine" value="true">
<param name="pressedItem" value="1">
<param name="tabType" value="0"> 
<param name="backColor" value="336699">
<param name="tabColor" value="93BEE2">
<param name="tabHighColor" value="93BEE2">
<param name="fontColor" value="666699">
<param name="fontHighColor" value="000000">
<param name="font" value="Arial,11,1">
<param name="menuItems" value="
      {Properties,edit_lms_properties.php,edit_main,_}
      {Registration Form,edit_lms_form.php,edit_main,_}	    	  
      {Forums,edit_lms_forums.php,edit_main,_}	  
      ">
</applet>
    </TD>
  </TR>
  <TR>
<TD VALIGN="MIDDLE">&nbsp;
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 120" Height = "22" MAYSCRIPT>   
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
		  {Save Properties,javascript:1,_self,images/save.gif}    		
		">
		<param name="javascript:1" value="rupdate();">
		<param name="javascript:2" value="rdelete();">
		</applet>


</TD>
<TD ALIGN="RIGHT">

</TD>

  </TR>
</TABLE>

</body>
</html>
<SCRIPT>
