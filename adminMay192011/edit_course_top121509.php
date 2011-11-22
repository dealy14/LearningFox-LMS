<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php 

/*
<applet Code="apTabMenu" Archive="apTabMenu.jar" Width=350 Height=22 MAYSCRIPT>
<param name="Copyright" value="Apycom Software - www.apycom.com">
<param name="bottomLine" value="true">
<param name="pressedItem" value="<?php echo $selectedTab;?>">
<param name="tabType" value="0"> 
<param name="backColor" value="336699">
<param name="tabColor" value="93BEE2">
<param name="tabHighColor" value="93BEE2">
<param name="fontColor" value="666699">
<param name="fontHighColor" value="000000">
<param name="font" value="Arial,11,1">
<param name="menuItems" value="
      {Properties,edit_course_bottom.php?ID=<?php echo $ID;?>,edit_main,_}
      {Layout,edit_course_layout.php?ID=<?php echo $ID;?>,edit_main,_}	    	  
	  {Lessons,edit_course_torder.php?ID=<?php echo $ID;?>,edit_main,_}	
      {Publish,edit_course_publish.php?ID=<?php echo $ID;?>,edit_main,_}	
      ">
</applet>
	  */
	  ?>
	  <?php
/*
<applet Code="apPopupMenu" Archive="apPopupMenu.jar" Width = 200" Height = "22" MAYSCRIPT>   
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
		  {Save Course,javascript:1,_self,images/save.gif}    		
		  {Delete Course,javascript:2,_self,images/delete.gif} 
		" >
		<param name="javascript:1" value="rupdate();">
		<param name="javascript:2" value="rdelete();">
		</applet>
*/
?>
<html>
<head>
	<title>Untitled</title>
<SCRIPT language="javascript">
<!--
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
		//alert('alert2');
		
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
				top.top1.currcourse=null;
				top.rmain.edit_main.document.editForm.submit();
				alert("Deleted");
		}
	}
}
-->
</SCRIPT>


<link href="style.css" rel="stylesheet" type="text/css">

</head>

<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" width="100%" height="41">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP" width="57" height="41"><IMG SRC="images/edit_course.gif" width="57" height="41" ALIGN="absmiddle"> &nbsp;</TD>
    <TD COLSPAN="2" VALIGN="TOP"><B>Properties</B></TD>
<TD ROWSPAN="2" VALIGN="TOP" width="879">&nbsp;</TD>
  </TR>
  <TR>
<TD VALIGN="MIDDLE" nowrap="nowrap" width="114"><a href="javascript:rupdate();" class="thebutton"><img border="0" src="images/save.gif" alt="save course"> Save</a></TD>
<TD nowrap="nowrap" width="123" valign="middle">
<a href="javascript:rdelete();" class="thebutton"><img src="images/delete.gif" border="0" alt="Delete course">Delete Course</a></TD>
<TD nowrap="nowrap" width="78" valign="middle">
<a href="content-preview.php?ref=<?php echo $_REQUEST['ID'];?>" class="thebutton" target="_blank"><!--<img src="images/delete.gif" border="0" alt="Delete course">--> Preview</a></TD>
</TR>
</TABLE>

</body>
</html>
<SCRIPT>
