<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php

$ID = $_REQUEST[ 'ID' ];
$sel_item = $_REQUEST["sel_item"];

if(!$sel_item)
{
$sel_item=1;
}
?>
<html>
<head>
	<title>Untitled</title>
<SCRIPT type="text/javascript" language="javascript">
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
top.rmain.details.edit_main.document.editForm.formAction.value="SAVE";
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
				top.top1.currTest=null;
				top.rmain.details.edit_main.document.editForm.formAction.value="DELETE";
				top.rmain.details.edit_main.document.editForm.submit();
		}
	}
}
function custometabs2(tabid)
{
document.getElementById('test_prop_tab1').className='mytablinknotselected';
document.getElementById('test_prop_tab2').className='mytablinknotselected';

document.getElementById( tabid          ).className='mytablinkselected';
}
-->
</SCRIPT>

<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body BGCOLOR="#93BEE2" TOPMARGIN="0" RIGHTMARGIN="0" LEFTMARGIN="0">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD ROWSPAN="2" VALIGN="TOP" width="57" height="41" ><IMG SRC="images/edit_tests.gif" width="57" height="41" ALIGN="absmiddle"> &nbsp;</TD>

 <TD ALIGN="center" VALIGN="TOP" NOWRAP ><a id="test_prop_tab1" href="test_details.php?ID=<?php echo $ID;?>" onClick="custometabs2('test_prop_tab1')" target="edit_main" class="mytablinkselected" >Survey Properties</a></TD>
	<td ALIGN="center" VALIGN="TOP" NOWRAP ><a id="test_prop_tab2" href="test_questions.php?ID=<?php echo $ID;?>" onClick="custometabs2('test_prop_tab2')"  target="edit_main" class="mytablinknotselected">Survey Questions</a></TD>
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
		  {Save Test,javascript:1,_self,images/save.gif}    		
		  {Delete Test,javascript:2,_self,images/delete.gif} 		  
		">
		<param name="javascript:1" value="rupdate();">
		<param name="javascript:2" value="rdelete();">
		</applet>
</TD>
*/
?>
<TD VALIGN="MIDDLE" nowrap="nowrap" width="1%"><a href="javascript:rupdate();" class="thebutton"><img border="0" src="images/save.gif" alt="save Test"> Save Survey</a></TD>
<td nowrap="nowrap" width="1%">
<a href="javascript:rdelete();" class="thebutton"><img src="images/delete.gif" border="0" alt="Delete Test"> Delete Survey</a></TD>
</TR>
</TABLE>

</body>
</html>
<SCRIPT>
